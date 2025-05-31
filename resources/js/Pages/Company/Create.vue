<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {useForm} from "@inertiajs/vue3";
import {Card, CardHeader} from "@/components/ui/card/index.js";
import FormTextInput from "@/Components/FormTextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {Button} from "@/components/ui/button/index.js";
import {
    Breadcrumb,
    BreadcrumbItem,
    BreadcrumbLink,
    BreadcrumbList,
    BreadcrumbPage, BreadcrumbSeparator
} from "@/components/ui/breadcrumb/index.js";

const form = useForm({
  name: '',
  location: '',
  industry: '',
  website: '',
})

const handleSubmit = (e) => {
    e.preventDefault();
    form.post(route('companies.store'), {

    });
}
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                <Breadcrumb>
                    <BreadcrumbList>
                        <BreadcrumbItem>
                            <BreadcrumbLink href="/">
                                Home
                            </BreadcrumbLink>
                        </BreadcrumbItem>
                        <BreadcrumbSeparator />
                        <BreadcrumbItem>
                            <BreadcrumbPage>Create Company</BreadcrumbPage>
                        </BreadcrumbItem>
                    </BreadcrumbList>
                </Breadcrumb>
            </h2>
        </template>
      <div class="">
        <div class="mx-auto max-w-4xl mt-8">
          <Card class="bg-white rounded-lg border border-slate-300 shadow-md py-7 max-w-sm mx-auto p-6 ">
            <form @submit.prevent="handleSubmit" class="flex flex-col gap-2">
              <div class="">
                <InputLabel class="text-lg font-light" for="name" value="Name"/>
                <FormTextInput v-model="form.name" />
              </div>
              <div>
                <InputLabel for="location" value="Location"/>
                <FormTextInput v-model="form.location"/>
              </div>
              <div>
                <InputLabel for="industry" value="Industry"/>
                <FormTextInput v-model="form.industry"/>
              </div>
              <div>
                <InputLabel for="website" value="Website URL"/>
                <FormTextInput v-model="form.website"/>
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
