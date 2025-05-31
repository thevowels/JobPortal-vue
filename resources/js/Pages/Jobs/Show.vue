<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import JobCard from "@/Components/Jobs/JobCard.vue";
import {
    Breadcrumb,
    BreadcrumbItem,
    BreadcrumbLink,
    BreadcrumbList,
    BreadcrumbPage,
    BreadcrumbSeparator,
} from '@/components/ui/breadcrumb'
import {Button} from "@/components/ui/button/index.js";

defineProps(['job', 'company_jobs', 'can'])
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <Breadcrumb>
                <BreadcrumbList>
                    <BreadcrumbItem>
                        <BreadcrumbLink href="/">
                            Home
                        </BreadcrumbLink>
                    </BreadcrumbItem>
                    <BreadcrumbSeparator />
                    <BreadcrumbItem>
                        <BreadcrumbLink :href="route('jobs.index')">
                            Jobs
                        </BreadcrumbLink>
                    </BreadcrumbItem>
                    <BreadcrumbSeparator />
                    <BreadcrumbItem>
                        <BreadcrumbPage>{{job.title}}</BreadcrumbPage>
                    </BreadcrumbItem>
                </BreadcrumbList>
            </Breadcrumb>

        </template>
        <div class="py-12">
            <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
                <JobCard :job="job">
                    <p class="whitespace-pre-line">{{job.description}}</p>
                    <Button v-if="can.apply" variant="outline"  class="bg-blue-200 w-48 mt-4">
                        <a :href="route('jobs.application.create', job)">Apply</a>
                    </Button>
                    <div v-if="!can.apply" class=" mt-6 mb-2 text-center text-slate-700 underline">
                        You already applied this job!
                    </div>

                </JobCard>
            </div>
            <div class="mx-auto max-w-4xl sm:px-6 lg:px-8 mt-8 space-y-4">
                <div class="border border-slate-200 rounded-lg p-4 shadow-md bg-gradient-to-r to-slate-100 from-slate-200">
                    <h1 class="text-xl font-semibold text-slate-600">Other Jobs from <span class="font-bold text-slate-900">{{job.company.name}}</span></h1>
                </div>

                <div v-for="singleJob in company_jobs">
                    <JobCard :job="singleJob">
                        <p class="whitespace-pre-line line-clamp-4">{{job.description}}</p>
                        <Button as-child variant="outline" class="bg-slate-200 shadow-lg border-slate-300 mt-4">
                            <a :href="route('jobs.show', singleJob.id)" >See more</a>
                        </Button>

                    </JobCard>
                </div>

            </div>

        </div>
    </AuthenticatedLayout>
</template>
