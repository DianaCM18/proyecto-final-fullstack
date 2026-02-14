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
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    
<div class="container py-5"> 
<?php
    //Información de conexión

    include 'utils/conn.php';

    $conn = mysqli_connect($servidor, $usuario, $password, $dbname);
    if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    session_start();

// Comprobamos si el administrador ha iniciado sesión
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit();
}

    //Evitamos inyección SQL
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $correo = mysqli_real_escape_string($conn, $_POST['correo']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $plan = mysqli_real_escape_string($conn, $_POST['plan']);
    $roll = mysqli_real_escape_string($conn, $_POST['roll']);

    if (empty($nombre) || empty($correo) || empty($password) || empty($plan)) {
        die("Error: Todos los campos son obligatorios.");
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Insertamos incluyendo el valor fijo para 'roll'
    $sql = "INSERT INTO usuarios (nombre, correo, password, plan, roll) 
            VALUES ('$nombre', '$correo', '$$passwordHash', '$plan', '$roll')";

    if (mysqli_query($conn, $sql)) {
        $mensaje = "Usuario agregado con éxito.";
        echo '<div class="alert alert-success" role="alert">' . $mensaje . '</div>';
        header("Location: admin-listar-usuario.php?mensaje=" . urlencode($mensaje)); 
        exit;
    } else {
        echo '<div class="alert alert-danger" role="alert">
                Error al añadir el usuario: ' . mysqli_error($conn) . '
              </div>';
    }

    mysqli_close($conn);
?>
<br>
</div>

</body>
</html>