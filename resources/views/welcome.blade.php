@extends('layouts.app')
@section('content')
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <div id="app">
                <div class="links" style="text-align:center;">
                    <div class="users" style="display: inline-block;">
                        <router-link to="/user/list">Użytkownicy</router-link>
                    </div>
                    <div class="companys" style="display: inline-block;">
                        <router-link to="/company/list">Firmy</router-link>
                    </div>
                </div>
                <router-view></router-view>
            </div>
        <script src="{{mix('js/app.js')}}"></script>

    </div>
    </body>
@endsection
