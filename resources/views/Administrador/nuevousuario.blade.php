
@extends('layout.layout')

@section('module-container')
    <div class="module">
        <span class="title">Nuevo usuario</span>
        <div class="tab-container content-container form">
            <form class="form-new-user" action="{{route('administrador-usuarios-nuevo-agregar')}}" method="POST">
                @csrf    
                <div class="form-row">
                    <input type="text" class="input input-form-text" id="nuevo_usuario_nombre" name="nombres" placeholder="Nombres" required>
                    <input type="text" class="input input-form-text" id="nuevo_usuario_apellido" name="apellidos" placeholder="Apellidos" required>
                </div>
                <div class="form-row">
                    <input type="number" class="input input-form-text" id="nuevo_usuario_documento" name="documento" placeholder="Numero de identificación" required>
                    <input type="number" class="input input-form-text" id="nuevo_usuario_telefono" name="celular" placeholder="Teléfono" required>                    
                </div>
                <div class="form-row">
                    <input type="email" class="input input-form-text" id="nuevo_usuario_email" name="email" placeholder="Correo electrónico" required>
                    <div class="select-container">
                        <div class="select">
                            <input type="text" id="input" placeholder="Rol" name="select_rol" onfocus="this.blur();" required>
                        </div>
                        <div class="option-container">
                            <div class="option">
                                <label>Administrador</label>
                            </div>
                            <div class="option">
                                <label>Auditor</label>
                            </div>
                            <div class="option">
                                <label>Docente</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <input type="password" class="input input-form-text" id="nuevo_usuario_password" name="password" placeholder="Contraseña" required>
                    <input type="password" class="input input-form-text" id="password_confirmation" name="password_confirmation" placeholder="Confirmar contraseña" required>
                </div>
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
                    <button type="submit" class="btn-function-action mt-10" id="submit_new_user_form">Crear usuario</button>    
                    <a class="btn-function-action back-action mt-10" href="{{route('administrador-usuarios')}}">Regresar</a>    
                </div>
            </form>

        </div>
    </div>
@endsection


@section('js-container')
    <script src="{{asset('js/administrador.js')}}" type="text/javascript"></script>
@endsection