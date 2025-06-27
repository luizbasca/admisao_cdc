<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistema E-Social - Cadastro de Funcionários')</title>

    <!-- Vite Assets -->
    @vite(['resources/scss/app.scss', 'resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
    
    <!-- Livewire Styles -->
    @livewireStyles
</head>

<body>
    @include('partials.progress-indicator')
    @include('partials.navbar')

    <!-- Main Content -->
    <main class="container my-4">
    @include('partials.alerts')
    @yield('content')
    </main>

    @include('partials.toasts')

    @stack('scripts')
    
    <!-- Livewire Scripts -->
    @livewireScripts
</body>

</html>