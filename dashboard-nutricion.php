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
  <title>Kairós: Nutrición</title>
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


<!-- Hero Image -->
<img src="./imagenes/nutricionIntro.jpg" alt="Ensalada saludable" class="hero-image">

<!-- Texto Descriptivo -->
<div class="container my-4">
  <p><strong>En Kairós</strong> encontrarás todo lo que necesitas para mejorar tu alimentación y cuidar tu salud.
  Descubre consejos prácticos, recetas saludables y planes de alimentación adaptados a tus necesidades. Tu
  bienestar empieza con lo que comes. ¡Descubre una forma de alimentarte que te haga sentir bien!</p>
</div>


</div>
<div class="container mt-5">
  <p>A continuación, encontrarás una selección de recetas diseñadas para ofrecerte opciones deliciosas 
    y nutritivas que se adaptan a diferentes estilos de vida. Ya sea que busques comidas rápidas y 
    saludables, opciones ricas en proteínas o platos llenos de vitaminas y minerales, estas recetas 
    te ayudarán a incorporar buenos hábitos alimenticios de manera sencilla y deliciosa. 
    
    Cada plato ha sido pensado para equilibrar sabor y bienestar, permitiéndote disfrutar de la 
    comida mientras cuidas tu salud. Descubre nuevas ideas para tus comidas diarias y da el primer 
    paso hacia una alimentación más consciente y equilibrada.</p>
  <!-- PHP para mostrar recetas desde la base de datos -->
  <div class="container mt-5">
  <p style="text-align: center;"><strong>DESCUBRE NUESTRAS RECETAS</strong></p>
  <div class="row mt-4">
      <?php
      include 'conexion.php';
      $sql = "SELECT id_receta, nombre_receta, imagen_receta, descripcion_receta FROM nutricion";
      $resultado = $conexion->query($sql);

      if ($resultado->num_rows > 0):
          while ($row = $resultado->fetch_assoc()):
              $id_receta = $row['id_receta'];
              $nombre_receta = $row['nombre_receta'];
              $imagen_receta = $row['imagen_receta'];
              $descripcion_receta = $row['descripcion_receta'];
              $imagePath = './imagenes/' . htmlspecialchars($imagen_receta);
      ?>
              <div class="col-sm-4 mb-3">
                  <div class="flip-card">
                      <div class="flip-card-inner">
                          <!-- Parte frontal -->
                          <div class="flip-card-front">
                              <img src="<?= $imagePath; ?>" class="card-img-top" id="img-receta" alt="<?= htmlspecialchars($nombre_receta); ?>">
                              <div class="card-body text-dark text-center">
                                  <h5 class="card-title" id="titulo-receta"><?= htmlspecialchars($nombre_receta); ?></h5>
                                  
                              </div>
                          </div>
                          <!-- Parte trasera -->
                          <div class="flip-card-back">
                              <p><?= htmlspecialchars($descripcion_receta); ?></p>
                              <a href="ver-receta.php?id_receta=<?= $id_receta; ?>" class="btn btn-primary">Ver receta</a>
                          </div>
                      </div>
                  </div>
              </div>
      <?php
          endwhile;
      else:
          echo "<p class='text-center'>No se encontraron recetas.</p>";
      endif;
      $conexion->close();
      ?>
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