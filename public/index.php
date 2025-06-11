<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Licitaciones Seguro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/97a2c299cf.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header class="container mt-4">
        <h1 class="text-center"><i class="fa-solid fa-cart-shopping"></i> Buscador de licitaciones públicas</h1>
    </header>

    <main class="container">
        <p id="texto" class="text-center mt-5">Completa almenos uno de los campos para buscar licitaciones</p>

        <form class="mt-4">
            <div class="mb-3 row">
                <label for="codigoLicitacion" class="col-sm-3 col-form-label">Código de licitación</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="codigoLicitacion" placeholder="Ej: 1057539-17-LR25">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="entidad" class="col-sm-3 col-form-label">Nombre de entidad</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="entidad" placeholder="Ej: Ministerio de Salud">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="fechaInicio" class="col-sm-3 col-form-label">Fecha desde</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" id="fechaInicio">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="fechaFin" class="col-sm-3 col-form-label">Fecha hasta</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" id="fechaFin">
                </div>
            </div>
            <div class="text-center">
                <button onclick="buscar()" type="submit" id="btnBuscar" class="btn btn-primary"><i
                        class="fa-solid fa-magnifying-glass"></i> Buscar</button>
            </div>
        </form>
    </main>


    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <!-- Despues lo pasas al js o php. -->
    <script>
        document.querySelector('#btnBuscar').addEventListener('click', function (e) {
            e.preventDefault();

            let codigoLicitacion = document.querySelector('#codigoLicitacion').value.trim();
            let entidad = document.querySelector('#entidad').value.trim();
            let fechaInicio = document.querySelector('#fechaInicio').value;
            let fechaFin = document.querySelector('#fechaFin').value;

            if (codigoLicitacion === '' && entidad === '' && fechaInicio === '' && fechaFin === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Campos vacíos',
                    text: 'Debes ingresar al menos un dato para realizar la búsqueda.',
                    confirmButtonText: 'Entendido'
                });
            } else {
                console.log('Buscando...');
            }
        });
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
</body>

</html>