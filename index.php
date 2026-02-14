
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
  <title>Kairós : Página de inicio</title>
</head>
<body>
  <header>
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
    <div id="Logos">
      <a href="index.php"><img src="imagenes/LOGO SIN FONDO.png" /></a>
    </div>
      
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <?php if ($nombre): ?>
                  <li class="nav-item"><span class="nav-link text-white">Hola, <?php echo htmlspecialchars($nombre); ?>!</span></li>
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
                  <a href="./utils/usuario_logout.php" class="nav-link text-white" >Cerrar sesión</a>
              <?php else: ?>
                  <li class="nav-item"><a class="nav-link text-white" href="login.php"><i class="fa-solid fa-user"></i> ACCESO</a></li>
              <?php endif; ?>
          </ul>
      </div>
  </div>
</nav>
  </header>

<img src="./imagenes/foto-inicio.jpg" alt="Foto inicio" class="hero-image">

<div class="hero d-flex align-items-center justify-content-center">
  
  <!-- PRESENTACIÓN -->
  <section class="mt-3 py-4 px-4">
    <h5 class="section-title" style="text-align: center;font-size:50px; color: #7fa095 "><b>Descubre Kairós: Tu Espacio de Bienestar Integral</b></h5></br>
    <p>
      En Kairós, creemos que el bienestar es un equilibrio entre cuerpo y mente.
      Nuestra plataforma está diseñada para acompañarte en cada paso de tu camino hacia una vida más saludable y plena.
    </p>
    <p>
      Aquí encontrarás recursos especializados en nutrición, actividad física y salud emocional, adaptados a tus necesidades.
      Ya sea que busques consejos prácticos, seguimiento personalizado o un espacio de aprendizaje, en Kairós tienes todo lo que necesitas para mejorar tu calidad de vida.
    </p>
  </section>
  </div>

<!-- SECCIÓN YOGA -->
<h6 class="section-title mt-5 mb-2" style="text-align: center ;background-color: #7fa095; color: white; padding: 10px;" >EL YOGA ES PARA TODO EL MUNDO Y ESTAMOS CONVENCIDOS QUE TAMBIÉN ES PARA TI</h6>
<div class="hero d-flex align-items-center justify-content-center">
  
  <section class="mt-3 py-4 px-4">
    <div class="row align-items-center">
    <div class="col-md-6">
      <img src="./imagenes/yoga-inicio.jpg" class="img-fluid rounded" alt="Yoga">
    </div>
    <div class="col-md-6">
      <p>
        El yoga es mucho más que una actividad física: es una disciplina que conecta cuerpo y mente,
        ayudándote a mejorar la flexibilidad, reducir el estrés y fortalecer tu bienestar general.
        En Kairós, creemos que cualquier persona puede beneficiarse del yoga, sin importar la edad o el nivel de experiencia.
      </p>
      <p>
        Aquí encontrarás sesiones guiadas, consejos para mejorar tu práctica y artículos sobre sus beneficios.
        Desde posturas básicas hasta técnicas de respiración y relajación, queremos ayudarte a hacer del yoga una parte de tu rutina para lograr un equilibrio físico y emocional.
      </p>
      
    </div>
  </div>
</section>
</div>
<!-- SECCIÓN INTELIGENCIA EMOCIONAL -->
<h6 class="section-title mt-5 mb-2" style="text-align: center;background-color: #DECDBE; color: white; padding: 10px;">TODOS PODEMOS APRENDER A GESTIONAR NUESTRAS EMOCIONES, Y ESTAMOS SEGUROS DE QUE TÚ TAMBIÉN PUEDES HACERLO</h6>
<div class="hero d-flex align-items-center justify-content-center">
  
  <section class="mt-3 py-4 px-4">
    <div class="row align-items-center">
    
    <div class="col-md-6">
      <p>
        Las emociones influyen en cada aspecto de nuestra vida, desde nuestras relaciones hasta nuestra 
productividad y bienestar general. Desarrollar inteligencia emocional significa aprender a reconocer, 
comprender y gestionar nuestras emociones de manera efectiva.
      </p>
      <p>
        En Kairós, te brindamos herramientas prácticas, incluyendo libros y podcasts recomendados que te
ayudarán a mejorar tu bienestar emocional, manejar el estrés y fortalecer tu autoestima.
      </p>
      <p>
        Creemos que cuidar la mente es tan importante como cuidar el cuerpo, y queremos acompañarte 
en este camino de crecimiento personal.
      </p>
      
    </div>
    <div class="col-md-6">
      <img src="./imagenes/emociones-inicio.jpg" class="img-fluid rounded" alt="Emociones">
    </div>
  </div>
