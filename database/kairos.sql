-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2025 a las 09:37:23
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS kairos;
CREATE DATABASE kairos;
USE kairos;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `kairos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `correo`, `password`) VALUES
(1, 'claudia@gmail.com', '$2y$10$WKpwN1tliLsnz.yoWGLm7e.HqMlca0nZjMRARfPzs8i1Qt2QIwGOm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases_online`
--

CREATE TABLE `clases_online` (
  `id_video` int(11) NOT NULL,
  `nombre_video` varchar(50) NOT NULL,
  `descripcion_video` text NOT NULL,
  `nivel_video` varchar(20) NOT NULL,
  `video` varchar(255) NOT NULL,
  `miniatura` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clases_online`
--

INSERT INTO `clases_online` (`id_video`, `nombre_video`, `descripcion_video`, `nivel_video`, `video`, `miniatura`) VALUES
(1, 'YOGA KUNDALINI', ' En esta sesión vamos a despertar la poderosa energía Kundalini a través del Surya Kriya (Energía Solar), este Kriya está relacionado con la depuración corporal y a nivel mental nos eleva nuestro potencial para lograr nuestros objetivos y metas con c', 'basico', 'video01.mp4', 'basico_01.jpg'),
(2, 'RUTINA DIARIA', 'A lo largo de esta clase, te guiare paso a paso por las posturas básicas del Yoga, así como por los principios fundamentales de la respiración. Esta es una oportunidad perfecta para aprender y conocer el Yoga de manera segura y cómoda.', 'basico', 'video02.mp4', 'basico_02.jpg'),
(3, 'YOGA AL DESPERTAR', 'Es una práctica perfecta para relajarse, para hacer antes de dormir o antes de meditar, te anima a volver a tu centro, a que sueltes estrés y tensiones del diario, ideal para cuando te sientas exhausto y sobrecargado. La idea es conectar con la energía de la luna, en su estado más pasivo, sereno, tranquilo e íntimo. ', 'basico', 'video03.mp4', 'basico_03.jpg'),
(4, 'GANAR FLEXIBILIDAD ESPALDA', 'La flexibilidad, como seguramente sabes, es una parte clave del mantenimiento de la salud y que, además, nos ayuda a evitar lesiones. El estiramiento que hacemos con la práctica del yoga físico nos ayuda a aumentar la capacidad de mover los músculos y las articulaciones. ', 'avanzado', 'video04.mp4', 'avanzado_03.jpg'),
(5, 'YOGA FLOW', 'Dale un poco de amor a cada área del cuerpo, sincroniza la respiración con el movimiento, relaja tu mente mientras cultivas el calor para desarrollar la fuerza y movilidad de tu cuerpo y alma.  ', 'intermedio', 'video05.mp4', 'intermedio_01.jpg'),
(6, 'VINYASA YOGA', 'VINYASA YOGA para toda ocasión, 20 min que no debes dejar pasar por alto, para que pases tiempo contigo mismo, mejores tu desempeño físico desde la flexibilidad, fuerza, resistencia y equilibrio y actitud. Inhala, exhala, fluye a tu ritmo, ¡pero sobre todo acéptate y disfruta!', 'intermedio', 'video11.mp4', 'intermedio_02.jpg'),
(7, 'YOGA PARA TODO EL CUERPO', 'Una práctica de yoga completa para todo el cuerpo, ideal para mejorar la flexibilidad, fuerza y equilibrio. Perfecta para todos los niveles y para liberar tensiones en cualquier momento del día.', 'intermedio', 'video07.mp4', 'intermedio_03.jpg'),
(8, 'EJERCICIO PARA ABDOMEN', 'Una serie de ejercicios diseñados para tonificar y fortalecer el abdomen. Esta rutina trabaja la zona media, mejora la estabilidad y aumenta la resistencia, ayudando a conseguir un abdomen más firme y definido.', 'avanzado', 'video08.mp4', 'avanzado_01.jpg'),
(9, 'EJERCICIO PARA PIERNAS', 'Yoga para Adelgazar y la primera práctica es para trabajar las piernas y glúteos. Una rutina que durará 37 minutos, acompañada de excelentes asanas y posturas para así hacer más fuertes las piernas.', 'avanzado', 'video09.mp4', 'avanzado_02.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nutricion`
--

CREATE TABLE `nutricion` (
  `id_receta` int(11) NOT NULL,
  `nombre_receta` varchar(20) NOT NULL,
  `descripcion_receta` varchar(250) NOT NULL,
  `imagen_receta` varchar(255) NOT NULL,
  `ingredientes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nutricion`
--

INSERT INTO `nutricion` (`id_receta`, `nombre_receta`, `descripcion_receta`, `imagen_receta`, `ingredientes`) VALUES
(1, 'Dorada al horno', 'Dorada al horno con patatas y salsa de limón, ligera y nutritiva, perfecta para una dieta equilibrada.', 'receta1.jpg', '2 doradas,1 patata grande,2 dientes de ajo,1 chorro de aceite de oliva,1 pizca de sal,1 chorro de vino,1 manojo de perejil'),
(2, 'Guisantes', 'Guisantes salteados con sepia, una combinación baja en calorías y rica en proteínas, ideal para una comida saludable y ligera.', 'receta2.jpg', '700 grs guisantes,1 diente de ajo,1 pizca de perejil picado,1 sepia limpia,50 grs cebolla,aceite de oliva,sal'),
(3, 'Arroz provenzal', 'Arroz provenzal con hierbas aromáticas, un plato vegetal lleno de sabor, perfecto para una alimentación equilibrada y natural.', 'receta3.jpg', '340 grs arroz bomba,2 escalonias,250 ml vino blanco seco,500 ml agua,2 dientes de ajo,2 cucharilla tomillo fresco,2 cucharilla albahaca fresca,2 cucharilla perejil fresco,1 cucharilla salvia fresca,½ cucharilla romero fresco,60 grs mantequilla ablandada,3 cucharadas aceite de oliva,sal'),
(4, 'Gazpacho', 'Gazpacho de remolacha y fresas, una opción refrescante y antioxidante, ideal para cuidar la piel y el sistema inmunológico.', 'receta4.jpg', '400 grs de remolacha cocida,200 grs de fresas,100 grs de tomates pera,1 diente de ajo,3 cucharadas de aceite de oliva virgen extra,2 cucharadas de vinagre,sal,pimienta'),
(5, 'Pimientos rellenos', 'Pimientos rellenos de salmón ahumado, una opción sabrosa y rica en omega-3, perfecta para cuidar el corazón y la salud cerebral.', 'receta5.jpg', '300 grs de salmón ahumado,2 pimientos morrones,1 cebolla morada,2 yemas de huevo,2 cucharadas de eneldo fresco picado,Comino molido,Queso rallado,Aceite de oliva virgen extra,sal,pimienta'),
(6, 'Tiramisú', 'Tiramisú de mandarinas y galletas especiadas, un postre ligero con un toque cítrico, ideal para disfrutar sin excesos.', 'receta6.jpg', '12 mandarinas pequeñas,250 grs de mascarpone,250 grs de galletas tipo speculoos,50 grs de azúcar,3 huevos,1 vaina de vainilla,2 cucharadas de licor tipo Amaretto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opiniones`
--

CREATE TABLE `opiniones` (
  `id_opinion` int(11) NOT NULL,
  `opinion` varchar(250) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `opiniones`
--

INSERT INTO `opiniones` (`id_opinion`, `opinion`, `fecha`) VALUES
(20, 'Le regalé a mi hija el libro de \"El perfil emocional de tu cerebro\" y le ha ayudado a controlar el estrés en aquellos momentos en los que no podía', '2025-05-07 20:58:53'),
(44, 'Me compré el libro de \"La bruja emocional\" y me ayudó a gestionar la tristeza con sus herramientas prácticas', '2025-05-11 16:21:57'),
(48, 'Vi el podcast de Paulo Moreira. Aunque en general aporta ideas interesantes sobre inteligencia emocional, algunas de las aplicaciones prácticas que mencionó para la toma de decisiones no me parecieron realistas ni aplicables en mi caso.', '2025-05-15 08:27:01'),
(53, 'que pasada de podcast, nunca había tenido un sueño tan profundo mientras lo escuchaba... era como dormir al lado del mar ', '2025-05-15 16:52:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasos_receta`
--

CREATE TABLE `pasos_receta` (
  `id` int(11) NOT NULL,
  `id_receta` int(11) DEFAULT NULL,
  `paso_numero` int(11) DEFAULT NULL,
  `descripcion_paso` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pasos_receta`
--

INSERT INTO `pasos_receta` (`id`, `id_receta`, `paso_numero`, `descripcion_paso`) VALUES
(1, 1, 1, 'Precalentamos el horno a 200ºC. Pelamos la patata y la cortamos en láminas finas. Ponemos un poco de aceite de oliva sobre la base de una fuente para horno y distribuimos las patatas formando una cama. Ponemos también una pizca de sal.'),
(2, 1, 2, 'Quitamos la piel a la cebolla, la cortamos en juliana y la colocamos sobre la cama de patatas. Vertemos un poco más de aceite y sazonamos ligeramente. Añadimos el vino y tapamos la fuente con un trozo de papel de aluminio. Llevamos la fuente al horno y horneamos durante 25 minutos o hasta que las patatas estén casi listas.'),
(3, 1, 3, 'Mientras tanto, pelamos los dientes de ajo, los prensamos y los ponemos en un cuenco pequeño, añadiendo un poco de sal y el perejil picado. Añadimos un chorro de aceite de oliva, removemos y untamos el interior del pescado con la mezcla.'),
(4, 1, 4, 'Pasados los 25 minutos, sacamos la fuente del horno y quitamos el papel de aluminio. Colocamos las doradas dentro de la fuente, volvemos a poner en el horno y horneamos 25 minutos más.'),
(5, 1, 5, 'Acabado el tiempo de cocción, sacamos la fuente del horno y servimos de inmediato la dorada, cubriendo el pescado con un poco de salsa. El resto se servirá en una salsera en la mesa.'),
(6, 2, 1, 'Cortamos los ajos y la cebolla y freímos en un poco de aceite de oliva. Una vez dorados, agregamos la sepia limpia cortada en trozos. Salteamos durante unos 3 minutos y ponemos un poco de perejil.'),
(7, 2, 2, 'Añadimos los guisantes y los rehogamos con la sepia y los ajos durante otros 3 minutos. Salpimentamos, y listo!'),
(8, 3, 1, 'Pelamos y picamos las escalonias y los ajos. Lavamos las hierbas aromáticas y picamos con un cuchillo afilado.'),
(9, 3, 2, 'Dejamos la mantequilla a temperatura ambiente para que se reblandezca.'),
(10, 3, 3, 'Rehogamos las escalonias con el aceite en una cacerola ancha durante 5 minutos a fuego muy lento. Añadimos el ajo picado y dejamos cocer durante 2 minutos más. Agregamos el arroz y rehogamos durante 2 minutos, sin dejar de remover. Incorporamos el vino blanco y lo llevamos a ebullición.'),
(11, 3, 4, 'Vertemos el agua hirviendo, sazonamos con una pizca de sal y cocemos a fuego medio durante 20 minutos aproximadamente.'),
(12, 3, 5, 'Mientras, mezclamos en un recipiente la mantequilla reblandecida con todas las hierbas aromáticas picadas.'),
(13, 3, 6, 'Cuando el arroz esté en un punto, añadimos la mantequilla con las hierbas. Mezclamos delicadamente y servimos enseguida.'),
(14, 4, 1, 'Limpiar y desinfectar las fresas.'),
(15, 4, 2, 'Triturar todos los ingredientes con sal y pimienta.'),
(16, 4, 3, 'Tamizar y agregar el aceite de oliva.'),
(17, 4, 4, 'Reservar en nevera y servir bien frío.'),
(18, 5, 1, 'Antes de empezar, precalentamos el horno a 180ºC.'),
(19, 5, 2, 'Lavamos y cortamos por la mitad los pimientos y les quitamos las semillas. Luego, rellenamos cada mitad con un poco de salmón ahumado previamente picado. Después, con un pincel de cocina o la mano, untamos la parte lisa del pimiento con aceite de oliva virgen extra. Una vez el horno esté caliente los metemos en el horno sobre una rejilla durante 10-15 minutos vigilando de que no se quemen.'),
(20, 5, 3, 'Mientras tanto, pelamos y picamos la cebolla y las zanahorias. En una sartén echamos un chorrito de aceite de oliva y cocinamos las verduras con un poco de agua. Una vez se evapore el agua incorporamos el resto del salmón. Removemos alternativamente durante 5 minutos más o menos. Salpimentamos y echamos el comino y el eneldo. Apagamos el fuego y echamos las yemas de huevo.'),
(21, 5, 4, 'Sacamos los pimientos del horno y rellenamos con las verduras. Echamos un poco de queso rallado por encima y gratinamos unos minutos.'),
(22, 6, 1, 'Empezamos separando las claras y las de yemas de los huevos. Partimos la vaina de vainilla por la mitad y rascamos las semillas.'),
(23, 6, 2, 'En un bol grande mezclamos las semillas con las yemas de huevo y el azúcar. Batimos bien hasta que la mezcla tome un color más clarito y haya una ligera espuma. Introducimos primero la mitad del mascarpone y seguimos mezclado, y luego la otra parte.'),
(24, 6, 3, 'En otro recipiente batimos las claras de huevo a punto de nieve y las incorporamos a la mezcla de mascarpone. Mezclamos suavemente con una espátula.'),
(25, 6, 4, 'Mientras tanto, exprimimos 6 mandarinas y pelamos y separamos en cuartos las otras 6.'),
(26, 6, 5, 'Mezclamos el zumo de las mandarinas con el licor para remojar las galletas.'),
(27, 6, 6, 'En unos vasitos, colocamos la galleta remojada al fondo, luego unos gajos de mandarina y luego la crema de mascarpone.'),
(28, 6, 7, 'Espolvoreamos un poquito de cacao por encima y reservamos en la nevera 4 horas.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE `recursos` (
  `id_recurso` int(11) NOT NULL,
  `nombre_recurso` varchar(150) DEFAULT NULL,
  `tipo_recurso` varchar(10) NOT NULL,
  `descripcion_recurso` varchar(250) NOT NULL,
  `imagen_recurso` varchar(250) NOT NULL,
  `autor_recurso` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`id_recurso`, `nombre_recurso`, `tipo_recurso`, `descripcion_recurso`, `imagen_recurso`, `autor_recurso`) VALUES
(26, 'Como ganar amigos ', 'libro', 'Cómo tratar a las personas en diferentes situaciones.', 'hhsslibro.jpg', 'Molo Cebrián, Luis Muiño y Mónica González'),
(27, 'El perfil emocional ', 'libro', 'Cómo podemos modificar nuestro cerebro para mejorar nuestra capacidad de afrontar el estrés y alcanzar un mayor bienestar emocional.', 'estreslibro2.jpg', 'Richard Davidson y Sharon Begley'),
(28, 'La bruja emocional', 'libro', 'Cómo funcionan nuestras emociones y ofrece herramientas prácticas para gestionar el miedo, la ansiedad, el enfado y la tristeza.', 'emocioneslibro.jpg', 'Elsa Punset'),
(29, 'Entiende tu mente', 'podcast', 'Consejos prácticos para conectar mejor con los demás.', 'podcasthhss.jpg', 'Molo Cebrián, Luis Muiño y Mónica González'),
(30, 'Medita Podcast', 'podcast', 'Guías prácticas para la meditación y reflexión emocional.', '1747259866_podcastemociones.jpg', 'Mar del Cerro'),
(31, 'Inteligencia Emocional – O Podcast', 'podcast', 'Aplicación práctica sobre toma de decisiones, relaciones interpersonales y comunicación efectiva.', '1747296883_intemocional.jpeg', 'Paulo Moreira');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `plan` varchar(10) NOT NULL,
  `roll` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `correo`, `password`, `plan`, `roll`) VALUES
(31, 'victor', 'victor@gmail.com', '$2y$10$70E1vEZE2uvuI55UoHEnuewoMvsRZYuV/mG4R8Ooorea6tGpvFZ5G', 'nutricion', 'cliente'),
(32, 'Cristina', 'cris@gmail.com', '$2y$10$Yw9HakfM6sYQYPw87/KZEORqJAcuC9YbHBQGz052PWfwRzg8fRhTq', 'clases', 'cliente'),
(33, 'Carla', 'carla@gmail.com', '$2y$10$qSole0PeMjobLDsJMUsq6eHh82U3CliitYMvsDwN4fVAd1v5alFsa', 'completo', 'cliente'),
(34, 'luis', 'luis@gmail.com', '$2y$10$ESkJOrNFTIwSA30IsG4.meUij0E1VkilCnvqFNdu2ZzIKj2T8bOwy', 'nutricion', 'cliente'),
(44, 'Pepe', 'pepe@gmail.com', '$2y$10$lCwOMkEzpk66wDYChIAcKOp1Gx7PmtTyiDaG0T1k.gXiv0H0WhAY.', 'nutricion', 'cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `clases_online`
--
ALTER TABLE `clases_online`
  ADD PRIMARY KEY (`id_video`);

--
-- Indices de la tabla `nutricion`
--
ALTER TABLE `nutricion`
  ADD PRIMARY KEY (`id_receta`);

--
-- Indices de la tabla `opiniones`
--
ALTER TABLE `opiniones`
  ADD PRIMARY KEY (`id_opinion`);

--
-- Indices de la tabla `pasos_receta`
--
ALTER TABLE `pasos_receta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pasos_receta_ibfk_1` (`id_receta`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`id_recurso`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `clases_online`
--
ALTER TABLE `clases_online`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `nutricion`
--
ALTER TABLE `nutricion`
  MODIFY `id_receta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `opiniones`
--
ALTER TABLE `opiniones`
  MODIFY `id_opinion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `pasos_receta`
--
ALTER TABLE `pasos_receta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
  MODIFY `id_recurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pasos_receta`
--
ALTER TABLE `pasos_receta`
  ADD CONSTRAINT `pasos_receta_ibfk_1` FOREIGN KEY (`id_receta`) REFERENCES `nutricion` (`id_receta`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
