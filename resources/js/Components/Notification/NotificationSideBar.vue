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
import {usePage} from "@inertiajs/vue3";
const page = usePage();

const notifications = computed(() => page.props.auth.user.notifications || []);

const unreadCount = computed( () => {
    return notifications.value.filter( noti => noti.read_at === null).length;
})





const showNotificationSideBar = inject('showNotificationSideBar');
</script>

<template>
    <Sheet :open="showNotificationSideBar" @update:open="val => showNotificationSideBar = val">
        <SheetContent class="w-full sm:w-[600px] absolute top-0 bg-white">
            <SheetHeader>
                <SheetTitle>Notifications</SheetTitle>
                <SheetDescription>Your latest updates</SheetDescription>
            </SheetHeader>

            <div v-if="notifications.length" class="mt-4 space-y-3">
                <div v-for="notification in notifications">
                    {{notification.id}}
                </div>
            </div>
            <div v-else>
                You have no notifications yet!
            </div>
        </SheetContent>
    </Sheet>

</template>
