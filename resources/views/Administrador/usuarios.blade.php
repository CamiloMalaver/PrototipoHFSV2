
@extends('layout.layout')

@section('module-container')
    <div class="module">
        <span class="title">Usuarios</span>
        <div class="tab-container content-container">
            <div class="users-tools-container">
                <input type="text" class="input input-search" id="usuarios_input_search" placeholder="Buscar por Nombre">
                <div class="btn-new-user">Nuevo usuario</div>
            </div>
            <div class="card-users-container">
                <div class="user-card">
                    <div class="profile-icon-container">
                        <img class="icon user-profile-pic" src="{{asset('img/bulk/usersquare.png')}}" alt="">
                    </div>
                    <span class="user-full-name">Enersto EMiliano Diaz</span>
                    <span class="user-role">Administrador</span>
                    <div class="actions-container">
                        <div class="action">
                            <img class="icon" src="{{asset('img/bulk/useredit.png')}}" alt="">
                        </div>
                        <div class="action">
                            <img class="icon" src="{{asset('img/bulk/trash.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="user-card">
                    <div class="profile-icon-container">
                        <img class="icon user-profile-pic" src="{{asset('img/bulk/usersquare.png')}}" alt="">
                    </div>
                    <span class="user-full-name">Enersto EMiliano Diaz</span>
                    <span class="user-role">Administrador</span>
                    <div class="actions-container">
                        <div class="action">
                            <img class="icon" src="{{asset('img/bulk/useredit.png')}}" alt="">
                        </div>
                        <div class="action">
                            <img class="icon" src="{{asset('img/bulk/trash.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="user-card">
                    <div class="profile-icon-container">
                        <img class="icon user-profile-pic" src="{{asset('img/bulk/usersquare.png')}}" alt="">
                    </div>
                    <span class="user-full-name">Enersto EMiliano Diaz</span>
                    <span class="user-role">Administrador</span>
                    <div class="actions-container">
                        <div class="action">
                            <img class="icon" src="{{asset('img/bulk/useredit.png')}}" alt="">
                        </div>
                        <div class="action">
                            <img class="icon" src="{{asset('img/bulk/trash.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js-container')
    <script src="{{asset('js/docente.js')}}" type="text/javascript"></script>
@endsection