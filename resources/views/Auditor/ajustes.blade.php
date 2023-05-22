@extends('layout.layout')

@section('module-container')
<div class="module">
    <span class="title">Ajustes</span>
    <div class="tab-container ajustes-container">
        <form class="form-new-user" action="{{route('auditor-ajustes-password')}}" method="POST">
            @csrf
            <span class="subtitle">Cambiar contraseña</span>
            <input type="password" name="password_actual" class="input informe-range" placeholder="Contraseña actual" required>
            <input type="password" name="password" class="input informe-range" placeholder="Nueva contraseña" required>
            <input type="password" name="password_confirmation" class="input informe-range" placeholder="Repetir nueva contraseña" required>
            <button type="submit" class="btn-function-action mt-5">Guardar cambios</button>
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
        </form>
    </div>
</div>
@endsection


@section('js-container')
<script src="{{secure_asset('js/docente.js')}}" type="text/javascript"></script>
@endsection