<script setup>

import {usePage} from "@inertiajs/vue3";
import DashboardCard from "@/Components/Admin/DashboardCard.vue";
import {Card, CardContent, CardHeader} from "@/components/ui/card/index.js";
import RecentJobPost from "@/Components/Admin/RecentJobPost.vue";
import Linechart from "@/Components/Admin/Linechart.vue";
import {
    Tabs,
    TabsContent,
    TabsList,
    TabsTrigger,
} from '@/components/ui/tabs'
import {computed, ref} from "vue";
import {Button} from "@/components/ui/button/index.js";
import {Slider} from "@/components/ui/slider/index.js";


const page = usePage();
const users_count = page.props.users_count;
const companies_count = page.props.companies_count;
const jobApplications_count = page.props.jobApplications_count;
const jobs_count = page.props.jobsCount;
const last_10_jobs = page.props.last_10_jobs;

const days  = ref([-30]);

const data =  computed(() => page.props.timeSeries.slice(days.value));



// const num_users = computed(() => page.props.count);
</script>


<template>
    <div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 mt-8 gap-8">
            <div>
                <DashboardCard title="Job Applications">
                    <template #icon>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                        </svg>
                    </template>
                    <template #value>
                        {{jobApplications_count}}
                    </template>
                    <template #info>
                        +23% form last month

                    </template>
                </DashboardCard>
            </div>
            <div>
                <DashboardCard title="Jobs">
                    <template #icon>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                        </svg>
                    </template>
                    <template #value>
                        {{jobs_count}}
                    </template>
                    <template #info>
                        +23% form last month

                    </template>
                </DashboardCard>

            </div>
            <div>
                <DashboardCard title="Users">
                    <template #icon>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </template>
                    <template #value>
                        {{users_count}}
                    </template>
                    <template #info>
                        +23% form last month

                    </template>
                </DashboardCard>
            </div>
            <div>
                <DashboardCard title="Companies">
                    <template #icon>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                        </svg>
                    </template>
                    <template #value>
                        {{companies_count}}
                    </template>
                    <template #info>
                        +23% form last month

                    </template>
                </DashboardCard>

            </div>
        </div>
        <div class="mt-4 grid grid-cols-1 lg:grid-cols-12 gap-4">
            <div class="lg:col-span-7">
                <Card>
                    <CardHeader>
                       <h1 class="text-slate-900 font-semibold font-inter">User Activities</h1>
                    </CardHeader>
                    <CardContent>
                        <div class="flex justify-end">
                            <div class="w-36">
                                <Slider
                                    v-model="days"
                                    :min="-30"
                                    :max="-7"
                                    :step="-1"
                                />
                                <p class="mt-2 font-semibold font-inter text-slate-600 text-right">Last <span class="text-slate-900 text-pretty">{{-days[0]}}</span> Days</p>

                            </div>

                        </div>
                        <Linechart :data="data" :categories="page.props.timeSeriesCategories"/>

                    </CardContent>
                </Card>
            </div>
            <div class="lg:col-span-5">
                <Card class="min-h-[480px]">
                    <CardHeader>
                        <h1 class="font-semibold">
                            Recent Jobs
                        </h1>
                        <p class="text-sm text-slate-500">
                            Companies have posted 42 jobs this week.
                        </p>
                    </CardHeader>
                    <CardContent>
                        <div class="flex flex-col">
                            <RecentJobPost v-for="job in last_10_jobs" :company-name="job.company.name" :job-name="job.title" :salary="job.salary" :applicants-count="job.job_applications_count"/>
                        </div>

                    </CardContent>
                </Card>

            </div>
        </div>

    </div>
</template>
