-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-07-2023 a las 01:58:33
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sprinf`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `navegador` varchar(105) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_cierre` time DEFAULT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(80) NOT NULL,
  `token` varchar(85) NOT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`id`, `fecha`, `navegador`, `hora_inicio`, `hora_cierre`, `nombre`, `apellido`, `token`, `idusuario`) VALUES
(24, '2023-07-08', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/', '14:33:33', NULL, 'Root', 'Root', '13b4e8c82cf3eba6db2396ed9834ed9c52d00d3daf09f26bc75db5a74bbd8313', 1),
(25, '2023-07-08', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/', '14:52:16', NULL, 'Root', 'Root', '95f1493cecaa9722e7129fc7a0747898f0af2a025450ea4323000dab2fa7cff4', 1),
(26, '2023-07-08', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/', '14:53:32', NULL, 'Root', 'Root', '27b12769acc291a7c7b0079565989c9cf134c1a29aef68578b5b3dd40aee7908', 1),
(27, '2023-07-08', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/', '14:54:22', NULL, 'Root', 'Root', 'be4ffe864074b21bc31c60aaefaa295fc4da210f83ceab8a4775f927d36b64f5', 1),
(28, '2023-07-08', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/', '14:58:40', NULL, 'Root', 'Root', 'c43951ade88b9d2c9e5b1a229d7a483bc7fca992605ac3e2f73a2ef123cb3b4c', 1),
(29, '2023-07-08', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/', '15:02:01', NULL, 'Root', 'Root', '969ddfef4e01e85db8f285e54a887a7afbcd8df1af528d0ed4d3e63c19b78355', 1),
(30, '2023-07-11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/', '08:06:27', NULL, 'Root', 'Root', 'd23f46594866302acab48611b6a91bffff65587fabfb135609f132a96550f2cf', 1),
(31, '2023-07-11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/', '08:07:16', NULL, 'Root', 'Root', '9f35e05010cadbf291f97b1ed976df219078d6df1fbf912d9b2d0cbdaea07076', 1),
(32, '2023-07-11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/', '08:07:56', NULL, 'Root', 'Root', 'b8a231266876ba39ba073ba74e18673f7baed2cc07f31246023688f78ec96de6', 1),
(33, '2023-07-11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/', '08:08:26', NULL, 'Root', 'Root', '77fd2f736f0a689d3e533d8a283265f6b1d99202cb3c49b36060e9b5328a497f', 1),
(34, '2023-07-11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/', '08:10:27', NULL, 'Root', 'Root', 'bbcdd3dee42071e747164cd4fe29f8ec4931e93af23e6d6fe49bbd4646b8b39f', 1),
(35, '2023-07-11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/', '08:11:44', NULL, 'Root', 'Root', 'ecddc2a4968e23fcafa876d1c55f3b24eef2788a1f7bf9baba93cd930addf2da', 1),
(36, '2023-07-11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/', '08:18:32', NULL, 'Root', 'Root', '6a434e7cb278b18dcf393aa3e3df3d7f7fd1e402be69f0eb24ed78ba9fdb3ec3', 1),
(37, '2023-07-13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/', '18:15:22', '18:25:49', 'Root', 'Root', '05d11074211ff0758ac21d19549c985ae37027e2140503aff5ee90af1c307859', 1),
(38, '2023-07-13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/', '18:26:43', '18:26:45', 'Root', 'Root', 'd646760468f81eb8976014cf99559ceea9bd200e329a54f53a51049db67f85f2', 1),
(39, '2023-07-13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/', '18:26:47', '18:26:49', 'Root', 'Root', '0ec6e7a41d61e97f259bbe99406a3778ab7c7da3b91e1efeabc4aa3c46dde04a', 1),
(40, '2023-07-13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/', '18:26:51', '18:34:58', 'Root', 'Root', '051e736ca24d8875c28da4217aa5dd6d08d1d44fcad7d296381ff60b2f187bf8', 1),
(41, '2023-07-13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/', '18:47:26', '20:26:58', 'Root', 'Root', '298e3eeba2248e5676e50cd24056358e29b46ffc0d44a8669edd4e67a7e30b61', 1),
(42, '2023-07-13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/', '20:39:33', NULL, 'Root', 'Root', '214f2cbabc8b38e093fb0e5ce7ed55391814cd31007156f395ffe96f76714407', 1),
(43, '2023-07-13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/', '07:37:35', NULL, 'Root', 'Root', '9dd8b5e1a164d7e0ac7301ca19970fc59df92fdfcd48fe6dbf050a6bb37a1ec3', 1),
(44, '2023-07-14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/', '19:01:12', '19:23:51', 'Root', 'Root', 'affbdeecf9d78a672a36c4c3d863ede8d8da09d2dec5790e541d5a9e4f8f8edb', 1),
(45, '2023-07-15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/', '09:33:11', '10:01:23', 'Root', 'Root', '44d395d3e573b6aec1f149912f8fef5a566625018037dcc5e7d703ca22a8b00a', 1),
(46, '2023-07-15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/', '13:04:52', NULL, 'Root', 'Root', '7312ff499b749b37d0fd3c22b4d6d7873891a8b251c4ddb9e2589a5c601f7336', 1),
(47, '2023-07-19', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/', '18:35:33', '19:51:53', 'Root', 'Root', '902d1a2a07edf03558bb1870be9189385ba9845768c72741333bceb96467afaa', 1),
(48, '2023-07-19', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/', '19:54:23', NULL, 'Root', 'Root', '4fa29b2278e45f5ac159480ceb0db68c79e4318439ceccaa7481927b8b9f8bb0', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `idmodulo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idpermisos` int(11) NOT NULL,
  `consultar` int(11) NOT NULL,
  `actualizar` int(1) NOT NULL,
  `crear` int(1) NOT NULL,
  `eliminar` int(1) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idmodulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Gestion de permisos de interaciones entre usuario  modullo';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `nacimiento` date NOT NULL,
  `estatus` int(45) NOT NULL,
  `usuarios_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `cedula`, `nombre`, `apellido`, `direccion`, `telefono`, `nacimiento`, `estatus`, `usuarios_id`) VALUES
(1, 'V-12345678', 'Root', 'Root', 'La web', '0404-1234567', '1996-10-14', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id` int(11) NOT NULL,
  `pregunta` varchar(75) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `usuarios_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `id` int(11) NOT NULL,
  `respuesta` varchar(45) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `pregunta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'root'),
(2, 'profesor'),
(3, 'coordinador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(80) NOT NULL,
  `contrasena` varchar(105) NOT NULL,
  `token` varchar(100) NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `contrasena`, `token`, `rol_id`) VALUES
(1, 'root@gmail.com', '5ebe2294ecd0e0f08eab7690d2a6ee69', '4fa29b2278e45f5ac159480ceb0db68c79e4318439ceccaa7481927b8b9f8bb0', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bitacora_usuario1_idx` (`idusuario`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`idmodulo`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idpermisos`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idmodulo` (`idmodulo`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cedula_UNIQUE` (`cedula`),
  ADD KEY `fk_persona_usuario1_idx` (`usuarios_id`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarios_id` (`usuarios_id`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pregunta_id` (`pregunta_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idpermisos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `fk_bitacora_usuario1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`idmodulo`) REFERENCES `modulo` (`idmodulo`),
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `fk_persona_usuario1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `usuarios_id` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `pregunta_id` FOREIGN KEY (`pregunta_id`) REFERENCES `pregunta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
