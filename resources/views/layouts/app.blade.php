<!DOCTYPE html>
<html lang="nl" dir="ltr">
<!-- Head -->
@include('layouts.head')

<body class="bg-gray-100">

    <!-- Top Bar -->
    @include('layouts.header')

    <!-- Sidebar -->
    @include('layouts.sidebar')

    <!-- Main Content -->
    <main class="pt-20 md:ml-60 ">

        {{-- Blade Content --}}
        @yield('content')
    </main>
    <!-- Footer -->
    @include('layouts.footer')
</body>

</html>
