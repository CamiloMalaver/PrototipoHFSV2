
@extends('layout.layout')

@section('module-container')
    <div class="module">
        <span class="title">Docentes</span>
        <div class="tab-container content-container">
            <span class="subtitle josefin-bold">Docentes a mi cargo</span>
            <div class="card-users-container">
            @foreach($docentes as $docente)
                <div class="user-card">
                    <div class="profile-icon-container">
                        <img class="icon user-profile-pic" src="{{secure_asset('img/usersquare.png')}}" alt="">
                    </div>
                    <span class="user-full-name">{{ $docente->nombres . ' ' . $docente->apellidos }}</span>
                    <span class="user-role">{{$docente->funcionsustantiva_count}} {{($docente->funcionsustantiva_count != 1) ? 'funciones' : 'función'}}</span>
                    <div class="actions-container">
                    <div class="tooltip">
                        <div class="action">
                            <a href="{{route('auditor-gestionar-docente', $docente->id)}}"><img class="icon" src="{{secure_asset('img/personalcard.png')}}" alt=""></a>
                        </div>
                        <span class="tooltiptext">Gestionar</span>
                    </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $docentes->links() }}
        </div>
    </div>
@endsection


@section('js-container')
    <script src="{{secure_asset('js/docente.js')}}" type="text/javascript"></script>
@endsection