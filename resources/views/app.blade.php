<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="description" content="Omaash Middleman Service helps you grade your valuable Pokémon and other TCG card collections using PSA, BGS, and CGC card grading companies.">
        <meta name="keywords" content="Omaash, Pokemon, Pokémon, pokémon tcg, pokemon streaming, card openings, Pokemon Collection, Card Grading, Grading Service, TCG, CGC, PSA, BGS, Dragon Ball Super, MetaZoo, Digimon, Weiss Schwarz, red, blue, yellow, pikachu, bulbasaur, squirttle, charmander, Charizard, Blastoise, Venasaur, how to grade cards, card grading services near me, grading middleman, psa middleman usa">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bungee&family=Source+Sans+Pro:wght@400;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
