<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <x-assets.seo/>
        <x-assets.css/>
        <x-assets.js/>
    </head>
    <body>
        <x-global.navigator/>
        <x-global.header/>

        <livewire:serverlist/>
        <x-homepage.statistics/>
        <x-homepage.features/>

        <x-global.footer/>
    </body>
</html>
