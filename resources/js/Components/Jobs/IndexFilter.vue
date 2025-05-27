<script setup>
import {Button} from "@/components/ui/button/index.js";
import FormTextInput from "@/Components/FormTextInput.vue";
import {Card} from "@/components/ui/card/index.js";
import {RadioGroup, RadioGroupItem} from "@/components/ui/radio-group/index.js";
import InputLabel from "@/Components/InputLabel.vue";
import {computed} from "vue";
import {useForm, usePage} from "@inertiajs/vue3";

const props = defineProps(['categories', 'experiences']);

const query = usePage().props.query;
const errors = computed(() => usePage().props.errors);
const form = useForm({
    'search': query.search || '',
    'experience': query.experience || '',
    'category': query.category || '',
    'min_salary': query.min_salary || '',
    'max_salary': query.max_salary || '',
})
const handleFilter = () => {
    form.get(route('jobs.index'), {
        preserveScroll: true,
        preserveState: true,
    });
}



</script>


<template>
    <Card>
        <form @submit.prevent="handleFilter">
            <div class="grid grid-cols-2 justify-between items-center p-3 gap-3">
                <div>
                    <InputLabel class="text-slate-900 font-bold" for="search" value="Search"/>
                    <FormTextInput  v-model="form.search" type="text" id="search" class="w-full" @submit="handleFilter"/>
                    <p v-if="errors.search" class="text-sm text-red-500">{{errors.search}}</p>
                </div>
                <div>
                    <InputLabel class="text-slate-900 font-bold" for="min_salary" value="Salary"/>
                    <div class="flex justify-between items-center space-x-3">
                        <div>
                            <FormTextInput  v-model="form.min_salary" type="text" id="min_salary" class="w-full" placeholder="From" @submit="handleFilter"/>
                            <p v-if="errors.min_salary" class="text-sm text-red-500">{{errors.min_salary}}</p>

                        </div>
                        <div>
                            <FormTextInput  v-model="form.max_salary" type="text" id="max_salary" class="w-full" placeholder="To" @submit="handleFilter"/>
                            <p v-if="errors.max_salary" class="text-sm text-red-500">{{errors.max_salary}}</p>
                        </div>

                    </div>
                </div>
                <div class="p-4">
                    <RadioGroup default-value="" v-model="form.experience" @update:model-value="handleFilter">
                        <div class="flex items-center space-x-2">
                            <RadioGroupItem id="all" value='' />
                            <InputLabel for="all">All </InputLabel>
                        </div>
                        <div v-for="experience in experiences" :key="experience" class="flex items-center space-x-2">
                            <RadioGroupItem :id=experience :value=experience />
                            <InputLabel :for=experience>{{experience}}</InputLabel>
                        </div>
                        <div>
                            <p v-if="errors.search" class="text-sm text-red">{{errors.experience}}</p>
                        </div>
                    </RadioGroup>
                </div>
                <div class="p-4">
                    <RadioGroup default-value="" v-model="form.category" @update:model-value="handleFilter">
                        <div class="flex items-center space-x-2">
                            <RadioGroupItem id="all" value='' />
                            <InputLabel for="all">All </InputLabel>
                        </div>
                        <div v-for="category in categories" :key="category" class="flex items-center space-x-2">
                            <RadioGroupItem :id=category :value=category />
                            <InputLabel :for=category>{{category}}</InputLabel>
                        </div>
                    </RadioGroup>
                </div>
                <div class="col-span-2">
                    <Button variant="outline" class="w-full">Search</Button>
                </div>

            </div>
        </form>
    </Card>

</template>
