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
    <link
      rel="shortcut icon"
      href="./imagenes/LOGO SIN FONDO.png"
      type="image/x-icon"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;400;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <link rel="stylesheet" href="styles.css" />
    <title>Kairós : Suscripción</title>
  </head>
  <body>
    <header>
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
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
    <form action="utils/procesar_suscripcion.php" method="POST">
      <div class="form-container mt-5">
        <div class="mb-3">
          <label for="name" class="form-label">Usuario</label>
          <input type="text" class="form-control" id="name" name="nombre" />
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Dirección de correo</label>
          <input
            type="email"
            class="form-control"
            id="email"
            name="correo"
            aria-describedby="emailHelp"
          />
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Contraseña</label>
          <input
            type="password"
            class="form-control"
            id="password1"
            name="password"
          />
        </div>
      </div>

      <!-- PLANES DE SUSCRIPCION -->
      <section class="py-5" style="background-color: #f5f5f5">
        <div class="container">
          <h2 class="text-center mb-4">
            Suscríbete a uno de nuestros planes y empieza a disfrutar
          </h2>
          <div class="row g-4">
            <!-- Plan Nutrición -->
            <div class="col-md-4">
              <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center">
                  <h5 class="card-title">Plan Nutrición</h5>
                  <p class="card-text">
                    Accede a contenido exclusivo sobre alimentación saludable,
                    recetas personalizadas y consejos nutricionales.
                  </p>
                  <h6 class="my-3">9,99€/mes</h6>
                  <div class="form-check d-flex justify-content-center mt-2">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="plan"
                      value="nutricion"
                      required
                    />
                    <label class="form-check-label ms-2">Seleccionar</label>
                  </div>
                </div>
              </div>
            </div>

            <!-- Plan Clases Online -->
            <div class="col-md-4">
              <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center">
                  <h5 class="card-title">Plan Clases Online</h5>
                  <p class="card-text">
                    Accede a todas nuestras sesiones guiadas de yoga, meditación
                    y ejercicios para cuerpo y mente.
                  </p>
                  <h6 class="my-3">11,99€/mes</h6>
                  <div class="form-check d-flex justify-content-center mt-2">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="plan"
                      value="clases"
                      required
                    />
                    <label class="form-check-label ms-2">Seleccionar</label>
                  </div>
                </div>
              </div>
            </div>

            <!-- Plan Completo -->
            <div class="col-md-4">
              <div class="card h-100 shadow-sm border-0 border-primary">
                <div class="card-body text-center">
                  <h5 class="card-title">Plan Completo</h5>
                  <p class="card-text">
                    Todo el contenido de nutrición y clases online en un solo
                    plan. ¡Tu bienestar integral empieza aquí!
                  </p>
                  <h6 class="my-3">17,99€/mes</h6>
                  <div class="form-check d-flex justify-content-center mt-2">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="plan"
                      value="completo"
                      required
                    />
                    <label class="form-check-label ms-2">Seleccionar</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- PASARELA DE PAGO FICTICIA -->
          <section class="py-3">
            <div class="container">
              <h3 class="text-center mb-4">Método de pago</h3>

              <div class="row">
                <div class="col-md-6 offset-md-3">
                  <div class="mb-3">
                    <label for="card_number" class="form-label"
                      >Número de tarjeta</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      id="card_number"
                      name="card_number"
                      placeholder="XXXX XXXX XXXX XXXX"
                      required
                    />
                  </div>

                  <div class="mb-3">
                    <label for="expiry_date" class="form-label"
                      >Fecha de vencimiento</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      id="expiry_date"
                      name="expiry_date"
                      placeholder="MM/AA"
                      required
                    />
                  </div>

                  <div class="mb-3">
                    <label for="cvv" class="form-label">CVV</label>
                    <input
                      type="text"
                      class="form-control"
                      id="cvv"
                      name="cvv"
                      placeholder="XXX"
                      required
                    />
                  </div>
                </div>
              </div>
            </div>
          </section>
          <div class="text-center">
            <button
              type="submit"
              id="btn-index"
              class="btn btn-primary px-4 py-2"
            >
              Suscríbete ahora
            </button>
            
          </div>
        </div>
      </section>
    </form>
    <!-- FOOTER -->
    <footer class="Piepag">
      <div class="container">
        <div class="row">
          <!-- Sección de enlaces legales  -->
          <div class="col-12 text-center">
            <ul class="list-inline">
              <li class="list-inline-item">
                <a href="#" class="text-white text-decoration-none"
                  >POLÍTICA COOKIES</a>
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

          <!-- Sección de redes sociales alineadas  -->
          <div class="col-12 d-flex justify-content-start">
            <div class="d-flex gap-3">
              <img src="imagenes/facebook.png" alt="Facebook" width="30" />
              <img src="imagenes/instagram.png" alt="Instagram" width="30" />
              <img src="imagenes/youtube.png" alt="YouTube" width="30" />
            </div>
          </div>
        </div>

        <!-- Derechos de autor-->
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
