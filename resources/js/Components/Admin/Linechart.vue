<script setup >
import { LineChart } from '@/components/ui/chart-line'
import {onMounted} from "vue";

const props = defineProps(['data', 'categories']);

</script>

<template>
    <LineChart
        :data="data"
        index="date"
        :categories="categories"
        :y-formatter="(tick) => new Intl.NumberFormat().format(tick)"
    />
</template>
