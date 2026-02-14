<?php
session_start();
$plan = $_SESSION['plan'] ?? null;
$nombre = $_SESSION['nombre'] ?? null;
include 'conexion.php';

// Verificar si `id_receta` está en la URL
$id_receta = $_GET['id_receta'] ?? null;

if ($id_receta) {
    // Consulta para obtener los detalles de la receta
    $query = "SELECT nombre_receta, imagen_receta, ingredientes FROM nutricion WHERE id_receta = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id_receta);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $receta = $resultado->fetch_assoc();
    $stmt->close();

    // Consulta para obtener los pasos de la receta
    $query_pasos = "SELECT paso_numero, descripcion_paso FROM pasos_receta WHERE id_receta = ? ORDER BY paso_numero ASC";
    $stmt_pasos = $conexion->prepare($query_pasos);
    $stmt_pasos->bind_param("i", $id_receta);
    $stmt_pasos->execute();
    $resultado_pasos = $stmt_pasos->get_result();
    $pasos_receta = $resultado_pasos->fetch_all(MYSQLI_ASSOC);
    $stmt_pasos->close();
} else {
    echo "<div class='container'><h2 class='text-danger text-center'>ID de receta no proporcionado.</h2></div>";
    exit();
}

$conexion->close();
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
  <title>Kairós: Recetas</title>
</head>
<body>
<header>
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
    <div id="Logos">
      <a href="index.html"><img src="imagenes/LOGO SIN FONDO.png" /></a>
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
                  <a href="#" class="nav-link text-white" >Cerrar sesión</a>
              <?php else: ?>
                  <li class="nav-item"><a class="nav-link text-white" href="login.php"><i class="fa-solid fa-user"></i> ACCESO</a></li>
              <?php endif; ?>
          </ul>
      </div>
  </div>
</nav>
  </header>
  <div class="container mt-3 mb-4">
    <?php if ($receta): ?>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card shadow-lg">
                    <div class="card-header text-center bg-light">
                        <h1 class="display-5 mb-0"><?= htmlspecialchars($receta['nombre_receta']); ?></h1>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="imagenes/<?= htmlspecialchars($receta['imagen_receta']); ?>" class="img-fluid rounded" style="max-height: 400px; object-fit: cover;">
                        </div>
                        <h4 class="mb-3">Ingredientes:</h4>
                        <ul class="list-group list-group-flush mb-4">
                            <?php foreach (explode(",", $receta['ingredientes']) as $ingrediente): ?>
                                <li class="list-group-item"><?= htmlspecialchars(trim($ingrediente)); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <h4 class="mb-3">Instrucciones:</h4>
                        <ol class="list-group list-group-numbered mb-4">
                            <?php foreach ($pasos_receta as $paso): ?>
                                <li class="list-group-item"><?= htmlspecialchars($paso['descripcion_paso']); ?></li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="dashboard-nutricion.php" class="btn btn-secondary">Volver a la lista de recetas</a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <h2 class="text-danger text-center">Receta no encontrada.</h2>
    <?php endif; ?>
</div>

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

          <!-- Sección de redes sociales alineadas  -->
          <div class="col-12 d-flex justify-content-start">
              <div class="d-flex gap-3">
                  <img src="imagenes/facebook.png" alt="Facebook" width="30">
                  <img src="imagenes/instagram.png" alt="Instagram" width="30">
                  <img src="imagenes/youtube.png" alt="YouTube" width="30">
              </div>
          </div>
      </div>

      <!-- Derechos de autor -->
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