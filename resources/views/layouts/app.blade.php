@php
    $title = trim($__env->yieldContent('title', 'Home'));
@endphp

<x-layouts.app :title="$title">
    @yield('content')
</x-layouts.app>
