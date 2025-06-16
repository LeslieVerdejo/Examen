<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Licita Seguro</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Licita Seguro</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContenido"
                aria-controls="navbarContenido" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContenido">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#menu">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#licitaciones">Licitaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#proveedores">Proveedores</a>
                    </li>
                    <!-- Puedes agregar más módulos aquí -->
                </ul>
            </div>
        </div>
    </nav>
    <h2>Licitaciones</h2>
    <p>Seleccione el estado y fecha para buscar licitaciones</p>
    <div class="row">
        <div class="col-6">
            <select id="selectEstado" class="form-select">
                <option value="0">-- Seleccione un estado --</option>
                <option value="adjudicada">Adjudicadas</option>
                <option value="revocada">Revocadas</option>
            </select>
        </div>
        <div class="col-3">
            <input type="date" class="form-control" id="inputFecha" value="2025-05-30">
        </div>
        <div class="col-3">
            <button class="btn btn-primary form-control" onclick="buscarLicitaciones(this)">Buscar</button>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td>Codigo Externo</td>
                        <td>Nombre</td>
                        <td>Estado</td>
                        <td>Fecha de Cierre</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <tr>
                        <td colspan="5" class="text-center">Sin Información</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade modal-xl" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <h2>Buscar Proveedor por RUT</h2>
    <div class="row mb-4">
        <div class="col-6">
            <input type="text" id="inputRUTProveedor" class="form-control" placeholder="Ej: 77.653.382-3">
        </div>
        <div class="col-3">
            <button class="btn btn-success form-control" onclick="buscarProveedorPorRUT()">Buscar Proveedor</button>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Código Empresa</th>
                        <th>Nombre Empresa</th>
                    </tr>
                </thead>
                <tbody id="proveedorTableBody">
                    <tr>
                        <td colspan="2" class="text-center">Sin resultados</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- jQuery primero -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

<!-- luego tu script -->
<script src="assets/js/validaciones.js"></script>

<!-- luego Bootstrap (si lo necesitas) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
    crossorigin="anonymous"></script>

</body>

</html>