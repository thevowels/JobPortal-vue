<script setup>

import AppSidebar from "@/Components/Admin/AppSidebar.vue";
import { SidebarProvider, SidebarTrigger } from "@/components/ui/sidebar";
import {Button} from "@/components/ui/button/index.js";
import { SearchIcon, ChevronDownIcon} from "lucide-vue-next";
import {Input} from "@/components/ui/input/index.js";
import {router, usePage} from '@inertiajs/vue3'
import { Checkbox } from '@/components/ui/checkbox'

import dayjs from "dayjs";
const props = defineProps(['users'])

const query = new URLSearchParams(window.location.search)
const page = usePage();

const path = page.url.split('?')[0];
const sortKey = query.get('sortKey');
const sortOrder = query.get('sortOrder');
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
    PaginationEllipsis,
    PaginationItem,
    PaginationNext,
    PaginationPrevious,
} from '@/components/ui/pagination'

import {Badge} from "@/components/ui/badge/index.js";
import DataTableHeader from "@/Components/Admin/DataTableHeader.vue";
import {DropdownMenuCheckboxItem} from "@/components/ui/dropdown-menu/index.js";

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
                        <Button variant="outline">Add User</Button>
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
                        <DropdownMenuCheckboxItem :model-value="true" >
                            Admin
                        </DropdownMenuCheckboxItem>
                        <DropdownMenuCheckboxItem>
                            Recruiter
                        </DropdownMenuCheckboxItem>
                        <DropdownMenuCheckboxItem>
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
                        <DropdownMenuCheckboxItem>Active</DropdownMenuCheckboxItem>
                        <DropdownMenuCheckboxItem>Inactive</DropdownMenuCheckboxItem>
                    </DropdownMenuContent>
                </DropdownMenu>
                <DropdownMenu>
                    <DropdownMenuTrigger class="bg-white px-3 py-2 rounded-lg shadow-md flex gap-2">
                        Date Joined
                        <ChevronDownIcon/>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent>
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
                                <Badge>
                                    {{user.role || 'Recruiter'}}
                                </Badge>
                            </TableCell>
                            <TableCell >
                                <Badge>
                                    Active
                                </Badge>
                            </TableCell>
                            <TableCell >
                                {{dayjs(user.created_at).format('DD MMM YYYY') }}
                            </TableCell>
                            <TableCell >
                               ...
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
