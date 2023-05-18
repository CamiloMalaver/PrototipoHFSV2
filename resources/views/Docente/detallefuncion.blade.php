@extends('layout.layout')

@section('module-container')
<div class="module">
    <span class="title mb-0">{{$funcion->tipofuncion->nombre}}</span>
    <div class="tab-container informes-container gap-1">
        <span class="subtitle">{{date('h:m a', strtotime($funcion->hora_inicio))}} - {{date('h:m a', strtotime($funcion->hora_final))}}</span>
        <span class="subtitle">{{$funcion->fecha}}</span>
    </div>
    <form class="form-new-user" action="{{route('docente-misfunciones-reportar-enviar')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="tab-container informes-container mt-10">
            <input type="hidden" name="funcion_id" value="{{$funcion->id}}">
            <textarea type="text" name="descripcion_actividad" class="input report-textarea-big" placeholder="Descripción de actividad" required></textarea>
            <textarea type="text" name="observaciones" class="input report-textarea" placeholder="Observaciones"></textarea required>
            <input type="file" name="evidencias[]" id="evidencias_input" required multiple>
            <div>
                <span class="subtitle josefin-light lh-custom">Sube hasta máximo 3 archivos de tipo .txt, .docx, .doc, .pdf o .jpg</span>
                <span class="subtitle josefin-light lh-custom">Recuerda no superar el límite de peso para los archivos: 2MB</span>
            </div>
            <button class="btn-function-action mt-5" type="submit">Reportar</button>
        </div>
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
@endsection


@section('js-container')
<script src="{{asset('js/docente.js')}}" type="text/javascript"></script>
@endsection