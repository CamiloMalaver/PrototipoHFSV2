@extends('layout.layout')

@section('module-container')
<div class="module mb-20">
    <div class="assoc-docente-title-container">
        <div class="left-container">
            <span class="title mb-0">{{$funcion->tipofuncion->nombre}}</span>
            <span class="subtitle josefin-bold">{{$funcion->user->nombres . ' ' . $funcion->user->apellidos}}</span>
            <span class="subtitle fs-16">{{$funcion->lugar}}</span>
            <span class="subtitle fs-16">{{$funcion->hora_inicio}} - {{$funcion->hora_final}}</span>
            <span class="subtitle fs-16">{{$funcion->fecha}}</span>
        </div>
        <div class="right-container">
            <div class="status-badge status{{$funcion->estado->id}}">
                <span class="text">{{$funcion->estado->nombre}}</span>
            </div>
            <div class="form-row right mt-10">
                <a class="btn-function-action back-action" href="{{route('auditor-gestionar-docente', $funcion->usuario_id)}}">Regresar</a>
            </div>
        </div>
    </div>
    <div class="tab-container informes-container detalle-funcion-audit mt-10">
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
                        <img class="icon user-profile-pic" src="{{secure_asset('img/documentdownload.png')}}" alt="">
                    </div>
                @endforeach
            </div>
            @if($funcion->estado_id == 2)
            <form class="form-new-user" action="{{route('auditor-asignar-estado-final')}}" method="POST" id="form_review_function">
                @csrf
                <input type="hidden" name="estado" id="input_state" required> 
                <input type="hidden" name="funcion_id" value="{{$funcion->id}}" required> 
                <div class="form-row">
                    <textarea type="text" name="observaciones" class="input report-textarea" placeholder="Observaciones" id="frm_observaciones"></textarea>
                </div>
                <div class="form-row">
                    <button class="btn-function-action" id="review_function_submit_approbed">Aprobar</button>
                    <button class="btn-function-action danger" id="review_function_submit_rejected">Rechazar</button>
                </div>
            </form>
            @else
                <span class="subtitle">Observaciones auditor</span>
                @if(is_null($funcion->observaciones_auditor))
                <span class="subtitle josefin-light text-start">Ninguna</span>
                @else                
                <span class="subtitle josefin-light text-start">{{$funcion->observaciones_auditor}}</span>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection


@section('js-container')
<script src="{{secure_asset('js/docente.js')}}" type="text/javascript"></script>
@endsection