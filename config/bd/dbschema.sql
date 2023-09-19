DROP SCHEMA `sprinf_bd`;
CREATE SCHEMA `sprinf_bd`;

CREATE TABLE `sprinf_bd`.`periodo` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `fecha_inicio` date,
  `fecha_cierre` date
);

CREATE TABLE `sprinf_bd`.`trayecto` (
  `codigo` varchar(255) UNIQUE PRIMARY KEY,
  `periodo_id` int,
  `nombre` varchar(255)
);

CREATE TABLE `sprinf_bd`.`fase` (
  `codigo` varchar(255) UNIQUE PRIMARY KEY,
  `trayecto_id` varchar(255),
  `nombre` varchar(255),
  `siguiente_fase` varchar(255)
);

CREATE TABLE `sprinf_bd`.`seccion` (
  `codigo` varchar(255) UNIQUE PRIMARY KEY,
  `trayecto_id` varchar(255),
  `observacion` int
);

CREATE TABLE `sprinf_bd`.`malla_curricular` (
  `codigo` varchar(255) UNIQUE PRIMARY KEY,
  `fase_id` varchar(255),
  `materia_id` varchar(255)
);

CREATE TABLE `sprinf_bd`.`materias` (
  `codigo` varchar(255) UNIQUE PRIMARY KEY,
  `nombre` varchar(255),
  `htasist` int,
  `htind` int,
  `ucredito` int,
  `hrs_acad` int,
  `eje` varchar(255)
);

CREATE TABLE `sprinf_bd`.`profesor` (
  `codigo` varchar(255) UNIQUE PRIMARY KEY,
  `persona_id` int
);

CREATE TABLE `sprinf_bd`.`clase` (
  `codigo` varchar(255) UNIQUE PRIMARY KEY,
  `profesor_id` varchar(255),
  `seccion_id` varchar(255),
  `unidad_curricular_id` varchar(255)
);

CREATE TABLE `sprinf_bd`.`dimension` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `unidad_id` varchar(255),
  `nombre` varchar(255),
  `grupal` bool
);

CREATE TABLE `sprinf_bd`.`indicadores` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `dimension_id` int,
  `nombre` varchar(255),
  `ponderacion` float
);

CREATE TABLE `sprinf_bd`.`estudiante` (
  `id` varchar(255) UNIQUE PRIMARY KEY,
  `persona_id` int
);

CREATE TABLE `sprinf_bd`.`inscripcion` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `clase_id` varchar(255),
  `estudiante_id` varchar(255),
  `calificacion` float
);

CREATE TABLE `sprinf_bd`.`proyecto` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `fase_id` varchar(255),
  `nombre` varchar(255),
  `comunidad` varchar(255),
  `area` varchar(255),
  `motor_productivo` varchar(255),
  `resumen` varchar(255),
  `direccion` varchar(255),
  `municipio` varchar(255),
  `parroquia` varchar(255),
  `cerrado` bool DEFAULT false
);

CREATE TABLE `sprinf_bd`.`proyecto_historico` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `nombre_estudiante` varchar(255),
  `cedula_estudiante` int,
  `nombre_proyecto` varchar(255),
  `comunidad` varchar(255),
  `area` varchar(255),
  `motor_productivo` varchar(255),
  `resumen` varchar(255),
  `direccion` varchar(255),
  `municipio` varchar(255),
  `parroquia` varchar(255),
  `nota_fase_1` float,
  `nota_fase_2` float,
  `periodo_inicio` date,
  `periodo_final` date
);

CREATE TABLE `sprinf_bd`.`integrante_proyecto` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `estudiante_id` varchar(255),
  `proyecto_id` int
);

CREATE TABLE `sprinf_bd`.`notas_integrante_proyecto` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `indicador_id` int,
  `integrante_id` int,
  `calificacion` float,
);

CREATE TABLE `sprinf_bd`.`persona` (
  `cedula` int UNIQUE PRIMARY KEY,
  `usuario_id` int,
  `nombre` varchar(255),
  `apellido` varchar(255),
  `direccion` varchar(255),
  `telefono` int,
  `estatus` bool
);

CREATE TABLE `sprinf_bd`.`usuario` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `email` varchar(255),
  `contrasena` varchar(255),
  `token` varchar(255)
);

CREATE TABLE `sprinf_bd`.`roles_usuarios` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `rol_id` int,
  `usuario_id` int
);

CREATE TABLE `sprinf_bd`.`roles` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(255)
);

CREATE TABLE `sprinf_bd`.`modulo` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(255)
);

CREATE TABLE `sprinf_bd`.`permisos` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `rol_id` int,
  `modulo_id` int,
  `crear` bool,
  `consultar` bool,
  `actualizar` bool,
  `eliminar` bool
);

