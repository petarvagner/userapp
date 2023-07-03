<script setup lang="ts">
import { computed, ComputedRef } from 'vue'
import {Head, usePage} from '@inertiajs/vue3'

const user: ComputedRef<User> = computed(() => usePage().props?.auth.user)
</script>

<template>
    <Head>
       <title> Home </title>
    </Head>
    <h1 class="text-3xl">
        Your Account
    </h1>
    <div class="grid grid-cols-2 gap-4">
        <section class="mt-3">
            <h2 class="text-lg">Your personal details</h2>
            <div class="text-sm mt-2">Your Name</div>
            <span class="text-gray-500">{{ user.name }}</span>
            <div class="text-sm mt-2">Your email</div>
            <span class="text-gray-500">{{ user.email }}</span>
        </section>
        <section class="mt-3">
            <h2 class="text-lg">Your tokens</h2>
            <table
                    v-if="user.tokens.length > 0"
                    class="min-w-full mt-4 divide-y divide-gray-200"
            >
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="py-2 px-4 text-sm font-normal text-left text-gray-500">
                        Name
                    </th>

                    <th scope="col" class="py-2 px-4 text-sm font-normal text-left text-gray-500">
                        Last Used
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="token in user.tokens">
                    <td class="px-4 py-2 text-sm font-medium whitespace-nowrap">
                        {{ token.name }}
                    </td>
                    <td class="px-4 py-2 text-sm font-medium whitespace-nowrap">
                        {{ token.lastUsed }}
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
    </div>
</template>

<style scoped>

</style>