<template>

<nav aria-label="Page navigation example">
  <ul class="flex items-center -space-x-px h-8 text-sm">
    <li>
      <Link :href="data.prev_page_url || '#'" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
        <span class="sr-only">Previous</span>
        <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
        </svg>
      </Link>
    </li>
    <li v-for="link in cleanLinks" :key="link.label">
      <Link :href="link.url || '#'" class="flex items-center justify-center px-3 h-8 leading-tight border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
      :class="{ 'bg-gray-500 text-gray-900 font-bold': link.active, 'text-gray-500 bg-white': !link.active, 'hidden sm:inline-flex': (link.label > data.current_page + 1 || link.label < data.current_page - 1) }">
        {{ link.label }}
      </Link>
    </li>
    <li>
      <Link :href="data.next_page_url || '#'" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
        <span class="sr-only">Next</span>
        <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
        </svg>
      </Link>
    </li>
  </ul>
</nav>

</template>

<script>
import { Link } from '@inertiajs/vue3'

export default {
    name: "Pagination",
    props: {
        data: {
            type: Object,
        }
    },
    computed: {
        cleanLinks() {
            const cleanLinks = [...this.data.links];
            cleanLinks.shift(); // Remove the first link (usually "First")
            cleanLinks.pop(); // Remove the last link (usually "Last")
            return cleanLinks;
        },

    }
};
</script>