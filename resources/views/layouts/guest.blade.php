<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'e-Bursary') }}</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Favicon (optional) --}}
    <link rel="icon"
          href="{{ asset('favicon.ico') }}">
</head>

<body class="bg-gray-100 text-gray-900 antialiased">
    {{ $slot }}
</body>

</html>
