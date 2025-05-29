<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps(['company']);
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h1 class="text-2xl font-bold">{{company.name}}</h1>
        </template>
        <div>
            Company show page
        </div>

    </AuthenticatedLayout>
</template>
