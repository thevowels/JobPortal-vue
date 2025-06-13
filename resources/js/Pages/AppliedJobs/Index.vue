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

const props = defineProps(['applications', 'jobApplications', 'StatusEnum']);

const form = useForm();

console.log(props.jobApplications.pending);

const withdrawApplication = (applicationId) => {
    form.put(route('appliedJobs.withdraw', applicationId), {
        preserveScrolling: true,
        preserveState: true,
    });
}

import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs'
import JobApplicationsList from "@/Components/JobApplications/JobApplicationsList.vue";

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

                        <div>
                            <Tabs default-value="pending" >
                                <TabsList class="bg-slate-200 shadow-md">
                                        <TabsTrigger value="pending">
                                            Pending
                                        </TabsTrigger>
                                        <TabsTrigger value="shortlisted">
                                            ShortListed
                                        </TabsTrigger>
                                        <TabsTrigger value="waiting_interview">
                                            WaitingInterview
                                        </TabsTrigger>
                                        <TabsTrigger value="accepted">
                                            Accepted
                                        </TabsTrigger>
                                        <TabsTrigger value="rejected">
                                            Rejected
                                        </TabsTrigger>
                                    </TabsList>
                                <TabsContent value="pending">
                                    <JobApplicationsList :job-applications="jobApplications.pending" :withdraw-application="withdrawApplication"/>
                                </TabsContent>
                                <TabsContent value="shortlisted">
                                    <JobApplicationsList :job-applications="jobApplications.shortlisted" :withdraw-application="withdrawApplication">
                                        <template v-slot:empty_info>
                                            <h1>You have no shortlisted Job Applications Yet.</h1>
                                        </template>

                                    </JobApplicationsList>
                                </TabsContent>
                                <TabsContent value="waiting_interview">
                                    <JobApplicationsList :job-applications="jobApplications.waiting_interview" :withdraw-application="withdrawApplication">
                                        <template v-slot:empty_info>
                                            <h1>You have no Waiting for Interview Job Applications Yet.</h1>
                                        </template>
                                    </JobApplicationsList>
                                </TabsContent>
                                <TabsContent value="accepted">
                                    <JobApplicationsList :job-applications="jobApplications.accepted" :withdraw-application="withdrawApplication">
                                        <template v-slot:empty_info>
                                            <h1>You have no Accepted Job Applications Yet.</h1>
                                        </template>
                                    </JobApplicationsList>
                                </TabsContent>
                                <TabsContent value="rejected">
                                    <JobApplicationsList :job-applications="jobApplications.rejected" :withdraw-application="withdrawApplication">
                                        <template v-slot:empty_info>
                                            <h1>You have no Rejected Job Applications Yet.</h1>
                                        </template>
                                    </JobApplicationsList>
                                </TabsContent>
                            </Tabs>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
