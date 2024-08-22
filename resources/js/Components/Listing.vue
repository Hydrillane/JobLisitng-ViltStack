<template>
  <div class="listing-card flex items-center justify-between py-4 border-b border-gray-200">
    <div class="listing-details flex-grow">
  <Link :href="route('listings.show', {listing: listing.id})" class="job-title text-lg font-semibold text-blue-600">
    {{ listing.position }}
  </Link>
      <p class="company-name text-base font-medium">{{ listing.company }}</p>
      <p class="location text-sm text-gray-600">
        {{ listing.location }}
      </p>
      <p class="posted-date text-sm text-gray-500">
        {{ listing.position }} Posted
      </p>
    </div>
    <div class="company-logo ml-4">
      <img :src="listing.logo_url" :alt="listing.company + ' logo'" class="w-16 h-16 object-contain">
    </div>
  </div>
</template>

<script>

import { Link } from '@inertiajs/vue3'
export default {
    components: {
    Link
    },
  props: {
    listing: {
      type: Object,
      required: true
    }
  },
  methods: {
    formatDays(days) {
      if (days < 1) {
        return 'Today';
      }
      if (days > 1 && days < 2) {
        return 'Yesterday';
      } else {
        return `${parseInt(days)} days ago`;
      }
    }
  }
}
</script>
