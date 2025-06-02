<script setup>
defineProps({
    'active': {
        type: Boolean,
        default: false
    }
})
</script>

<template>
    <div :class="['font-medium font-inter', {'text-slate-900': active}, {'text-slate-500': !active}]">
        <slot/>
    </div>
</template>
