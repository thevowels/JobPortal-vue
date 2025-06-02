<script setup lang="ts">
import { LineChart } from '@/components/ui/chart-line'

const data = [
    {
        'year': 1978,
        'Export Growth Rate': 1.74,
        'Import Growth Rate': 1.7,
    },
    {
        'year': 1979,
        'Export Growth Rate': 1.77,
        'Import Growth Rate': 1.67,
    },
    {
        'year': 1980,
        'Export Growth Rate': 1.79,
        'Import Growth Rate': 1.7,
    },
    {
        'year': 1981,
        'Export Growth Rate': 1.81,
        'Import Growth Rate': 1.72,
    },
    {
        'year': 1982,
        'Export Growth Rate': 1.84,
        'Import Growth Rate': 1.73,
    },
    {
        'year': 1983,
        'Export Growth Rate': 1.77,
        'Import Growth Rate': 1.73,
    },
    {
        'year': 1984,
        'Export Growth Rate': 1.78,
        'Import Growth Rate': 1.78,
    },
    {
        'year': 1985,
        'Export Growth Rate': 1.78,
        'Import Growth Rate': 1.81,
    },
    {
        'year': 1986,
        'Export Growth Rate': 1.82,
        'Import Growth Rate': 1.89,
    },
    {
        'year': 1987,
        'Export Growth Rate': 1.82,
        'Import Growth Rate': 1.91,
    },
    {
        'year': 1988,
        'Export Growth Rate': 1.77,
        'Import Growth Rate': 1.94,
    },
    {
        'year': 1989,
        'Export Growth Rate': 1.76,
        'Import Growth Rate': 1.94,
    },
    {
        'year': 1990,
        'Export Growth Rate': 1.75,
        'Import Growth Rate': 1.97,
    },
]
</script>

<template>
    <LineChart
        :data="data"
        index="year"
        :categories="['Export Growth Rate', 'Import Growth Rate']"
        :y-formatter="(tick, i) => {
      return typeof tick === 'number'
        ? `$ ${new Intl.NumberFormat('us').format(tick).toString()}`
        : ''
    }"
    />
</template>
