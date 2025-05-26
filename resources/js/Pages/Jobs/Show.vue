<script setup>
defineProps({job: Object})
</script>

<template>
   <p>Show Page for
    {{job.title}}
   </p>
    ID: {{job.id}}
</template>