</section>
</div>
<!--SECCION NUTRICION -->
<h6 class="section-title mt-5 mb-2" style="text-align: center;background-color: #E38f18; color: white; padding: 10px;">NUTRIR TU CUERPO ES CUIDAR DE TI MISMO, Y ESTAMOS AQUÍ PARA ACOMPAÑARTE EN  ESE CAMINO</h6>
<div class="hero d-flex align-items-center justify-content-center">
  
  <section class="mt-3 mb-5 py-4 px-4">
    <div class="row align-items-center">
    <div class="col-md-6">
      <img src="./imagenes/nutricion-inicio.jpeg" class="img-fluid rounded" alt="Yoga">
    </div>
    <div class="col-md-6">
      <p>
        Lo que comemos influye directamente en cómo nos sentimos, tanto física como mentalmente. 
Una alimentación equilibrada no se trata solo de contar calorías, sino de aprender a nutrir el cuerpo 
con alimentos adecuados para cada necesidad.
      </p>
      <p>
        En Kairós, te ofrecemos información basada en la ciencia para que puedas tomar decisiones 
saludables sin caer en dietas restrictivas. Encontrarás recetas nutritivas y consejos para adaptar la 
alimentación a tu estilo de vida. 
      </p>
      <p>
        Nuestro objetivo es ayudarte a desarrollar hábitos sostenibles que te permitan sentirte bien y disfrutar 
de la comida sin culpa.
      </p>
      
    </div>
  </div>
</section>
</div>
<!-- PLANES DE SUSCRIPCION -->
<section class="py-5" style="background-color: #DECDBE;">
  <div class="container">
    <h2 class="text-center mb-4">Suscríbete a uno de nuestros planes y empieza a disfrutar</h2>
    <div class="row g-4">

      <!-- Plan Nutrición -->
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body text-center">
            <h5 class="card-title">Plan Nutrición</h5>
            <p class="card-text">Accede a contenido exclusivo sobre alimentación saludable, recetas personalizadas y consejos nutricionales.</p>
            <h6 class="my-3">9,99€/mes</h6>
            <a href="suscripcion.php" id="btn-index" class="btn btn-outline-primary">Suscribirse</a>
          </div>
        </div>
      </div>

      <!-- Plan Clases Online -->
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body text-center">
            <h5 class="card-title">Plan Clases Online</h5>
            <p class="card-text">Accede a todas nuestras sesiones guiadas de yoga, meditación y ejercicios para cuerpo y mente.</p>
            <h6 class="my-3">11,99€/mes</h6>
            <a href="suscripcion.php" id="btn-index" class="btn btn-outline-primary">Suscribirse</a>
          </div>
        </div>
      </div>

      <!-- Plan Completo -->
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 border-primary">
          <div class="card-body text-center">
            <h5 class="card-title">Plan Completo</h5>
            <p class="card-text">Todo el contenido de nutrición y clases online en un solo plan. ¡Tu bienestar integral empieza aquí!</p>
            <h6 class="my-3">17,99€/mes</h6>
            <a href="suscripcion.php" id="btn-index" class="btn btn-outline-primary">Suscribirse</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- FOOTER -->
<footer class="Piepag">
  <div class="container">
      <div class="row">
          <!-- Sección de enlaces legales  -->
          <div class="col-12 text-center">
              <ul class="list-inline">
                  <li class="list-inline-item"><a href="#" class="text-white text-decoration-none">POLÍTICA COOKIES</a></li>
                  <li class="list-inline-item"><a href="#" class="text-white text-decoration-none">TÉRMINOS Y CONDICIONES DE USO</a></li>
                  <li class="list-inline-item"><a href="#" class="text-white text-decoration-none">POLÍTICA DE PRIVACIDAD</a></li>
              </ul>
          </div>

          <!-- Sección de redes sociales  -->
          <div class="col-12 d-flex justify-content-start">
              <div class="d-flex gap-3">
                  <img src="imagenes/facebook.png" alt="Facebook" width="30">
                  <img src="imagenes/instagram.png" alt="Instagram" width="30">
                  <img src="imagenes/youtube.png" alt="YouTube" width="30">
              </div>
          </div>
      </div>

      <!-- Derechos de autor  -->
      <div class="text-center">
          <small>@2025 Kairós - Todos los derechos reservados</small>
      </div>
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (isset($_GET['logout']) && $_GET['logout'] == 1): ?>
<script>
  
  Swal.fire({
    icon: 'success',
    title: 'Sesión cerrada',
    text: 'Has cerrado sesión correctamente',
    confirmButtonText: 'Aceptar',
    confirmButtonColor: '#7FA095'
  });
</script>
<?php endif; ?>
</body>
</html>