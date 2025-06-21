<script setup>

import {
    Breadcrumb,
    BreadcrumbItem,
    BreadcrumbLink,
    BreadcrumbList, BreadcrumbPage,
    BreadcrumbSeparator
} from "@/components/ui/breadcrumb/index.js";

import {Button} from "@/components/ui/button/index.js";
import {Head, Link} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import JobCard from "@/Components/Jobs/JobCard.vue";
import {Card, CardHeader, CardContent} from "@/components/ui/card/index.js";
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";


dayjs.extend(relativeTime);

defineProps(['job','jobApplications'])
</script>

<template>
    <Head title="Candidates Management"/>
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Candidates Management
            </h2>
        </template>

        <div class="max-w-4xl mx-auto">
            <div>
                <JobCard :job="job"/>
            </div>
            <div class="mt-4 border rounded-md  border-slate-400 shadow-lg ">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200 m-4 font-inter"
                >
                    Candidates Management
                </h2>
                <div >
                    <div v-for="jobApplication in jobApplications">
                        <Card class="m-4">
                            <CardHeader>
                                <div class="flex justify-between">
                                    <h1 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                        {{jobApplication.user.name}}
                                    </h1>
                                    <h1>
                                        {{ dayjs(jobApplication.created_at).fromNow() }}
                                    </h1>
                                </div>
                            </CardHeader>
                            <CardContent>
                                <div class="text-gray-600 dark:text-gray-400">
                                    <p class="mb-2">Email: {{jobApplication.user.email}}</p>
                                    <!-- <p class="mb-2">Phone: {{jobApplication.user.phone}}</p> -->
                                    <!-- <p class="mb-2">Resume: <a :href="jobApplication.resume" target="_blank" class="text-blue-500 hover:underline">View Resume</a></p> -->
                                </div>
                                <div class="flex justify-end mt-4">
                                    <Button class="bg-blue-500 text-white hover:bg-blue-600" as-child>
                                        <Link :href="route('jobs.application.show', jobApplication)">View Application</Link>
                                    </Button>
                                </div> 
                            </CardContent>
                        </Card>

                    </div>

                </div>

            </div>
        </div>

    </AuthenticatedLayout>

</template>
