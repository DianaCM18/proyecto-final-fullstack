<?php
session_start(); //Iniciar sesión

include 'conn.php';

// Establecemos conexión con la base de datos
$conn = mysqli_connect($servidor, $usuario, $password, $dbname);
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Se obtienen los datos del formulario
$correo = trim(mysqli_real_escape_string($conn, $_POST['admin']));
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Verificamos si los campos no están vacíos
if (empty($correo) || empty($password)) {
    header("Location: ../login_admin.php?error=campos");
    exit();
}

// Preparamos la consulta para obtener al administrador
$stmt = $conn->prepare("SELECT * FROM administradores WHERE correo = ?");
if (!$stmt) {
    die("Error al preparar la consulta: " . mysqli_error($conn)); 
}

$stmt->bind_param("s", $correo); 
$stmt->execute();

// Obtenemos el resultado de la consulta
$result = $stmt->get_result();

// Si el resultado es una fila de la base de datos accede al usuario
if ($result && mysqli_num_rows($result) === 1) {
    $admin = mysqli_fetch_assoc($result);

    // Verificamos contraseña
    if (password_verify($password, $admin['password'])) {
        $_SESSION['admin'] = $admin['correo']; 
        $_SESSION['admin_name'] = $admin['nombre']; 
        header("Location: ../funciones_admin.php");
        exit();
    } else {
        header("Location: ../login_admin.php?error=login");
        exit();
    }
} else {
    header("Location: ../login_admin.php?error=login");
    exit();
}
// Se cierra la declaración y la conexión
$stmt->close();
mysqli_close($conn);
?>