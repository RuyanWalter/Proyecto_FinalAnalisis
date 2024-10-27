<!-- Vista/menu.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="Publico/Img/logo.PNG" alt="TextilSmart" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/index.php?controlador=MateriaPrima&accion=listar">Registro de Materia Prima</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/index.php?controlador=Inventario&accion=controlarInventario">Controlar Inventario</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/index.php?controlador=OrdenesCompra&accion=listarOrdenes">Órdenes de Compra</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/produccion/planificar">Planificar Producción</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/produccion/generar_informe"> Ver informes de Producción</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="../Vista/pedido.php"> Gestion pedidos</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
