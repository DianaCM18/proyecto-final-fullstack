<?php
session_start();

// Comprobamos si el administrador ha iniciado sesión
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit();
}
   // Conexión a la base de datos
    $conn = mysqli_connect('localhost', 'root', '', 'kairos'); 
       if (!$conn) {
          die("Conexión fallida: " . mysqli_connect_error());
        }
    $mensaje = ""; // Mostramos el mensaje

    if (isset($_GET['id_receta'])) {
    $id_receta = intval($_GET['id_receta']);

    // Realizamos la consulta de la receta
    $sql = "SELECT nombre_receta,descripcion_receta,ingredientes,imagen_receta FROM nutricion WHERE id_receta = $id_receta";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $receta = $result->fetch_assoc();
    } else {
        echo "Receta no encontrada.";
        exit;
    }

    // Realizamos la consulta de pasos
    $sql_pasos = "SELECT paso_numero,descripcion_paso FROM pasos_receta WHERE id_receta = $id_receta ORDER BY paso_numero ASC";
    $result_pasos = $conn->query($sql_pasos);
    $pasos = [];
    while ($row = $result_pasos->fetch_assoc()) {
        $pasos[] = $row;
    }

} else {
    echo "No se proporcionó un ID de receta.";
    exit;
}

// Procesar actualización
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre_receta'];
    $descripcion = $_POST['descripcion_receta'];
    $ingredientes = $_POST['ingredientes'];

    // Mostramos la imágen para editar
    $imagen_actual = $receta['imagen_receta'];
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombre_imagen = basename($_FILES['imagen']['name']);
        $ruta_destino = 'imagenes/' . $nombre_imagen;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino);
    } else {
        $nombre_imagen = $imagen_actual; // Si no se sube nada, se mantiene la imágen que ya estaba
    }
    //Actualizamos la base de datos de nutrición
    $sql_update = "UPDATE nutricion SET nombre_receta = ?, descripcion_receta = ?, ingredientes = ?, imagen_receta = ? WHERE id_receta = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("ssssi", $nombre, $descripcion, $ingredientes,$nombre_imagen, $id_receta);
    $stmt->execute();

    // Actualizamos la base de datos de pasos
    foreach ($_POST['pasos_receta'] as $num => $texto) {
        $sql_paso = "UPDATE pasos_receta SET descripcion_paso = ? WHERE id_receta = ? AND paso_numero = ?";
        $stmt_paso = $conn->prepare($sql_paso);
        $stmt_paso->bind_param("sii", $texto, $id_receta, $num);
        $stmt_paso->execute();
    }

    $mensaje = "Receta actualizada con éxito.";

    // Redirigimos a la lista de recetas después de guardar los cambios
    header("Location: admin-listar-receta.php?mensaje=" . urlencode($mensaje));
    exit;
}
  ?>



<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Editar Receta - Kairós</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="shortcut icon" href="./imagenes/LOGO SIN FONDO.png" type="image/x-icon">
  <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="styles.css" />
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<!--Formulario para editar recetas-->
  <div class="container mt-5">
    <?php if (isset($_GET['mensaje'])): ?>
        <div id="mensaje" class="alert alert-success"><?php echo htmlspecialchars($_GET['mensaje']); ?></div>
    <?php endif; ?>

    <h2>Editar Receta: <?php echo htmlspecialchars($receta['nombre_receta']); ?></h2>
    <form method="POST" id="editarRecetaForm" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" class="form-control" name="nombre_receta" value="<?php echo htmlspecialchars($receta['nombre_receta']); ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea class="form-control" name="descripcion_receta" required><?php echo htmlspecialchars($receta['descripcion_receta']); ?></textarea>
      </div>
      
      <div class="mb-3">
        <label class="form-label">Ingredientes</label>
        <textarea class="form-control" name="ingredientes" required><?php echo htmlspecialchars($receta['ingredientes']); ?></textarea>
      </div>
      <div class="mb-3">
  <label class="form-label">Imagen actual</label><br>
  <?php if (!empty($receta['imagen_receta'])): ?>
    <img src="imagenes/<?php echo htmlspecialchars($receta['imagen_receta']); ?>" alt="Imagen receta" style="max-width: 300px; border-radius: 10px;">
  <?php else: ?>
    <p>No hay imagen cargada.</p>
  <?php endif; ?>
</div>

<div class="mb-3">
  <label class="form-label">Cambiar imagen</label>
  <input type="file" class="form-control" name="imagen" accept="image/*">
</div>
      <h4>Pasos:</h4>
      <?php foreach ($pasos as $paso): ?>
        <div class="mb-3">
          <label class="form-label">Paso <?php echo $paso['paso_numero']; ?></label>
          <textarea class="form-control" name="pasos_receta[<?php echo $paso['paso_numero']; ?>]"><?php echo htmlspecialchars($paso['descripcion_paso']); ?></textarea>
        </div>
      <?php endforeach; ?>
      <div id="nuevosPasos"></div>
<!-- Se incluye un botón para añadir paso en una nueva línea -->
<div class="mt-3 mb-2">
    <button type="button" id="agregarPaso" class="btn btn-secondary">Añadir Paso</button>
</div>

      <button type="submit" class="btn btn-primary">Guardar Cambios</button>
      <a href="admin-listar-receta.php" class="btn btn-primary">Cancelar Cambios</a>

    </form>
  </div>
  <script>
    // Función para añadir nuevos pasos dinámicamente
        document.getElementById('agregarPaso').addEventListener('click', function() {
            var pasosDiv = document.getElementById('nuevosPasos');
            var pasoCount = pasosDiv.children.length + 1;
            var nuevoPaso = document.createElement('div');
            nuevoPaso.classList.add('mb-3');
            nuevoPaso.innerHTML = `
                <label class="form-label">Nuevo Paso ${pasoCount}</label>
                <textarea class="form-control" name="nuevos_pasos[]"></textarea>
            `;
            pasosDiv.appendChild(nuevoPaso);
        });
    // Captura el evento de envío del formulario
    document.getElementById('editarRecetaForm').addEventListener('submit', function(e) {
        e.preventDefault(); 
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¿Quieres guardar los cambios?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'No, cancelar',
            confirmButtonColor: '#E38f18', 
            cancelButtonColor: '#7fa095'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si se confirma, se envía el formulario
                this.submit(); // Enviar el formulario
            }
        });
    });

  </script>
</body>
</html>