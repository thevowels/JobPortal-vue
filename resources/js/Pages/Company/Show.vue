<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {
    Breadcrumb,
    BreadcrumbItem, BreadcrumbLink,
    BreadcrumbList,
    BreadcrumbPage,
    BreadcrumbSeparator
} from "@/components/ui/breadcrumb/index.js";
import {Button} from "@/components/ui/button/index.js";
import JobCard from "@/Components/Jobs/JobCard.vue";
import {Link} from "@inertiajs/vue3";

defineProps(['company', 'jobs']);
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
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
                                <BreadcrumbPage class="font-bold text-slate-800">{{company.name}}</BreadcrumbPage>
                            </BreadcrumbItem>
                        </BreadcrumbList>
                    </Breadcrumb>
                </h2>
                <div>
                    <Button variant="outline" class="bg-slate-300" >
                      <Link :href="route('jobs.create', company)">Ceate New Job</Link>
                    </Button>
                </div>
            </div>
        </template>
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="p-4 text-white font-bold bg-gradient-to-r from-slate-400 to-slate-200 border rounded-lg">
                        Available jobs
                    </div>
                    <ul>
                        <li v-for="job in jobs" :key="job.id"  >
                            <JobCard :job="job" class="mt-4">
                                <p class=" whitespace-pre-wrap line-clamp-3">{{job.description}}</p>
                                <Button as-child variant="outline" class="bg-slate-200 shadow-lg border-slate-300">
                                    <Link :href="route('jobs.show', job.id)" >See more</Link>
                                </Button>
                            </JobCard>
                        </li>
                    </ul>

                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
