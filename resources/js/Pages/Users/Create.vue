<script lang="ts">
export default {
    layout: null
}
</script>

<script setup lang="ts">
import { ref } from "vue";
import { useForm, Link, Head } from "@inertiajs/vue3";

const form = useForm({
    'name': '',
    'email': '',
    'password': '',
})

const showPassword = ref(false)

const submit = () => {
    form.post('/users')
}
</script>

<template>
    <Head title="Create User"/>
    <h1 class="text-3xl">Create new user</h1>
    <form @submit.prevent="submit" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
        <div>
            <label for="name" class="sr-only">Name</label>

            <div class="relative">
                <input
                    v-model="form.name"
                    type="text"
                    name="name"
                    id="name"
                    class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                    placeholder="Enter name"
                />

                <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="h-4 w-4 text-gray-400"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </span>
            </div>

            <div v-if="form.errors.name" v-text="form.errors.name" class="text-red-500 text-xs mt-1"></div>
        </div>
        <div>
            <label for="email" class="sr-only">Email</label>

            <div class="relative">
                <input
                    v-model="form.email"
                    type="email"
                    name="email"
                    id="email"
                    class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                    placeholder="Enter email"
                />

                <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4 text-gray-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"
                        />
                    </svg>
                </span>
            </div>

            <div v-if="form.errors.email" v-text="form.errors.email" class="text-red-500 text-xs mt-1"></div>

        </div>

        <div>
            <label for="password" class="sr-only">Password</label>

            <div class="relative">
                <input
                    v-model="form.password"
                    :type="showPassword ? 'text' : 'password'"
                    class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                    placeholder="Enter password"
                />

                <span class="absolute inset-y-0 end-0 grid place-content-center px-4" @click="showPassword = !showPassword">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4 text-gray-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                        />
                    </svg>
                </span>
            </div>

            <div v-if="form.errors.password" v-text="form.errors.password" class="text-red-500 text-xs mt-1"></div>

        </div>

        <div class="flex items-center justify-between">
            <p class="text-sm text-gray-500">
                Have an account?
                <Link class="underline" href="/login" as="a">Sign in</Link>
            </p>

            <button
                type="submit"
                class="inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white"
                :class="{'bg-gray': form.processing}"
                :disabled="form.processing"
            >
                Create
            </button>
        </div>
    </form>
</template>