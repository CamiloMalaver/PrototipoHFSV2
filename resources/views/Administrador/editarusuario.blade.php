
@extends('layout.layout')

@section('module-container')
    <div class="module">
        <span class="title">Nuevo usuario</span>
        <div class="tab-container content-container form">       
            <form class="form-new-user" action="{{route('administrador-usuarios-editar-exec')}}" method="POST">
                @csrf    
                <input type="hidden" name="id" value="{{$user->id}}">
                <div class="form-row">
                    <input type="text" class="input input-form-text" value="{{$user->nombres}}" disabled>
                    <input type="text" class="input input-form-text" value="{{$user->apellidos}}" disabled>
                </div>
                <div class="form-row">
                    <input type="number" class="input input-form-text" name="documento" value="{{$user->documento}}" disabled>
                    <input type="number" class="input input-form-text" id="nuevo_usuario_telefono" name="celular" placeholder="Teléfono" value="{{$user->celular}}" required>                    
                </div>
                <div class="form-row">
                    <input type="email" class="input input-form-text" value="{{$user->email}}" disabled>
                    <input type="email" class="input input-form-text" value="{{$user->rol->nombre_rol}}" disabled>
                </div>
                <div class="form-row">
                    <input type="password" class="input input-form-text" id="nuevo_usuario_password" name="password" placeholder="Contraseña">
                    <input type="password" class="input input-form-text" id="password_confirmation" name="password_confirmation" placeholder="Confirmar contraseña">
                </div>
                <p class="edit-user-password-warning">*Omitir campos de contraseña si no se desea editar.</p>
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
                    <div class="content-success-message">
                        {{ session()->get('message') }}
                    </div>
                @endif       
                <div class="form-row">
                    <button type="submit" class="btn-function-action mt-10" id="submit_new_user_form">Actualizar usuario</button>    
                    <a class="btn-function-action back-action mt-10" href="{{route('administrador-usuarios')}}">Regresar</a>    
                </div>
            </form>

        </div>
    </div>
@endsection


@section('js-container')
    <script src="{{asset('js/administrador.js')}}" type="text/javascript"></script>
@endsection