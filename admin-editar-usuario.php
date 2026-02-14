<?php
session_start();

// Comprobamos si el administrador ha iniciado sesión
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit();
}
// Conexión a la base de datos
$conn = mysqli_connect('localhost', 'root', '', 'kairos'); 
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$mensaje = ""; // Mostramos el mensaje

// Comprobar si se pasó el id_usuario por GET
if (isset($_GET['id_usuario'])) {
    $id_usuario = intval($_GET['id_usuario']);

    // Consulta para obtener los detalles del usuario
    $sql = "SELECT nombre, correo, password, plan, roll FROM usuarios WHERE id_usuario = $id_usuario";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
    } else {
        echo "Usuario no encontrado.";
        exit;
    }

} else {
    echo "No se proporcionó un ID de usuario.";
    exit;
}

// Procesar la actualización 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $plan = $_POST['plan'];
    $roll = 'usuario';  // El valor es siempre "usuario"

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Consulta de actualización del usuario
    $sql_update = "UPDATE usuarios SET nombre = ?, correo = ?, password = ?, plan = ?, roll = ? WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("sssssi", $nombre, $correo, $passwordHash, $plan, $roll, $id_usuario);
    $stmt->execute();

    $mensaje = "Usuario actualizado con éxito.";

    // Redirigir a la página de visualización del usuario con mensaje
    header("Location: admin-listar-usuario.php?mensaje=" . urlencode($mensaje));
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Editar Usuario - Kairós</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="./imagenes/LOGO SIN FONDO.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="styles.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container mt-5">
        <?php if (isset($_GET['mensaje'])): ?>
            <div id="mensaje" class="alert alert-success"><?php echo htmlspecialchars($_GET['mensaje']); ?></div>
        <?php endif; ?>

        <h2>Editar Usuario: <?php echo htmlspecialchars($usuario['nombre']); ?></h2>
        <form method="POST" id="editarUsuarioForm">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Correo</label>
                <input type="email" class="form-control" name="correo" value="<?php echo htmlspecialchars($usuario['correo']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password" value="<?php echo htmlspecialchars($usuario['password']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Plan</label>
                <select class="form-control" name="plan" required>
                    <option value="nutricion" >nutrición</option>
                    <option value="clases_online" >clases online</option>
                    <option value="completo" >completo</option>
                </select>
            </div>
            <div class="mb-3">
            <label class="form-label">Roll</label>
    <!-- El valor "usuario" es fijo y no permite selección -->
             <input type="text" class="form-control" name="roll" value="usuario" readonly>


            <button type="submit" class="btn btn-primary mt-4">Guardar Cambios</button>
            <a href="admin-listar-usuario.php" class="btn btn-primary mt-4">Cancelar Cambios</a>
        </form>
    </div>

    <script>
        // Captura el evento de envío del formulario
        document.getElementById('editarUsuarioForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Previene el envío del formulario
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Quieres guardar los cambios?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, guardar',
                cancelButtonText: 'No, cancelar',
                confirmButtonColor: '#E38f18', 
                cancelButtonColor: '#7fa095'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si se confirma, se envía el formulario
                    this.submit(); // Enviar el formulario
                }
            });
        });
    </script>
</body>
</html>
