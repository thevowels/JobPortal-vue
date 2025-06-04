<script setup >
import { LineChart } from '@/components/ui/chart-line'

const props = defineProps(['data', 'categories','index']);

</script>

<template>
    <LineChart
        :data="data"
        :index="index"
        :categories="categories"
        :y-formatter="(tick) => new Intl.NumberFormat().format(tick)"
        curve-type="basis"
    />
</template>
