<script setup>

import { ref } from "vue";
import {usePage, router} from "@inertiajs/vue3";
import { useUrlSearchParams } from "@vueuse/core"

import { ChevronsUpDown, ChevronUp, ChevronDown  } from "lucide-vue-next";

const props = defineProps(['name', 'label','sortOrder' ])

const order = ref(props.sortOrder);

const page = usePage();

const path = page.url.split('?')[0];
const doSort = () => {
    if (order.value === 'asc') {
        order.value = 'desc';
    }else{
        order.value = 'asc';
    }
    const query = new URLSearchParams(window.location.search)

    query.set('sortKey', props.name);
    query.set('sortOrder', order.value);
    query.delete('page');
    router.visit(`${path}?${query}`, {
        preserveScroll: true,
        only: ['users']
    });


}
</script>

<template>
    <div class="flex" @click="doSort">
        {{label}}
        <div v-if="order">
            <ChevronUp v-if="order === 'asc'"/>
            <ChevronDown v-else/>
        </div>
        <div v-else>
            <ChevronsUpDown/>
        </div>

    </div>
</template>
