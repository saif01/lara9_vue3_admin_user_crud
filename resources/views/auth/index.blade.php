<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- @include('common.cpbd-icon') --}}
    <title>CPB-IT Login</title>
    
</head>
<body>
    <div id="app">
        <div v-if="preloader" class="loader">
            <div class="loader-icon">Loading...</div>
        </div>
        <index-component></index-component>
        @if(config('values.app_debug')) <p>You Are Running In Local</p> @endif
    </div>
   
    @vite('resources/js/auth/js/app.js')
</body>

</html>
