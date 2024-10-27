<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Módulo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="text-center bg-white p-5 shadow rounded">
            <h1 class="mb-4">Seleccionar Módulo</h1>
            <div class="d-grid gap-3">
                <!-- Enlace para Gestión de Materia Prima -->
                <a class="btn btn-secondary btn-lg" href="index.php?controlador=MateriaPrima&accion=listar">Gestión de Materia Prima</a>
                
                <!-- Enlace para Gestión de Producción -->
               
                <a class="btn btn-secondary btn-lg" href="index.php?controlador=Produccion&accion=planificar">Gestión de Producción</a>
                <a class="btn btn-secondary btn-lg" href="../Vista/pedido.php">Gestión de Pedidos</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
