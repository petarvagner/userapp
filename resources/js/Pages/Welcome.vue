<script setup lang="ts">
import type { PropType } from 'vue'
import { computed } from 'vue'
import route from 'ziggy-js'
import { Head, Link, usePage } from '@inertiajs/vue3'

defineProps({
    name: String as PropType<string>,
})

// const user = computed(() => usePage().props?.user)
</script>

<template>
    <h1 class="text-3xl font-bold underline">
        Hello world!
    </h1>
</template>

<style scoped>

</style>