<template>
    <Search :filters="filters" />
<div class="max-w-7xl mx-auto font-sans">
<header class="flex justify-between items-center py-4">
  <div class="flex items-center space-x-4">
                <span class="text-xl font-bold">{{totalCount}} Jobs Found</span>
  </div>
  <button class="bg-blue-600 text-white px-4 py-2 rounded">Email Jobs</button>
</header>
<div class="max-w-7xl mx-auto font-sans flex">
  <!-- Left sidebar with filters -->
  <aside class="w-1/4 pr-8">
                <Filters />
  </aside>

  <!-- Main content area with job listings -->
  <main class="w-3/4">
                <div v-for="listing in listings.data" :key="listing.id">
                    <Listing :listing="listing" />
                </div>
            </main>

</div>
</div>
</template>


<script setup>
import Boxs from '../../Components/Boxs.vue';
import Listing from '../../Components/Listing.vue';
import Pagination from '../../Components/Pagination.vue';
import { Link, useForm } from '@inertiajs/vue3';
import Filters from '../../Components/Filters.vue';
import Search from '../../Components/Search.vue';
const props = defineProps({
    listings: Object,
    filters: Object,
    totalCount: Number
});


const form = useForm({
    position: props.filters.position ?? null,
    location: props.filters.location ?? null
});

const search = () => {
    form.get(route("listing.index"), {
        preserveState: true,
        preserveScroll: true,
    })
}

const searchLocation = () => {
    form.get(route("listing.index"), {
        preserveState: true,
        preserveScroll: true
    })

}

</script>
