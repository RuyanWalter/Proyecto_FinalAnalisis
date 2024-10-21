<!-- Vista/menu.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark"> <!-- Esta es la parte que trabaja el menu-->
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
                    <a class="nav-link" href="index.php?accion=listar">Registro de Materia Prima</a> <!-- Ajusta el tamaño del texto aquí -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?accion=controlarInventario">Controlar Inventario</a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?accion=ordenesCompra">Órdenes de Compra</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controlador=Produccion2&accion=listar">Planificación de Producción</a> <!-- Nueva opción en el menú -->
                </li>
            </ul>
        </div>
    </div>
</nav>
