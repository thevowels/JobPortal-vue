<script setup>

defineProps(['title'])
import {Card, CardContent, CardHeader} from "@/components/ui/card/index.js";
</script>

<template>
    <Card class="h-36 shadow-md">
        <CardHeader>
            <div class="flex justify-between">
                <h1 class="text-black">
                    {{ title }}
                </h1>
                <div>
                    <slot name="icon"></slot>
                </div>
            </div>
        </CardHeader>
        <CardContent>
            <p class="text-xl  font-bold">
                <slot name="value"/>
            </p>
            <p class="text-[10px]">
                <slot name="info"/>
            </p>
        </CardContent>
    </Card>

</template>
