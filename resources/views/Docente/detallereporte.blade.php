@extends('layout.layout')

@section('module-container')
<div class="module">
    <span class="title mb-0">{{$funcion->tipofuncion->nombre}}</span>
    <div class="tab-container informes-container gap-1">
        <span class="subtitle">{{date('h:m a', strtotime($funcion->hora_inicio))}} - {{date('h:m a', strtotime($funcion->hora_final))}}</span>
        <span class="subtitle">{{$funcion->fecha}}</span>
        <div class="status-badge status{{$funcion->estado->id}}">
            <span class="text">{{$funcion->estado->nombre}}</span>
        </div>
    </div>
    <form class="form-new-user">
        <div class="tab-container informes-container mt-10">
            <input type="hidden" name="funcion_id" value="{{$funcion->id}}">
            <textarea type="text" name="descripcion_actividad" class="input report-textarea-big" placeholder="Descripción de actividad" required></textarea>
            <textarea type="text" name="observaciones" class="input report-textarea" placeholder="Observaciones"></textarea required>
            <input type="file" name="evidencias[]" id="evidencias_input" required multiple>
        </div>
    </form>
    @foreach($funcion->evidencia as $evidencia)
        <a href="{{ url('storage/' . $evidencia->url) }}" download>Download File</a>
    @endforeach
</div>
@endsection


@section('js-container')
<script src="{{asset('js/docente.js')}}" type="text/javascript"></script>
@endsection