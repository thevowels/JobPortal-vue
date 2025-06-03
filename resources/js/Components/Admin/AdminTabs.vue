<script setup>
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs'
import Overview from "@/Components/Admin/Overview.vue";

</script>

<template>
    <Tabs default-value="overview">
        <TabsList class="">
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
                Notifications
            </TabsTrigger>
        </TabsList>
        <TabsContent value="overview">
            <Overview/>
        </TabsContent>
        <TabsContent value="analytics">
            Analytics
        </TabsContent>
        <TabsContent value="reports">
            Reports
        </TabsContent>
        <TabsContent value="notifications">
            Notifications
        </TabsContent>
    </Tabs>

</template>
