
@extends('layout.layout')

@section('module-container')
    <div class="module">
        <span class="title">Ajustes</span>
        <div class="tab-container informes-container">
            <span class="subtitle">Cambiar contraseña</span>
            <input type="password" name="informe-date-range" class="input informe-range" id="informe_date_range" placeholder="Contraseña actual">
            <input type="password" name="informe-date-range" class="input informe-range" id="informe_date_range" placeholder="Nueva contraseña">
            <input type="password" name="informe-date-range" class="input informe-range" id="informe_date_range" placeholder="Repetir nueva contraseña">
            <div class="btn-function-action mt-5">Guardar cambios</div>
        </div>
    </div>
@endsection


@section('js-container')
    <script src="{{asset('js/docente.js')}}" type="text/javascript"></script>
@endsection