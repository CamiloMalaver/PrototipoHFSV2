
@extends('layout.layout')

@section('module-container')
    <div class="module">
        <span class="title">Informes</span>
        <div class="tab-container informes-container">
            <input type="text" name="informe-date-range" class="input informe-range" id="informe_date_range" placeholder="Ingresa el rango de fechas">
            <div class="btn-function-action">Generar informe</div>
        </div>
    </div>
@endsection


@section('js-container')
    <script src="{{asset('js/docente.js')}}" type="text/javascript"></script>
@endsection