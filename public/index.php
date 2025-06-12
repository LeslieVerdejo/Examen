<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Licita Seguro</title>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script>
        function buscarLicitaciones(_btn) {
            // console.log('buscar...');
            //elemntos del documento
            const select = document.getElementById('selectEstado');
            const date = document.getElementById('inputFecha');
            const fechaTemporal = date.value.split('-');
            const fecha = fechaTemporal[2] + fechaTemporal[1] + fechaTemporal[0]

            // console.log(select.value);
            // console.log(date.value);

            let parametrosOK = 0;

            if (select.value == 0) {
                select.classList.remove('is-valid');
                select.classList.add('is-invalid');
            } else {
                select.classList.remove('is-invalid');
                select.classList.add('is-valid');
                parametrosOK++;
            }

            if (date.value.length < 1) {
                date.classList.remove('is-valid');
                date.classList.add('is-invalid');
            } else {
                date.classList.remove('is-invalid');
                date.classList.add('is-valid');
                parametrosOK++;
            }

            if (parametrosOK == 2) {
                _btn.setAttribute('disabled', 'disabled');
                let urlEndpoint = 'https://api.mercadopublico.cl/servicios/v1/publico/licitaciones.json?fecha=' + fecha + '&estado=' + select.value + '&ticket=AC3A098B-4CD0-41AF-81A5-41284248419B';
                getEndpoint_in_tbody(urlEndpoint, 'tableBody', _btn);
            }
        }

        function getEndpoint_in_tbody(_endpoint, _tbody, _btn) {
            _tbody = document.getElementById(_tbody);
            _tbody.innerHTML = `<tr><td colspan="5" class="text-center">Recuperando Información...</td></tr>`;
            const ajaxOptions = {
                url: _endpoint,
                method: 'GET',
                dataType: 'json',
                headers: {
                    'Content-type': 'application/json'
                },
                success: function (data) {
                    _tbody.innerHTML = '';
                    // console.log(data['Listado']);
                    data['Listado'].forEach(item => {
                        const fila = document.createElement('tr');
                        const datoCodigo = document.createElement('td');
                        const datoNombre = document.createElement('td');
                        const datoEstado = document.createElement('td');
                        const datoFechaCierre = document.createElement('td');
                        const acciones = document.createElement('td');

                        // seteo de datos a la tabla
                        datoCodigo.innerText = item.CodigoExterno;
                        datoNombre.innerText = item.Nombre;
                        datoEstado.innerHTML = item.CodigoEstado == 15 ? '<span class="badge text-bg-danger">Revocada</span>' : '<span class="badge text-bg-primary">Adjudicada</span>';
                        datoFechaCierre.innerText = item.FechaCierre;
                        acciones.innerHTML = `
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="buildModal('${item.CodigoExterno}')">
                            Más Info
                        </button>
                        `;

                        fila.appendChild(datoCodigo);
                        fila.appendChild(datoNombre);
                        fila.appendChild(datoEstado);
                        fila.appendChild(datoFechaCierre);
                        fila.appendChild(acciones);
                        _tbody.appendChild(fila);
                    });
                    _btn.removeAttribute('disabled');
                },
                error: function () {
                    _tbody.innerHTML = `<tr><td colspan="5" class="text-center">Error al recuperar la información</td></tr>`;
                }
            };
            $.ajax(ajaxOptions);
        }

        function getEndpoint_in_modal(_endpoint, _codigo) {
            const modal = document.getElementById('exampleModal');

            const ajaxOptions = {
                url: _endpoint,
                method: 'GET',
                dataType: 'json',
                headers: {
                    'Content-type': 'application/json'
                },
                success: function (data) {
                    //console.log(data['Listado'][0]);

                    const elemento = data['Listado'][0];

                    const modalBody = `
                    <h1>Datos de la Licitación</h1>
                    <table class="table table-hover">
                        <tr>
                            <th>Nombre</th>
                            <td>${elemento.Nombre}</td>
                        </tr>
                        <tr>
                            <th>Descripción</th>
                            <td>${elemento.Descripcion}</td>
                        </tr>
                    </table>
                    <h1>Datos del Comprador</h1>
                    <table class="table table-hover">
                        <tr>
                            <th>Rut</th>
                            <td>${elemento.Comprador.RutUnidad}</td>
                        </tr>
                        <tr>
                            <th>Nombre</th>
                            <td>${elemento.Comprador.NombreOrganismo}</td>
                        </tr>
                    </table>
                    `;

                    modal.innerHTML = `
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Buscando Licitación</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ${modalBody}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                        </div>
                    </div>
                    `;
                },
                error: function () {
                    modal.innerHTML = `
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Buscando Licitación</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Error al recuperar la Licitación...<button class="btn btn-primary" onclick="buildModal('${_codigo}')">Reintentar</button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                        </div>
                    </div>
                    `;
                }
            };
            $.ajax(ajaxOptions);
        }

        function buildModal(_codigo) {
            const modal = document.getElementById('exampleModal');
            modal.innerHTML = `
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Buscando Licitación</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Buscando datos de la licitación <b>${_codigo}</b>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
            `;
            const urlEndpoint = 'https://api.mercadopublico.cl/servicios/v1/publico/licitaciones.json?codigo=' + _codigo + '&ticket=AC3A098B-4CD0-41AF-81A5-41284248419B';
            getEndpoint_in_modal(urlEndpoint, _codigo);
        }

        function buscarProveedorPorRUT() {
            const rut = document.getElementById('inputRUTProveedor').value.trim();
            const tbody = document.getElementById('proveedorTableBody');

            if (rut.length < 8) {
                tbody.innerHTML = `<tr><td colspan="2" class="text-center text-danger">RUT inválido</td></tr>`;
                return;
            }

            const url = `https://api.mercadopublico.cl/servicios/v1/Publico/Empresas/BuscarProveedor?rutempresaproveedor=${rut}&ticket=AC3A098B-4CD0-41AF-81A5-41284248419B`;

            tbody.innerHTML = `<tr><td colspan="2" class="text-center">Buscando...</td></tr>`;

            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data.Cantidad > 0) {
                        const empresa = data.listaEmpresas[0];
                        tbody.innerHTML = `
                    <tr>
                        <td>${empresa.CodigoEmpresa}</td>
                        <td>${empresa.NombreEmpresa}</td>
                    </tr>
                `;
                    } else {
                        tbody.innerHTML = `<tr><td colspan="2" class="text-center">Proveedor no encontrado</td></tr>`;
                    }
                },
                error: function () {
                    tbody.innerHTML = `<tr><td colspan="2" class="text-center text-danger">Ingrese el rut con puntos y guion</td></tr>`;
                }
            });
        }

    </script>
</body>

</html>