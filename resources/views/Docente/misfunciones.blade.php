
@extends('layout.layout')

@section('module-container')
    <div class="module">
        <span class="title">Mis funciones</span>
        <div class="tab-container">
            <div class="divider-start"></div>
            <div class="tab active" id="docente_today_tab">Hoy</div>
            <div class="tab" id="docente_incoming_tab">Próximas</div>
            <div class="tab" id="docente_previous_tab">Anteriores</div>
            <div class="divider-end"></div>
        </div>
        <div class="functions-container" id="docente_today_container">
            <div class="function-card">
                <div class="left-content">
                    <span class="function-type-name">Nombre de la funcion emilia</span>
                    <span class="function-location">Edificio nuevo 2002</span>
                    <span class="function-date">11/05/2023</span>
                </div>
                <div class="right-content">
                    <div class="status-badge assigned">
                        <span class="text">Estado</span>
                    </div>
                    <div class="btn-function-action">Enviar reporte</div>
                </div>
            </div>
            <div class="function-card">
                <div class="left-content">
                    <span class="function-type-name">Nombre de la funcion emilia</span>
                    <span class="function-location">Edificio nuevo 2002</span>
                    <span class="function-date">11/05/2023</span>
                </div>
                <div class="right-content">
                    <div class="status-badge pending">
                        <span class="text">Estado</span>
                    </div>
                </div>
            </div>
            <div class="function-card">
                <div class="left-content">
                    <span class="function-type-name">Nombre de la funcion emilia</span>
                    <span class="function-location">Edificio nuevo 2002</span>
                    <span class="function-date">11/05/2023</span>
                </div>
                <div class="right-content">
                    <div class="status-badge waiting">
                        <span class="text">Estado</span>
                    </div>
                </div>
            </div>
            <div class="function-card">
                <div class="left-content">
                    <span class="function-type-name">Nombre de la funcion emilia</span>
                    <span class="function-location">Edificio nuevo 2002</span>
                    <span class="function-date">11/05/2023</span>
                </div>
                <div class="right-content">
                    <div class="status-badge aprobed">
                        <span class="text">Estado</span>
                    </div>
                </div>
            </div>
            <div class="function-card">
                <div class="left-content">
                    <span class="function-type-name">Nombre de la funcion emilia</span>
                    <span class="function-location">Edificio nuevo 2002</span>
                    <span class="function-date">11/05/2023</span>
                </div>
                <div class="right-content">
                    <div class="status-badge rejected">
                        <span class="text">Estado</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="functions-container d-none" id="docente_previous_container">
            <div class="function-card">
                <div class="left-content">
                    <span class="function-type-name">Nombre de la funcion emilia</span>
                    <span class="function-location">Edificio nuevo 2002</span>
                    <span class="function-date">11/05/2023</span>
                </div>
                <div class="right-content">
                    <div class="status-badge waiting">
                        <span class="text">Estado</span>
                    </div>
                </div>
            </div>
            <div class="function-card">
                <div class="left-content">
                    <span class="function-type-name">Nombre de la funcion emilia</span>
                    <span class="function-location">Edificio nuevo 2002</span>
                    <span class="function-date">11/05/2023</span>
                </div>
                <div class="right-content">
                    <div class="status-badge aprobed">
                        <span class="text">Estado</span>
                    </div>
                </div>
            </div>
            <div class="function-card">
                <div class="left-content">
                    <span class="function-type-name">Nombre de la funcion emilia</span>
                    <span class="function-location">Edificio nuevo 2002</span>
                    <span class="function-date">11/05/2023</span>
                </div>
                <div class="right-content">
                    <div class="status-badge rejected">
                        <span class="text">Estado</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="functions-container d-none" id="docente_incoming_container">
            <div class="function-card">
                <div class="left-content">
                    <span class="function-type-name">Nombre de la funcion emilia</span>
                    <span class="function-location">Edificio nuevo 2002</span>
                    <span class="function-date">11/05/2023</span>
                </div>
                <div class="right-content">
                    <div class="status-badge assigned">
                        <span class="text">Estado</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js-container')
    <script src="{{asset('js/docente.js')}}" type="text/javascript"></script>
@endsection