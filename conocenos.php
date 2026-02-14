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
    <title>Conócenos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="styles.css" />
    <style>
      .foto-equipo {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #ccc;
      }
    </style>
</head>
<body>
    <header>
        <!-- CONOCENOS -->
        <div class="hero d-flex align-items-center justify-content-center">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <div id="Logos">
                        <a href="index.php"><img src="imagenes/LOGO SIN FONDO.png" alt="logo" style="cursor: pointer;" /></a>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <?php if ($nombre): ?>
                  <li class="nav-item"><span class="nav-link text-white">Hola, <?php echo $nombre; ?>!</span></li>
              <?php endif; ?>
                            <li class="nav-item"><a class="nav-link text-white" href="conocenos.php">CONÓCENOS</a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="emociones.php">INTELIGENCIA EMOCIONAL</a></li>
                            <?php if ($plan === 'nutricion' || $plan === 'completo'): ?>
                                <li class="nav-item"><a class="nav-link text-white" href="dashboard-nutricion.php">NUTRICIÓN</a></li>
                            <?php endif; ?>
                            <?php if ($plan === 'clases' || $plan === 'completo'): ?>
                                <li class="nav-item"><a class="nav-link text-white" href="clases_online.php">CLASES ONLINE</a></li>
                            <?php endif; ?>
                           <?php if ($nombre): ?>
                  <li class="nav-item"><a class="nav-link text-white" href="utils/usuario_logout.php">Cerrar sesión</a></li>
              <?php else: ?>
                  <li class="nav-item"><a class="nav-link text-white" href="login.php"><i class="fa-solid fa-user"></i> ACCESO</a></li>
              <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- Conocenos Image -->
    <img src="imagenes/conocenos.jpeg" alt="Foto Conocenos" class="hero-image">

    <!-- Párrafos descriptivos de la web -->
    <div class="container my-5">
        <div class="row text-center">
            <div class="col-md-4">
                <h2>Conócenos</h2>
                <p>
                    En Kairos, creemos que el bienestar verdadero nace del equilibrio entre cuerpo, mente y emociones.
                    Somos un equipo de profesionales comprometidos con acompañarte en tu camino hacia una vida más plena
                    y saludable, combinando herramientas de desarrollo personal, hábitos físicos y conciencia emocional.
                </p>
            </div>
            <div class="col-md-4">
                <h2>Qué Hacemos</h2>
                <p>
                    En nuestra plataforma reunimos recursos prácticos y accesibles para ayudarte a cuidar de tu bienestar
                    integral: clases de yoga en video, recetas nutritivas, y artículos sobre salud mental, nutrición y más.
                    Todo pensado para aplicarlo en tu día a día.
                </p>
            </div>
            <div class="col-md-4">
                <h2>Nuestros Valores</h2>
                <p>
                    Nos guiamos por la empatía, el respeto y la autenticidad. Promovemos el autocuidado, la conciencia y
                    una visión holística de la salud, ofreciendo un acompañamiento humano y cercano.
                </p>
            </div>
        </div>
    </div>

    <!-- El equipo -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Nuestro Equipo</h2>
        <div class="row justify-content-center text-center">
            <div class="col-md-3">
                <img src="imagenes/equipo1.jpeg" alt="Diana" class="foto-equipo mb-3">
                <h5>Diana</h5>
                <p>Psicóloga</p>
                <p>Apasionada por el desarrollo personal y el bienestar emocional, acompaña a las personas a reconectar con su propósito.</p>
            </div>
            <div class="col-md-3">
                <img src="imagenes/equipo2.jpeg" alt="Sara" class="foto-equipo mb-3">
                <h5>Sara</h5>
                <p>Nutricionista</p>
                <p>Experta en nutrición consciente, cree que alimentarse bien es un acto de amor propio y equilibrio diario.</p>
            </div>
            <div class="col-md-3">
                <img src="imagenes/equipo3.jpeg" alt="Virginia" class="foto-equipo mb-3">
                <h5>Virginia</h5>
                <p>Instructora de Yoga</p>
                <p>Guía sesiones con enfoque integrador, ayudando a cultivar calma, energía y conexión cuerpo-mente.</p>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
<footer class="Piepag">
  <div class="container">
      <div class="row">
          <!-- Sección de enlaces legales en una línea -->
          <div class="col-12 text-center">
              <ul class="list-inline">
                  <li class="list-inline-item"><a href="#" class="text-white text-decoration-none">POLÍTICA COOKIES</a></li>
                  <li class="list-inline-item"><a href="#" class="text-white text-decoration-none">TÉRMINOS Y CONDICIONES DE USO</a></li>
                  <li class="list-inline-item"><a href="#" class="text-white text-decoration-none">POLÍTICA DE PRIVACIDAD</a></li>
              </ul>
          </div>

          <!-- Sección de redes sociales alineadas a la izquierda -->
          <div class="col-12 d-flex justify-content-start">
              <div class="d-flex gap-3">
                  <img src="imagenes/facebook.png" alt="Facebook" width="30">
                  <img src="imagenes/instagram.png" alt="Instagram" width="30">
                  <img src="imagenes/youtube.png" alt="YouTube" width="30">
              </div>
          </div>
      </div>

      <!-- Derechos de autor centrado -->
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