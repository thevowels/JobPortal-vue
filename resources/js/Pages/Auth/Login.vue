<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import {Button} from "@/components/ui/button/index.js";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>
        <div class="flex flex-row w-full h-full">
            <div class="flex-1 my-auto">
                <div class="flex flex-col justify-center items-center">
                    <Link href="/">
                        <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" />
                    </Link>
                    <h1 class="text-5xl my-4 font-sansita">
                        Welcome back !
                    </h1>

                </div>

                <div
                    class="mt-6 mx-auto w-full overflow-hidden bg-gradient-to-r from-indigo-200 to-slate-300 px-6 py-4 shadow-lg max-w-md rounded-lg  dark:bg-gray-800">

                    <form @submit.prevent="submit">
                        <div>
                            <InputLabel for="email" value="Email" />

                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full font-semibold text-sm"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="Email"
                            />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="password" value="Password" />

                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full font-semibold text-sm"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                                placeholder="At lease 8 characters"
                            />

                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div class="mt-4 block">
                            <label class="flex items-center">
                                <Checkbox name="remember" v-model:checked="form.remember" />
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400"
                                >Remember me</span
                                >
                            </label>
                        </div>

                        <div class="mt-4 flex justify-between items-center">
                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                            >
                                Forgot your password?
                            </Link>
                            <Link
                                v-if="canResetPassword"
                                :href="route('register')"
                                class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                            >
                                New User?
                            </Link>


                        </div>
                        <div class="mt-4 flex justify-center ">
                            <PrimaryButton
                                class="w-full justify-center py-3"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Log in
                            </PrimaryButton>
                        </div>
                    </form>
                    <div class="flex items-center gap-4 my-4">
                        <div class="flex-grow h-px bg-gray-500"></div>
                        <span class="text-gray-500 text-sm whitespace-nowrap">Or</span>
                        <div class="flex-grow h-px bg-gray-500"></div>
                    </div>
                    <div class="space-y-4">
                        <div class="bg-white rounded-full bg-opacity-50  py-3 px-2 text-slate-600 font-semibold shadow-lg ">
                            <div class="flex  gap-3 justify-center items-center">
                                <svg xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 48 48">
                                    <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path><path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path><path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path><path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
                                </svg>
                                Sign in with Google
                            </div>
                        </div>
                        <div class="bg-white rounded-full bg-opacity-50  py-3 px-2 text-slate-600 font-semibold shadow-lg ">
                            <div class="flex  gap-3 justify-center items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="fill-blue-700"  x="0px" y="0px" width="26" height="26" viewBox="0 0 48 48">
                                    <path d="M25,3C12.85,3,3,12.85,3,25c0,11.03,8.125,20.137,18.712,21.728V30.831h-5.443v-5.783h5.443v-3.848 c0-6.371,3.104-9.168,8.399-9.168c2.536,0,3.877,0.188,4.512,0.274v5.048h-3.612c-2.248,0-3.033,2.131-3.033,4.533v3.161h6.588 l-0.894,5.783h-5.694v15.944C38.716,45.318,47,36.137,47,25C47,12.85,37.15,3,25,3z"></path>
                                </svg>
                                Sign in with Facebook
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </GuestLayout>
</template>
