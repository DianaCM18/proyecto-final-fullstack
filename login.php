
<?php
session_start();
$plan = $_SESSION['plan'] ?? null;
$nombre = $_SESSION['nombre'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="./imagenes/LOGO SIN FONDO.png" type="image/x-icon">
  <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="styles.css" />
  <title>Kairós: Acceso</title>
</head>
<body>
  <?php if (isset($_SESSION['registrado']) && $_SESSION['registrado']): ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.7/dist/sweetalert2.all.min.js"></script>
  <script>
    Swal.fire({
      title: "¡Registro exitoso!",
      text: "Tu suscripción se ha completado correctamente.",
      icon: "success",
      confirmButtonColor: '#7FA095',
      willClose: () => {
        window.location.href = "index.php";
      }
    });
  </script>
  <?php unset($_SESSION['registrado']); ?>
<?php endif; ?>
  <header>
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
    <div id="Logos">
      <a href="index.php"><img src="imagenes/LOGO SIN FONDO.png" /></a>
    </div>
      
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
              <li class="nav-item"><a class="nav-link text-white" href="conocenos.php">CONÓCENOS</a></li>
              <li class="nav-item"><a class="nav-link text-white" href="emociones.html">INTELIGENCIA EMOCIONAL</a></li>
              <?php if ($plan === 'nutricion' || $plan === 'completo'): ?>
              <li class="nav-item"><a class="nav-link text-white" href="dashboard-nutricion.php">NUTRICIÓN</a></li>
              <?php endif; ?>
              <?php if ($plan === 'clases' || $plan === 'completo'): ?>
              <li class="nav-item"><a class="nav-link text-white" href="clases_online.php">CLASES ONLINE</a></li>
              <?php endif; ?> 
              <li class="nav-item"><a class="nav-link text-white" href="login.php"><i class="fa-solid fa-user"></i> ACCESO</a></li> 
          </ul>
      </div>
  </div>
</nav>
  </header>

  <div class="form-container mt-5 mb-5">
    <form action="utils/procesar_login.php" method="POST">
      <div class="mb-3">
        <label for="nname" class="form-label">Usuario</label>
        <input type="text" name="nombre" class="form-control" id="name">
      </div>

      <div class="mb-3">
        <label for="correo" class="form-label">Dirección de correo</label>
        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" name="password" class="form-control" id="password1">
      </div>

      <button type="submit" class="btn btn-primary">Acceder</button>
    </form>
    <!-- Enlace para crear cuenta -->
  <div class="mt-3">
    <p>¿No tienes cuenta? <a href="suscripcion.php" style="color: #7FA095;">Crear cuenta</a></p>
  </div>
</div>
</div>
  </div>
    <!-- FOOTER -->
    <footer class="Piepag">
      <div class="container">
        <div class="row">
          <!-- Sección de enlaces legales -->
          <div class="col-12 text-center">
            <ul class="list-inline">
              <li class="list-inline-item">
                <a href="#" class="text-white text-decoration-none"
                  >POLÍTICA COOKIES</a
                >
              </li>
              <li class="list-inline-item">
                <a href="#" class="text-white text-decoration-none"
                  >TÉRMINOS Y CONDICIONES DE USO</a
                >
              </li>
              <li class="list-inline-item">
                <a href="#" class="text-white text-decoration-none"
                  >POLÍTICA DE PRIVACIDAD</a
                >
              </li>
            </ul>
          </div>

          <!-- Sección de redes sociales -->
          <div class="col-12 d-flex justify-content-start">
            <div class="d-flex gap-3">
              <img src="imagenes/facebook.png" alt="Facebook" width="30" />
              <img src="imagenes/instagram.png" alt="Instagram" width="30" />
              <img src="imagenes/youtube.png" alt="YouTube" width="30" />
            </div>
          </div>
        </div>

        <!-- Derechos de autor  -->
        <div class="text-center">
          <small>@2025 Kairós - Todos los derechos reservados</small>
        </div>
      </div>
    </footer>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
</body>
</html>