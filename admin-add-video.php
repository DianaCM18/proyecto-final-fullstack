<?php
session_start();

// Comprobamos si el administrador ha iniciado sesión
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "kairos");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibimos los datos del formulario
$nombre = $_POST['nombre'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$nivel = $_POST['nivel'] ?? '';

// Archivos subidos
$miniaturaNombre = $_FILES['miniatura']['name'];
$miniaturaTmp = $_FILES['miniatura']['tmp_name'];

$videoNombre = $_FILES['video']['name'];
$videoTmp = $_FILES['video']['tmp_name'];

// Nuevos nombres de archivo para la miniatura y el video
$nombreMiniaturaNuevo = uniqid("miniatura_") . ".jpg"; 
$rutaMiniatura = "imagenes/" . $nombreMiniaturaNuevo;
$rutaVideo = "videos/" . basename($videoNombre); 

// Crear las carpetas si no existen
if (!is_dir("imagenes")) {
    mkdir("imagenes", 0777, true); 
}
if (!is_dir("videos")) {
    mkdir("videos", 0777, true); 
}

// Mover los archivos subidos a las carpetas correspondientes
if (move_uploaded_file($miniaturaTmp, $rutaMiniatura) && move_uploaded_file($videoTmp, $rutaVideo)) {

    
    $videoEnBD = basename($videoNombre); 
    
    // Preparar la consulta para insertar los datos en la base de datos
    $stmt = $conn->prepare("INSERT INTO clases_online (nombre_video, descripcion_video, nivel_video, video, miniatura) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nombre, $descripcion, $nivel, $videoEnBD, $nombreMiniaturaNuevo); 

    if ($stmt->execute()) {
        header("Location: admin-listar-video.php?mensaje=" . urlencode("Video agregado con éxito"));
        exit();
    } else {
        echo "Error al agregar el video en la base de datos.";
    }

    $stmt->close();
} else {
    echo "Error al subir el archivo de video o la miniatura.";
}

$conn->close();
?>