CREATE TABLE `sprinf_bd`.`bitacora` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `navegador` varchar(105) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_cierre` time DEFAULT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(80) NOT NULL,
  `token` varchar(85) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ;

ALTER TABLE `sprinf_bd`.`trayecto` ADD FOREIGN KEY (`periodo_id`) REFERENCES `sprinf_bd`.`periodo` (`id`);

ALTER TABLE `sprinf_bd`.`fase` ADD FOREIGN KEY (`trayecto_id`) REFERENCES `sprinf_bd`.`trayecto` (`codigo`);

ALTER TABLE `sprinf_bd`.`fase` ADD FOREIGN KEY (`siguiente_fase`) REFERENCES `sprinf_bd`.`fase` (`codigo`);

ALTER TABLE `sprinf_bd`.`seccion` ADD FOREIGN KEY (`trayecto_id`) REFERENCES `sprinf_bd`.`trayecto` (`codigo`);

ALTER TABLE `sprinf_bd`.`malla_curricular` ADD FOREIGN KEY (`fase_id`) REFERENCES `sprinf_bd`.`fase` (`codigo`);

ALTER TABLE `sprinf_bd`.`malla_curricular` ADD FOREIGN KEY (`materia_id`) REFERENCES `sprinf_bd`.`materias` (`codigo`);

ALTER TABLE `sprinf_bd`.`profesor` ADD FOREIGN KEY (`persona_id`) REFERENCES `sprinf_bd`.`persona` (`cedula`);

ALTER TABLE `sprinf_bd`.`clase` ADD FOREIGN KEY (`profesor_id`) REFERENCES `sprinf_bd`.`profesor` (`codigo`);

ALTER TABLE `sprinf_bd`.`clase` ADD FOREIGN KEY (`seccion_id`) REFERENCES `sprinf_bd`.`seccion` (`codigo`);

ALTER TABLE `sprinf_bd`.`clase` ADD FOREIGN KEY (`unidad_curricular_id`) REFERENCES `sprinf_bd`.`malla_curricular` (`codigo`);

ALTER TABLE `sprinf_bd`.`dimension` ADD FOREIGN KEY (`unidad_id`) REFERENCES `sprinf_bd`.`malla_curricular` (`codigo`);

ALTER TABLE `sprinf_bd`.`indicadores` ADD FOREIGN KEY (`dimension_id`) REFERENCES `sprinf_bd`.`dimension` (`id`);

ALTER TABLE `sprinf_bd`.`estudiante` ADD FOREIGN KEY (`persona_id`) REFERENCES `sprinf_bd`.`persona` (`cedula`);

ALTER TABLE `sprinf_bd`.`inscripcion` ADD FOREIGN KEY (`clase_id`) REFERENCES `sprinf_bd`.`clase` (`codigo`);

ALTER TABLE `sprinf_bd`.`inscripcion` ADD FOREIGN KEY (`estudiante_id`) REFERENCES `sprinf_bd`.`estudiante` (`id`);

ALTER TABLE `sprinf_bd`.`proyecto` ADD FOREIGN KEY (`fase_id`) REFERENCES `sprinf_bd`.`fase` (`codigo`);

ALTER TABLE `sprinf_bd`.`integrante_proyecto` ADD FOREIGN KEY (`estudiante_id`) REFERENCES `sprinf_bd`.`estudiante` (`id`);

ALTER TABLE `sprinf_bd`.`integrante_proyecto` ADD FOREIGN KEY (`proyecto_id`) REFERENCES `sprinf_bd`.`proyecto` (`id`);

ALTER TABLE `sprinf_bd`.`notas_integrante_proyecto` ADD FOREIGN KEY (`indicador_id`) REFERENCES `sprinf_bd`.`indicadores` (`id`);

ALTER TABLE `sprinf_bd`.`notas_integrante_proyecto` ADD FOREIGN KEY (`integrante_id`) REFERENCES `sprinf_bd`.`integrante_proyecto` (`id`);

ALTER TABLE `sprinf_bd`.`persona` ADD FOREIGN KEY (`usuario_id`) REFERENCES `sprinf_bd`.`usuario` (`id`);

ALTER TABLE `sprinf_bd`.`roles_usuarios` ADD FOREIGN KEY (`rol_id`) REFERENCES `sprinf_bd`.`roles` (`id`);

ALTER TABLE `sprinf_bd`.`roles_usuarios` ADD FOREIGN KEY (`usuario_id`) REFERENCES `sprinf_bd`.`usuario` (`id`);

ALTER TABLE `sprinf_bd`.`permisos` ADD FOREIGN KEY (`rol_id`) REFERENCES `sprinf_bd`.`roles` (`id`);

ALTER TABLE `sprinf_bd`.`permisos` ADD FOREIGN KEY (`modulo_id`) REFERENCES `sprinf_bd`.`modulo` (`id`);

ALTER TABLE `sprinf_bd`.`bitacora` ADD FOREIGN KEY (`usuario_id`) REFERENCES `sprinf_bd`.`usuario` (`id`);

