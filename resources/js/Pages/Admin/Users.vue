<script setup>

import AppSidebar from "@/Components/Admin/AppSidebar.vue";
import { SidebarProvider, SidebarTrigger } from "@/components/ui/sidebar";
import {Button} from "@/components/ui/button/index.js";
import { SearchIcon, ChevronDownIcon} from "lucide-vue-next";
import {Input} from "@/components/ui/input/index.js";
import {router, usePage} from '@inertiajs/vue3'
import {Badge} from "@/components/ui/badge/index.js";
import DataTableHeader from "@/Components/Admin/DataTableHeader.vue";
import {DropdownMenuCheckboxItem} from "@/components/ui/dropdown-menu/index.js";
import {reactive, watch, ref} from "vue";
import { RangeCalendar } from '@/components/ui/range-calendar'
import { getLocalTimeZone, today, parseDate } from '@internationalized/date'


import dayjs from "dayjs";

const props = defineProps(['users'])

const query = new URLSearchParams(window.location.search)
const page = usePage();

const path = page.url.split('?')[0];
const sortKey = query.get('sortKey');
const sortOrder = query.get('sortOrder');

const parseFrom = (date) => {
    try {
        return parseDate(query.get(date))
    }catch{
        query.delete(date);
        router.visit(`${path}?${query}`,{
            only: ['users'],
            preserveScroll: true,
            preserveState: true
        })

        return null;
    }
}

const dateRange = ref({
    start: query.has('from') ? parseFrom('from') : null,
    end : query.has('to') ?  parseFrom('to') : null,
//     TODO: if to and from data are incorrect, parseDate throws error need to fix later
});


const selectedRoles = reactive({
    'admin': true,
    'recruiter':true,
    'candidate': true
});

const selectedStatus = reactive({
    'active':true,
    'inactive':true
});

const doRangeFilter = () => {
    query.delete('page');

    dateRange.value.start &&  query.set('from', dateRange.value.start);
    !dateRange.value.start && query.delete('from');
    dateRange.value.end && query.set('to', dateRange.value.end);
    !dateRange.value.end && query.delete('to');

    router.visit(`${path}?${query}`,{
        only: ['users'],
        preserveScroll: true,
        preserveState: true
    })
}

watch(() => ({...dateRange.value}),
    doRangeFilter,
    {deep:true}
)

const doSelection = () => {
    query.delete('page');
    const roles = Object.keys(selectedRoles).filter(k => selectedRoles[k])
    const status = Object.keys(selectedStatus).filter(k => selectedStatus[k])

    query.set('roles',roles.join(','));
    query.set('status', status.join(','));

    router.visit(`${path}?${query}`,{
        only: ['users'],
        preserveScroll: true,
        preserveState: true
    })
}

watch( () => ({...selectedRoles, ...selectedStatus}),
    doSelection,
    {deep:true}
);


import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'

import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'

import {
    Pagination,
    PaginationContent,
    PaginationItem,
} from '@/components/ui/pagination'
import {Popover, PopoverAnchor, PopoverContent, PopoverTrigger} from "@/components/ui/popover/index.js";
import UserStatusSwitch from "@/Components/Admin/UserStatusSwitch.vue";
import Banner from "@/Components/Banner.vue";


const doSearch = (e) => {
    query.set('search', e.target.value);
    query.delete('page');

    router.visit(`${path}?${query}`, {
        only: ['users'],
        preserveScroll: true
    })
}

</script>

