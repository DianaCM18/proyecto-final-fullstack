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

    
    if (isset($_GET['id_recurso'])) {
        $id_recurso = intval($_GET['id_recurso']); 

        // Realizamos la consulta de los recursos
        $sql = "SELECT nombre_recurso,tipo_recurso, descripcion_recurso, autor_recurso FROM recursos WHERE id_recurso = $id_recurso";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $recurso = $result->fetch_assoc(); 
        } else {
            echo "Recurso no encontrado.";
            exit;
        }
    }

    // Procesar actualización
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre_recurso'];
        $tipo = $_POST['tipo_recurso'];
        $descripcion = $_POST['descripcion_recurso'];
        $autor = $_POST['autor_recurso'];
        $imagen_nueva = $_FILES['imagen_recurso']; // Obtener archivo de la imagen

        // Se verifica si se subió una nueva imagen y se define la ruta
        if ($imagen_nueva['error'] == 0) {
            $nombre_imagen = time() . "_" . basename($imagen_nueva['name']);
            $ruta_imagen = "./imagenes/" . $nombre_imagen;
            
            // se  mueve la imagen a la carpeta definida antes
            if (move_uploaded_file($imagen_nueva['tmp_name'], $ruta_imagen)) {
                // Si la imagen se sube correctamente, actualizamos la base de datos con la nueva imagen
                $sql_update = "UPDATE recursos SET nombre_recurso = ?, tipo_recurso = ?, descripcion_recurso = ?, autor_recurso = ?, imagen_recurso = ? WHERE id_recurso = ?";
                $stmt = $conn->prepare($sql_update);
                $stmt->bind_param("sssssi", $nombre, $tipo, $descripcion, $autor, $nombre_imagen, $id_recurso);
            } else {
                $mensaje = "Error al subir la imagen.";
            }
        } else {
            // Si no se ha subido una nueva imagen, solo actualizamos los demás campos
            $sql_update = "UPDATE recursos SET nombre_recurso = ?, tipo_recurso = ?, descripcion_recurso = ?, autor_recurso = ? WHERE id_recurso = ?";
            $stmt = $conn->prepare($sql_update);
            $stmt->bind_param("ssssi", $nombre, $tipo, $descripcion, $autor, $id_recurso);
        }
        $stmt->execute();

        $mensaje = "Recurso actualizado con éxito.";

        // Redirigir a la lista de recursos después de darle a guardar
        header("Location: admin-listar-recursos.php?mensaje=" . urlencode($mensaje)); 
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Editar Recurso - Kairós</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="./imagenes/LOGO SIN FONDO.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="styles.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<!-- Incluimos el formulario para poder editar los recursos-->
    <div class="container mt-5">
        <?php if (isset($_GET['mensaje'])): ?>
            <div id="mensaje" class="alert alert-success"><?php echo htmlspecialchars($_GET['mensaje']); ?></div>
        <?php endif; ?>

        <h2>Editar Recurso: <?php echo htmlspecialchars($recurso['nombre_recurso']); ?></h2> 
        <form method="POST" id="editarRecursoForm" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Tipo</label>
        <input type="text" class="form-control" name="tipo_recurso" value="<?php echo htmlspecialchars($recurso['tipo_recurso']); ?>" >
    </div>
    <div class="mb-3">
        <label class="form-label">Título</label>
        <textarea class="form-control" name="nombre_recurso" required><?php echo htmlspecialchars($recurso['nombre_recurso']); ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Autor</label>
        <textarea class="form-control" name="autor_recurso" required><?php echo htmlspecialchars($recurso['autor_recurso']); ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea class="form-control" name="descripcion_recurso" required><?php echo htmlspecialchars($recurso['descripcion_recurso']); ?></textarea>
    </div>

    <!-- A continuación se muestra la imagen actual -->
    <div class="mb-3">
        <label class="form-label">Imagen actual</label><br>
        <?php
            $sql_img = "SELECT imagen_recurso FROM recursos WHERE id_recurso = $id_recurso";
            $res_img = mysqli_query($conn, $sql_img);
            $row_img = mysqli_fetch_assoc($res_img);
            if (!empty($row_img['imagen_recurso'])) {
                echo "<img src='./imagenes/" . htmlspecialchars($row_img['imagen_recurso']) . "' alt='Imagen del recurso' width='150'>";
            } else {
                echo "No hay imagen.";
            }
        ?>
    </div>

    <!-- Incluimos para que se pueda subir una nueva imagen -->
    <div class="mb-3">
        <label class="form-label">Cargar nueva imagen (opcional)</label>
        <input type="file" class="form-control" name="imagen_recurso" accept="image/*">
    </div>

    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    <a href="admin-listar-recursos.php" class="btn btn-primary">Cancelar Cambios</a>
</form>
    </div>

    <script>
        // Captura el evento de envío del formulario
        document.getElementById('editarRecursoForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Previene el envío del formulario
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Quieres guardar los cambios?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, guardar',
                cancelButtonText: 'No, cancelar',
                confirmButtonColor: '#E38f18', 
                cancelButtonColor: '#7fa095',
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