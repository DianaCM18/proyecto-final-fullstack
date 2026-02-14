<?php
session_start(); // Iniciar sesión
$plan = $_SESSION['plan'] ?? null;
$nombre = $_SESSION['nombre'] ?? null;


include 'conn.php';

$conn = mysqli_connect($servidor,$usuario,$password,$dbname);
    if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
    }
// Cogemos todos los valores del formulario
$nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
$correo = mysqli_real_escape_string($conn, $_POST['correo']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$plan = mysqli_real_escape_string($conn, $_POST['plan']);



// Ver que no están vacíos. Si está vacio algun campo lo indicamos
if (empty($nombre) || empty($correo) || empty($password) || empty($plan)) {
     echo '
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Error</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link
      rel="shortcut icon"
      href="../imagenes/LOGO SIN FONDO.png"
      type="image/x-icon"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;400;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <link rel="stylesheet" href="../styles.css" />
    </head>
    <body class="bg-light d-flex align-items-center justify-content-center vh-100">
        <div class="container text-center">
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Error</h4>
                <p>Todos los campos son obligatorios.</p>
                <hr>
                <a href="../suscripcion.php" class="btn btn-primary">Volver</a>
            </div>
        </div>
    </body>
    </html>';
    exit;
}

// Verificar si el correo ya existe
$sql_check_email = "SELECT * FROM usuarios WHERE correo = '$correo'";
$result = mysqli_query($conn, $sql_check_email);
if (mysqli_num_rows($result) > 0) {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Correo ya registrado</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link
      rel="shortcut icon"
      href="../imagenes/LOGO SIN FONDO.png"
      type="image/x-icon"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;400;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <link rel="stylesheet" href="../styles.css" />
    </head>
    <body class="bg-light d-flex justify-content-center align-items-center vh-100">
        <div class="container text-center">
            <div class="alert alert-danger p-4 shadow">
                <h4 class="alert-heading">¡Ups!</h4>
                <p>El correo electrónico <strong><?php echo htmlspecialchars($correo); ?></strong> ya está registrado.</p>
                <hr>
                <a href="../suscripcion.php" class="btn btn-primary">Volver</a>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}

//Ahora encriptamos las contraseñas

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Se prepara la secuencia sql para evitar inyecciones
$stmt = mysqli_prepare($conn, "INSERT INTO usuarios (nombre, correo, password, plan, roll) VALUES (?, ?, ?, ?, ?)");
if ($stmt === false) {
    die('Error en la preparación de la consulta: ' . mysqli_error($conn));
}
// Asignamos el rol de usuario
$roll = 'cliente';

// Vinculamos los parámetros de la consulta
mysqli_stmt_bind_param($stmt, "sssss", $nombre, $correo, $passwordHash, $plan, $roll);

// Ejecutamos la consulta
if (mysqli_stmt_execute($stmt)) {
    $_SESSION['plan'] = $plan;
    $_SESSION['registrado'] = true;
    $_SESSION['nombre'] = $nombre;
    // Redirigimos al usuario a la página de login
    header("Location: ../login.php");
    exit;
} else {
    echo "Error: " . mysqli_stmt_error($stmt);
}


// Se cierra la declaración y la conexión
mysqli_stmt_close($stmt);
mysqli_close($conn);

?>




    
