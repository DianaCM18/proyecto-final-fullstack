<?php
session_start();
$plan = $_SESSION['plan'] ?? null;
$nombre = $_SESSION['nombre'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
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
    <link rel="stylesheet" href="styles.css" />
  <title>Kairós: Clases Online</title>
  </head>
  <body>
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
                <?php if ($nombre): ?>
                  <li class="nav-item"><span class="nav-link text-white">Hola, <?php echo $nombre; ?>!</span></li>
              <?php endif; ?>
                  <li class="nav-item"><a class="nav-link text-white" href="conocenos.php">CONÓCENOS</a></li>
                  <li class="nav-item"><a class="nav-link text-white" href="emociones.php">INTELIGENCIA EMOCIONAL</a></li>
              <?php if ($plan === 'nutricion' || $plan === 'completo'): ?>
                  <li class="nav-item"><a class="nav-link text-white" href="dashboard-nutricion.php">NUTRICIÓN</a></li>
              <?php endif; ?>
              <?php if ($plan === 'clases' || $plan === 'completo'): ?>
                  <li class="nav-item"><a class="nav-link text-white" href="clases_online.html">CLASES ONLINE</a></li>
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

      <!-- Texto Descriptivo -->
<div class="container my-4">
  <div class="titulo">Bienvenido a Kairós: un espacio en el que encontrarás clases online de todos los niveles</div></br>
  
  <img src="imagenes\introduccion_clases.jpg " alt="Introduccion clases" class="basico-image"></br></br>
  <div class="bloque">
    HA LLEGADO EL MOMENTO DE EMPEZAR A CUIDARTE
  </div></br></br>
  <p><strong>En Kairós</strong> creemos que la práctica física y mental es transformadora para el cuerpo, la mente y el espíritu.
     Nuestro objetivo es brindarte un espacio donde puedas conectar contigo mismo, sin importar tu nivel de experiencia. 
     Ya seas principiante o alguien con más experiencia, 
    en nuestra plataforma encontrarás clases adaptadas a tus necesidades y ritmo.</p>


<div class="subtittle">
  NUESTROS NIVELES
</div>


      <!-- Niveles clases online -->
    <div class="row mt-4 gx-1 justify-content-center">
        <!-- Tarjeta 1 -->
        <div class="col-sm-4 mb-3">
          <div class="card" style="width: 18rem;">
            <a href="nivel_basico.php"
            ><img src="imagenes\basico.jpg" class="card-img-top" alt="Basico"
          /></a>

            <div class="card-body-nivel">
              <p class="card-text">BASICO</p>
            </div>
          </div>
        </div>
        
        <!-- Tarjeta 2 -->
        <div class="col-sm-4 mb-3 justify-content-center">
          <div class="card" style="width: 18rem;">
            <a href="nivel_intermedio.php"
            ><img src="imagenes\intermedio.jpg" class="card-img-top" alt="Intermedio"
          /></a>
            <div class="card-body-nivel">
              <p class="card-text">INTERMEDIO</p>
            </div>
          </div>
        </div>
  
        <!-- Tarjeta 3 -->
        <div class="col-sm-4 mb-3 justify-content-center">
          <div class="card" style="width: 18rem;">
            <a href="nivel_avanzado.php"
            ><img src="imagenes\avanzado.jpg" class="card-img-top" alt="Avanzado"
          /></a>
            <div class="card-body-nivel">
              <p class="card-text">AVANZADO</p>
            </div>
          </div>
        </div>
      </div>

    </div>

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
