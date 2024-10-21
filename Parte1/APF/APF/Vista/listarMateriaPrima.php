<?php ob_start(); ?>
<h1 class="text-center">Lista de Materia Prima</h1>

<!-- Formulario para buscar materias primas por código y fecha -->
<form method="GET" action="index.php" class="d-flex justify-content-center mb-4 align-items-center">
    <input type="hidden" name="accion" value="buscar">
    <input type="text" name="codigo" placeholder="Buscar por código (opcional)" class="form-control w-25" value="<?php echo htmlspecialchars($_GET['codigo'] ?? '', ENT_QUOTES); ?>" id="codigo-input">
    <input type="date" name="fecha" placeholder="Buscar por fecha de ingreso (opcional)" class="form-control w-25 ms-2" value="<?php echo htmlspecialchars($_GET['fecha'] ?? '', ENT_QUOTES); ?>" id="fecha-input">
    <button type="submit" class="btn btn-primary ms-2">Buscar</button>
</form>

<!-- Mensaje para aclarar la búsqueda flexible (solo se muestra cuando el usuario interactúa con los campos) -->
<p id="filtro-mensaje" class="alert alert-warning mt-4 shadow-lg" style="display: none;">
    Puede filtrar por código, por fecha, o por ambos para obtener resultados más específicos.
</p>


<!-- Script para mostrar el mensaje del filtro solo cuando el usuario interactúe con los campos -->
<script>
    const codigoInput = document.getElementById('codigo-input');
    const fechaInput = document.getElementById('fecha-input');
    const filtroMensaje = document.getElementById('filtro-mensaje');

    codigoInput.addEventListener('input', function() {
        filtroMensaje.style.display = 'block';
    });

    fechaInput.addEventListener('input', function() {
        filtroMensaje.style.display = 'block';
    });
</script>

<!-- Mostrar la tabla completa si no se ha realizado ninguna búsqueda -->
<?php if (!isset($_GET['accion']) || $_GET['accion'] != 'buscar'): ?>
    <?php if (!empty($materiasPrimas)): ?>
        <!-- Contenedor para hacer la tabla responsiva en móviles -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th style="width: 100px;">Unidad de Medida</th>
                        <th>Cantidad Comprada</th>
                        <th>Fecha de Ingreso</th>
                        <th>Precio Unitario</th>
                        <th>Proveedor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($materiasPrimas as $materiaPrima): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($materiaPrima['codigo_materia_prima']); ?></td>
                            <td><?php echo htmlspecialchars($materiaPrima['nombre_materia_prima']); ?></td>
                            <td><?php echo htmlspecialchars($materiaPrima['descripcion']); ?></td>
                            <td><?php echo htmlspecialchars($materiaPrima['unidad_medida']); ?></td>
                            <td><?php echo htmlspecialchars($materiaPrima['cantidad_comprada']); ?></td>
                            <td><?php echo htmlspecialchars($materiaPrima['fecha_ingreso']); ?></td>
                            <td><?php echo htmlspecialchars($materiaPrima['precio_unitario']); ?></td>
                            <td><?php echo htmlspecialchars($materiaPrima['nombre_proveedor']); ?></td>
                            <td>
                                <div class="d-flex justify-content-start">
                                    <a href="index.php?accion=editar&id=<?php echo $materiaPrima['id_ingreso']; ?>" class="btn btn-primary btn-sm me-2">Editar</a>
                                    <a href="index.php?accion=borrar&id=<?php echo $materiaPrima['id_ingreso']; ?>" class="btn btn-danger btn-sm">Borrar</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Solo mostrar el botón de registrar materia prima -->
        <div class="d-flex justify-content-start mt-3">
            <a href="index.php?accion=crear" class="btn btn-success">Registrar Materia Prima</a>
        </div>

    <?php else: ?>
        <div class="alert alert-info mt-4">
            <strong>¡Atención!</strong> No hay productos registrados.
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php if (isset($_GET['accion']) && $_GET['accion'] == 'buscar'): ?>
    <!-- Mostrar resultados filtrados -->
    <?php if (!empty($materiasPrimas)): ?>
        <!-- Contenedor para hacer la tabla responsiva en móviles -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th style="width: 100px;">Unidad de Medida</th>
                        <th>Cantidad Comprada</th>
                        <th>Fecha de Ingreso</th>
                        <th>Precio Unitario</th>
                        <th>Proveedor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($materiasPrimas as $materiaPrima): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($materiaPrima['codigo_materia_prima']); ?></td>
                            <td><?php echo htmlspecialchars($materiaPrima['nombre_materia_prima']); ?></td>
                            <td><?php echo htmlspecialchars($materiaPrima['descripcion']); ?></td>
                            <td><?php echo htmlspecialchars($materiaPrima['unidad_medida']); ?></td>
                            <td><?php echo htmlspecialchars($materiaPrima['cantidad_comprada']); ?></td>
                            <td><?php echo htmlspecialchars($materiaPrima['fecha_ingreso']); ?></td>
                            <td><?php echo htmlspecialchars($materiaPrima['precio_unitario']); ?></td>
                            <td><?php echo htmlspecialchars($materiaPrima['nombre_proveedor']); ?></td>
                            <td>
                                <div class="d-flex justify-content-start">
                                    <a href="index.php?accion=editar&id=<?php echo $materiaPrima['id_ingreso']; ?>" class="btn btn-primary btn-sm me-2">Editar</a>
                                    <a href="index.php?accion=borrar&id=<?php echo $materiaPrima['id_ingreso']; ?>" class="btn btn-danger btn-sm">Borrar</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Colocar botones de registrar y regresar debajo de la tabla -->
        <div class="d-flex justify-content-start mt-3">
            <a href="index.php?accion=crear" class="btn btn-success me-2">Registrar Materia Prima</a>
            <a href="index.php?accion=listar" class="btn btn-secondary">Regresar a la lista completa</a>
        </div>

    <?php else: ?>
        <!-- Mensaje y botones debajo de la tabla cuando no se encuentran registros -->
        <div class="alert alert-warning mt-4 shadow-lg">
            <strong>¡Atención!</strong> No hay productos registrados con el código o fecha ingresados.
        </div>
        <div class="d-flex justify-content-start mt-3">
            <a href="index.php?accion=crear" class="btn btn-success me-2">Registrar Materia Prima</a>
            <a href="index.php?accion=listar" class="btn btn-secondary">Regresar a la lista completa</a>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
