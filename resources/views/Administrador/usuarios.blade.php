
@extends('layout.layout')

@section('module-container')
    <div class="module">
        <span class="title">Usuarios</span>
        <div class="tab-container content-container">
            <div class="users-tools-container">
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
                        <div class="tooltip">
                            <div class="action">
                                <a href="{{route('administrador-usuarios-asociardocente', $user->id)}}"><img class="icon" src="{{asset('img/bulk/useradd.png')}}" alt="">
                            </div>
                            <span class="tooltiptext">Asignar docentes</span>
                        </div>
                        @endif     
                        <div class="tooltip">                   
                            <div class="action">
                                <a href="{{route('administrador-usuarios-editar', $user->id)}}"><img class="icon" src="{{asset('img/bulk/useredit.png')}}" alt=""></a>
                            </div>
                            <span class="tooltiptext">Editar</span>
                        </div>
                        @if (auth()->user()->id != $user->id)
                        <div class="tooltip">
                            <div class="action">
                                <a href=""><img class="icon" src="{{asset('img/bulk/userminus.png')}}" alt=""></a>
                            </div>
                            <span class="tooltiptext">Inhabilitar</span>
                        </div>
                        @endif   
                    </div>
                </div>
            @endforeach
        </div>
        {{ $users->links() }}
        </div>
    </div>
@endsection


@section('js-container')
    <script src="{{asset('js/docente.js')}}" type="text/javascript"></script>
@endsection