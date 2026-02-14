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

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$ingredientes = $_POST['ingredientes'];
$pasos = $_POST['pasos'];

// Procesar imagen
$imagenNombre = basename($_FILES['imagen']['name']);
$imagenTmp = $_FILES['imagen']['tmp_name'];
$rutaDestino = "imagenes/" . $imagenNombre;

if (move_uploaded_file($imagenTmp, $rutaDestino)) {
    // Guardamos solo el nombre de la imagen en la base de datos
    $stmt = $conn->prepare("INSERT INTO nutricion (nombre_receta, descripcion_receta, imagen_receta, ingredientes) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $descripcion, $imagenNombre, $ingredientes);

    if ($stmt->execute()) {
        $id_receta = $conn->insert_id;

        $stmtPaso = $conn->prepare("INSERT INTO pasos_receta (id_receta, paso_numero, descripcion_paso) VALUES (?, ?, ?)");
        $numeroPaso = 1;
        foreach ($pasos as $descripcionPaso) {
            if (!empty(trim($descripcionPaso))) {
                $stmtPaso->bind_param("iis", $id_receta, $numeroPaso, $descripcionPaso);
                $stmtPaso->execute();
                $numeroPaso++;
            }
        }

        // Redirigimos un mensaje si la receta se ha agregado con éxito
        header("Location: admin-listar-receta.php?mensaje=" . urlencode("Receta agregada con éxito"));
        exit();
    } else {
        echo "Error al agregar la receta.";
    }

    $stmt->close();
} else {
    echo "Error al subir la imagen.";
}

$conn->close();
?>
