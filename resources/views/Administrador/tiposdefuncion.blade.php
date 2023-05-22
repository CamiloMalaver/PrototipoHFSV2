@extends('layout.layout')

@section('module-container')
<div class="module">
    <div class="assoc-docente-title-container">
        <div class="left-container">
            <span class="title mb-0">Funciones sustantivas</span>
        </div>
        <div class="right-container">
            <form class="form-new-user" action="{{route('administrador-funciones-nueva')}}" method="POST">
                @csrf
                <div class="form-row  right">
                    <input type="text" class="input input-form-text" name="nombre_funcion" placeholder="Nombre de nueva función" required>
                </div>
                <div class="form-row right">
                    <a class="btn-function-action back-action" href="{{route('administrador-usuarios')}}">Regresar</a>
                    <button type="submit" class="btn-function-action">Registrar función</button>
                </div>
            </form>
            @if ($errors->any())
                <div class="login-errors-container">
                    @foreach ($errors->all() as $error)
                    <div class="content-error-message left">
                        {{ $error }}
                    </div>
                    @endforeach
                </div>
            @endif
            @if(session()->has('message'))
                <div class="login-errors-container">
                    <div class="content-success-message left">
                        {{ session()->get('message') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="tab-container content-container">
        <span class="subtitle josefin-bold">Funciones sustantivas</span>
        <div class="card-users-container">
            @foreach($funciones as $funcion)
            <div class="user-card">
                <div class="profile-icon-container">
                    <img class="icon user-profile-pic" src="{{secure_asset('img/autonio.png')}}" alt="">
                </div>
                <span class="user-full-name">{{$funcion->nombre}}</span>
                <div class="actions-container">
                    <div class="tooltip">
                        <div class="action">
                            <a href="{{route('administrador-funciones-eliminar', $funcion->id)}}"><img class="icon" src="{{secure_asset('img/trash.png')}}" alt=""></a>
                        </div>
                        <span class="tooltiptext">Eliminar</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection


@section('js-container')
<script src="{{secure_asset('js/administrador.js')}}" type="text/javascript"></script>
@endsection