<script setup>

import {Head, Link, useForm} from "@inertiajs/vue3";
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
import {Card} from "@/components/ui/card/index.js";

const props = defineProps(['applications']);

const form = useForm();

const withdrawApplication = (applicationId) => {
    form.put(route('appliedJobs.withdraw', applicationId), {
        preserveScrolling: true,
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
                            <BreadcrumbPage>Applied Jobs</BreadcrumbPage>
                        </BreadcrumbItem>
                    </BreadcrumbList>
                </Breadcrumb>
            </h2>
        </template>
        <div class="">
            <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <Card class="py-4 px-8 font-semibold text-xl bg-gradient-to-r from-slate-300 to-slate-100 mb-8">Your Job Applications</Card>
                        <ul v-if="applications.length">
                            <li v-for="application in props.applications" class="mb-3">
                                <JobCard :job="application.job">
                                    <div class="flex items-center justify-between text-slate-500">
                                        <div class="">
                                            <div>
                                                Applied {{ application.created_at}}
                                            </div>
                                            <div>
                                                Other applicants:  {{application.job.job_applications_count}}
                                            </div>
                                        </div>
                                        <div class="flex ">
                                            <div class="grid grid-cols-2">
                                                <div class="">
                                                    Your expected salary
                                                </div>
                                                <div class="text-right">
                                                    {{ application.expected_salary}}
                                                </div>
                                                <div class="">
                                                    Average expected salary
                                                </div>
                                                <div class="text-right">
                                                    {{ application.job.job_applications_avg_expected_salary}}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <Button class="bg-slate-700 text-slate-200"
                                            @click="withdrawApplication(application.id)"
                                        >
                                            Cancel
                                        </Button>
                                    </div>
                                </JobCard>
                            </li>
                        </ul>
                        <div v-else class="text-center">
                            You can apply for jobs <Link :href="route('jobs.index')" class="text-blue-600 hover:underline hover:text-blue-700 font-semibold">hrere!</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
