<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {useForm, usePage} from "@inertiajs/vue3";
import {Card, CardHeader} from "@/components/ui/card/index.js";
import FormTextInput from "@/Components/FormTextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {Button} from "@/components/ui/button/index.js";
import {Textarea} from "@/components/ui/textarea/index.js";
import { RadioGroup, RadioGroupItem } from '@/components/ui/radio-group';
import { Label } from "@/components/ui/label/index.js";
import {Input} from "@/components/ui/input/index.js";

const props = defineProps(['experiences', 'categories'])

const page = usePage();
const form = useForm({
    title: '',
    location: '',
    salary: '',
    description: '',
    experience: '',
    category: '',
})

const handleSubmit = (e) => {
    e.preventDefault();
    form.post(route('jobs.store'), {
    });
}
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h1 class="text-2xl font-bold">Companies</h1>
        </template>
        <div class="">
            <div class="mx-auto max-w-4xl mt-8">
                <Card class="bg-white rounded-lg border border-slate-300 shadow-md py-7 max-w-2xl mx-auto p-6 ">
                    <form @submit.prevent="handleSubmit" class="flex flex-col gap-2">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <Label for="title">Job Title</Label>
                                <Input id="title" v-model="form.title" />
                                <p class="text-xs text-red-600">{{page.props.errors.title}}</p>
                            </div>
                            <div>
                                <Label for="location">Location</Label>
                                <Input id="location" v-model="form.location"/>
                                <p class="text-xs text-red-600">{{page.props.errors.location}}</p>

                            </div>
                        </div>
                        <div>
                            <Label for="salary">Salary</Label>
                            <Input id="salary" type="number" v-model="form.salary"/>
                            <p class="text-xs text-red-600">{{page.props.errors.salary}}</p>

                        </div>
                        <div>
                            <Label for="description">Description</Label>
                            <Textarea id="description"  v-model="form.description" />
                            <p class="text-xs text-red-600">{{page.props.errors.description}}</p>

                        </div>
                        <div class="grid grid-cols-2">
                            <div class="">
                                <Label for="experience">Experience</Label>
                                <RadioGroup id="experience" v-model="form.experience">
                                    <div v-for="experience in experiences" class="flex items-center space-x-2" >
                                        <RadioGroupItem :id="experience" :value="experience"/>
                                        <Label class="text-base text-slate-700" :for="experience">{{experience}}</Label>
                                    </div>
                                </RadioGroup>
                                <p class="text-xs text-red-600">{{page.props.errors.experience}}</p>

                            </div>
                            <div class="">
                                <Label for="category">Category</Label>
                                <RadioGroup id="category" v-model="form.category">
                                    <div v-for="category in categories" class="flex items-center space-x-2" >
                                        <RadioGroupItem :id="category" :value="category"/>
                                        <Label class="text-base text-slate-700" :for="category">{{category}}</Label>
                                    </div>
                                </RadioGroup>
                                <p class="text-xs text-red-600">{{page.props.errors.category}}</p>

                            </div>
                        </div>
                        <div class="mt-4">
                            <Button variant="outline" class="w-full bg-slate-100 shadow-md border border-slate-300">Create Job</Button>
                        </div>
                    </form>
                </Card>

            </div>

        </div>


    </AuthenticatedLayout>
</template>
