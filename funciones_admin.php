<?php
session_start();

// Si no hay sesión activa, redirigimos a login_admin.php
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit();
}

// Se obtiene el nombre del administrador desde la sesión
$admin_name = $_SESSION['admin']; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./imagenes/LOGO SIN FONDO.png" type="image/x-icon">
    <title>Funciones Administrador</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="./styles.css" />
    <style>
         .logo {
      max-width: 300px;
      
    }

    </style>
</head>
<body>
    <header>
        <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
       
          
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
               <!-- Mensaje de sesión iniciada -->
        <li class="nav-item">
          <span class="nav-link text-white">Sesión iniciada: <?php echo htmlspecialchars($admin_name); ?></span>
        </li>
                 <li class="nav-item">
  <a class="nav-link text-white" href="admin-listar-usuario.php">USUARIO</a>
</li>
<li class="nav-item">
  <a class="nav-link text-white" href="admin-listar-recursos.php">RECURSOS</a>
</li>
<li class="nav-item">
  <a class="nav-link text-white" href="admin-listar-receta.php">RECETAS</a>
</li>
<li class="nav-item">
  <a class="nav-link text-white" href="admin-listar-video.php">VIDEOS</a>
</li>
<li class="nav-item">
  <a class="nav-link text-white" href="admin-listar-comentarios.php">COMENTARIOS</a>
</li>

        <li class="nav-item">
  <a href="#" id="cerrarSesion" class="nav-link text-white">Cerrar sesión</a>
</li>
                       
          </div>
      </div>
    </nav>
      </header>

      <div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
        <img src="imagenes/LOGO SIN FONDO.png" alt="Logo" class="logo" />
      </div>
      

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById('cerrarSesion').addEventListener('click', function(e) {
    e.preventDefault();
    Swal.fire({
      title: '¿Quieres cerrar sesión?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sí, cerrar sesión',
      cancelButtonText: 'Cancelar',
      confirmButtonColor: '#E38f18', 
      cancelButtonColor: '#7fa095'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = './utils/admin-logout.php?cerrada=1';
      }
    });
  });
</script>
</body>
</html>