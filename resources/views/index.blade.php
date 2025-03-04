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
                    <div class="col d-flex justify-content-end">
                        <form method="post" action="#" enctype="multipart/form-data">
                            <label for="file" class="btn btn-success">
                                <i class="bi bi-filetype-json fs-4"></i> Adjuntar Archivo
                            </label>
                            <input type="file" id="file" name="file" class="d-none" accept=".json" required>

                            <label for="sendFile" class="btn btn-primary">
                                <i class="bi bi-upload fs-5"></i> Subir
                            </label>
                            <input id="sendFile" type="submit" class="d-none">
                        </form>
                    </div>
                </div>
                <div class="row mx-auto content_width">
                    <div class="col my-5">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
                                                            type="button" role="tab" aria-controls="todos-tab-pane"
                                                            aria-selected="true">Todos</button>
                                                    </li>

                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="aprobados-tab" data-bs-toggle="tab"
                                                            data-bs-target="#aprobados-tab-pane" type="button"
                                                            role="tab" aria-controls="aprobados-tab-pane"
                                                            aria-selected="false">Aprobados</button>
                                                    </li>

                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="rechazados-tab"
                                                            data-bs-toggle="tab" data-bs-target="#rechazados-tab-pane"
                                                            type="button" role="tab"
                                                            aria-controls="rechazados-tab-pane"
                                                            aria-selected="false">Rechazados</button>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" id="myTabContent">

                                                    <div class="tab-pane fade show active" id="todos-tab-pane"
                                                        role="tabpanel" aria-labelledby="todos-tab" tabindex="0">
                                                        <div class="row">
                                                            <div class="col-11 col-md-6 col-xl-4 my-4 mx-auto">
                                                                <div class="card shadow">
                                                                    <img src="img/users.png" class="card-img-top"
                                                                        alt="...">
                                                                    <div class="card-body">
                                                                        <p>Nombre del Cliente</p>
                                                                        <p>Puntaje Crediticio: 750</p>
                                                                        <p>Estado de Crédito: Aprobado</p>
                                                                        <p>Monto Solicitado: $10,000</p>
                                                                        <p>Monto Aprobado: $8,000</p>
                                                                        <p>Capacidad de Endeudamiento: $15,000</p>

                                                                        <button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#todos-modal">
                                                                            Detalles
                                                                        </button>
                                                                        <div class="modal fade" id="todos-modal"
                                                                            tabindex="-1"
                                                                            aria-labelledby="todosModalLabel"
                                                                            aria-hidden="true">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h1 class="modal-title fs-5"
                                                                                            id="todosModalLabel">
                                                                                            Nombre del Cliente
                                                                                        </h1>
                                                                                        <button type="button"
                                                                                            class="btn-close"
                                                                                            data-bs-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <p class="fs-4 fw-bold">
                                                                                            Información de préstamo</p>
                                                                                        <hr>
                                                                                        <p>Ingresos mensuales: $3,000
                                                                                        </p>
                                                                                        <p>Gastos mensuales: $1,500</p>
                                                                                        <p>Puntaje Crediticio: 750</p>
                                                                                        <p>Deuda actual: $2,000</p>
                                                                                        <p>Créditos actuales y
                                                                                            negativos: 0</p>

                                                                                        <p class="fs-4 fw-bold">
                                                                                            Penalizaciones Aplicadas</p>
                                                                                        <hr>
                                                                                        <p>Sin penalizaciones aplicadas.
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button"
                                                                                            class="btn btn-secondary"
                                                                                            data-bs-dismiss="modal">Cerrar</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">
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
                                                            <td>200</td>
                                                            <td>
                                                                <div class="progress" role="progressbar"
                                                                    aria-label="Success example" aria-valuenow="100"
                                                                    aria-valuemin="0" aria-valuemax="200">
                                                                    <div class="progress-bar bg-success"
                                                                        style="width: 100%">100%</div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Total de usuarios aprobados</td>
                                                            <td>150</td>
                                                            <td>
                                                                <div class="progress" role="progressbar"
                                                                    aria-label="Success example" aria-valuenow="75"
                                                                    aria-valuemin="0" aria-valuemax="200">
                                                                    <div class="progress-bar bg-success"
                                                                        style="width: 75%">75%</div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Total de usuarios rechazados</td>
                                                            <td>50</td>
                                                            <td>
                                                                <div class="progress" role="progressbar"
                                                                    aria-label="Danger example" aria-valuenow="25"
                                                                    aria-valuemin="0" aria-valuemax="200">
                                                                    <div class="progress-bar bg-danger"
                                                                        style="width: 25%">25%</div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Promedio de monto aprobado</td>
                                                            <td>$5,000</td>
                                                            <td>
                                                                <div class="progress" role="progressbar"
                                                                    aria-label="Success example" aria-valuenow="60"
                                                                    aria-valuemin="0" aria-valuemax="200">
                                                                    <div class="progress-bar bg-danger"
                                                                        style="width: 60%">60%</div>
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
