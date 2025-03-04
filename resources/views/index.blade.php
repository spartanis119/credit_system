<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/scss/app.scss', 'resources/js/app.js', 'resources/css/style.css'])
    <title>System Credit</title>
</head>

<body>
    <div class="content-fixed">
        <header>
            <h1 class="text-center mt-4">Simulador de Préstamos y Capacidad de Endeudamiento</h1>
        </header>
        <main>
            <div class="container-fluid">
                <div class="row mx-auto content_width">
                    <hr class="mt-3">
                    <form method="post" action="{{ route('processingJson') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col d-flex justify-content-end">
                            <label for="file" class="btn btn-success me-2">
                                <i class="bi bi-filetype-json fs-4"></i> Adjuntar Archivo
                            </label>
                            <input type="file" id="file" name="file" class="d-none" accept=".json" required>

                            <label for="sendFile" class="btn btn-primary">
                                <i class="bi bi-upload fs-5"></i> Subir
                            </label>
                            <input id="sendFile" type="submit" class="d-none">
                        </div>
                        <div class="col d-flex justify-content-end mt-2">
                            @error('file')
                                <small style="color:red;">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="row mx-auto content_width">
                    <div class="col my-4">
                        @if (!empty($clients))
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            Usuarios
                                        </button>
                                    </h2>

                                    <div id="collapseOne" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-12">

                                                    <ul class="nav nav-tabs d-flex justify-content-end" id="myTab"
                                                        role="tablist">

                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link active" id="todos-tab"
                                                                data-bs-toggle="tab" data-bs-target="#todos-tab-pane"
                                                                type="button" role="tab"
                                                                aria-controls="todos-tab-pane"
                                                                aria-selected="true">Todos</button>
                                                        </li>

                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="aprobados-tab"
                                                                data-bs-toggle="tab"
                                                                data-bs-target="#aprobados-tab-pane" type="button"
                                                                role="tab" aria-controls="aprobados-tab-pane"
                                                                aria-selected="false">Aprobados</button>
                                                        </li>

                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="rechazados-tab"
                                                                data-bs-toggle="tab"
                                                                data-bs-target="#rechazados-tab-pane" type="button"
                                                                role="tab" aria-controls="rechazados-tab-pane"
                                                                aria-selected="false">Rechazados</button>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content" id="myTabContent">

                                                        <div class="tab-pane fade show active" id="todos-tab-pane"
                                                            role="tabpanel" aria-labelledby="todos-tab" tabindex="0">
                                                            <div class="row">
                                                                @foreach ($clients as $client)
                                                                    <div class="col-11 col-md-6 col-xl-4 my-4 mx-auto">
                                                                        <div class="card shadow">
                                                                            <img src="{{ asset('img/users.png') }}"
                                                                                class="card-img-top" alt="...">
                                                                            <div class="card-body">
                                                                                <p>{{ $client->name }}</p>
                                                                                <p>Puntaje Crediticio:
                                                                                    {{ $client->credit_score }}</p>
                                                                                <p>Estado de Credito:
                                                                                    {{ $client->credit_status }}</p>
                                                                                <p>Monto Solicitado:
                                                                                    ${{ $client->requested_amount }}</p>
                                                                                <p>Monto Aprobado:
                                                                                    ${{ $client->approved_requested_amount }}
                                                                                </p>
                                                                                <p>Capacidad de Endeudamiento:
                                                                                    ${{ $client->debt_capacity }}
                                                                                </p>
                                                                                <!-- Button trigger modal -->
                                                                                <button type="button"
                                                                                    class="btn btn-primary"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#todos-modal{{ $client->id }}">
                                                                                    Detalles
                                                                                </button>
                                                                                <!-- Modal -->
                                                                                <div class="modal fade"
                                                                                    id="todos-modal{{ $client->id }}"
                                                                                    tabindex="-1"
                                                                                    aria-labelledby="todosModalLabel"
                                                                                    aria-hidden="true">
                                                                                    <div class="modal-dialog">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h1 class="modal-title fs-5"
                                                                                                    id="todosModalLabel">
                                                                                                    {{ $client->name }}
                                                                                                </h1>
                                                                                                <button type="button"
                                                                                                    class="btn-close"
                                                                                                    data-bs-dismiss="modal"
                                                                                                    aria-label="Close"></button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <p
                                                                                                    class="fs-4 fw-bold">
                                                                                                    Información de
                                                                                                    préstamo</p>
                                                                                                <hr>
                                                                                                <p>Ingresos mensuales:
                                                                                                    ${{ $client->monthly_income }}
                                                                                                </p>
                                                                                                <p>Gastos mensuales:
                                                                                                    {{ $client->monthly_expenses }}
                                                                                                </p>
                                                                                                <p>Puntaje Crediticio:
                                                                                                    {{ $client->credit_score }}
                                                                                                </p>
                                                                                                <p>Deuda actual:
                                                                                                    {{ $client->current_debt }}
                                                                                                </p>
                                                                                                <p>Créditos actuales y
                                                                                                    negativos:
                                                                                                    {{ $client->current_negative_credits }}
                                                                                                </p>
                                                                                                <p
                                                                                                    class="fs-4 fw-bold">
                                                                                                    Penalizaciones
                                                                                                    Aplicadas</p>
                                                                                                <hr>
                                                                                                @if ($client->max_amount < 100000)
                                                                                                    <p>Rechazado por no
                                                                                                        superar el monto
                                                                                                        máximo requerido
                                                                                                    </p>
                                                                                                @else
                                                                                                    @if ($client->negative_credit_penalization > 0)
                                                                                                        <p>Penalización
                                                                                                            del
                                                                                                            30%
                                                                                                            aplicada
                                                                                                            debido
                                                                                                            a
                                                                                                            {{ $client->current_negative_credits }}
                                                                                                            {{ $client->current_negative_credits > 0 ? 'créditos' : 'crédito' }}
                                                                                                            negativo
                                                                                                            actual.
                                                                                                        </p>
                                                                                                    @endif
                                                                                                    @if ($client->negative_historical_last_12_months > 0)
                                                                                                        <p>Penalización
                                                                                                            del
                                                                                                            {{ $client->negative_dispute_penalization_percentage }}%
                                                                                                            aplicada
                                                                                                            debido
                                                                                                            a
                                                                                                            {{ $client->negative_historical_last_12_months }}
                                                                                                            {{ $client->negative_historical_last_12_months > 0 ? 'disputas' : 'disputa' }}
                                                                                                            {{ $client->negative_historical_last_12_months > 0 ? 'negativas' : 'negativa' }}
                                                                                                            en los
                                                                                                            últimos
                                                                                                            12
                                                                                                            meses.
                                                                                                        </p>
                                                                                                    @endif
                                                                                                    @if ($client->approved_requested_amount > 0)
                                                                                                        <p>Monto
                                                                                                            solicitado
                                                                                                            ajustado por
                                                                                                            exceder
                                                                                                            la capacidad
                                                                                                            máxima
                                                                                                        </p>
                                                                                                    @endif
                                                                                                @endif
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button type="button"
                                                                                                    class="btn btn-secondary"
                                                                                                    data-bs-dismiss="modal">Close</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach

                                                            </div>
                                                        </div>

                                                        <div class="tab-pane fade" id="aprobados-tab-pane"
                                                            role="tabpanel" aria-labelledby="aprobados-tab"
                                                            tabindex="0">
                                                            <div class="row">
                                                                @if (!empty($clients))
                                                                    @foreach ($clients as $client)
                                                                        @if ($client->credit_status == 'Aprobado')
                                                                            <div
                                                                                class="col-11 col-md-6 col-xl-4 my-4 mx-auto">
                                                                                <div class="card shadow">
                                                                                    <img src="{{ asset('img/users.png') }}"
                                                                                        class="card-img-top"
                                                                                        alt="...">
                                                                                    <div class="card-body">
                                                                                        <p>{{ $client->name }}</p>
                                                                                        <p>Puntaje Crediticio:
                                                                                            {{ $client->credit_score }}
                                                                                        </p>
                                                                                        <p>Estado de Credito:
                                                                                            {{ $client->credit_status }}
                                                                                        </p>
                                                                                        <p>Monto Solicitado:
                                                                                            ${{ $client->requested_amount }}
                                                                                        </p>
                                                                                        <p>Monto Aprobado:
                                                                                            ${{ $client->approved_requested_amount }}
                                                                                        </p>
                                                                                        <p>Capacidad de Endeudamiento:
                                                                                            ${{ $client->debt_capacity }}
                                                                                        </p>
                                                                                        <!-- Button trigger modal -->
                                                                                        <button type="button"
                                                                                            class="btn btn-primary"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target="#aprobados-modal{{ $client->id }}">
                                                                                            Detalles
                                                                                        </button>
                                                                                        <!-- Modal -->
                                                                                        <div class="modal fade"
                                                                                            id="aprobados-modal{{ $client->id }}"
                                                                                            tabindex="-1"
                                                                                            aria-labelledby="aprobadosModalLabel"
                                                                                            aria-hidden="true">
                                                                                            <div class="modal-dialog">
                                                                                                <div
                                                                                                    class="modal-content">
                                                                                                    <div
                                                                                                        class="modal-header">
                                                                                                        <h1 class="modal-title fs-5"
                                                                                                            id="aprobadosModalLabel">
                                                                                                            {{ $client->name }}
                                                                                                        </h1>
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn-close"
                                                                                                            data-bs-dismiss="modal"
                                                                                                            aria-label="Close"></button>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="modal-body">
                                                                                                        <p
                                                                                                            class="fs-4 fw-bold">
                                                                                                            Información
                                                                                                            de
                                                                                                            préstamo</p>
                                                                                                        <hr>
                                                                                                        <p>Ingresos
                                                                                                            mensuales:
                                                                                                            ${{ $client->monthly_income }}
                                                                                                        </p>
                                                                                                        <p>Gastos
                                                                                                            mensuales:
                                                                                                            {{ $client->monthly_expenses }}
                                                                                                        </p>
                                                                                                        <p>Puntaje
                                                                                                            Crediticio:
                                                                                                            {{ $client->credit_score }}
                                                                                                        </p>
                                                                                                        <p>Deuda actual:
                                                                                                            {{ $client->current_debt }}
                                                                                                        </p>
                                                                                                        <p>Créditos
                                                                                                            actuales
                                                                                                            y
                                                                                                            negativos:
                                                                                                            {{ $client->current_negative_credits }}
                                                                                                        </p>
                                                                                                        <p
                                                                                                            class="fs-4 fw-bold">
                                                                                                            Penalizaciones
                                                                                                            Aplicadas
                                                                                                        </p>
                                                                                                        <hr>
                                                                                                        @if ($client->negative_credit_penalization > 0)
                                                                                                            <p>Penalización
                                                                                                                del
                                                                                                                30%
                                                                                                                aplicada
                                                                                                                debido
                                                                                                                a
                                                                                                                {{ $client->current_negative_credits }}
                                                                                                                {{ $client->current_negative_credits > 0 ? 'créditos' : 'crédito' }}
                                                                                                                negativo
                                                                                                                actual.
                                                                                                            </p>
                                                                                                        @endif
                                                                                                        @if ($client->negative_historical_last_12_months > 0)
                                                                                                            <p>Penalización
                                                                                                                del
                                                                                                                {{ $client->negative_dispute_penalization_percentage }}%
                                                                                                                aplicada
                                                                                                                debido
                                                                                                                a
                                                                                                                {{ $client->negative_historical_last_12_months }}
                                                                                                                {{ $client->negative_historical_last_12_months > 0 ? 'disputas' : 'disputa' }}
                                                                                                                {{ $client->negative_historical_last_12_months > 0 ? 'negativas' : 'negativa' }}
                                                                                                                en los
                                                                                                                últimos
                                                                                                                12
                                                                                                                meses.
                                                                                                            </p>
                                                                                                        @endif
                                                                                                        @if ($client->approved_requested_amount > 0)
                                                                                                            <p>Monto
                                                                                                                solicitado
                                                                                                                ajustado
                                                                                                                por
                                                                                                                exceder
                                                                                                                la
                                                                                                                capacidad
                                                                                                                máxima
                                                                                                            </p>
                                                                                                        @endif
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="modal-footer">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn btn-secondary"
                                                                                                            data-bs-dismiss="modal">Close</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <div class="col-10 mx-auto">
                                                                        <div class="alert alert-danger d-flex align-items-center mt-5"
                                                                            role="alert">
                                                                            <i
                                                                                class="bi bi-exclamation-triangle-fill me-2"></i>
                                                                            <div class="text-center">No se encontrarón
                                                                                usuarios
                                                                                relacionados
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane fade" id="rechazados-tab-pane"
                                                            role="tabpanel" aria-labelledby="rechazados-tab"
                                                            tabindex="0">
                                                            <div class="row">
                                                                @if (!empty($clients))
                                                                    @foreach ($clients as $client)
                                                                        @if ($client->credit_status == 'Rechazado')
                                                                            <div
                                                                                class="col-11 col-md-6 col-xl-4 my-4 mx-auto">
                                                                                <div class="card shadow">
                                                                                    <img src="{{ asset('img/users.png') }}"
                                                                                        class="card-img-top"
                                                                                        alt="...">
                                                                                    <div class="card-body">
                                                                                        <p>{{ $client->name }}</p>
                                                                                        <p>Puntaje Crediticio:
                                                                                            {{ $client->credit_score }}
                                                                                        </p>
                                                                                        <p>Estado de Credito:
                                                                                            {{ $client->credit_status }}
                                                                                        </p>
                                                                                        <p>Monto Solicitado:
                                                                                            ${{ $client->requested_amount }}
                                                                                        </p>
                                                                                        <p>Monto Aprobado:
                                                                                            ${{ $client->approved_requested_amount }}
                                                                                        </p>
                                                                                        <p>Capacidad de Endeudamiento:
                                                                                            ${{ $client->debt_capacity }}
                                                                                        </p>
                                                                                        <!-- Button trigger modal -->
                                                                                        <button type="button"
                                                                                            class="btn btn-primary"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target="#rechados-modal{{ $client->id }}">
                                                                                            Detalles
                                                                                        </button>
                                                                                        <!-- Modal -->
                                                                                        <div class="modal fade"
                                                                                            id="rechados-modal{{ $client->id }}"
                                                                                            tabindex="-1"
                                                                                            aria-labelledby="rechazadosModalLabel"
                                                                                            aria-hidden="true">
                                                                                            <div class="modal-dialog">
                                                                                                <div
                                                                                                    class="modal-content">
                                                                                                    <div
                                                                                                        class="modal-header">
                                                                                                        <h1 class="modal-title fs-5"
                                                                                                            id="rechazadosModalLabel">
                                                                                                            {{ $client->name }}
                                                                                                        </h1>
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn-close"
                                                                                                            data-bs-dismiss="modal"
                                                                                                            aria-label="Close"></button>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="modal-body">
                                                                                                        <p
                                                                                                            class="fs-4 fw-bold">
                                                                                                            Información
                                                                                                            de
                                                                                                            préstamo</p>
                                                                                                        <hr>
                                                                                                        <p>Ingresos
                                                                                                            mensuales:
                                                                                                            ${{ $client->monthly_income }}
                                                                                                        </p>
                                                                                                        <p>Gastos
                                                                                                            mensuales:
                                                                                                            {{ $client->monthly_expenses }}
                                                                                                        </p>
                                                                                                        <p>Puntaje
                                                                                                            Crediticio:
                                                                                                            {{ $client->credit_score }}
                                                                                                        </p>
                                                                                                        <p>Deuda actual:
                                                                                                            {{ $client->current_debt }}
                                                                                                        </p>
                                                                                                        <p>Créditos
                                                                                                            actuales
                                                                                                            y
                                                                                                            negativos:
                                                                                                            {{ $client->current_negative_credits }}
                                                                                                        </p>
                                                                                                        <p
                                                                                                            class="fs-4 fw-bold">
                                                                                                            Penalizaciones
                                                                                                            Aplicadas
                                                                                                        </p>
                                                                                                        <hr>
                                                                                                        @if ($client->max_amount < 100000)
                                                                                                            <p>Rechazado
                                                                                                                por
                                                                                                                no
                                                                                                                superar
                                                                                                                el
                                                                                                                monto
                                                                                                                máximo
                                                                                                                requerido
                                                                                                            </p>
                                                                                                        @else
                                                                                                            @if ($client->negative_credit_penalization > 0)
                                                                                                                <p>Penalización
                                                                                                                    del
                                                                                                                    30%
                                                                                                                    aplicada
                                                                                                                    debido
                                                                                                                    a
                                                                                                                    {{ $client->current_negative_credits }}
                                                                                                                    {{ $client->current_negative_credits > 0 ? 'créditos' : 'crédito' }}
                                                                                                                    negativo
                                                                                                                    actual.
                                                                                                                </p>
                                                                                                            @endif
                                                                                                            @if ($client->negative_historical_last_12_months > 0)
                                                                                                                <p>Penalización
                                                                                                                    del
                                                                                                                    {{ $client->negative_dispute_penalization_percentage }}%
                                                                                                                    aplicada
                                                                                                                    debido
                                                                                                                    a
                                                                                                                    {{ $client->negative_historical_last_12_months }}
                                                                                                                    {{ $client->negative_historical_last_12_months > 0 ? 'disputas' : 'disputa' }}
                                                                                                                    {{ $client->negative_historical_last_12_months > 0 ? 'negativas' : 'negativa' }}
                                                                                                                    en
                                                                                                                    los
                                                                                                                    últimos
                                                                                                                    12
                                                                                                                    meses.
                                                                                                                </p>
                                                                                                            @endif
                                                                                                            @if ($client->approved_requested_amount > 0)
                                                                                                                <p>Monto
                                                                                                                    solicitado
                                                                                                                    ajustado
                                                                                                                    por
                                                                                                                    exceder
                                                                                                                    la
                                                                                                                    capacidad
                                                                                                                    máxima
                                                                                                                </p>
                                                                                                            @endif
                                                                                                        @endif
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="modal-footer">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn btn-secondary"
                                                                                                            data-bs-dismiss="modal">Close</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <div class="col-10 mx-auto">
                                                                        <div class="alert alert-danger d-flex align-items-center mt-5"
                                                                            role="alert">
                                                                            <i
                                                                                class="bi bi-exclamation-triangle-fill me-2"></i>
                                                                            <div class="text-center">No se encontrarón
                                                                                usuarios
                                                                                relacionados
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                            Reporte
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-11 mx-auto">
                                                    <h3 class="text-center">Resumen General</h3>
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Datos Evaluados</th>
                                                                <th scope="col">Valores</th>
                                                                <th scope="col">Estadísticas</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Total de usuarios procesados</td>
                                                                <td>{{ !empty($processed_clients) ? $processed_clients : 'Datos no encontrados' }}
                                                                </td>
                                                                <td>
                                                                    <div class="progress" role="progressbar"
                                                                        aria-label="Success example"
                                                                        aria-valuenow="25" aria-valuemin="0"
                                                                        aria-valuemax="200">
                                                                        @if (!empty($processed_clients))
                                                                            <div class="progress-bar bg-success"
                                                                                style="width: 100%">

                                                                                100%
                                                                            </div>
                                                                        @else
                                                                            <div class="progress-bar bg-success"
                                                                                style="width: 0%">0%
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Total de usuarios aprobados</td>
                                                                <td>
                                                                    {{ !empty($approved_clients) ? $approved_clients : 'Datos no encontrados' }}
                                                                </td>
                                                                <td>
                                                                    <div class="progress" role="progressbar"
                                                                        aria-label="Success example"
                                                                        aria-valuenow="25" aria-valuemin="0"
                                                                        aria-valuemax="200">
                                                                        @if (!empty($processed_clients))
                                                                            @php
                                                                                $percentage_approved =
                                                                                    ($approved_clients * 100) /
                                                                                    $processed_clients;
                                                                            @endphp
                                                                            <div class="progress-bar bg-success"
                                                                                style="width: {{ $percentage_approved }}%">

                                                                                {{ $percentage_approved }}%
                                                                            </div>
                                                                        @else
                                                                            <div class="progress-bar bg-success"
                                                                                style="width: 0%">0%
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Total de usuarios rechazados</td>
                                                                <td>
                                                                    {{ !empty($rejected_clients) ? $rejected_clients : 'Datos no encontrados' }}
                                                                </td>
                                                                <td>
                                                                    <div class="progress" role="progressbar"
                                                                        aria-label="Danger example" aria-valuenow="75"
                                                                        aria-valuemin="0" aria-valuemax="200">
                                                                        @if (!empty($processed_clients))
                                                                            @php
                                                                                $percentage_rejected =
                                                                                    ($rejected_clients * 100) /
                                                                                    $processed_clients;
                                                                            @endphp
                                                                            <div class="progress-bar bg-danger"
                                                                                style="width: {{ $percentage_rejected }}%">

                                                                                {{ $percentage_rejected }}%
                                                                            </div>
                                                                        @else
                                                                            <div class="progress-bar bg-danger"
                                                                                style="width: 0%">0%</div>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Promedio de monto aprobado</td>
                                                                <td>
                                                                    {{ !empty($amount_approved_average) ? '$' . $amount_approved_average : 'Datos no encontrados' }}
                                                                </td>
                                                                <td>
                                                                    <div class="progress" role="progressbar"
                                                                        aria-label="Success example"
                                                                        aria-valuenow="25" aria-valuemin="0"
                                                                        aria-valuemax="200">
                                                                        @if (!empty($processed_clients))
                                                                            @php
                                                                                $percentage_approved =
                                                                                    ($amount_approved_average * 100) /
                                                                                    $accumulateApprovedAmount;
                                                                            @endphp
                                                                            <div class="progress-bar bg-danger"
                                                                                style="width: {{ $percentage_approved }}%">

                                                                                {{ $percentage_approved }}%
                                                                            </div>
                                                                        @else
                                                                            <div class="progress-bar bg-danger"
                                                                                style="width: 0%">0%
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-primary d-flex align-items-center" role="alert">
                                <i class="bi bi-info-circle-fill"></i>
                                <div class="ms-2">No se encontro datos porfavor ingrese un archivo</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
        <footer class="pt-5">
            <div class="row me-0">
                <div class="col-12 text-center mt-5">
                    <p>Daniel Camargo © 2025</p>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
