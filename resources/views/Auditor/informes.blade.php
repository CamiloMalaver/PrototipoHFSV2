@extends('layout.layout')

@section('module-container')
@php
    $oneWeekBefore = \Carbon\Carbon::now()->subWeek();
@endphp
<div class="module">
    <span class="title">Informes</span>
    <div class="tab-container informes-container">
        <form class="form-new-user" action="{{route('auditor-informes-generar')}}" method="POST">
            @csrf
            <span class="subtitle">Fecha inicial</span>
            <input type="date" name="fecha_inicial" class="input informe-range" placeholder="Ingresa la fecha inicial" max="{{ $oneWeekBefore->format('Y-m-d') }}"  required>
            <span class="subtitle">Fecha final</span>
            <input type="date" name="fecha_final" class="input informe-range" placeholder="Ingresa la fecha final" max="{{ date('Y-m-d') }}" required>
            <span class="subtitle">Docente</span>
            <input type="hidden" name="user_id">
            <div class="select-container">
                    <div class="select">
                        <input type="text" id="input" placeholder="Elige el docente" name="select_user" onfocus="this.blur();" required>
                    </div>
                    <div class="option-container">
                        @foreach($users as $user)
                        <div class="option">
                            <label>{{$user->nombres . ' ' . $user->apellidos}}</label>
                            <input type="hidden" name="user_id_tmp" value="{{$user->id}}">
                        </div>
                        @endforeach
                    </div>
                </div>
            <button type="submit" class="btn-function-action generate-inform">Generar informe</button>
        </form>
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
</div>
@endsection


@section('js-container')
<script src="{{asset('js/auditor.js')}}" type="text/javascript"></script>
@endsection