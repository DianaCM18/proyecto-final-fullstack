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
if (isset($_GET['id_opinion'])) {
    $id_opinion = $_GET['id_opinion'];

    // Se prepara la consulta para eliminar el usuario
    $stmt = $conn->prepare("DELETE FROM opiniones WHERE id_opinion = ?");
    $stmt->bind_param("i", $id_opinion); // "i" indica que $id_usuario es un entero

    if ($stmt->execute()) {
        // Redirigimos a ver-usuario.php con mensaje de éxito
        header("Location: admin-listar-comentarios.php?mensaje= Opinión eliminada con éxito");
    } else {
        // En caso de error
        echo "<div class='alert alert-danger'>Hubo un error al eliminar la opinión.</div>";
    }

    $stmt->close();
}

$conn->close();
?>