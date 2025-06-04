<script setup>

import {Card, CardContent, CardHeader} from "@/components/ui/card/index.js";
import DashboardCard from "@/Components/Admin/DashboardCard.vue";
import Linechart from "@/Components/Admin/Linechart.vue";
import {AreaChart} from "@/components/ui/chart-area/index.js";
import {LineChart} from "@/components/ui/chart-line/index.js";
import {BarChart} from "@/components/ui/chart-bar/index.js";


const demo_traffic = [
    { name: 'Mon', visits: Math.floor(Math.random() * 50) + 150 },
    { name: 'Tue', visits: Math.floor(Math.random() * 50) + 150 },
    { name: 'Wed', visits: Math.floor(Math.random() * 50) + 150 },
    { name: 'Thu', visits: Math.floor(Math.random() * 50) + 150 },
    { name: 'Fri', visits: Math.floor(Math.random() * 50) + 150 },
    { name: 'Sat', visits: Math.floor(Math.random() * 50) + 150 },
    { name: 'Sun', visits: Math.floor(Math.random() * 50) + 150 },
    { name: 'Mon', visits: Math.floor(Math.random() * 50) + 150 },
    { name: 'Tue', visits: Math.floor(Math.random() * 50) + 150 },
    { name: 'Wed', visits: Math.floor(Math.random() * 50) + 150 },
    { name: 'Thu', visits: Math.floor(Math.random() * 50) + 150 },
    { name: 'Fri', visits: Math.floor(Math.random() * 50) + 150 },
    { name: 'Sat', visits: Math.floor(Math.random() * 50) + 150 },
    { name: 'Sun', visits: Math.floor(Math.random() * 50) + 150 },
]
const demo_jobViews = [
    { name: 'Mon', views: Math.floor(Math.random() * 700) + 350 },
    { name: 'Tue', views: Math.floor(Math.random() * 700) + 350 },
    { name: 'Wed', views: Math.floor(Math.random() * 700) + 350 },
    { name: 'Thu', views: Math.floor(Math.random() * 700) + 350 },
    { name: 'Fri', views: Math.floor(Math.random() * 700) + 350 },
    { name: 'Sat', views: Math.floor(Math.random() * 700) + 350 },
    { name: 'Sun', views: Math.floor(Math.random() * 700) + 350 },
    { name: 'Mon', views: Math.floor(Math.random() * 700) + 350 },
    { name: 'Tue', views: Math.floor(Math.random() * 700) + 350 },
    { name: 'Wed', views: Math.floor(Math.random() * 700) + 350 },
    { name: 'Thu', views: Math.floor(Math.random() * 700) + 350 },
    { name: 'Fri', views: Math.floor(Math.random() * 700) + 350 },
    { name: 'Sat', views: Math.floor(Math.random() * 700) + 350 },
    { name: 'Sun', views: Math.floor(Math.random() * 700) + 350 },
]

</script>

<template>
    <div class="font-inter mx-auto">
        <div class="mt-4">
            <h1 class="text-2xl font-semibold  text-slate-900">Analytics</h1>
            <p class="text-sm  text-slate-600">Overview of platform activity</p>
        </div>
        <div class="mt-4">
            <div>
                <h1 class="font-semibold text-xl">User Acquision</h1>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <DashboardCard title="Daily Signups">
                        <template #icon>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/>
                            </svg>
                        </template>
                        <template #value>
                            {{ 20 }}
                        </template>
                        <template #info>
                            <p class="text-green-700  font-semibold"> +10%</p>

                        </template>

                    </DashboardCard>
                    <DashboardCard title="Weekly Signups">
                        <template #icon>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/>
                            </svg>
                        </template>
                        <template #value>
                            {{ 342 }}
                        </template>
                        <template #info>
                            <p class="text-green-700  font-semibold"> +15%</p>

                        </template>

                    </DashboardCard>
                    <DashboardCard title="Daily Login">
                        <template #icon>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/>
                            </svg>
                        </template>
                        <template #value>
                            {{ 150 }}
                        </template>
                        <template #info>
                            <p class="text-red-700  font-semibold"> -5%</p>

                        </template>
                    </DashboardCard>
                    <DashboardCard title="Weekly Logins">
                        <template #icon>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/>
                            </svg>
                        </template>
                        <template #value>
                            {{ 923 }}
                        </template>
                        <template #info>
                            <p class="text-green-700  font-semibold"> +17%</p>
                        </template>
                    </DashboardCard>
                </div>
                <div>
                    <Card>
                        <CardHeader>
                            <h1 class="font-semibold text-lg">Traffic Sources</h1>
                        </CardHeader>
                        <CardContent class="mb-12">
                            <LineChart class="h-40" index="name" :categories="['visits']" :data="demo_traffic"
                                       curve-type="basis"/>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <div>
                <h1 class="font-semibold text-xl">Job Engagement</h1>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <Card>
                        <CardHeader>
                            <h1 class="font-semibold text-slate-700 text-lg">Job Views</h1>
                            <h1 class="font-bold  text-xl">13248</h1>
                        </CardHeader>
                        <CardContent class="mb-12">
                            <BarChart class="h-40" index="name" :categories="['views']" :data="demo_jobViews"
                                       curve-type="basis"/>
                        </CardContent>
                    </Card>

                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 ">
                    <DashboardCard title="Views per Job Post">
                        <template #icon>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/>
                            </svg>
                        </template>
                        <template #value>
                            {{ 250 }}
                        </template>
                        <template #info>
                            <p class="text-green-700  font-semibold"> +7%</p>

                        </template>

                    </DashboardCard>
                    <DashboardCard title="Application Rate">
                        <template #icon>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/>
                            </svg>
                        </template>
                        <template #value>
                            38%
                        </template>
                        <template #info>
                            <p class="text-green-700  font-semibold"> -2%</p>

                        </template>

                    </DashboardCard>
                    <DashboardCard title="Jobs Posted">
                        <template #icon>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/>
                            </svg>
                        </template>
                        <template #value>
                            {{ 217 }}
                        </template>
                        <template #info>
                            <p class="text-green-700  font-semibold"> +18%</p>
                        </template>
                    </DashboardCard>

                </div>


            </div>
        </div>

    </div>
</template>