<template>
    <Banner class="max-w-full"/>
    <SidebarProvider >
        <AppSidebar />
        <div class="px-4 to-indigo-200 from-slate-200 bg-gradient-to-r w-full font-inter">
            <header class="mt-8">
                <SidebarTrigger/>
                <div class="flex  justify-between">
                    <h1 class=" text-4xl font-semibold">
                        Users
                    </h1>
                    <div>
                        <Button variant="outline">Export</Button>
                    </div>
                </div>
            </header>
            <div class="flex mt-4  w-full bg-indigo-200 rounded-lg items-center relative">
                <SearchIcon class="absolute top-4.5 left-2"/>
                <Input :model-value="query.get('search')" class="pl-8 py-5 rounded-lg" @keyup.enter="doSearch" />
            </div>
            <div class="mt-8 flex gap-4">
                <DropdownMenu>
                    <DropdownMenuTrigger class="bg-white px-3 py-2 rounded-lg shadow-md flex gap-2">
                        Role
                        <ChevronDownIcon/>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent>
                        <DropdownMenuLabel>Role</DropdownMenuLabel>
                        <DropdownMenuSeparator />
                        <DropdownMenuCheckboxItem :model-value="selectedRoles.admin"  @select="() => selectedRoles.admin = !selectedRoles.admin">
                            Admin
                        </DropdownMenuCheckboxItem>
                        <DropdownMenuCheckboxItem :model-value="selectedRoles.recruiter" @select="() => selectedRoles.recruiter = !selectedRoles.recruiter">
                            Recruiter
                        </DropdownMenuCheckboxItem>
                        <DropdownMenuCheckboxItem :model-value="selectedRoles.candidate" @select="() => selectedRoles.candidate = !selectedRoles.candidate">
                            Candidate
                        </DropdownMenuCheckboxItem>
                    </DropdownMenuContent>
                </DropdownMenu>
                <DropdownMenu>
                    <DropdownMenuTrigger class="bg-white px-3 py-2 rounded-lg shadow-md flex gap-2">
                        Status
                        <ChevronDownIcon/>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent>
                        <DropdownMenuLabel>Status</DropdownMenuLabel>
                        <DropdownMenuSeparator />
                        <DropdownMenuCheckboxItem :model-value="selectedStatus.active" @select="() => {selectedStatus.active = !selectedStatus.active; }">
                            Active
                        </DropdownMenuCheckboxItem>
                        <DropdownMenuCheckboxItem :model-value="selectedStatus.inactive" @select="() => selectedStatus.inactive = !selectedStatus.inactive">
                            Inactive
                        </DropdownMenuCheckboxItem>
                    </DropdownMenuContent>
                </DropdownMenu>
                <DropdownMenu>
                    <DropdownMenuTrigger class="bg-white px-3 py-2 rounded-lg shadow-md flex gap-2">
                        {{dateRange.start ? ( `From ${dateRange.start } To ${dateRange.end}`) : ' Select Date Range' }}
                        <ChevronDownIcon/>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent>
                        <RangeCalendar v-model="dateRange" class="rounded-md"/>
                        <div class="text-right">
                            <Button @click="() => {dateRange.start=null; dateRange.end=null;}">
                                Clear
                            </Button>
                        </div>
                    </DropdownMenuContent>
                </DropdownMenu>

            </div>
            <div class="m-4 p-4 bg-white rounded-md ">

                <Table>
                    <TableCaption>Manage all your users here.</TableCaption>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="w-[300px]">
                                <DataTableHeader label="Name" name="name" :sortOrder="sortKey === 'name' ? sortOrder : null " />
                            </TableHead>
                            <TableHead>
                                <DataTableHeader label="Email" name="email" :sortOrder="sortKey === 'email' ? sortOrder : null " />
                            </TableHead>
                            <TableHead class="text-center">
                                Role
                            </TableHead>
                            <TableHead >
                                Status
                            </TableHead>
                            <TableHead >
                                <DataTableHeader label="Created Date" name="created_at" :sortOrder="sortKey === 'created_at' ? sortOrder : null " />

                            </TableHead>
                            <TableHead class="w-[50px]">
                                Actions
                            </TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="user in users.data" :key="user.id">
                            <TableCell class="font-medium">
                                {{ user.name }}
                            </TableCell>
                            <TableCell>{{ user.email }}</TableCell>
                            <TableCell class="text-center">
                                <Badge class="bg-slate-200 text-black px-8  py-2 text-base ">
                                    {{user.role || 'Recruiter'}}
                                </Badge>
                            </TableCell>
                            <TableCell >
                                <Badge class="bg-slate-200 text-black px-8  py-2 text-base ">
                                    {{user.status}}
                                </Badge>
                            </TableCell>
                            <TableCell >
                                {{dayjs(user.created_at).format('DD MMM YYYY') }}
                            </TableCell>
                            <TableCell  >
                                <DropdownMenu>
                                    <DropdownMenuTrigger>Open</DropdownMenuTrigger>
                                    <DropdownMenuContent class="space-y-2 bg-slate-300">
                                        <DropdownMenuItem as-child>
                                            <UserStatusSwitch  :user="user"/>
                                        </DropdownMenuItem>
                                        <DropdownMenuItem as-child>
                                            <Button variant="outline" class="w-full">
                                                Export data
                                            </Button>
                                        </DropdownMenuItem>
                                    </DropdownMenuContent>
                                </DropdownMenu>


                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
                <Pagination v-slot="{ page }" :items-per-page="users.per_page" :total="users.total" :default-page="users.current_page">
                    <PaginationContent>
                        <template v-for="(item, index) in users.links" :key="index">
                            <PaginationItem
                                :value="Number(item.label)"
                                :is-active="item.active"
                                @click="item.url && router.visit(item.url, {
                                    preserveScroll:true,
                                    preserveState: true,
                                    only: ['users']
                                })"
                            >
                                {{ item.label }}
                            </PaginationItem>
                        </template>
                    </PaginationContent>
                </Pagination>


            </div>
        </div>
    </SidebarProvider>

</template>
