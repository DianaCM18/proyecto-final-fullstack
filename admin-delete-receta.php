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

// Verificamos si el ID del usuario está presente en la URL
if (isset($_GET['id_receta'])) {
    $id_receta = $_GET['id_receta'];

    // Se prepara la consulta para eliminar el usuario
    $stmt = $conn->prepare("DELETE FROM nutricion WHERE id_receta = ?");
    $stmt->bind_param("i", $id_receta); 

    if ($stmt->execute()) {
        // Redirigimos a otra pagina con mensaje de éxito
        header("Location: admin-listar-receta.php?mensaje= Receta eliminada con éxito");
    } else {
        // En caso de error de muestra el siguiente mensaje
        echo "<div class='alert alert-danger'>Hubo un error al eliminar la receta.</div>";
    }

    $stmt->close();
}

$conn->close();
?>
