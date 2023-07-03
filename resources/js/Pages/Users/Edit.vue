<script setup lang="ts">
import {computed, ComputedRef, ref, defineProps, PropType} from "vue";
import {useForm, Link, Head, usePage} from "@inertiajs/vue3";

const props = defineProps({
    'token': {
        type: String as PropType<string>,
        default: ''
    }
})

const user: ComputedRef<User> = computed(() => usePage().props?.auth.user)

const updateUserForm = useForm({
    'name': user.value.name,
    'email': user.value.email,
    'newPassword': undefined,
})
const createTokenForm = useForm({
    'name': '',
})
const showPassword = ref(false)
const isCopied = ref(false)

const updateUser = () => {
    if (!updateUserForm.newPassword) {
        updateUserForm.newPassword = undefined
    }
    updateUserForm.post('/users/'+user.value.id, {
    })
}
const createToken = () => {
    createTokenForm.post('/tokens', {
        preserveScroll: true,
        onSuccess: function () {
            createTokenForm.reset()
        },
    })
}

const copyToClipboard = async () => {
    try {
        if (!navigator.clipboard) {
            throw new Error("Browser don't have support for native clipboard.");
        }
        await navigator.clipboard.writeText(props.token as string)
        isCopied.value = true
        setTimeout( () => {
            isCopied.value = false
        }, 5000);
    } catch (error) {
        console.log(error.toString())
    }
}
</script>

<template>
    <Head title="Edit User Account"/>
    <h1 class="text-3xl">Edit User Account</h1>
    <div class="grid grid-cols-2 gap-6">
        <form @submit.prevent="updateUser" class="mb-0 mt-8 space-y-4">
            <div>
                <label for="name" class="sr-only">Name</label>

                <div class="relative">
                    <input
                            v-model="updateUserForm.name"
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

                <div v-if="updateUserForm.errors.name" v-text="updateUserForm.errors.name" class="text-red-500 text-xs mt-1"></div>
            </div>
            <div>
                <label for="email" class="sr-only">Email</label>

                <div class="relative">
                    <input
                            v-model="updateUserForm.email"
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

                <div v-if="updateUserForm.errors.email" v-text="updateUserForm.errors.email" class="text-red-500 text-xs mt-1"></div>

            </div>

            <div>
                <label for="password" class="sr-only">Password</label>

                <div class="relative">
                    <input
                            v-model="updateUserForm.newPassword"
                            :type="showPassword ? 'text' : 'password'"
                            class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                            placeholder="Create New Password"
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

                <div v-if="updateUserForm.errors.newPassword" v-text="updateUserForm.errors.newPassword" class="text-red-500 text-xs mt-1"></div>

            </div>

            <button
                    type="submit"
                    class="inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white"
                    :class="{'bg-gray': updateUserForm.processing}"
                    :disabled="updateUserForm.processing"
            >
                Update
            </button>
        </form>
        <form @submit.prevent="createToken" class="mb-0 mt-8 space-y-4">
            <div>
                <label for="name" class="sr-only">Name</label>

                <div class="relative">
                    <input
                            v-model="createTokenForm.name"
                            type="text"
                            name="name"
                            id="name"
                            class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                            placeholder="Enter Token Name"
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
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                    </svg>

                </span>
                </div>

                <div v-if="createTokenForm.errors.name" v-text="createTokenForm.errors.name" class="text-red-500 text-xs mt-1"></div>
            </div>

            <div class="grid justify-items-end">
                <button
                        type="submit"
                        class="flex rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white"
                        :class="{'bg-gray': createTokenForm.processing}"
                        :disabled="createTokenForm.processing"
                >
                    Create Token
                </button>
            </div>

        </form>
    </div>
    <section class="mt-6">
        <h2 class="text-lg">Your tokens</h2>
        <table
                v-if="user.tokens.length > 0"
                class="min-w-full divide-y divide-gray-200 mt-4"
        >
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="py-2 px-4 text-sm font-normal text-left text-gray-500">
                    Name
                </th>

                <th scope="col" class="py-2 px-4 text-sm font-normal text-left text-gray-500">
                    Token
                </th>

                <th scope="col" class="py-2 px-4 text-sm font-normal text-left text-gray-500">
                    Expires
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="token in user.tokens">
                <td class="px-4 py-3 text-sm font-medium whitespace-nowrap">
                    {{ token.name }}
                </td>
                <td class="px-4 py-3 text-sm font-medium whitespace-nowrap">
                    {{ token.lastUsed }}
                </td>
                <td class="px-4 py-3 text-sm font-medium whitespace-nowrap">
                    <Link :href="'/tokens/'+token.id" method="delete">Delete</Link>
                </td>
            </tr>
            </tbody>
        </table>
        <div
                v-else
                class="text-gray-500 text-base"
        >
            No tokens created yet.
        </div>
    </section>
    <div v-if="!!token"
         class="fixed inset-0 z-10 overflow-y-auto"
         aria-labelledby="modal-title" role="dialog" aria-modal="true"
    >
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="relative inline-block p-4 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl sm:max-w-sm rounded-xl sm:my-8 sm:w-full sm:p-6">

                <div class="mt-5 text-center">
                    <h3 class="text-lg font-medium text-gray-800" id="modal-title">
                        Api Token Created!
                    </h3>

                    <p class="mt-2 text-gray-500">
                        Please save copy and save the API token since You cannot retrieve it again after closing this dialog.
                    </p>
                </div>

                <div class="flex items-center justify-between w-full mt-5 gap-x-2">
                    <input type="text" :value="token" class="flex-1 block h-10 px-4 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring" />

                    <button
                            @click="copyToClipboard"
                            class="rounded-md hidden sm:block p-1.5 text-gray-700 bg-white border border-gray-200 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring transition-colors duration-300 hover:text-blue-500 dark:hover:text-blue-500">
                        <svg v-if="!isCopied" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                    </button>
                </div>

                <div class="mt-4 sm:flex sm:items-center sm:justify-between sm:mt-6 sm:-mx-2">
                    <Link
                        :href="'/users/'+user.id"
                        as="button"
                        class="px-4 sm:mx-2 w-full py-2.5 mt-3 sm:mt-0 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                        Close
                    </Link>
                </div>
            </div>
        </div>
    </div>

</template>