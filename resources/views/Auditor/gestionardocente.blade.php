@extends('layout.layout')

@section('module-container')
<div class="module">
    <div class="assoc-docente-title-container">
        <div class="left-container">
            <span class="title mb-0">Gestionar docente</span>
            <span class="subtitle">{{$docente->nombres}} {{$docente->apellidos}}</span>
            <span class="subtitle">CC {{$docente->documento}}</span>
        </div>
        <div class="right-container">
            <form class="form-new-user" action="{{route('administrador-usuarios-asociardocente-exec')}}" method="POST">
                @csrf
                <input type="hidden" name="auditor_id" value="{{$docente->id}}">
                <div class="form-row right">
                    <a class="btn-function-action back-action" href="{{route('auditor-misdocentes')}}">Regresar</a>
                </div>
                <div class="form-row right">
                    <button type="submit" class="btn-function-action">Nueva función</button>
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
        <span class="subtitle josefin-bold">Funciones sustantivas asignadas</span>
        <div class="card-users-container">

            <div class="user-card">
                <div class="profile-icon-container">
                    <img class="icon user-profile-pic" src="{{asset('img/bulk/autonio.png')}}" alt="">
                </div>
                <span class="user-full-name"></span>
                <div class="actions-container">
                    <div class="action">
                        <img class="icon" src="{{asset('img/bulk/trash.png')}}" alt="">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection


@section('js-container')
<script src="{{asset('js/auditor.js')}}" type="text/javascript"></script>
@endsection