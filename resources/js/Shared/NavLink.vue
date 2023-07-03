<script setup lang="ts">
import {PropType} from "vue";

defineProps({
    url: String as PropType<string>,
    active: Boolean as PropType<boolean>,
})
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <Link :href="url" class="text-blue-500 hover:underline" :class="{ 'font-bold underline': active }">
        <slot />
    </link>
</template>

<style scoped>

</style>