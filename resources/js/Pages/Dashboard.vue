<template>

    <form @submit.prevent="onSubmitSearch" class="max-w-sm mx-auto">
    <div class="relative w-full max-w-md mx-auto">
    <input
        v-model="searchTerm"
        type="search"
        id="default-search"
        name="q"
        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 pl-4 pr-10 py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Busca"
    />

    <button type="submit" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-blue-600">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z"/>
        </svg>
    </button>
    </div>

    </form>

    <ul class="w-full max-w-md mx-auto divide-y divide-gray-200 divide-gray-700">
    <li class="pb-3 sm:pb-4" v-for="chunk in chunks.data" key="chunk.id">
        <Link :href="route('chunk', chunk.id)">
        <div class="flex justify-between items-center w-full">
            
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900 truncate text-white">
                {{ chunk.artigo }}
                </p>
                <p class="text-sm text-gray-500 truncate text-gray-400">
                {{ chunk.titulo }}
                </p>
            </div>
            <div class="inline-flex items-center text-base font-semibold text-gray-900 text-white">
                Página {{ chunk.pagina }}
            </div>
        </div>
        </Link>
    </li>   
    </ul>
    
    <div class="flex flex-wrap justify-center gap-2 mt-4 mb-4">
        <pagination :data="chunks" />
    </div>

</template>


<script>
import AppLayout from '../App.vue';
import Pagination from '@/Components/Pagination.vue'

export default {
    layout: AppLayout,
    name: 'Dashboard',
    components: {
        Pagination
    },
    props: {
        chunks: {
            type: Object,
        }
    },
    data() {
        return {
            searchTerm: ''
        }
    },
    methods: {
        onSubmitSearch() {
            this.$inertia.get(route('dashboard', {'search': this.searchTerm}));
        }
    }
}
</script>

