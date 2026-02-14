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

if (isset($_GET['id_video'])) {
    $id_video = intval($_GET['id_video']);

    // Consulta principal del video
    $sql = "SELECT nombre_video, descripcion_video, nivel_video, video, miniatura FROM clases_online WHERE id_video = $id_video";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $video = $result->fetch_assoc();
    } else {
        echo "Video no encontrado.";
        exit;
    }

} else {
    echo "No se proporcionó un ID de video.";
    exit;
}

// Procesar actualización
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre_video'];
    $descripcion = $_POST['descripcion_video'];
    $nivel = $_POST['nivel_video'];

    // Valores actuales por defecto
    $url_video = $video['video'];
    $miniatura = $video['miniatura'];

    // Se sube nuevo video si se proporciona
    if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
        $nombre_archivo_video = basename($_FILES['video']['name']);
        $ruta_video = 'videos/' . $nombre_archivo_video;
        move_uploaded_file($_FILES['video']['tmp_name'], $ruta_video);
        $url_video = $ruta_video;
    }

    // Subir nueva miniatura si se proporciona
    if (isset($_FILES['miniatura']) && $_FILES['miniatura']['error'] === UPLOAD_ERR_OK) {
        $nombre_archivo_miniatura = basename($_FILES['miniatura']['name']);
        $ruta_miniatura = 'imagenes/' . $nombre_archivo_miniatura;
        move_uploaded_file($_FILES['miniatura']['tmp_name'], $ruta_miniatura);
        $miniatura = $ruta_miniatura;
    }

    // Actualizamos la base de datos de clases_online
    $sql_update = "UPDATE clases_online SET nombre_video = ?, descripcion_video = ?, nivel_video = ?, video = ?, miniatura = ? WHERE id_video = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("sssssi", $nombre, $descripcion, $nivel, $url_video, $miniatura, $id_video);
    $stmt->execute();

    $mensaje = "Video actualizado con éxito.";
    header("Location: admin-listar-video.php?mensaje=" . urlencode($mensaje));
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Editar Video - Kairós</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="shortcut icon" href="./imagenes/LOGO SIN FONDO.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="styles.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <div class="container mt-5">
    <?php if (isset($_GET['mensaje'])): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($_GET['mensaje']); ?></div>
    <?php endif; ?>

    <h2>Editar Video: <?php echo htmlspecialchars($video['nombre_video']); ?></h2>
    <!--Formulario para poder editar los videos-->
    <form method="POST" id="editarVideoForm" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Nombre del Video</label>
        <input type="text" class="form-control" name="nombre_video" value="<?php echo htmlspecialchars($video['nombre_video']); ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea class="form-control" name="descripcion_video" required><?php echo htmlspecialchars($video['descripcion_video']); ?></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Nivel</label>
        <select class="form-select" name="nivel_video" required>
          <option value="Basico" <?php if ($video['nivel_video'] == 'Basico') echo 'selected'; ?>>Básico</option>
          <option value="Intermedio" <?php if ($video['nivel_video'] == 'Intermedio') echo 'selected'; ?>>Intermedio</option>
          <option value="Avanzado" <?php if ($video['nivel_video'] == 'Avanzado') echo 'selected'; ?>>Avanzado</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Video (actual: <?php echo htmlspecialchars($video['video']); ?>)</label>
        <input type="file" class="form-control" name="video" accept="video/*">
      </div>
      <div class="mb-3">
        <label class="form-label">Miniatura actual</label><br>
        <input type="file" class="form-control" name="miniatura" accept="image/*">
        </br>
        <?php if (!empty($video['miniatura'])): ?>
          <!-- Mostrar la imagen si existe -->
          <img src="./imagenes/<?php echo htmlspecialchars($video['miniatura']); ?>" alt="Imagen video" style="max-width: 200px; border-radius: 10px;">
        <?php else: ?>
          <!-- Mostrar mensaje si no hay miniatura -->
          <p>No hay imagen cargada.</p>
        <?php endif; ?>
      </div>
      <button type="submit" class="btn btn-primary">Guardar Cambios</button>
      <a href="admin-listar-video.php" class="btn btn-primary">Cancelar Cambios</a>
    </form>
  </div>

  <script>
    // Captura el evento de envío del formulario
    document.getElementById('editarVideoForm').addEventListener('submit', function(e) {
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
                this.submit();
            }
        });
    });
  </script>
</body>
</html>
