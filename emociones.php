<?php
session_start();
$plan = $_SESSION['plan'] ?? null;
$nombre = $_SESSION['nombre'] ?? null;
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="./imagenes/LOGO SIN FONDO.png" type="image/x-icon">
  <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    <link rel="stylesheet" href="styles.css" />
    <title>Kairós: Emociones</title>
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
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
          <div id="Logos">
            <a href="index.php"><img src="imagenes/LOGO SIN FONDO.png" /></a>
          </div>

          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
          >
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
    </header>

    <div>
      <div>
        <!--SECCION EMOCIONES -->
<h6 class="section-title mt-5 mb-2" style="text-align: center;background-color: #DECDBE; color: white; padding: 10px;"> Las emociones bien gestionadas, son la base de una vida
              equilibrada</h6>
<div class="hero d-flex align-items-center justify-content-center">
  
  <section class="mt-3 mb-5 py-4 px-4">
    <div class="row align-items-center">
    <div class="col-md-6">
      <img src=".\imagenes\imagenmoc3.jpeg" class="img-fluid rounded" alt="imageoc3">
    </div>
    <div class="col-md-6">
      <p>
        En nuestro día a día, las emociones juegan un papel fundamental en cómo pensamos, actuamos y nos relacionamos con los demás. 
        La gestión emocional no consiste en controlar o reprimir lo que sentimos, sino en aprender a reconocer, comprender y canalizar 
        nuestras emociones de manera saludable.

      </p>
      <p>
        El estrés, la ansiedad, la tristeza o incluso la euforia pueden tener un impacto directo en nuestra salud física y mental. 
        Aprender a gestionar estos estados emocionales nos permite tomar decisiones más conscientes, mejorar nuestras relaciones y 
        fortalecer nuestro bienestar general.
 
      </p>
      <p>
        Además, el entorno social influye profundamente en cómo experimentamos y expresamos nuestras emociones. 
        Las relaciones familiares, laborales o de amistad pueden ser tanto fuente de equilibrio como de desequilibrio emocional.
         Por eso, abordamos la gestión emocional no solo desde lo individual, sino también desde lo relacional: cómo nos afecta lo que vivimos con los demás, y cómo podemos responder de forma más saludable ante esos estímulos.

      </p>
      
    </div>
  </div>
</section>
</div>
<!-- SECCION EMOCIONES -->
    <div class="container my-5">
        <div class="row justify-content-center text-center">
            <div class="col-md-3">
                <img src="imagenes/manejo-emociones.jpeg" alt="manejo-emociones" class="foto-equipo mb-3">
                <h5>Manejo de emociones</h5>
                
                
            </div>
            <div class="col-md-3">
                <img src="imagenes/gestion-estres.jpeg" alt="gestion-estres" class="foto-equipo mb-3">
                <h5>Gestion de estrés</h5>
                
                
            </div>
            <div class="col-md-3">
                <img src="imagenes/habilidades-sociales.jpeg" alt="habilidades-sociales" class="foto-equipo mb-3">
                <h5>Habilidades sociales</h5>
                
                
            </div>
            <a href="recursos_emociones.php">
              <button type="button" class="btn btn-primary mt-4">
                Acceso a diferentes recursos
              </button>
            </a>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="Piepag">
      <div class="container">
        <div class="row">
          <!-- Sección de enlaces legales en una línea -->
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

          <!-- Sección de redes sociales alineadas a la izquierda -->
          <div class="col-12 d-flex justify-content-start">
            <div class="d-flex gap-3">
              <img src="imagenes/facebook.png" alt="Facebook" width="30" />
              <img src="imagenes/instagram.png" alt="Instagram" width="30" />
              <img src="imagenes/youtube.png" alt="YouTube" width="30" />
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
