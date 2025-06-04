<script setup lang="ts">
import { BarChart } from '@/components/ui/chart-bar'
import { defineProps } from 'vue';

const props = defineProps(['data', 'categories']);
</script>

<template>
    <BarChart
        :data="data"
        index="name"
        :categories="categories"
    />
</template>
