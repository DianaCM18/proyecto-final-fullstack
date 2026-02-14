<?php
session_start();

// Comprobamos si el administrador ha iniciado sesión
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./imagenes/LOGO SIN FONDO.png" type="image/x-icon">
    <title>Listado Usuarios Kairós</title>
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
              <li class="nav-item">
  <span class="nav-link text-white">Sesión iniciada: <?php echo htmlspecialchars($_SESSION['admin']); ?></span>
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
</ul>                    
          </div>
      </div>
    </nav>
      </header>
      <!-- Formulario de busqueda -->
<form method="GET" class="container mt-3 mb-2">
  <div class="input-group">
    <input type="text" name="buscar_id" class="form-control" placeholder="Buscar por ID de usuario" value="<?php echo isset($_GET['buscar_id']) ? htmlspecialchars($_GET['buscar_id']) : ''; ?>">
    <button type="submit" class="btn btn-primary rounded-end">Buscar</button>
    <?php if (isset($_GET['buscar_id']) && $_GET['buscar_id'] !== ''): ?>
      <a href="admin-listar-usuario.php" class="btn btn-primary rounded-start ms-2">Ver todos</a>
    <?php endif; ?>
  </div>
</form>
<?php if (isset($_GET['mensaje'])): ?>
    <div id="mensaje" class="alert alert-success"><?php echo htmlspecialchars($_GET['mensaje']); ?></div>
<?php endif; ?>
     <div class="container d-flex justify-content-between align-items-center mt-4 mb-2">
  <div class="titulo-listar">Listado de usuarios</div>
  <a href="admin-add-usuario.html" class="btn btn-primary">Crear Usuario</a>
</div>

  <div class="container-eventos">
      <table class="table mt-2">
          <thead>
            <tr>
              
              <th >NOMBRE</th>
              <th >CORREO</th>
              <th >PASSWORD</th>
              <th >PLAN</th>
              <th >ROLL</th>
              <th>ACCIONES</th>
              
            </tr>
          </thead>
          <tbody>
            <?php
                // Conectar a la base de datos
                $conn = mysqli_connect('localhost', 'root', '', 'kairos'); 
                if (!$conn) {
                    die("Conexión fallida: " . mysqli_connect_error());
                }
                
                // Lógica de búsqueda
            $buscar_id = isset($_GET['buscar_id']) ? trim($_GET['buscar_id']) : '';

            if ($buscar_id !== '') {
            $sql = "SELECT id_usuario, nombre, correo, password,plan,roll FROM usuarios WHERE id_usuario = " . intval($buscar_id);
            } else {
            $sql = "SELECT id_usuario, nombre, correo, password,plan,roll FROM usuarios";
            }
            $result = mysqli_query($conn, $sql);
                

                // Comprobar si hay resultados
                if (mysqli_num_rows($result) > 0) {
                    
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                                
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['correo'] . "</td>";
                        echo "<td>" . $row['password'] . "</td>";
                        echo "<td>" . $row['plan'] . "</td>";
                        echo "<td>" . $row['roll'] . "</td>";
                        echo "<td>"; 
                        echo "<div class='d-flex gap-2'>";
                        echo "<a href='admin-editar-usuario.php?id_usuario=" . $row["id_usuario"] . "' class='btn btn-primary'>Editar</a>"; 
                        echo "<a href='javascript:void(0);' class='btn btn-primary'  onclick='eliminarUsuario(" . $row['id_usuario'] . ")'>Eliminar</a>";  
                        echo "</div>"; 
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No hay usuarios registrados.</td></tr>";
                }

                // Cerrar la conexión
                mysqli_close($conn);
            ?>
          </tbody>
      </table>
  </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function eliminarUsuario(id_usuario) {
    Swal.fire({
      title: '¿Estás seguro?',
      text: "No podrás revertir esta acción",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar',
      confirmButtonColor: '#E38f18', 
      cancelButtonColor: '#7fa095',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = 'admin-delete-usuario.php?id_usuario=' + id_usuario;
      }
    });
  }
  document.getElementById('cerrarSesion').addEventListener('click', function(e) {
    e.preventDefault();
    Swal.fire({
      title: '¿Quieres cerrar sesión?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sí, cerrar sesión',
      cancelButtonText: 'Cancelar',
      confirmButtonColor: '#E38f18', 
      cancelButtonColor: '#7fa095',
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = './utils/admin-logout.php?cerrada=1';
      }
    });
  });
  // Si el mensaje está presente, hacer que desaparezca después de 2 segundos
    if (document.getElementById('mensaje')) {
      setTimeout(function() {
        document.getElementById('mensaje').style.display = 'none';
      }, 2000); 
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
