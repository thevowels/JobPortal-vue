<script setup>
import JobCard from "@/Components/Jobs/JobCard.vue";
import {Button} from "@/components/ui/button/index.js";
import {Link} from "@inertiajs/vue3";

defineProps(['jobApplications', 'withdrawApplication']);

</script>

<template>
    <div>
        <ul class="mt-4" v-if="jobApplications?.length">
            <li v-for="application in jobApplications" class="mb-3">
                <JobCard :job="application.job">
                    <div class="flex items-center justify-between text-slate-500">
                        <div class="">
                            <div>
                                Applied {{ application.created_at}}
                            </div>
                            <div>
                                Other applicants:  {{application.job.job_applications_count}}
                            </div>
                        </div>
                        <div class="flex ">
                            <div class="grid grid-cols-2">
                                <div class="">
                                    Your expected salary
                                </div>
                                <div class="text-right">
                                    {{ application.expected_salary}}
                                </div>
                                <div class="">
                                    Average expected salary
                                </div>
                                <div class="text-right">
                                    {{ application.job.job_applications_avg_expected_salary}}
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="text-right">
                        <Button class="bg-slate-700 text-slate-200"
                                @click="withdrawApplication(application.id)"
                        >
                            Cancel
                        </Button>
                    </div>
                </JobCard>
            </li>
        </ul>
        <div v-else class="text-center mt-24">
            <slot name="empty_info"/>
<!--            <h1>You have no shortlisted Job Applications Yet.</h1>-->
            <h1>You can apply for jobs <Link :href="route('jobs.index')" class="text-blue-600 hover:underline hover:text-blue-700 font-semibold" >hrere!</Link></h1>
        </div>

    </div>

</template>
