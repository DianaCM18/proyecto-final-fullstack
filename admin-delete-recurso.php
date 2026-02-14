<?php
session_start(); // Iniciar sesión

session_start();

// Comprobamos si el administrador ha iniciado sesión
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit();
}

// Conexión a la base de datos MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kairos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobamos si la conexión es exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificamos si el ID del usuario está presente en la URL
if (isset($_GET['id_recurso'])) {
    $id_recurso = $_GET['id_recurso'];

    // Se prepara la consulta para eliminar el usuario
    $stmt = $conn->prepare("DELETE FROM recursos WHERE id_recurso = ?");
    $stmt->bind_param("i", $id_recurso); // "i" indica que $id_usuario es un entero

    if ($stmt->execute()) {
        // Redirigimos a otra pagina con mensaje de éxito
        header("Location: admin-listar-recursos.php?mensaje= Recurso eliminado con éxito");
    } else {
        // En caso de error se muestra el siguiente mensaje
        echo "<div class='alert alert-danger'>Hubo un error al eliminar el recurso.</div>";
    }

    $stmt->close();
}

$conn->close();
?>

