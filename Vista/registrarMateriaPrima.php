<!DOCTYPE html>
<html lang="es">
<!-- Vista/registrarMateriaPrima.php -->    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Materia Prima</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Registrar Materia Prima</h1>
        <form action="index.php?accion=guardar" method="post">
            <!-- Campos del formulario -->
            <div class="mb-3">
                <label for="codigo_materia_prima" class="form-label">Código de Materia Prima</label>
                <input type="text" class="form-control" id="codigo_materia_prima" name="codigo_materia_prima" required>
            </div>

            <div class="mb-3">
                <label for="nombre_materia_prima" class="form-label">Nombre de la Materia Prima</label>
                <input type="text" class="form-control" id="nombre_materia_prima" name="nombre_materia_prima" required>
            </div>

            <!-- Agregar campo para la descripción -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
            </div>

            <!-- Agregar campo para la unidad de medida -->
            <div class="mb-3">
                <label for="unidad_medida" class="form-label">Unidad de Medida</label>
                <input type="text" class="form-control" id="unidad_medida" name="unidad_medida" required>
            </div>

            <div class="mb-3">
                <label for="cantidad_comprada" class="form-label">Cantidad Comprada</label>
                <input type="number" class="form-control" id="cantidad_comprada" name="cantidad_comprada" min="1" required>
            </div>

            <div class="mb-3">
                <label for="fecha_ingreso" class="form-label">Fecha de Compra</label>
                <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required>
            </div>

            <div class="mb-3">
                <label for="precio_unitario" class="form-label">Precio Unitario</label>
                <input type="number" class="form-control" id="precio_unitario" name="precio_unitario" step="0.01" required>
            </div>

            <!-- Campo select para el proveedor -->
            <div class="mb-3">
                <label for="id_proveedor" class="form-label">Proveedor</label>
                <select class="form-control" id="id_proveedor" name="id_proveedor" required>
                    <option value="">Seleccione un proveedor</option>
                    <?php foreach ($proveedores as $proveedor): ?>
                        <option value="<?php echo $proveedor['id_proveedor']; ?>">
                            <?php echo $proveedor['nombre_proveedor']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Botones: Guardar y Cancelar -->
            <div class="text-center">
                <button type="submit" class="btn btn-success">Guardar</button>
                <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
            </div>
        </form>
    </div>
</body>
</html>
