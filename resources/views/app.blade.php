<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Vue Study</title>
    
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">

    @vite(['resources/js/app.js', 'resources/css/app.css'])

    @inertiaHead
    @routes

    <!-- Fontes e estilos externos se quiser -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>

  <body class="antialiased bg-gray-100 dark:bg-gray-900 dark:text-gray-100">
    @inertia
  </body>
</html>
