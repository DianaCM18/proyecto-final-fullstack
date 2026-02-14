<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
</head>
<body>
    
<div class="container py-5"> 
<?php
    //Información de conexión
    include 'utils/conn.php';

    $conn = mysqli_connect($servidor,$usuario,$password,$dbname);
    if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    
session_start();

// Comprobamos si el administrador ha iniciado sesión
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit();
}


    // Se cogen todos los valores del formulario
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre_recurso']);
    $tipo = mysqli_real_escape_string($conn, $_POST['tipo_recurso']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion_recurso']);
    $imagen = mysqli_real_escape_string($conn, $_FILES['imagen_recurso']['name']);  
    $autor = mysqli_real_escape_string($conn, $_POST['autor_recurso']);

    

    // Vemos que no están vacíos
    if (empty($nombre) || empty($tipo) || empty($descripcion)|| empty($autor) || empty($imagen)) {
        die("Error: Todos los campos son obligatorios.");
    }
    

    // Insertamos los datos en la base de datos
    $sql = "INSERT INTO recursos (nombre_recurso, tipo_recurso, descripcion_recurso, autor_recurso, imagen_recurso) 
        VALUES ('$nombre', '$tipo', '$descripcion', '$autor', '$imagen')";
            
    //Si se hace la conexión se añade correctamente
    if (mysqli_query($conn, $sql)) {
        $mensaje = "Recurso agregado con éxito.";
        echo '<div class="alert alert-success" role="alert">' . $mensaje . '</div>';
        header("Location: admin-listar-recursos.php?mensaje=" . urlencode($mensaje));
        exit;
    } else {
        echo '<div class="alert alert-danger" role="alert">
                Error al eliminar el recurso: ' . $stmt->error . '
              </div>';
    }

    
    mysqli_close($conn);
  ?>
<br>
</div>

</body>
</html>