<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center bg-gradient-to-r to-indigo-300 from-slate-400 pt-6 sm:justify-center sm:pt-0 dark:bg-gray-900"
    >
<!--        <div>-->
<!--            <Link href="/">-->
<!--                <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" />-->
<!--            </Link>-->
<!--        </div>-->

            <slot />
    </div>
</template>
