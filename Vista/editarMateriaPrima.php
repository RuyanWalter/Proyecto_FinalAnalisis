<!DOCTYPE html>
<!-- Vista/editarMateriaPrima -->
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Materia Prima</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Editar Materia Prima</h1>
        
        <?php if (isset($materiaPrima) && isset($proveedores)): ?>
            <form action="index.php?accion=actualizar" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($materiaPrima['id_ingreso']); ?>">

                <!-- Campos del formulario -->
                <div class="mb-3">
                    <label for="codigo_materia_prima" class="form-label">Código de Materia Prima</label>
                    <input type="text" class="form-control" id="codigo_materia_prima" name="codigo_materia_prima" value="<?php echo htmlspecialchars($materiaPrima['codigo_materia_prima']); ?>" required>
                </div>


                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre de la Materia Prima</label>
                    <input type="text" class="form-control" id="nombre_materia_prima" name="nombre_materia_prima" value="<?php echo htmlspecialchars($materiaPrima['nombre_materia_prima']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" required><?php echo htmlspecialchars($materiaPrima['descripcion']); ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="unidad_medida" class="form-label">Unidad de Medida</label>
                    <input type="text" class="form-control" id="unidad_medida" name="unidad_medida" value="<?php echo htmlspecialchars($materiaPrima['unidad_medida']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="cantidad_comprada" class="form-label">Cantidad Comprada</label>
                    <input type="number" class="form-control" id="cantidad_comprada" name="cantidad_comprada" value="<?php echo htmlspecialchars($materiaPrima['cantidad_comprada']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
                    <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" value="<?php echo htmlspecialchars($materiaPrima['fecha_ingreso']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="precio_unitario" class="form-label">Precio Unitario</label>
                    <input type="number" class="form-control" id="precio_unitario" name="precio_unitario" step="0.01" value="<?php echo htmlspecialchars($materiaPrima['precio_unitario']); ?>" required>
                </div>

                <!-- Campo select para el proveedor -->
                <div class="mb-3">
                    <label for="id_proveedor" class="form-label">Proveedor</label>
                    <select class="form-control" id="id_proveedor" name="id_proveedor" required>
                        <?php foreach ($proveedores as $proveedor): ?>
                            <option value="<?php echo $proveedor['id_proveedor']; ?>" <?php if ($proveedor['id_proveedor'] == $materiaPrima['id_proveedor']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($proveedor['nombre_proveedor']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Botones: Actualizar y Cancelar -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
                </div>
            </form>
        <?php else: ?>
            <p class="text-danger">Error: No se encontraron los datos de la materia prima o los proveedores.</p>
        <?php endif; ?>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function() {
            console.log("Formulario enviado");
        });
    </script>
</body>
</html>
