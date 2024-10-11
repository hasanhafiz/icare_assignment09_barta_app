@include('partials.header')
<body class="bg-gray-100">
    <header>
        @include('partials.nav')
    </header>

    <main class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
        @yield('content')
    </main>
@include('partials.footer')
