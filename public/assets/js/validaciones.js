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