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
    <link rel="stylesheet" href="styles.css" />
    <style>
      .modal-dialog {
        max-width: 80%;
        width: 100%;
      }
      .modal-content {
        border-radius: 15px;
      }
      .modal-body iframe {
        width: 100%;
        height: 500px;
      }
    </style>
    <title>CO Nivel Intermedio</title>
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

    <!-- Imagen introductoria -->
    <img src="imagenes/nivel_intermedio.jpg" alt="Nivel intermedio" class="hero-image"/>

    <!-- Texto Descriptivo -->
    <div class="container my-4">
      <p>En nuestra plataforma, te ofrecemos una serie de videos diseñados especialmente para quienes ya tienen experiencia previa en yoga, 
         pero desean llevar su práctica a un nivel más avanzado. Estos videos están diseñados para fortalecer lo aprendido y ayudarte a 
         continuar mejorando en tu práctica.</p><br>
    </div>

    <div class="container my-4">
      <p>Con la guía de nuestros instructores experimentados, aprenderás secuencias más desafiantes que trabajarán en profundidad cada parte de tu cuerpo. 
         Tómate un momento para ti y desafía tu práctica, explorando nuevos movimientos y mejorando tu fuerza y flexibilidad.</p>
    </div>

    <!-- Sección de Video Nivel Intermedio -->
    <div class="row">
      <?php
        include('conexion.php');

        // Consulta SQL para obtener los videos de nivel intermedio
        $sql = "SELECT * FROM clases_online WHERE nivel_video = 'intermedio'";
        $result = $conexion->query($sql);

        // Mostrar los resultados
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Generar la URL completa del video
                $videoUrl = 'videos/' . $row['video'];

                echo '<div class="col-sm-4 mb-3 mb-sm-0">';
                echo '<div class="card">';
                echo '<img src="imagenes/' . $row['miniatura'] . '" class="card-img-top" alt="miniatura"/>';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row['nombre_video'] . '</h5>';
                echo '<p class="card-text">' . $row['descripcion_video'] . '</p>';echo '<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#videoModal" onclick="cargarVideo(\'' . $videoUrl . '\')">Ver Video</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "No hay videos disponibles para este nivel.";
        }

        $conexion->close();
      ?>
    </div>

    <!-- Modal para mostrar el video -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="videoModalLabel">Nivel Intermedio</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="cerrarModal()"></button>
          </div>
          <div class="modal-body"></div>
        </div>
      </div>
    </div>

    <footer class="Piepag">
      <div class="container">
        <div class="row"><div class="col-12 text-center">
            <ul class="list-inline">
              <li class="list-inline-item">
                <a href="#" class="text-white text-decoration-none">POLÍTICA COOKIES</a>
              </li>
              <li class="list-inline-item">
                <a href="#" class="text-white text-decoration-none">TÉRMINOS Y CONDICIONES DE USO</a>
              </li>
              <li class="list-inline-item">
                <a href="#" class="text-white text-decoration-none">POLÍTICA DE PRIVACIDAD</a>
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

    <script>
      // Función para cargar el video en el modal
      function cargarVideo(url) {
        var modalBody = document.querySelector('.modal-body');
        var video = document.createElement('video');
        video.setAttribute('src', url);
        video.setAttribute('controls', true);
        video.setAttribute('allowfullscreen', true);
        video.setAttribute('width', '100%');
        video.setAttribute('height', '500px');
        modalBody.innerHTML = '';
        modalBody.appendChild(video);
      }

      // Función para cerrar el modal y detener el video
      function cerrarModal() {
        var modalBody = document.querySelector('.modal-body');
        modalBody.innerHTML = '';
      }
    </script>

  </body>
</html>
