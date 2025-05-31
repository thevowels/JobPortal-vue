<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {useForm, usePage} from "@inertiajs/vue3";
import {Card, CardHeader} from "@/components/ui/card/index.js";
import FormTextInput from "@/Components/FormTextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {Button} from "@/components/ui/button/index.js";
import {Input} from "@/components/ui/input/index.js";

const props = defineProps(['job']);

const form = useForm({
    expected_salary: '',
    cv:null,
})

const handleSubmit = (e) => {
    e.preventDefault();
    form.post(route('jobs.application.store', props.job), {});
}

const page = usePage();

const handleFileChange = (e) => {
    form.cv = e.target.files[0];
}
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h1 class="text-2xl font-bold text-slate-600">
                Apply for <span class="text-blue-800">{{job.title}}</span>
            </h1>
        </template>
        <div class="">
            <div class="mx-auto max-w-4xl mt-8">
                <Card class="bg-white rounded-lg border border-slate-300 shadow-md py-7 max-w-sm mx-auto p-6 ">
                    <form enctype="multipart/form-data" @submit.prevent="handleSubmit" class="flex flex-col gap-2">
                        <div class="">
                            <InputLabel class="text-lg font-light" for="expected_salary" value="Expected Salary"/>
                            <FormTextInput type="number" v-model="form.expected_salary" />
                            <p class="text-sm text-red-600" v-if="page.props.errors.expected_salary" >{{page.props.errors.expected_salary}}</p>
                        </div>
                        <div>
                            <InputLabel class="text-lg font-light" for="cv" value="Upload Your CV"/>
                            <Input
                                type="file"
                                class="mt-1 block w-full"
                                @change="handleFileChange"
                                accept=".pdf,.docx"/>
                            <p class="text-sm text-red-600" v-if="page.props.errors.cv" >{{page.props.errors.cv}}</p>


                        </div>
                        <div class="mt-4">
                            <Button variant="outline" class="w-full bg-slate-100 shadow-md border border-slate-300">Add</Button>
                        </div>
                    </form>
                </Card>

            </div>

        </div>


    </AuthenticatedLayout>
</template>
