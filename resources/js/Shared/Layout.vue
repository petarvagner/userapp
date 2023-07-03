<script setup lang="ts">
import Nav from "@/Shared/Nav.vue";
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";

const user = computed(() => usePage().props?.auth.user)
</script>

<template>

    <section class="p-6 shadow-md bg-blue-100">
        <header class="flex justify-between items-center">
            <h1 class="font-bold text-lg">User App</h1>
            <p>
                Welcome back, {{ user.name }}
            </p>
            <Nav />
        </header>
    </section>

    <section class="p-6">
        <div class="max-w-4xl mx-auto">
            <slot />
        </div>
    </section>
</template>

<style scoped>

</style>