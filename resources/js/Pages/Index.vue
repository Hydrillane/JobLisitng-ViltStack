<template>
    <v for="listing in listings" :key="listing.id">
    {{listing.position}}
    {{listing.name}}
    {{lisitng.company}}
    </v for="listing in listings">
</template>


<script setup>
defineProps({
    listings:Array,
})
</script>
