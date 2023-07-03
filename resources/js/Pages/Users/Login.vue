<script lang="ts">
export default {
    layout: null
}
</script>

<script setup lang="ts">
import { ref } from "vue";
import { useForm, Head } from "@inertiajs/vue3";
import NavLink from "@/Shared/NavLink.vue";

const form = useForm({
    'email': '',
    'password': '',
})

const showPassword = ref(false)

const submit = () => {
    form.post('/login')
}
</script>

<template>
    <Head title="Login Page"/>
    <main class="grid place-items-center min-h-screen">
        <section class="p-6 border rounded-xl m-auto w-96">
            <h1 class="text-3xl mb-3">Login Page</h1>
            <form @submit.prevent="submit" class="mb-0 mt-8 space-y-4">
                <div>
                    <label for="email" class="sr-only">Email</label>

                    <div class="relative">
                        <input
                                v-model="form.email"
                                type="email"
                                name="email"
                                id="email"
                                class="border w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
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
                                class="w-full border rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
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

                    <p class="text-sm text-gray-500">
                        Don't have an account?
                        <NavLink class="underline" href="/register" as="a">Register</NavLink>
                    </p>

                    <button
                            type="submit"
                            class="inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white"
                            :class="{'bg-gray': form.processing}"
                            :disabled="form.processing"
                    >
                        Log In
                    </button>
            </form>
        </section>
    </main>

</template>

<style scoped>

</style>