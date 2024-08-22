<template>
    <div class="flex gap-1">
       <Link v-for="(link, index) in links"
        :key="index"
        class="py-2 px-4 rounded-md"
        :href="link.url"
        v-html="link.label"
        :class="{
            'bg-blue-500 text-white': link.active,
            'bg-white text-blue-500': !link.active
        }"
        />

    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({
    links:Array,
})
</script>
