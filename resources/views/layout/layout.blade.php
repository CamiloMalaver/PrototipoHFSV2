<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{secure_asset('css/app.css')}}">
        
        <title>Prototipo HFS</title>
    </head>
    <body>
        <div class="app-header">
            <div class="app-header-user-info-container">
                <span class="user-name">{{ auth()->user()->nombres . ' ' . auth()->user()->apellidos }}</span>
                <span class="user-rol">{{auth()->user()->rol->nombre_rol}}</span>
            </div>
        </div>
        <div class="app-content">
            <div class="sidebar">
                <div class="top-container">
                    <span class="app-header-title">PROTOTIPO HFS</span>
                </div>
                <div class="bottom-container">
                    @if(auth()->user()->rol_id == 1)
                    <a class="flat-button {{ request()->route()->getName() === 'administrador-usuarios' ? 'active-module' : '' }}" href="{{route('administrador-usuarios')}}" id="btn_usuarios">
                        <img class="icon" src="{{secure_asset('img/people.png')}}" alt="">
                        <span class="">Usuarios</span>
                    </a>
                    <a class="flat-button {{ request()->route()->getName() === 'administrador-funciones' ? 'active-module' : '' }}" href="{{route('administrador-funciones')}}" id="btn_funciones">
                        <img class="icon" src="{{secure_asset('img/bulk/autonio.png')}}" alt="">
                        <span class="">Funciones</span>
                    </a>
                    @endif
                    @if(auth()->user()->rol_id == 2)
                    <a class="flat-button {{ request()->route()->getName() === 'auditor-misdocentes' ? 'active-module' : '' }}" href="{{route('auditor-misdocentes')}}" id="btn_docentes">
                        <img class="icon" src="{{secure_asset('img/bulk/calendartick.png')}}" alt="">
                        <span class="">Docentes</span>
                    </a>
                    <a class="flat-button {{ request()->route()->getName() === 'auditor-informes' ? 'active-module' : '' }}" href="{{route('auditor-informes')}}" id="btn_informes">
                        <img class="icon" src="{{secure_asset('img/bulk/clipboardtext.png')}}" alt="">
                        <span class="">Informes</span>
                    </a>
                    <a class="flat-button {{ request()->route()->getName() === 'auditor-ajustes' ? 'active-module' : '' }}" href="{{route('auditor-ajustes')}}" id="btn_ajustes">
                        <img class="icon" src="{{secure_asset('img/bulk/candle.png')}}" alt="">
                        <span class="">Ajustes</span>
                    </a>
                    @endif
                    @if(auth()->user()->rol_id == 3)
                    <a class="flat-button {{ request()->route()->getName() === 'docente-misfunciones' ? 'active-module' : '' }}" href="{{route('docente-misfunciones')}}" id="btn_mis_funciones">
                        <img class="icon" src="{{secure_asset('img/bulk/calendartick.png')}}" alt="">
                        <span class="">Mis funciones</span>
                    </a>
                    <a class="flat-button {{ request()->route()->getName() === 'docente-informes' ? 'active-module' : '' }}" href="{{route('docente-informes')}}" id="btn_informes">
                        <img class="icon" src="{{secure_asset('img/bulk/clipboardtext.png')}}" alt="">
                        <span class="">Informes</span>
                    </a>
                    <a class="flat-button {{ request()->route()->getName() === 'docente-ajustes' ? 'active-module' : '' }}" href="{{route('docente-ajustes')}}" id="btn_ajustes">
                        <img class="icon" src="{{secure_asset('img/bulk/candle.png')}}" alt="">
                        <span class="">Ajustes</span>
                    </a>
                    @endif                    
                    <a class="flat-button" href="{{route('salir')}}">
                        <img class="icon" src="{{secure_asset('img/bulk/arrowleft.png')}}" alt="">
                        <span class="">Cerrar sesión</span>
                    </a>
                </div>
            </div>
            <div class="app-module-container">
                @yield('module-container')
            </div>
        </div>
        <script src="{{secure_asset('js/jquery-3.7.0.min.js')}}" type="text/javascript"></script>
        @yield('js-container')
    </body>
</html>