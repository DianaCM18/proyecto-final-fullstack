<?php
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

// Verificamos si el ID del video está presente en la URL
if (isset($_GET['id_video'])) {
    $id_video = $_GET['id_video'];

    // Se prepara la consulta para eliminar el usuario
    $stmt = $conn->prepare("DELETE FROM clases_online WHERE id_video = ?");
    $stmt->bind_param("i", $id_video); 

    if ($stmt->execute()) {
        // Redirigimos a otra página con mensaje de éxito
        header("Location: admin-listar-video.php?mensaje=video eliminado con éxito");
    } else {
        // En caso de error salta el siguiente mensaje
        echo "<div class='alert alert-danger'>Hubo un error al eliminar el video.</div>";
    }

    $stmt->close();
}

$conn->close();
?>
