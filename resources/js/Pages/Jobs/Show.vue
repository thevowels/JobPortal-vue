<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import JobCard from "@/Components/Jobs/JobCard.vue";

defineProps({job: Object})
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Jobs
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
                <JobCard :job="job">
                    <p class="whitespace-pre-line">{{job.description}}</p>
                    
                </JobCard>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
