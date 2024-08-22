<template>

    <div class="max-w-fit mx-auto">This Listing is created by : {{ listing.owner.name }} </div>
    <div class="mt-3 flex justify-center text-medium text-zinc-500 gap-4">
        <p>listing lastCreated : {{ formatDays(listing.days_since_created) }} </p>
        <p>listing lastUpdated: {{ formatDays(listing.days_since_updated) }}</p>


    </div>

    <div class=" mr-4 p-4 flex gap-3">
        <p class="text-large text-center">Salary:</p>
        <span class="text-medium text-zinc-500"> {{ listing.formatted_salary_range }}</span>
    </div>


    <div v-html="parsedDescription"></div>

</template>

<script>
import { marked } from 'marked';

export default {
    props: {
        listing: Object,
    },
    computed: {
        parsedDescription() {
            return marked(this.listing.description);
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
};
</script>

<style scoped>
/* Add some basic styling for the Markdown content */
:deep(h1) {
    font-size: 1.5em;
    font-weight: bold;
    margin-top: 1em;
    margin-bottom: 0.5em;
}

:deep(p) {
    margin-bottom: 1em;
}

:deep(ul),
:deep(ol) {
    margin-left: 1em;
    margin-bottom: 1em;
}
</style>
