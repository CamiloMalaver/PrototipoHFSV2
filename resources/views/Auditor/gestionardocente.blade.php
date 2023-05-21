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
            <div class="form-row right">
                <a class="btn-function-action back-action" href="{{route('auditor-misdocentes')}}">Regresar</a>
            </div>
            <div class="form-row right mt-10">
                <button class="btn-function-action primary" id="toggle_new_function_form">Nueva función</button>
            </div>
        </div>
    </div>
    <div class="tab-container content-container d-none" id="form_add_function_container">
        <form class="form-new-user" action="{{route('auditor-asignar-funcion')}}" method="POST">
            @csrf
            <div class="form-row new-function">
                <input type="hidden" name="docente_id" value="{{$docente->id}}">
                <input id="input_function_date" type="date" class="input input-form-text" name="fecha_de_funcion" placeholder="Fecha de función" required>
                <input type="time" class="input input-form-time" name="hora_de_inicio" placeholder="Email docente" required>
                <input type="time" class="input input-form-time" name="hora_final" placeholder="Email docente" required>
            </div>
            <div class="form-row new-function">
                <input class="input input-form-text" type="text" name="lugar" placeholder="Lugar" maxlength="80" required>
                <div class="select-container">
                    <div class="select">
                        <input type="text" id="input" placeholder="Tipo de funcion" name="select_function" onfocus="this.blur();" required>
                    </div>
                    <div class="option-container">
                        @foreach($tipofuncion as $funcion)
                        <div class="option">
                            <label>{{$funcion->nombre}}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="form-row">
                <button type="submit" class="btn-function-action">Asignar función</button>
            </div>
        </form>
    </div>
    <div class="tab-container content-container">
        @if ($errors->any())
        <div class="login-errors-container">
            @foreach ($errors->all() as $error)
            <div class="content-error-message">
                {{ $error }}
            </div>
            @endforeach
        </div>
        @endif
        @if(session()->has('message'))
        <div class="login-errors-container">
            <div class="content-success-message">
                {{ session()->get('message') }}
            </div>
        </div>
        @endif
    </div>
    <div class="tab-container content-container">
        <span class="subtitle josefin-bold">Funciones sustantivas asignadas</span>
        <div class="card-users-container">
            @if($funciones)
            @foreach($funciones as $func)
            <div class="user-card">
                <div class="profile-icon-container">
                    <img class="icon user-profile-pic" src="{{asset('img/bulk/autonio.png')}}" alt="">
                </div>
                <span class="user-full-name funct-type">{{$func->tipoFuncion->nombre}}</span>
                <span class="user-role funct-time">{{$func->lugar}}</span>
                <span class="user-role funct-time">{{$func->time_difference}} horas</span>
                <div class="actions-container">
                    @if($func->estado_id == 2)
                    <div class="tooltip">
                        <div class="action">
                            <a href="{{route('auditor-detalle-reporte', $func->id)}}"><img class="icon" src="{{asset('img/bulk/searchstatus.png')}}" alt=""></a>
                        </div>
                        <span class="tooltiptext">Revisar</span>
                    </div>
                    @else
                    <div class="tooltip">
                        <div class="action">
                            <a href="{{route('auditor-detalle-reporte', $func->id)}}"><img class="icon" src="{{asset('img/bulk/eye.png')}}" alt=""></a>
                        </div>
                        <span class="tooltiptext">Ver detalle</span>
                    </div>
                    @endif 
                    <div class="status-badge status{{$func->estado_id}}">
                        <span class="text">{{$func->estado->nombre}}</span>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <span class="subtitle josefin-light">Aún no has registrado funciones para este docente.</span>
            @endif
        </div>
        <div class="tab-container content-container mt-10">
            {{$funciones->links()}}
        </div>
    </div>
</div>
@endsection


@section('js-container')
<script src="{{asset('js/auditor.js')}}" type="text/javascript"></script>
@endsection