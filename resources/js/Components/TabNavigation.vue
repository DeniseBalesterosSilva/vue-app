<template>

<div>
    <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white text-gray-900 dark:text-gray-100 dark:bg-gray-800">
        <li>
            <Link :href="route('dash')"
                class="py-2 px-3 rounded-sm"
                :class="isActiveTab('Dash') ? 'bg-primary text-white' : 'hover:bg-gray-100 dark:hover:bg-gray-700'">
                Dashboard
            </Link>
        </li>

        <li>
            <Link :href="route('assets-list')"
                class="py-2 px-3 rounded-sm"
                :class="isActiveTab('AssetsList') ? 'bg-primary text-white' : 'hover:bg-gray-100 dark:hover:bg-gray-700'">
                Ativos
            </Link>
        </li>

        <li>
            <Link :href="route('compare')"
                class="py-2 px-3 rounded-sm"
                :class="isActiveTab('Compare') ? 'bg-primary text-white' : 'hover:bg-gray-100 dark:hover:bg-gray-700'">
                Comparação
            </Link>
        </li>

        <li>
            <Link :href="route('consolidated')"
                class="py-2 px-3 rounded-sm"
                :class="isActiveTab('Consolidated') ? 'bg-primary text-white' : 'hover:bg-gray-100 dark:hover:bg-gray-700'">
                Consolidado
            </Link>
        </li>
    </ul>

</div>

</template>


<script>
import { Link, usePage } from '@inertiajs/vue3'

export default {
  components: {
    Link,
  },
  computed: {
    currentComponent() {
      return usePage().component
    },
  },
  methods: {
    isActiveTab(name) {
      return this.currentComponent === name
    },
  },
}
</script>