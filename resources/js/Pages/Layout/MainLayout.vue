<template>
  <header class="max-w-full bg-zinc-900 p-4">
    <div class="mx-4 flex flex-col sm:flex-row justify-between items-center">
      <nav aria-label="Main navigation" class="flex gap-3">
        <Link :href="route('listings.index')" class="text-white hover:text-gray-300">Home</Link>
        <a href="#" class="text-white hover:text-gray-300">Listings</a>
      </nav>
      <nav aria-label="User actions" class="flex gap-3 mt-2 sm:mt-0">
        <Link :href="route('login')" class="text-white hover:text-gray-300">Login/Register</Link>
        <a href="#" class="text-white hover:text-gray-300">Contact Sales</a>
      </nav>
    </div>
  </header>
  <main>
    <slot>Default</slot>
  </main>
</template>


<script setup>
import {Link} from '@inertiajs/vue3'
</script>
