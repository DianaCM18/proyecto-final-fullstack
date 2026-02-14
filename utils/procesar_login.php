<?php

session_start(); //Iniciar sesión

include 'conn.php';

// Establecemos conexión con la base de datos
$conn = mysqli_connect($servidor, $usuario, $password, $dbname);
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Se obtienen los datos del formulario
$correo = trim(mysqli_real_escape_string($conn, $_POST['email']));
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Verificar si los campos no están vacíos e indicamos un mensaje si están vacíos
if (empty($correo) || empty($password)) {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Campos vacíos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="../imagenes/LOGO SIN FONDO.png" type="image/x-icon" />
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;400;700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
        <link rel="stylesheet" href="../styles.css" />
    </head>
    <body class="bg-light d-flex justify-content-center align-items-center vh-100">
        <div class="container text-center">
            <div class="alert alert-danger p-4 shadow">
                <h4 class="alert-heading">¡Ups!</h4>
                <p>Los campos están vacíos.</p>
                <hr>
                <a href="../login.php" class="btn btn-primary">Volver</a>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}
// Preparar la consulta para obtener el usuario
$stmt = $conn->prepare("SELECT nombre, plan, password FROM usuarios WHERE correo = ?");
if (!$stmt) {
    die("Error al preparar la consulta: " . mysqli_error($conn)); 
}

$stmt->bind_param("s", $correo); 
$stmt->execute();

// Obtener el resultado de la consulta
$result = $stmt->get_result();


//Si el resultado es una fila de la base de datos accede al usuario
if ($result && mysqli_num_rows($result) === 1) {
    $usuario = mysqli_fetch_assoc($result);
  
    
    // Verificamos la contraseña y accedemos segun el plan a cada una de las paginas
    //si la contraseña no es correcta o el usuario no está registrado indicamos un mensaje
    if (password_verify($password, $usuario['password'])) {
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['plan'] = trim($usuario['plan']);
      
        $plan = $_SESSION['plan'];

        if ($plan === 'nutricion') {
            header("Location: ../dashboard-nutricion.php");
            exit;
        } elseif ($plan === 'clases') {
            header("Location: ../clases_online.php");
            exit;
        } elseif ($plan === 'completo') {
            header("Location: ../index.php");
            exit;
        } else {
            die("Error: El plan seleccionado no es válido.");
        }
    } else {
        ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Contraseña</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="../imagenes/LOGO SIN FONDO.png" type="image/x-icon" />
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;400;700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
        <link rel="stylesheet" href="../styles.css" />
    </head>
    <body class="bg-light d-flex justify-content-center align-items-center vh-100">
        <div class="container text-center">
            <div class="alert alert-danger p-4 shadow">
                <h4 class="alert-heading">¡Ups!</h4>
                <p>La contraseña es incorrecta.</p>
                <hr>
                <a href="../login.php" class="btn btn-primary">Volver</a>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
    }
} else {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Campos vacíos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="../imagenes/LOGO SIN FONDO.png" type="image/x-icon" />
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;400;700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
        <link rel="stylesheet" href="../styles.css" />
    </head>
    <body class="bg-light d-flex justify-content-center align-items-center vh-100">
        <div class="container text-center">
            <div class="alert alert-danger p-4 shadow">
                <h4 class="alert-heading">¡Ups!</h4>
                <p>El usuario no está registrado.</p>
                <hr>
                <a href="../login.php" class="btn btn-primary">Volver</a>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}
// Se cierra la declaración y la conexión
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>