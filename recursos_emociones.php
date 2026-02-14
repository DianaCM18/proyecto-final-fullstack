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
<title>Kairós: Recursos</title>
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

  <body>
          <section class="cuerpo2">
        <div>
          <p>RECURSOS PARA ENTENDER Y GESTIONAR LAS EMOCIONES</p>
          <h3>
            En esta sección, te presentamos una selección de libros y podcasts
            que te ayudarán a comprender mejor tus emociones y a manejarlas de
            manera efectiva.Cada uno ofrece enfoques prácticos para el
            desarrollo de tu inteligencia emocional
          </h3>

          <?php
// Conexión a la base de datos
include 'utils/conn.php';
$conn = mysqli_connect($servidor, $usuario, $password, $dbname);
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Consulta a la base de datos
$sql = "SELECT * FROM recursos";
$resultado = mysqli_query($conn, $sql);
$items = [];
while ($row = mysqli_fetch_assoc($resultado)) {
    $items[] = $row;
}
$total = count($items);
?>

<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <?php
    for ($i = 0; $i < $total; $i += 3) {
        $clase = $i === 0 ? 'carousel-item active' : 'carousel-item';
        echo "<div class='$clase'><div class='d-flex justify-content-center gap-3 mb-4'>";
        for ($j = $i; $j < $i + 3 && $j < $total; $j++) {
            $item = $items[$j];
            echo "
            <div class='card' style='width: 18rem'>
                <img src='imagenes/{$item['imagen_recurso']}' class='card-img-top mx-auto d-block mt-2 object-fit-cover' alt='{$item['nombre_recurso']}' style='width: 15rem; height: 21rem; object-fit: cover; border-radius: 8px;'>
            <div class='card-body'>
                <h5 class='card-title'>{$item['nombre_recurso']}</h5>
                <h6 class='card-text'>Autor: {$item['autor_recurso']}</h6>
                <h6 class='card-text'>Descripción: {$item['descripcion_recurso']}</h6>
    
            </div>
            </div>";
        }
             echo "</div></div>";
    }
    ?>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
</div>

<?php mysqli_close($conn); ?>

            
        </div>
        <?php
        // Conexión a la base de datos
        include 'utils/conn.php';
        $conn = mysqli_connect($servidor, $usuario, $password, $dbname);
        if (!$conn) {
            die("Error de conexión: " . mysqli_connect_error());
        }

        // Guardar comentario
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['comentario'])) {
            $comentario = mysqli_real_escape_string($conn, $_POST['comentario']);
            $sql = "INSERT INTO opiniones (opinion) VALUES ('$comentario')";
            mysqli_query($conn, $sql);
        }
        ?>

        <!-- Formulario de comentarios -->
        <form method="POST" class="container mt-5">
            <div class="mb-3">
                <textarea name="comentario" class="form-control my-3" rows="3" placeholder="Escribe tu comentario..." required></textarea>
                <button type="submit" class="btn btn-primary mb-4">Enviar comentario</button>
            </div>
        </form>

        <!-- se crea una lista de comentarios -->
        <div class="container mb-5">
        <h4 class="mb-4">Comentarios de los usuarios</h4>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM opiniones ORDER BY fecha DESC");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "
                <div class='card mb-3'>
                    <div class='card-body'>
                        <strong>Comentario:</strong><br>" . nl2br(htmlspecialchars($row['opinion'])) . "
                    </div>
                </div>";
            }
        } else {
            echo "<p class='text-muted'>No hay comentarios aún.</p>";
        }

        mysqli_close($conn);
        ?>
      </div>


      </section>
    </div>
    <footer class="Piepag">
      <div class="container">
          <div class="row">
              <div class="col-12 text-center">
                  <ul class="list-inline">
                      <li class="list-inline-item"><a href="#" class="text-white text-decoration-none">POLÍTICA COOKIES</a></li>
                      <li class="list-inline-item"><a href="#" class="text-white text-decoration-none">TÉRMINOS Y CONDICIONES DE USO</a></li>
                      <li class="list-inline-item"><a href="#" class="text-white text-decoration-none">POLÍTICA DE PRIVACIDAD</a></li>
                  </ul>
              </div>
    

              <div class="col-12 d-flex justify-content-start">
                  <div class="d-flex gap-3">
                      <img src="imagenes/facebook.png" alt="Facebook" width="30">
                      <img src="imagenes/instagram.png" alt="Instagram" width="30">
                      <img src="imagenes/youtube.png" alt="YouTube" width="30">
                  </div>
              </div>
          </div>
    

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
          function enviarComentario() {
              const texto = document.getElementById('comentarioTexto').value.trim();

              if (!texto) {
               alert("Por favor, escribe un comentario.");
              return;
             }

             // Se obtienen los comentarios previos desde el localStorage o iniciar un array vacío
              const comentarios = JSON.parse(localStorage.getItem('comentarios')) || [];

            // Crear un nuevo comentario
              const nuevoComentario = {
              usuario: 'Anónimo', 
              contenido: texto,
              fecha: new Date().toLocaleString(),
             };

             // Se agrega el nuevo comentario al array
               comentarios.push(nuevoComentario);

             // Se guardan los comentarios actualizados en el localStorage y se muestran
               localStorage.setItem('comentarios', JSON.stringify(comentarios));
               mostrarComentarios(comentarios);

             // Limpiar el campo de texto
               document.getElementById('comentarioTexto').value = '';
              }
          
          function mostrarComentarios(comentarios) {
              const contenedor = document.getElementById('comentarios');
              contenedor.innerHTML = comentarios.map((c, index) =>
                `<div class="border p-2 mb-2">
                  <strong>${c.usuario}</strong> <small class="text-muted">${c.fecha}</small><br>
                   ${c.contenido} 
                 <button class="btn btn-danger btn-sm" onclick="eliminarComentario(${index})">Eliminar</button>
                 </div>`
             ).join('');
            }

            // Función para eliminar un comentario
                  function eliminarComentario(index) {
            const comentarios = JSON.parse(localStorage.getItem('comentarios')) || [];
            comentarios.splice(index, 1);
            localStorage.setItem('comentarios', JSON.stringify(comentarios));
            mostrarComentarios(comentarios);
             }

            // Cargar los comentarios desde el localStorage cuando se carga la página
            window.onload = () => {
            const comentarios = JSON.parse(localStorage.getItem('comentarios')) || [];
            mostrarComentarios(comentarios);

             };
          </script>

      <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="toastComentario" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="d-flex">
            <div class="toast-body">
              ¡Comentario enviado correctamente!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
          </div>
        </div>
      </div>
  </body>
</html>
