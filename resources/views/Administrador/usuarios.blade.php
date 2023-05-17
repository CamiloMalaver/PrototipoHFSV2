
@extends('layout.layout')

@section('module-container')
    <div class="module">
        <span class="title">Usuarios</span>
        <div class="tab-container content-container">
            <div class="users-tools-container">
                <input type="text" class="input input-search" id="usuarios_input_search" placeholder="Buscar por Nombre">
                <a class="btn-new-user" href="{{route('administrador-usuarios-nuevo')}}">Nuevo usuario</a>
            </div>
            <div class="card-users-container">
            @foreach($users as $user)
                <div class="user-card">
                    <div class="profile-icon-container">
                        <img class="icon user-profile-pic" src="{{asset('img/bulk/usersquare.png')}}" alt="">
                    </div>
                    <span class="user-full-name">{{ $user->nombres . ' ' . $user->apellidos }} {{auth()->user()->id == $user->id ? '(Yo)' : ''}}</span>
                    <span class="user-role">{{ $user->rol->nombre_rol}}</span>
                    <div class="actions-container">
                        @if ($user->rol_id == 2)
                        <div class="action">
                            <a href="{{route('administrador-usuarios-asociardocente', $user->id)}}"><img class="icon" src="{{asset('img/bulk/useradd.png')}}" alt="">
                        </div>
                        @endif                        
                        <div class="action">
                            <a href="{{route('administrador-usuarios-editar', $user->id)}}"><img class="icon" src="{{asset('img/bulk/useredit.png')}}" alt=""></a>
                        </div>
                        @if (auth()->user()->id != $user->id)
                        <div class="action">
                            <img class="icon" src="{{asset('img/bulk/trash.png')}}" alt="">
                        </div>
                        @endif   
                    </div>
                </div>
            @endforeach
            {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection


@section('js-container')
    <script src="{{asset('js/docente.js')}}" type="text/javascript"></script>
@endsection