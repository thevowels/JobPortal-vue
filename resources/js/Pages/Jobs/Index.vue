<script setup>

import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import JobCard from "@/Components/Jobs/JobCard.vue";
import {Button} from "@/components/ui/button/index.js";
import {
    Breadcrumb, BreadcrumbItem,
    BreadcrumbLink,
    BreadcrumbList,
    BreadcrumbPage,
    BreadcrumbSeparator
} from "@/components/ui/breadcrumb/index.js";

import {useForm, usePage} from "@inertiajs/vue3"
import {Card} from "@/components/ui/card/index.js";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import {RadioGroup, RadioGroupItem} from "@/components/ui/radio-group/index.js";
import FormTextInput from "@/Components/FormTextInput.vue";

const props = defineProps(['jobs','categories', 'experiences']);
const query = usePage().props.query;
const form = useForm({
    'search': query.search || '',
    'experience': query.experience || '',
    'category': query.category || '',
    'min_salary': query.min_salary || '',
    'max_salary': query.max_salary || '',
})

const handleFilter = () => {
    form.get(route('jobs.index'), {
        preserveScroll: true,
        preserveState: true,
    });
}
</script>


<template>
    <Head title="Jobs" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                <Breadcrumb>
                    <BreadcrumbList>
                        <BreadcrumbItem>
                            <BreadcrumbLink href="/">
                                Home
                            </BreadcrumbLink>
                        </BreadcrumbItem>
                        <BreadcrumbSeparator />
                        <BreadcrumbItem>
                            <BreadcrumbPage>Jobs</BreadcrumbPage>
                        </BreadcrumbItem>
                    </BreadcrumbList>
                </Breadcrumb>
            </h2>
        </template>
        <div class="">
            <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <Card>
                                <form @submit.prevent="handleFilter">
                                    <div class="grid grid-cols-2 justify-between items-center p-3 gap-3">
                                        <div>
                                            <InputLabel class="text-slate-900 font-bold" for="search" value="Search"/>
                                            <FormTextInput  v-model="form.search" type="text" id="search" class="w-full" @submit="handleFilter"/>
                                        </div>
                                        <div>
                                            <InputLabel>Salary</InputLabel>
                                            <div class="flex justify-between items-center space-x-3">
                                                <FormTextInput  v-model="form.min_salary" type="text" id="min_salary" class="w-full" placeholder="From" @submit="handleFilter"/>
                                                <FormTextInput  v-model="form.max_salary" type="text" id="max_salary" class="w-full" placeholder="To" @submit="handleFilter"/>
                                            </div>
                                        </div>
                                        <div class="p-4">
                                            <RadioGroup default-value="" v-model="form.experience" @update:model-value="handleFilter">
                                                <div class="flex items-center space-x-2">
                                                    <RadioGroupItem id="all" value='' />
                                                    <Label for="all">All </Label>
                                                </div>
                                                <div v-for="experience in experiences" :key="experience" class="flex items-center space-x-2">
                                                    <RadioGroupItem :id=experience :value=experience />
                                                    <Label :for=experience>{{experience}}</Label>
                                                </div>
                                            </RadioGroup>
                                        </div>
                                        <div class="p-4">
                                            <RadioGroup default-value="" v-model="form.category" @update:model-value="handleFilter">
                                                <div class="flex items-center space-x-2">
                                                    <RadioGroupItem id="all" value='' />
                                                    <Label for="all">All </Label>
                                                </div>
                                                <div v-for="category in categories" :key="category" class="flex items-center space-x-2">
                                                    <RadioGroupItem :id=category :value=category />
                                                    <Label :for=category>{{category}}</Label>
                                                </div>
                                            </RadioGroup>
                                        </div>
                                        <div class="col-span-2">
                                            <Button variant="outline" class="w-full">Search</Button>
                                        </div>

                                    </div>
                                </form>
                        </Card>
                        <ul>
                            <li v-for="job in jobs" :key="job.id"  >
                                <JobCard :job="job" class="mt-4">
                                    <p class=" whitespace-pre-wrap line-clamp-3">{{job.description}}</p>
                                    <Button as-child>
                                        <a :href="route('jobs.show', job.id)">See more</a>
                                    </Button>
                                </JobCard>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
