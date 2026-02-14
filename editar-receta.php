<?php
                // Conectar a la base de datos
                $conn = mysqli_connect('localhost', 'root', '', 'kairos'); 
                if (!$conn) {
                    die("Conexión fallida: " . mysqli_connect_error());
                }
    $mensaje = ""; // Variable para mostrar mensaje

    if (isset($_GET['id_receta'])) {
    $id_receta = intval($_GET['id_receta']);

    // Consulta principal de la receta
    $sql = "SELECT nombre_receta,descripcion_receta,ingredientes FROM nutricion WHERE id_receta = $id_receta";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $receta = $result->fetch_assoc();
    } else {
        echo "Receta no encontrada.";
        exit;
    }

    // Consulta de pasos
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

    $sql_update = "UPDATE nutricion SET nombre_receta = ?, descripcion_receta = ?, ingredientes = ? WHERE id_receta = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("sssi", $nombre, $descripcion, $ingredientes, $id_receta);
    $stmt->execute();

    // Actualizar pasos
    foreach ($_POST['pasos_receta'] as $num => $texto) {
        $sql_paso = "UPDATE pasos_receta SET descripcion_paso = ? WHERE id_receta = ? AND paso_numero = ?";
        $stmt_paso = $conn->prepare($sql_paso);
        $stmt_paso->bind_param("sii", $texto, $id_receta, $num);
        $stmt_paso->execute();
    }

    $mensaje = "Receta actualizada con éxito.";

    // Redirigir a la lista de recetas después de guardar los cambios
    header("Location: listar_receta.php?mensaje=" . urlencode($mensaje));
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <div class="container mt-5">
    <?php if (isset($_GET['mensaje'])): ?>
        <div id="mensaje" class="alert alert-success"><?php echo htmlspecialchars($_GET['mensaje']); ?></div>
    <?php endif; ?>

    <h2>Editar Receta: <?php echo htmlspecialchars($receta['nombre_receta']); ?></h2>
    <form method="POST" id="editarRecetaForm">
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
      <h4>Pasos:</h4>
      <?php foreach ($pasos as $paso): ?>
        <div class="mb-3">
          <label class="form-label">Paso <?php echo $paso['paso_numero']; ?></label>
          <textarea class="form-control" name="pasos_receta[<?php echo $paso['paso_numero']; ?>]"><?php echo htmlspecialchars($paso['descripcion_paso']); ?></textarea>
        </div>
      <?php endforeach; ?>
      <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
  </div>
  <script>
    // Capturamos el evento de envío del formulario
    document.getElementById('editarRecetaForm').addEventListener('submit', function(e) {
        e.preventDefault(); 
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¿Quieres guardar los cambios?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'No, cancelar'
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