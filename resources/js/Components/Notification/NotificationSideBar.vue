<script setup>
import {computed, inject, onMounted, ref} from 'vue';
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
import {Link, router, usePage} from "@inertiajs/vue3";
import {Card} from "@/components/ui/card/index.js";
const page = usePage();

const notifications = computed(() => page.props.auth.user.notifications || []);

const unreadCount = computed( () => {
    return notifications.value.filter( noti => noti.read_at === null).length;
})

//TODO: mark as read once user click the notification

const showNotificationSideBar = inject('showNotificationSideBar');
</script>

<template>
    <Sheet :open="showNotificationSideBar" @update:open="val => showNotificationSideBar = val">
        <SheetContent class="w-full sm:w-[600px] absolute top-0 bg-gradient-to-r to-indigo-300 from-slate-300">
            <SheetHeader>
                <SheetTitle>Notifications</SheetTitle>
                <SheetDescription>Your latest updates</SheetDescription>
            </SheetHeader>

            <div v-if="notifications.length" class="mt-4 space-y-3">
                <Card v-for="notification in notifications" class="p-2">
                    <a :href="route('my-jobs')">
                        <span class="font-semibold text-slate-700">{{notification.data.user_name}}</span> has Applied for <span class="font-semibold text-indigo-800">{{notification.data.job_title}}</span> position.
                    </a>
                </Card>
            </div>
            <div v-else>
                You have no notifications yet!
            </div>
            <div class="border-b-2 mt-4 border-slate-800">

            </div>
        </SheetContent>
    </Sheet>

</template>
