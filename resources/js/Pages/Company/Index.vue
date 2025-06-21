<script setup>

import {Head, Link} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {
    Breadcrumb,
    BreadcrumbItem,
    BreadcrumbLink,
    BreadcrumbList,
    BreadcrumbPage, BreadcrumbSeparator
} from "@/components/ui/breadcrumb/index.js";
import {Button} from "@/components/ui/button/index.js";
import JobCard from "@/Components/Jobs/JobCard.vue";

const props = defineProps(['jobs']);
</script>

<template>
    <Head title="Jobs" />
    <AuthenticatedLayout>
        <template #header>
            <div
                class="flex justify-between"
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
                            <BreadcrumbPage>My Jobs</BreadcrumbPage>
                        </BreadcrumbItem>
                    </BreadcrumbList>
                </Breadcrumb>
                <div>
                    <Button class="bg-slate-50 text-slate-800" as-child>
                        <Link :href="route('my-jobs.create')">Add New </Link>
                    </Button>
                </div>
            </div>
        </template>
        <div>
            <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <ul v-if="jobs.length">
                            <li v-for="job in jobs" :key="job.id"  >
                                <JobCard :job="job" class="mt-4">
                                    <div class="text-xs">
                                        <div v-if="job.job_applications.length" v-for="application in job.job_applications">
                                            <div class="flex mb-4 items-center justify-between">
                                                <div>
                                                    <div> {{application.user.name}}</div>
                                                    <div>
                                                        Applied {{application.created_at}}
                                                    </div>
                                                    <div>
                                                        $ {{Number(application.expected_salary).toLocaleString()}}
                                                    </div>

                                                </div>
                                                <div>
                                                    <Button as-child variant="outline">
                                                        <a :href="route('downloadApplicantcv',application.id)" as="button">
                                                            Download CV
                                                        </a>
                                                    </Button>
                                                    <Button as-child variant="outline">
                                                        <a :href="route('viewApplicantcv',application.id)" target="_blank" as="button">
                                                            View  CV
                                                        </a>

                                                    </Button>

                                                </div>
                                            </div>
                                        </div>
                                        <div v-else class="text-center">
                                            No Applications Yet.
                                        </div>
                                        <div class="flex space-x-2 items-baseline justify-between">
                                            <Button as-child variant="outline">
                                                <Link :href="route('my-jobs.edit', job)">Edit</Link>
                                            </Button>
                                            <Button as-child variant="outline">
                                                <Link :href="route('my-jobs.manage', job)">Manage</Link>
                                            </Button>
                                        </div>
                                    </div>
                                </JobCard>
                            </li>
                        </ul>
                        <div v-else class="rounded-md border border-dashed border-slate-300 p-8">
                            <div class="text-center font-medium">
                                No Jobs Yet!.
                            </div>
                            <div class="text-center">
                                Post your first Job <Link class="text-indigo-700 hover:underline hover:text-indigo-500" :href="route('my-jobs.create')">here!</Link>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
