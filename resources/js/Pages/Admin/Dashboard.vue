<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import AppSidebar from "@/Components/Admin/AppSidebar.vue";
import { SidebarProvider, SidebarTrigger } from "@/components/ui/sidebar";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import {Button} from "@/components/ui/button/index.js";
import NavItem from "@/Components/Admin/NavItem.vue";
import AdminTabs from "@/Components/Admin/AdminTabs.vue";

defineProps([
    'users_count',
    'companies_count',
    'jobApplications_count',
    'jobsCount',
    'timeSeries',
    'timeSeriesCategories',
    'last_10_jobs',
])

</script>

<template>
    <SidebarProvider>
        <AppSidebar />
        <div class="to-indigo-200 from-slate-200 bg-gradient-to-r w-full font-inter">
            <div
                class=" bg-white dark:bg-gray-800 w-full"
            >
                <div class="mx-auto px-4 py-4  flex justify-left">
                    <SidebarTrigger/>

                    <div class="w-full border-l-2 ml-4 ps-3 flex gap-4 text-sm items-center">
                        <NavItem active>
                            Overview
                        </NavItem>
                        <NavItem>
                            Companies
                        </NavItem>
                        <NavItem>
                            Jobs
                        </NavItem>
                        <NavItem>
                            Job Applications
                        </NavItem>

                        <NavItem>
                            Settings
                        </NavItem>

                    </div>

                </div>
            </div>
            <header class="px-4 mt-8">
                <h1 class=" text-xl font-bold">
                    Dashboard
                </h1>
            </header>
            <div class="px-4 mt-4 space-y-4">
                <AdminTabs/>
            </div>

        </div>
    </SidebarProvider>

</template>
