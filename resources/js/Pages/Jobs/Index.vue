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

import {usePage} from "@inertiajs/vue3"
import IndexFilter from "@/Components/Jobs/IndexFilter.vue";

const props = defineProps(['jobs','categories', 'experiences']);

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
                        <IndexFilter :categories="categories" :experiences="experiences"/>
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
