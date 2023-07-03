<script setup lang="ts">
import {Link, usePage} from "@inertiajs/vue3";
import NavLink from "@/Shared/NavLink.vue";
import {computed} from "vue";

const user = computed(() => usePage().props?.auth.user)
</script>

<template>
    <nav>
        <ul class="flex space-x-6">
            <li v-if="$page.component !== 'Home'"><NavLink url="/">Back</NavLink></li>
            <li v-else><NavLink :url="/users/+user.id">Edit Account</NavLink></li>
            <li><NavLink href="/logout" method="POST" as="button" class="text-blue-500 hover:underline">Log Out</NavLink></li>
        </ul>
    </nav>
</template>

<style scoped>

</style>