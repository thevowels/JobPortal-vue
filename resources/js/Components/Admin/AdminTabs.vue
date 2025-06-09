<script setup>
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs'
import Overview from "@/Components/Admin/Overview.vue";
import Analytics from "@/Components/Admin/Analytics.vue";
import Exports from "@/Components/Admin/Exports.vue";

</script>

<template>
    <Tabs default-value="overview">
        <TabsList class="bg-slate-200">
            <TabsTrigger value="overview">
                Overview
            </TabsTrigger>
            <TabsTrigger value="analytics">
                Analytics
            </TabsTrigger>
            <TabsTrigger value="reports">
                Reports
            </TabsTrigger>
            <TabsTrigger value="notifications">
                Exports
            </TabsTrigger>
        </TabsList>
        <TabsContent value="overview">
            <Overview/>
        </TabsContent>
        <TabsContent value="analytics">
            <Analytics/>
        </TabsContent>
        <TabsContent value="reports">
            Reports
        </TabsContent>
        <TabsContent value="notifications">
            <Exports/>
        </TabsContent>
    </Tabs>

</template>
