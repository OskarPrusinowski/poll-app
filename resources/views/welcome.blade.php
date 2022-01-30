@extends('layouts.app')
@section('content')
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <div id="app">
                <main-vue></main-vue>
            </div>
        <script src="{{mix('js/app.js')}}"></script>

    </div>
    </body>
@endsection
