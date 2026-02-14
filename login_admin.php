<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="shortcut icon"
      href="./imagenes/LOGO SIN FONDO.png"
      type="image/x-icon"
    />
    <title>Administrador</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;400;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="styles.css" />
    <style>
      .container-flex {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        gap: 50px;
      }

      .logo {
        max-width: 300px;
        margin-left: 15%;
      }

      .form-container {
        max-width: 400px;
        width: 100%;
      }
    </style>
  </head>
  <body>
    <div class="container-flex">
      <img src="imagenes/LOGO SIN FONDO.png" alt="Logo" class="logo" />

      <div class="form-container">
         <?php
         
  if (isset($_GET['error'])) {
    if ($_GET['error'] == 'campos') {
      echo '<div class="alert alert-danger">Por favor, completa todos los campos.</div>';
    } elseif ($_GET['error'] == 'login') {
      echo '<div class="alert alert-danger">Usuario o contraseña incorrectos.</div>';
    }
  }

  ?>
        <form action="utils/procesar_login_admin.php" method="POST">
          <div class="mb-3">
            <label for="correo" class="form-label">Correo electrónico</label>
            <input
              type="email"
              class="form-control"
              id="correo"
              name="admin"
              required
            />
          </div>

          <div class="mb-3">
            <label for="password2" class="form-label">Contraseña</label>
            <input
              type="password"
              class="form-control"
              id="password2"
              name="password"
            />
          </div>

          <button type="submit" class="btn btn-primary">Acceder</button>
        </form>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] === 'logout'): ?>
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Sesión cerrada',
      text: 'Sesión cerrada correctamente',
      confirmButtonText: 'Aceptar',
      confirmButtonColor: '#7fa095'
    });
  </script>
<?php endif; ?>
  </body>
</html>
