<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <title>Prototipo HFS</title>
    </head>
    <body>
        <div class="app-header">
            <div class="app-header-user-info-container">
                <span class="user-name">Nombre Docente Emilio</span>
                <span class="user-rol">Administrador</span>
            </div>
        </div>
        <div class="app-content">
            <div class="sidebar">
                <div class="top-container">
                    <span class="app-header-title">PROTOTIPO HFS</span>
                </div>
                <div class="bottom-container">
                    <a class="flat-button" href="{{route('docente-misfunciones')}}">
                        <img class="icon" src="{{asset('img/bulk/people.png')}}" alt="">
                        <span class="">Usuarios</span>
                    </a>
                    <a class="flat-button" href="{{route('docente-misfunciones')}}">
                        <img class="icon" src="{{asset('img/bulk/autonio.png')}}" alt="">
                        <span class="">Funciones</span>
                    </a>
                    <a class="flat-button active-module" href="{{route('docente-misfunciones')}}">
                        <img class="icon" src="{{asset('img/bulk/calendartick.png')}}" alt="">
                        <span class="">Mis funciones</span>
                    </a>
                    <a class="flat-button" href="{{route('docente-informes')}}">
                        <img class="icon" src="{{asset('img/bulk/clipboardtext.png')}}" alt="">
                        <span class="">Informes</span>
                    </a>
                    <a class="flat-button" href="{{route('docente-ajustes')}}">
                        <img class="icon" src="{{asset('img/bulk/candle.png')}}" alt="">
                        <span class="">Ajustes</span>
                    </a>
                    <a class="flat-button" href="">
                        <img class="icon" src="{{asset('img/bulk/arrowleft.png')}}" alt="">
                        <span class="">Cerrar sesión</span>
                    </a>
                </div>
            </div>
            <div class="app-module-container">
                @yield('module-container')
            </div>
        </div>
        <script src="{{asset('js/jquery-3.7.0.min.js')}}" type="text/javascript"></script>
        @yield('js-container')
    </body>
</html>