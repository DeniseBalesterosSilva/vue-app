<!-- resources/js/App.vue -->
<template>
  <div class="antialiased bg-gray-100 dark:bg-gray-900 dark:text-gray-100 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white border-gray-200 dark:bg-gray-800">
      <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
          <img src="../../public/assets/app-icon.svg" class="h-8" alt="Logo" />
          <span class="self-center text-2xl font-semibold whitespace-nowrap">Babilonia</span>
        </a>

        <!-- Tabs: você pode trocar por um componente Vue futuramente -->
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1">
          <!-- Exemplo simples de tabs -->
          <TabNavigation />
        </div>

        <div class="flex md:order-2 rtl:space-x-reverse items-center space-x-4">
          <!-- Espaço para dropdown ou dark-mode -->
        </div>
      </div>
    </nav>

    <!-- Conteúdo das páginas -->
    <main class="flex-grow mx-4">
      <slot />
    </main>
  </div>
</template>

<script>
import TabNavigation from './Components/TabNavigation.vue'; // Adaptando a antiga @include

export default {
  name: 'AppLayout',
  components: {
    TabNavigation,
  },
};
</script>
