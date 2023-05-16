@extends('layout.layout')

@section('module-container')
<div class="module">
    <div class="assoc-docente-title-container">
        <div class="left-container">
            <span class="title mb-0">Asociar docentes</span>
            <span class="subtitle">{{$auditor->nombres}} {{$auditor->apellidos}}</span>
            <span class="subtitle">CC {{$auditor->documento}}</span>
        </div>
        <div class="right-container">
            <form class="form-new-user" action="{{route('administrador-usuarios-asociardocente-exec')}}" method="POST">
                @csrf
                <input type="hidden" name="auditor_id" value="{{$auditor->id}}">
                <div class="form-row  right">
                    <input type="email" class="input input-form-text" name="email_docente" placeholder="Email docente" required>
                </div>
                <div class="form-row right">
                    <a class="btn-function-action back-action" href="{{route('administrador-usuarios')}}">Regresar</a>
                    <button type="submit" class="btn-function-action" id="submit_assoc_doc">Asociar docente</button>
                </div>
            </form>
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
        </div>
    </div>
    <div class="tab-container content-container">
        <span class="subtitle josefin-bold">Docentes a cargo</span>
        <div class="card-users-container">
            @foreach($docentes as $doc)
            <div class="user-card">
                <div class="profile-icon-container">
                    <img class="icon user-profile-pic" src="{{asset('img/bulk/usersquare.png')}}" alt="">
                </div>
                <span class="user-full-name">{{$doc->nombres}} {{$doc->apellidos}}</span>
                <div class="actions-container">
                    <div class="action">
                        <img class="icon" src="{{asset('img/bulk/trash.png')}}" alt="">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection


@section('js-container')
<script src="{{asset('js/administrador.js')}}" type="text/javascript"></script>
@endsection