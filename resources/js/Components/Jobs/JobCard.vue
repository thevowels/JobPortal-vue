<script setup>

import {Card, CardHeader} from "@/components/ui/card/index.js";
import {Badge} from "@/components/ui/badge/index.js";
import {Button} from "@/components/ui/button/index.js";

defineProps({'job': Object});
</script>

<template>
    <Card class="p-4">
        <div class="flex items-center justify-between">
            <p class="font-semibold text-lg text-slate-900">{{job.title}}</p>
            <p class="text-slate-700">$ {{Number(job.salary).toLocaleString()}}</p>
        </div>
        <div class="flex items-center justify-between mt-2">
            <div class="flex text-sm items-center space-x-4">
                <p>Company Name</p>
                <p>{{job.location}}</p>
            </div>
            <div class="space-x-2">
                <Badge class="px-2 py-1 text-sm" variant="outline"><a href="#">{{job.category}}</a></Badge>
                <Badge class="px-2 py-1 text-sm" variant="outline"><a href="#">{{job.experience}}</a></Badge>
            </div>
        </div>
        <div class="mt-4">
           <slot/>
        </div>

    </Card>
</template>
