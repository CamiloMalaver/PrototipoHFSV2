@extends('layout.layout')

@section('module-container')
<div class="module">

    <div class="assoc-docente-title-container">
        <div class="left-container">
            <span class="title mb-0">{{$funcion->tipofuncion->nombre}}</span>
            <span class="subtitle">{{date('h:m a', strtotime($funcion->hora_inicio))}} - {{date('h:m a', strtotime($funcion->hora_final))}}</span>
            <span class="subtitle">{{$funcion->fecha}}</span>
        </div>
        <div class="right-container">
            <div class="status-badge status{{$funcion->estado->id}}">
                <span class="text">{{$funcion->estado->nombre}}</span>
            </div>
            <div class="form-row right mt-10">
                <a class="btn-function-action back-action" href="{{route('docente-misfunciones')}}">Regresar</a>
            </div>
        </div>
    </div>
    <div class="tab-container informes-container mt-10">
        <div class="card-detail-function mt-10">
            <span class="subtitle">Descripción de actividad</span>
            <span class="subtitle josefin-light text-start">{{$funcion->descripcion_actividad}}</span>
            <span class="subtitle">Observaciones</span>
            <span class="subtitle josefin-light text-start">{{$funcion->observaciones}}</span>
            <span class="subtitle">Evidencias</span>
            <div class="files-container">
                @foreach($funcion->evidencia as $evidencia)
                    <div class="file-download-item">
                        <a class="subtitle josefin-light text-start m-0" href="{{ url('storage/' . $evidencia->url) }}" download>{{$evidencia->nombre_archivo}}</a>
                        <img class="icon user-profile-pic" src="{{asset('img/bulk/documentdownload.png')}}" alt="">
                    </div>
                @endforeach
            </div>
            <span class="subtitle">Observaciones auditor</span>
            @if(is_null($funcion->observaciones_auditor))
            <span class="subtitle josefin-light text-start">Ninguna</span>
            @else                
            <span class="subtitle josefin-light text-start">{{$funcion->observaciones_auditor}}</span>
            @endif
        </div>
    </div>
</div>
@endsection


@section('js-container')
<script src="{{asset('js/docente.js')}}" type="text/javascript"></script>
@endsection