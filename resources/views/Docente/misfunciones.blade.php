@extends('layout.layout')

@section('module-container')
<div class="module">
    <span class="title">Mis funciones</span>
    @if(session()->has('message'))
        <div class="mis-funciones-success-container">
            <div class="content-success-message">
                {{ session()->get('message') }}
            </div>
        </div>
    @endif
    <div class="tab-container">
        <div class="divider-start"></div>
        <div class="tab active" id="docente_today_tab">Hoy</div>
        <div class="tab" id="docente_incoming_tab">Próximas</div>
        <div class="tab" id="docente_previous_tab">Anteriores</div>
        <div class="divider-end"></div>
    </div>

    <div class="functions-container" id="docente_today_container">
        @foreach($funciones as $func)
            @if(date('Y-m-d') == $func->fecha)
                <div class="function-card">
                <div class="left-content">
                    <span class="function-type-name">{{$func->tipofuncion->nombre}}</span>
                    <span class="function-location">{{$func->lugar}}</span>
                    <span class="function-date">{{$func->fecha}}</span>
                </div>
                <div class="right-content">
                    <div class="status-badge status{{$func->estado->id}}">
                        <span class="text">{{$func->estado->nombre}}</span>
                    </div>
                    @if($func->estado->id == 1 && date('Y-m-d') == $func->fecha)
                    <a class="btn-function-action" href="{{route('docente-misfunciones-reportar', $func->id)}}">Enviar reporte</a>
                    @else
                    <a class="btn-function-action" href="{{route('docente-detalle-reporte', $func->id)}}">Ver detalle</a>
                    @endif
                </div>
            </div>
            @endif            
        @endforeach
    </div>
    <div class="functions-container d-none" id="docente_previous_container">
    @foreach($funciones as $func)
            @if(strtotime(date('Y-m-d')) > strtotime($func->fecha))
                <div class="function-card">
                <div class="left-content">
                    <span class="function-type-name">{{$func->tipofuncion->nombre}}</span>
                    <span class="function-location">Edificio nuevo 2002</span>
                    <span class="function-date">{{$func->fecha}}</span>
                </div>
                <div class="right-content">
                    <div class="status-badge status{{$func->estado->id}}">
                        <span class="text">{{$func->estado->nombre}}</span>
                    </div>
                    <a class="btn-function-action" href="{{route('docente-detalle-reporte', $func->id)}}">Ver detalle</a>
                </div>
            </div>
            @endif            
        @endforeach
    </div>
    <div class="functions-container d-none" id="docente_incoming_container">
    @foreach($funciones as $func)
            @if(strtotime(date('Y-m-d')) < strtotime($func->fecha))
                <div class="function-card">
                <div class="left-content">
                    <span class="function-type-name">{{$func->tipofuncion->nombre}}</span>
                    <span class="function-location">Edificio nuevo 2002</span>
                    <span class="function-date">{{$func->fecha}}</span>
                </div>
                <div class="right-content">
                    <div class="status-badge status{{$func->estado->id}}">
                        <span class="text">{{$func->estado->nombre}}</span>
                    </div>
                </div>
            </div>
            @endif            
        @endforeach
    </div>
</div>
@endsection


@section('js-container')
<script src="{{asset('js/docente.js')}}" type="text/javascript"></script>
@endsection