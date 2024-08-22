<template>
    <form @submit.prevent="filter">
  <div class="search-bar-container">
       <div class="search-bar flex items-center bg-white border rounded-md overflow-hidden my-4 gap-3">
      <div class="flex-grow flex items-center border-r">
        <span class="text-gray-400 px-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
          </svg>
        </span>
        <input
          type="text"
          placeholder="Input your job title"
          v-model="filterForm.position"
          class="w-full py-3 px-2 outline-none"
        >
      </div>
      <div class="flex-grow flex items-center">
        <span class="text-gray-400 px-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
          </svg>
        </span>
        <input
          type="text"
          v-model="filterForm.location"
          placeholder=""
          class="w-full py-3 px-2 outline-none"
        >
      </div>
      <button
        type="submit"
        class="bg-blue-600 text-white px-6 py-3 hover:bg-blue-700 transition duration-300"
      >
        Search Jobs
      </button>
    </div>
  </div>
    </form>
</template>

<script setup>
import {useForm} from "@inertiajs/vue3";

const props = defineProps({filters: Object});

const filterForm = useForm({
    position: props.filters.position ?? null,
    location: props.filters.location ?? null,
})


const filter = () => {
    filterForm.get(route("listings.index"), {
        preserveState: false,
        preserveScroll: true,
    });
};

</script>

<style scoped>
.search-bar-container {
  max-width: 1200px;
  margin: 0 auto;
}
.search-bar {
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}
</style>

