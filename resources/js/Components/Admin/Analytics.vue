<script setup>

import {Card, CardContent, CardHeader} from "@/components/ui/card/index.js";
import DashboardCard from "@/Components/Admin/DashboardCard.vue";
import Linechart from "@/Components/Admin/Linechart.vue";
import {AreaChart} from "@/components/ui/chart-area/index.js";


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

                <div class="grid grid-cols-2 gap-4">
                    <DashboardCard title="Daily Signups">
                        <template #icon>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                            </svg>
                        </template>
                        <template #value>
                            {{20}}
                        </template>
                        <template #info >
                           <p class="text-green-700  font-semibold"> +10%</p>

                        </template>

                    </DashboardCard>
                    <DashboardCard title="Weekly Signups">
                        <template #icon>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                            </svg>
                        </template>
                        <template #value>
                            {{342}}
                        </template>
                        <template #info >
                            <p class="text-green-700  font-semibold"> +15%</p>

                        </template>

                    </DashboardCard>
                    <DashboardCard title="Daily Login">
                        <template #icon>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                            </svg>
                        </template>
                        <template #value>
                            {{150}}
                        </template>
                        <template #info >
                            <p class="text-red-700  font-semibold"> -5%</p>

                        </template>
                    </DashboardCard>
                    <DashboardCard title="Weekly Logins">
                        <template #icon>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                            </svg>
                        </template>
                        <template #value>
                            {{923}}
                        </template>
                        <template #info >
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
                            <Linechart class="h-40" index="name" :categories="['visits']" :data="demo_traffic" curve-type="basis"/>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </div>

    </div>
</template>
