<script setup>
import { inject, onMounted, ref } from 'vue';
import {
    Sheet,
    SheetContent,
    SheetDescription,
    SheetHeader,
    SheetTrigger,
    SheetTitle,
} from '@/components/ui/sheet/index.js';
import {Input} from "@/components/ui/input/index.js";
import {Button} from "@/components/ui/button/index.js";


const showNotificationSideBar = inject('showNotificationSideBar');
</script>

<template>
    <Sheet :open="showNotificationSideBar" @update:open="val => showNotificationSideBar = val">
        <SheetContent class="w-full sm:w-[600px] absolute top-0 bg-white">
            <SheetHeader>
                <SheetTitle>Notifications</SheetTitle>
                <SheetDescription>Your latest updates</SheetDescription>
            </SheetHeader>

            <div class="mt-4 space-y-3">
                <div class="bg-slate-100 dark:bg-slate-800 p-3 rounded-lg shadow">
                    📨 You applied for Developer at Acme Inc.
                </div>
                <div class="bg-slate-100 dark:bg-slate-800 p-3 rounded-lg shadow">
                    📢 New job posted: Frontend Engineer
                </div>
            </div>
        </SheetContent>
    </Sheet>

</template>
