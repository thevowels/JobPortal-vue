<script setup>

import { Link } from "@inertiajs/vue3";
import {Card, CardHeader} from "@/components/ui/card/index.js";
import {Badge} from "@/components/ui/badge/index.js";
import {Button} from "@/components/ui/button/index.js";

defineProps({'job': Object});
</script>

<template>
    <Card class="p-4 bg-gradient-to-r from-slate-100 to-slate-200">
        <div class="flex items-center justify-between">
            <p class="font-semibold text-lg text-slate-900">{{job.title}}</p>
            <p class="text-slate-700">$ {{Number(job.salary).toLocaleString()}}</p>
        </div>
        <div class="flex items-center justify-between mt-2">
            <div class="flex text-sm items-center space-x-4">
                <Link :href="route('companies.show', job.company)" class="text-slate-800 font-sans font-semibold">{{ job.company.name }}</Link>
                <p>{{job.location}}</p>
            </div>
            <div class="space-x-2">
                <Badge class="px-2 py-1 text-sm border-slate-300 shadow-md" variant="outline"><Link href="#">{{job.category}}</Link></Badge>
                <Badge class="px-2 py-1 text-sm border-slate-300 shadow-md" variant="outline"><Link href="#">{{job.experience}}</Link></Badge>
            </div>
        </div>
        <div class="mt-4">
           <slot/>
        </div>

    </Card>
</template>
