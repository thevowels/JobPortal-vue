<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />
        <div class="flex flex-row w-full h-full ">
            <div class="flex-1 my-auto">
                <div class="flex flex-col justify-center items-center ">
                    <Link href="/">
                        <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" />
                    </Link>
                    <div  class="max-w-md text-balance text-center text-3xl my-4 text-slate-800  font-semibold font-sansita">
                        Signup and discoer great amount of opportunities !
                    </div>

                </div>

                <div
                    class="mt-6 mx-auto w-full overflow-hidden bg-gradient-to-r from-indigo-200 to-slate-300 px-6 py-4 shadow-lg max-w-md rounded-lg  dark:bg-gray-800">

                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="name" value="Name" />

                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full font-bold"
                                    v-model="form.name"
                                    required
                                    autofocus
                                    autocomplete="name"
                                    placeholder=" Mr Smith!"
                                />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="email" value="Email" />

                                <TextInput
                                    id="email"
                                    type="email"
                                    class="mt-1 block w-full font-bold"
                                    v-model="form.email"
                                    required
                                    autocomplete="username"
                                    placeholder="name@example.com"
                                />

                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="password" value="Password" />

                                <TextInput
                                    id="password"
                                    type="password"
                                    class="mt-1 block w-full font-bold"
                                    v-model="form.password"
                                    required
                                    autocomplete="new-password"
                                    placeholder="At least 8 characters!"
                                />

                                <InputError class="mt-2" :message="form.errors.password" />
                            </div>

                            <div class="mt-4">
                                <InputLabel
                                    for="password_confirmation"
                                    value="Confirm Password"
                                />

                                <TextInput
                                    id="password_confirmation"
                                    type="password"
                                    class="mt-1 block w-full font-bold"
                                    v-model="form.password_confirmation"
                                    required
                                    autocomplete="new-password"
                                    placeholder="same as above"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.password_confirmation"
                                />
                            </div>

                            <div class="mt-4 flex items-center justify-end">
                                <Link
                                    :href="route('login')"
                                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                                >
                                    Already registered?
                                </Link>

                                <PrimaryButton
                                    class="ms-4"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Register
                                </PrimaryButton>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
