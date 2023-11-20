DROP SCHEMA IF EXISTS `sprinf_bd`;
CREATE SCHEMA `sprinf_bd`;

CREATE TABLE `sprinf_bd`.`periodo` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `fecha_inicio` date,
  `fecha_cierre` date
);

CREATE TABLE `sprinf_bd`.`trayecto` (
  `codigo` varchar(255) UNIQUE PRIMARY KEY,
  `periodo_id` int,
  `calificacion_minima` float,
  `nombre` varchar(255),
  `siguiente_trayecto` varchar(255)
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
  `observacion` varchar(255)
);

CREATE TABLE `sprinf_bd`.`malla_curricular` (
  `codigo` varchar(255) UNIQUE PRIMARY KEY,
  `materia_id` varchar(255),
  `fase_id` varchar(255),
  `ponderacion` float
);

CREATE TABLE `sprinf_bd`.`materias` (
  `codigo` varchar(255) UNIQUE PRIMARY KEY,
  `nombre` varchar(255),
  `htasist` int,
  `htind` int,
  `ucredito` int,
  `hrs_acad` int,
  `eje` varchar(255),
  `cursable` bool DEFAULT true
);

CREATE TABLE `sprinf_bd`.`profesor` (
  `codigo` varchar(255) UNIQUE PRIMARY KEY,
  `persona_id` int
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
  `profesor_id` varchar(255),
  `seccion_id` varchar(255),
  `unidad_curricular_id` varchar(255),
  `estudiante_id` varchar(255),
  `calificacion` float,
  `estatus` int DEFAULT 1
);

CREATE TABLE `sprinf_bd`.`municipios` (
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE `sprinf_bd`.`parroquias` (
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    municipio INT NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE `sprinf_bd`.`sector_consejo_comunal` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `parroquia_id` int,
  `nombre` varchar(255)
);

CREATE TABLE `sprinf_bd`.`consejo_comunal` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(255),
  `nombre_vocero` varchar(255),
  `telefono` varchar(255),
  `sector_id` int
);

CREATE TABLE `sprinf_bd`.`proyecto` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `fase_id` varchar(255) NOT NULL,
  `parroquia_id` int NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `comunidad` varchar(255) NOT NULL,
  `motor_productivo` varchar(255),
  `resumen` text,
  `direccion` varchar(255),
  `consejo_comunal_id` int,
  `observaciones` text,
  `tutor_in` varchar(255),
  `tutor_ex` varchar(255),
  `tlf_tin` varchar(12),
  `tlf_tex` varchar(12),
  `estatus` int,
  `cerrado` bool DEFAULT false
);

CREATE TABLE `sprinf_bd`.`integrante_proyecto` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `estudiante_id` varchar(255),
  `proyecto_id` int,
  `estatus` int DEFAULT 1
);

CREATE TABLE `sprinf_bd`.`notas_integrante_proyecto` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `indicador_id` int,
  `integrante_id` int,
  `calificacion` float
);

CREATE TABLE `sprinf_bd`.`persona` (
  `cedula` int UNIQUE PRIMARY KEY,
  `usuario_id` int,
  `nombre` varchar(255),
  `apellido` varchar(255),
  `direccion` text,
  `telefono` text,
  `estatus` bool
);

CREATE TABLE `sprinf_bd`.`usuario` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `rol_id` int,
  `email` varchar(255),
  `contrasena` varchar(255),
  `token` varchar(255)
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

CREATE TABLE `sprinf_bd`.`proyecto_historico` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `id_proyecto` int,
  `consejo_comunal_id` int,
  `codigo_trayecto` varchar(255),
  `codigo_siguiente_trayecto` varchar(255),
  `nombre_estudiante` varchar(255),
  `cedula_estudiante` int,
  `nombre_proyecto` varchar(255),
  `nombre_trayecto` varchar(255),
  `resumen` varchar(255),
  `direccion` varchar(255),
  `comunidad` varchar(255),
  `motor_productivo` varchar(255),
  `nombre_consejo_comunal` varchar(255),
  `nombre_vocero_consejo_comunal` varchar(255),
  `telefono_consejo_comunal` varchar(255),
  `sector_consejo_comunal` varchar(255),
  `municipio` varchar(255),
  `parroquia_id` int,
  `parroquia` varchar(255),
  `observaciones` text,
  `tutor_in` varchar(255),
  `tutor_ex` varchar(255),
  `tlf_tex` varchar(255),
  `nota_fase_1` float,
  `nota_fase_2` float,
  `estatus` int,
  `periodo_inicio` date,
  `periodo_final` date
);

CREATE TABLE `sprinf_bd`.`bitacora` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `navegador` varchar(105) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_cierre` time DEFAULT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(80) NOT NULL,
  `token` varchar(85) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_bitacora_usuario1_idx` (`usuario_id`),
  CONSTRAINT `fk_bitacora_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `sprinf_bd`.`pregunta` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `pregunta` varchar(255)
);

CREATE TABLE `sprinf_bd`.`respuestas` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `respuesta` varchar(255) NOT NULL,
  `pregunta_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
);


ALTER TABLE `sprinf_bd`.`trayecto` ADD FOREIGN KEY (`periodo_id`) REFERENCES `sprinf_bd`.`periodo` (`id`);

ALTER TABLE `sprinf_bd`.`trayecto` ADD FOREIGN KEY (`siguiente_trayecto`) REFERENCES `sprinf_bd`.`trayecto` (`codigo`);

ALTER TABLE `sprinf_bd`.`fase` ADD FOREIGN KEY (`trayecto_id`) REFERENCES `sprinf_bd`.`trayecto` (`codigo`);

ALTER TABLE `sprinf_bd`.`fase` ADD FOREIGN KEY (`siguiente_fase`) REFERENCES `sprinf_bd`.`fase` (`codigo`);

ALTER TABLE `sprinf_bd`.`seccion` ADD FOREIGN KEY (`trayecto_id`) REFERENCES `sprinf_bd`.`trayecto` (`codigo`);

ALTER TABLE `sprinf_bd`.`malla_curricular` ADD FOREIGN KEY (`materia_id`) REFERENCES `sprinf_bd`.`materias` (`codigo`);

ALTER TABLE `sprinf_bd`.`malla_curricular` ADD FOREIGN KEY (`fase_id`) REFERENCES `sprinf_bd`.`fase` (`codigo`);

ALTER TABLE `sprinf_bd`.`profesor` ADD FOREIGN KEY (`persona_id`) REFERENCES `sprinf_bd`.`persona` (`cedula`);

ALTER TABLE `sprinf_bd`.`dimension` ADD FOREIGN KEY (`unidad_id`) REFERENCES `sprinf_bd`.`malla_curricular` (`codigo`);

ALTER TABLE `sprinf_bd`.`indicadores` ADD FOREIGN KEY (`dimension_id`) REFERENCES `sprinf_bd`.`dimension` (`id`) ON DELETE CASCADE;

ALTER TABLE `sprinf_bd`.`estudiante` ADD FOREIGN KEY (`persona_id`) REFERENCES `sprinf_bd`.`persona` (`cedula`);

ALTER TABLE `sprinf_bd`.`inscripcion` ADD FOREIGN KEY (`profesor_id`) REFERENCES `sprinf_bd`.`profesor` (`codigo`);

ALTER TABLE `sprinf_bd`.`inscripcion` ADD FOREIGN KEY (`seccion_id`) REFERENCES `sprinf_bd`.`seccion` (`codigo`);

ALTER TABLE `sprinf_bd`.`inscripcion` ADD FOREIGN KEY (`unidad_curricular_id`) REFERENCES `sprinf_bd`.`malla_curricular` (`codigo`);

ALTER TABLE `sprinf_bd`.`inscripcion` ADD FOREIGN KEY (`estudiante_id`) REFERENCES `sprinf_bd`.`estudiante` (`id`);

ALTER TABLE `sprinf_bd`.`parroquias` ADD FOREIGN KEY (`municipio`) REFERENCES `sprinf_bd`.`municipios` (`id`);

ALTER TABLE `sprinf_bd`.`sector_consejo_comunal` ADD FOREIGN KEY (`parroquia_id`) REFERENCES `sprinf_bd`.`parroquias` (`id`);

ALTER TABLE `sprinf_bd`.`consejo_comunal` ADD FOREIGN KEY (`sector_id`) REFERENCES `sprinf_bd`.`sector_consejo_comunal` (`id`);

ALTER TABLE `sprinf_bd`.`proyecto` ADD FOREIGN KEY (`fase_id`) REFERENCES `sprinf_bd`.`fase` (`codigo`);

ALTER TABLE `sprinf_bd`.`proyecto` ADD FOREIGN KEY (`tutor_in`) REFERENCES `sprinf_bd`.`profesor` (`codigo`);


ALTER TABLE `sprinf_bd`.`proyecto` ADD FOREIGN KEY (`consejo_comunal_id`) REFERENCES `sprinf_bd`.`consejo_comunal` (`id`);

ALTER TABLE `sprinf_bd`.`proyecto` ADD FOREIGN KEY (`parroquia_id`) REFERENCES `sprinf_bd`.`parroquias` (`id`);

ALTER TABLE `sprinf_bd`.`integrante_proyecto` ADD FOREIGN KEY (`estudiante_id`) REFERENCES `sprinf_bd`.`estudiante` (`id`);

ALTER TABLE `sprinf_bd`.`integrante_proyecto` ADD FOREIGN KEY (`proyecto_id`) REFERENCES `sprinf_bd`.`proyecto` (`id`);

ALTER TABLE `sprinf_bd`.`notas_integrante_proyecto` ADD FOREIGN KEY (`indicador_id`) REFERENCES `sprinf_bd`.`indicadores` (`id`) ON DELETE CASCADE;

ALTER TABLE `sprinf_bd`.`notas_integrante_proyecto` ADD FOREIGN KEY (`integrante_id`) REFERENCES `sprinf_bd`.`integrante_proyecto` (`id`) ON DELETE CASCADE;

ALTER TABLE `sprinf_bd`.`persona` ADD FOREIGN KEY (`usuario_id`) REFERENCES `sprinf_bd`.`usuario` (`id`);

ALTER TABLE `sprinf_bd`.`usuario` ADD FOREIGN KEY (`rol_id`) REFERENCES `sprinf_bd`.`roles` (`id`);

ALTER TABLE `sprinf_bd`.`permisos` ADD FOREIGN KEY (`rol_id`) REFERENCES `sprinf_bd`.`roles` (`id`);

ALTER TABLE `sprinf_bd`.`permisos` ADD FOREIGN KEY (`modulo_id`) REFERENCES `sprinf_bd`.`modulo` (`id`);

ALTER TABLE `sprinf_bd`.`respuestas` ADD FOREIGN KEY (`usuario_id`) REFERENCES `sprinf_bd`.`usuario` (`id`);

ALTER TABLE `sprinf_bd`.`respuestas` ADD FOREIGN KEY (`pregunta_id`) REFERENCES `sprinf_bd`.`pregunta` (`id`);


use sprinf_bd;
-- 1_usuarios
delete from permisos where true;
delete from modulo where true;
delete from roles where true;
delete from persona where true;
delete from usuario where true;

-- ROLES
insert into roles (id, nombre) values (1, 'administrador'), (2, 'profesor'), (3, 'coordinador'), (4, 'estudiante');

-- modulos
insert into modulo (id, nombre) values (1, 'Proyecto');
insert into modulo (id, nombre) values (2, 'Materias');

-- permisos
insert into permisos (id, consultar, actualizar, crear, eliminar, rol_id, modulo_id) values (1, 1, 1, 1, 1, 1, 1);
insert into permisos (id, consultar, actualizar, crear, eliminar, rol_id, modulo_id) values (2, 1, 1, 1, 1, 1, 2);


-- usuarios
insert into usuario (rol_id, email, contrasena, token) values (1,'root@gmail.com',"$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72", 'fsadfsadfsadf');

insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (1, '28566432', 'Admin', 'admin', 'Urb. La Concordia', '04247777777', 1);

-- usuarios roles
-- insert into roles_usuarios (rol_id, usuario_id) values (1,1);


-- 2_profesores
delete from profesor where true;
delete from persona where usuario_id != 1;
delete from usuario where id != 1;


-- Profesora Sonia
insert into usuario (id,rol_id,email, contrasena, token)
values (2,2,'sonia@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (2, '9619518', 'Sonia', 'Cordoba', 'ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=', '2548475154', 1);
insert into profesor (codigo, persona_id) values ('p-135482354',9619518);

-- Profesor Ricardo Tillero
insert into usuario (id,rol_id,email, contrasena, token)
values (3,2,'ricardo@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (3, '654854354', 'Ricardo', 'Tillero', 'ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=', '2548475154', 1);
insert into profesor (codigo, persona_id) values ('p-654854354',654854354);


-- Profesor Orlando 
insert into usuario (id,rol_id,email, contrasena, token)
values (4,2,'orlando@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (4, '234565423', 'Orlando', 'Guerra', 'ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=', '2548475154', 1);
insert into profesor (codigo, persona_id) values ('p-234565423',234565423);

-- Profesora Lisset
insert into usuario (id,rol_id,email, contrasena, token)
values (5,2,'lisset@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (5, '125487', 'Lissette', 'Torrealba', 'ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=', '2548475154', 1);
insert into profesor (codigo, persona_id) values ('p-125487',125487);

-- Profesor orlando 
insert into usuario (id,rol_id,email, contrasena, token)
values (6,2,'oswaldo@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (6, '7404027', 'Oswaldo', 'Aparicio', 'ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=', 'WXsjxxCSSjrih+s2QwNSEUPPoE/D+jUqfv0W33mehLZjThcOO34Gpz/FxGACG+ivQOKrbgLnYoIpQm0npRBMtL9ZMpqzAkcXLMErvMXJED8IXXfJG0aBDH6JFKkqZSFCbNofpPI8ieEn+iiJ2QZryH/h4X3SgVlBGROWMlNboh8wX5HzihPoat8u976BT85RfUfzC1KJ+/hEJV7U2AA4z8+qXJwj+fmE2GuiIGsmZ8R1xkcDlZyqzVUPxoagxJSwJtoD9H3/cSYJJSwrd5pe/JQmxxRMdRydD78aEMxh9Y+aZX5XIZb0x9s+VLiR/3kUA3GSJ5gw/c0n5QpMQVkNjZtEfRIJAaRumOBGpL8qJcHQHd0w+MAuig1HzkTJcWVdPY8SPC8OkRoAbV3SKxWg0UQHPHnor7frlshd+3AiPy7IGibue2g2C6zQgecCDEhr0QPnhPV/Ti8/Q9RW6UHJ4JUOoBTHaoDf8OvvA7x74u5CHOGtOUsu2kL1WjgZ36jn7iOwZcxSGTKHGJDtXuckSYWB0ua5uc/HYzabn4dxS4Sxro4dpEg/kicFeeIiUoHBoosgKrIGkUhKY3/x6CnJklJ0+2oc6W/K1H5SKODRceoVLOtNjZXj6IK6hVTyumOW8T7/lanvHM8AnpK7EjRTW9xt/njNs1nVdaThX+KyLkU=', 1);
insert into profesor (codigo, persona_id) values ('p-132654318',7404027);

-- Profesora pura
insert into usuario (id,rol_id,email, contrasena, token)
values (7,2,'pura@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (7, '7392496', 'Pura', 'Castillo', 'ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=', 'WXsjxxCSSjrih+s2QwNSEUPPoE/D+jUqfv0W33mehLZjThcOO34Gpz/FxGACG+ivQOKrbgLnYoIpQm0npRBMtL9ZMpqzAkcXLMErvMXJED8IXXfJG0aBDH6JFKkqZSFCbNofpPI8ieEn+iiJ2QZryH/h4X3SgVlBGROWMlNboh8wX5HzihPoat8u976BT85RfUfzC1KJ+/hEJV7U2AA4z8+qXJwj+fmE2GuiIGsmZ8R1xkcDlZyqzVUPxoagxJSwJtoD9H3/cSYJJSwrd5pe/JQmxxRMdRydD78aEMxh9Y+aZX5XIZb0x9s+VLiR/3kUA3GSJ5gw/c0n5QpMQVkNjZtEfRIJAaRumOBGpL8qJcHQHd0w+MAuig1HzkTJcWVdPY8SPC8OkRoAbV3SKxWg0UQHPHnor7frlshd+3AiPy7IGibue2g2C6zQgecCDEhr0QPnhPV/Ti8/Q9RW6UHJ4JUOoBTHaoDf8OvvA7x74u5CHOGtOUsu2kL1WjgZ36jn7iOwZcxSGTKHGJDtXuckSYWB0ua5uc/HYzabn4dxS4Sxro4dpEg/kicFeeIiUoHBoosgKrIGkUhKY3/x6CnJklJ0+2oc6W/K1H5SKODRceoVLOtNjZXj6IK6hVTyumOW8T7/lanvHM8AnpK7EjRTW9xt/njNs1nVdaThX+KyLkU=', 1);
insert into profesor (codigo, persona_id) values ('p-52844735',7392496);

-- profesora Ligia
insert into usuario (id,rol_id,email, contrasena, token)
values (9,2,'ligia@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (9, '13991250', 'Ligia', 'Durán', 'ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=', 'WXsjxxCSSjrih+s2QwNSEUPPoE/D+jUqfv0W33mehLZjThcOO34Gpz/FxGACG+ivQOKrbgLnYoIpQm0npRBMtL9ZMpqzAkcXLMErvMXJED8IXXfJG0aBDH6JFKkqZSFCbNofpPI8ieEn+iiJ2QZryH/h4X3SgVlBGROWMlNboh8wX5HzihPoat8u976BT85RfUfzC1KJ+/hEJV7U2AA4z8+qXJwj+fmE2GuiIGsmZ8R1xkcDlZyqzVUPxoagxJSwJtoD9H3/cSYJJSwrd5pe/JQmxxRMdRydD78aEMxh9Y+aZX5XIZb0x9s+VLiR/3kUA3GSJ5gw/c0n5QpMQVkNjZtEfRIJAaRumOBGpL8qJcHQHd0w+MAuig1HzkTJcWVdPY8SPC8OkRoAbV3SKxWg0UQHPHnor7frlshd+3AiPy7IGibue2g2C6zQgecCDEhr0QPnhPV/Ti8/Q9RW6UHJ4JUOoBTHaoDf8OvvA7x74u5CHOGtOUsu2kL1WjgZ36jn7iOwZcxSGTKHGJDtXuckSYWB0ua5uc/HYzabn4dxS4Sxro4dpEg/kicFeeIiUoHBoosgKrIGkUhKY3/x6CnJklJ0+2oc6W/K1H5SKODRceoVLOtNjZXj6IK6hVTyumOW8T7/lanvHM8AnpK7EjRTW9xt/njNs1nVdaThX+KyLkU=', 1);
insert into profesor (codigo, persona_id) values ('p-354487534',13991250);


-- profesora Ingrid
insert into usuario (id,rol_id,email, contrasena, token)
values (10,2,'ingrid@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (10, '7423485', 'Ingrid', 'Figueroa', 'ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=', 'WXsjxxCSSjrih+s2QwNSEUPPoE/D+jUqfv0W33mehLZjThcOO34Gpz/FxGACG+ivQOKrbgLnYoIpQm0npRBMtL9ZMpqzAkcXLMErvMXJED8IXXfJG0aBDH6JFKkqZSFCbNofpPI8ieEn+iiJ2QZryH/h4X3SgVlBGROWMlNboh8wX5HzihPoat8u976BT85RfUfzC1KJ+/hEJV7U2AA4z8+qXJwj+fmE2GuiIGsmZ8R1xkcDlZyqzVUPxoagxJSwJtoD9H3/cSYJJSwrd5pe/JQmxxRMdRydD78aEMxh9Y+aZX5XIZb0x9s+VLiR/3kUA3GSJ5gw/c0n5QpMQVkNjZtEfRIJAaRumOBGpL8qJcHQHd0w+MAuig1HzkTJcWVdPY8SPC8OkRoAbV3SKxWg0UQHPHnor7frlshd+3AiPy7IGibue2g2C6zQgecCDEhr0QPnhPV/Ti8/Q9RW6UHJ4JUOoBTHaoDf8OvvA7x74u5CHOGtOUsu2kL1WjgZ36jn7iOwZcxSGTKHGJDtXuckSYWB0ua5uc/HYzabn4dxS4Sxro4dpEg/kicFeeIiUoHBoosgKrIGkUhKY3/x6CnJklJ0+2oc6W/K1H5SKODRceoVLOtNjZXj6IK6hVTyumOW8T7/lanvHM8AnpK7EjRTW9xt/njNs1nVdaThX+KyLkU=', 1);
insert into profesor (codigo, persona_id) values ('p-3542874',7423485);

-- profesora Lerida
insert into usuario (id,rol_id,email, contrasena, token)
values (11,2,'lerida@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (11, '11264888', 'Lerida', 'Figueroa', 'ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=', 'WXsjxxCSSjrih+s2QwNSEUPPoE/D+jUqfv0W33mehLZjThcOO34Gpz/FxGACG+ivQOKrbgLnYoIpQm0npRBMtL9ZMpqzAkcXLMErvMXJED8IXXfJG0aBDH6JFKkqZSFCbNofpPI8ieEn+iiJ2QZryH/h4X3SgVlBGROWMlNboh8wX5HzihPoat8u976BT85RfUfzC1KJ+/hEJV7U2AA4z8+qXJwj+fmE2GuiIGsmZ8R1xkcDlZyqzVUPxoagxJSwJtoD9H3/cSYJJSwrd5pe/JQmxxRMdRydD78aEMxh9Y+aZX5XIZb0x9s+VLiR/3kUA3GSJ5gw/c0n5QpMQVkNjZtEfRIJAaRumOBGpL8qJcHQHd0w+MAuig1HzkTJcWVdPY8SPC8OkRoAbV3SKxWg0UQHPHnor7frlshd+3AiPy7IGibue2g2C6zQgecCDEhr0QPnhPV/Ti8/Q9RW6UHJ4JUOoBTHaoDf8OvvA7x74u5CHOGtOUsu2kL1WjgZ36jn7iOwZcxSGTKHGJDtXuckSYWB0ua5uc/HYzabn4dxS4Sxro4dpEg/kicFeeIiUoHBoosgKrIGkUhKY3/x6CnJklJ0+2oc6W/K1H5SKODRceoVLOtNjZXj6IK6hVTyumOW8T7/lanvHM8AnpK7EjRTW9xt/njNs1nVdaThX+KyLkU=', 1);
insert into profesor (codigo, persona_id) values ('p-54875538',11264888);

-- profesora Ruben
insert into usuario (id,rol_id,email, contrasena, token)
values (12,2,'ruben@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (12, '9629702', 'Ruben', 'Godoy', 'ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=', 'WXsjxxCSSjrih+s2QwNSEUPPoE/D+jUqfv0W33mehLZjThcOO34Gpz/FxGACG+ivQOKrbgLnYoIpQm0npRBMtL9ZMpqzAkcXLMErvMXJED8IXXfJG0aBDH6JFKkqZSFCbNofpPI8ieEn+iiJ2QZryH/h4X3SgVlBGROWMlNboh8wX5HzihPoat8u976BT85RfUfzC1KJ+/hEJV7U2AA4z8+qXJwj+fmE2GuiIGsmZ8R1xkcDlZyqzVUPxoagxJSwJtoD9H3/cSYJJSwrd5pe/JQmxxRMdRydD78aEMxh9Y+aZX5XIZb0x9s+VLiR/3kUA3GSJ5gw/c0n5QpMQVkNjZtEfRIJAaRumOBGpL8qJcHQHd0w+MAuig1HzkTJcWVdPY8SPC8OkRoAbV3SKxWg0UQHPHnor7frlshd+3AiPy7IGibue2g2C6zQgecCDEhr0QPnhPV/Ti8/Q9RW6UHJ4JUOoBTHaoDf8OvvA7x74u5CHOGtOUsu2kL1WjgZ36jn7iOwZcxSGTKHGJDtXuckSYWB0ua5uc/HYzabn4dxS4Sxro4dpEg/kicFeeIiUoHBoosgKrIGkUhKY3/x6CnJklJ0+2oc6W/K1H5SKODRceoVLOtNjZXj6IK6hVTyumOW8T7/lanvHM8AnpK7EjRTW9xt/njNs1nVdaThX+KyLkU=', 1);
insert into profesor (codigo, persona_id) values ('p-5487531',9629702);

-- profesora Indira
insert into usuario (id,rol_id,email, contrasena, token)
values (13,2,'indira@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (13, '15693145', 'Indira', 'Gonzáles', 'ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=', 'WXsjxxCSSjrih+s2QwNSEUPPoE/D+jUqfv0W33mehLZjThcOO34Gpz/FxGACG+ivQOKrbgLnYoIpQm0npRBMtL9ZMpqzAkcXLMErvMXJED8IXXfJG0aBDH6JFKkqZSFCbNofpPI8ieEn+iiJ2QZryH/h4X3SgVlBGROWMlNboh8wX5HzihPoat8u976BT85RfUfzC1KJ+/hEJV7U2AA4z8+qXJwj+fmE2GuiIGsmZ8R1xkcDlZyqzVUPxoagxJSwJtoD9H3/cSYJJSwrd5pe/JQmxxRMdRydD78aEMxh9Y+aZX5XIZb0x9s+VLiR/3kUA3GSJ5gw/c0n5QpMQVkNjZtEfRIJAaRumOBGpL8qJcHQHd0w+MAuig1HzkTJcWVdPY8SPC8OkRoAbV3SKxWg0UQHPHnor7frlshd+3AiPy7IGibue2g2C6zQgecCDEhr0QPnhPV/Ti8/Q9RW6UHJ4JUOoBTHaoDf8OvvA7x74u5CHOGtOUsu2kL1WjgZ36jn7iOwZcxSGTKHGJDtXuckSYWB0ua5uc/HYzabn4dxS4Sxro4dpEg/kicFeeIiUoHBoosgKrIGkUhKY3/x6CnJklJ0+2oc6W/K1H5SKODRceoVLOtNjZXj6IK6hVTyumOW8T7/lanvHM8AnpK7EjRTW9xt/njNs1nVdaThX+KyLkU=', 1);
insert into profesor (codigo, persona_id) values ('p-523156847',15693145);

-- profesora Indira
insert into usuario (id,rol_id,email, contrasena, token)
values (14,2,'marling@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (14, '13527711', 'Marling', 'Brito', 'ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=', 'WXsjxxCSSjrih+s2QwNSEUPPoE/D+jUqfv0W33mehLZjThcOO34Gpz/FxGACG+ivQOKrbgLnYoIpQm0npRBMtL9ZMpqzAkcXLMErvMXJED8IXXfJG0aBDH6JFKkqZSFCbNofpPI8ieEn+iiJ2QZryH/h4X3SgVlBGROWMlNboh8wX5HzihPoat8u976BT85RfUfzC1KJ+/hEJV7U2AA4z8+qXJwj+fmE2GuiIGsmZ8R1xkcDlZyqzVUPxoagxJSwJtoD9H3/cSYJJSwrd5pe/JQmxxRMdRydD78aEMxh9Y+aZX5XIZb0x9s+VLiR/3kUA3GSJ5gw/c0n5QpMQVkNjZtEfRIJAaRumOBGpL8qJcHQHd0w+MAuig1HzkTJcWVdPY8SPC8OkRoAbV3SKxWg0UQHPHnor7frlshd+3AiPy7IGibue2g2C6zQgecCDEhr0QPnhPV/Ti8/Q9RW6UHJ4JUOoBTHaoDf8OvvA7x74u5CHOGtOUsu2kL1WjgZ36jn7iOwZcxSGTKHGJDtXuckSYWB0ua5uc/HYzabn4dxS4Sxro4dpEg/kicFeeIiUoHBoosgKrIGkUhKY3/x6CnJklJ0+2oc6W/K1H5SKODRceoVLOtNjZXj6IK6hVTyumOW8T7/lanvHM8AnpK7EjRTW9xt/njNs1nVdaThX+KyLkU=', 1);
insert into profesor (codigo, persona_id) values ('p-2658475',13527711);


insert into usuario (id,rol_id,email, contrasena, token)
values (17,2,'josesequera@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (17, '5428468', 'Jose', 'Sequera', 'ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=', 'WXsjxxCSSjrih+s2QwNSEUPPoE/D+jUqfv0W33mehLZjThcOO34Gpz/FxGACG+ivQOKrbgLnYoIpQm0npRBMtL9ZMpqzAkcXLMErvMXJED8IXXfJG0aBDH6JFKkqZSFCbNofpPI8ieEn+iiJ2QZryH/h4X3SgVlBGROWMlNboh8wX5HzihPoat8u976BT85RfUfzC1KJ+/hEJV7U2AA4z8+qXJwj+fmE2GuiIGsmZ8R1xkcDlZyqzVUPxoagxJSwJtoD9H3/cSYJJSwrd5pe/JQmxxRMdRydD78aEMxh9Y+aZX5XIZb0x9s+VLiR/3kUA3GSJ5gw/c0n5QpMQVkNjZtEfRIJAaRumOBGpL8qJcHQHd0w+MAuig1HzkTJcWVdPY8SPC8OkRoAbV3SKxWg0UQHPHnor7frlshd+3AiPy7IGibue2g2C6zQgecCDEhr0QPnhPV/Ti8/Q9RW6UHJ4JUOoBTHaoDf8OvvA7x74u5CHOGtOUsu2kL1WjgZ36jn7iOwZcxSGTKHGJDtXuckSYWB0ua5uc/HYzabn4dxS4Sxro4dpEg/kicFeeIiUoHBoosgKrIGkUhKY3/x6CnJklJ0+2oc6W/K1H5SKODRceoVLOtNjZXj6IK6hVTyumOW8T7/lanvHM8AnpK7EjRTW9xt/njNs1nVdaThX+KyLkU=', 1);
insert into profesor (codigo, persona_id) values ('p-5428468',5428468);


insert into usuario (id,rol_id,email, contrasena, token)
values (18,2,'pedro@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (18, '52213548', 'Pedro', 'Castillo', 'ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=', 'WXsjxxCSSjrih+s2QwNSEUPPoE/D+jUqfv0W33mehLZjThcOO34Gpz/FxGACG+ivQOKrbgLnYoIpQm0npRBMtL9ZMpqzAkcXLMErvMXJED8IXXfJG0aBDH6JFKkqZSFCbNofpPI8ieEn+iiJ2QZryH/h4X3SgVlBGROWMlNboh8wX5HzihPoat8u976BT85RfUfzC1KJ+/hEJV7U2AA4z8+qXJwj+fmE2GuiIGsmZ8R1xkcDlZyqzVUPxoagxJSwJtoD9H3/cSYJJSwrd5pe/JQmxxRMdRydD78aEMxh9Y+aZX5XIZb0x9s+VLiR/3kUA3GSJ5gw/c0n5QpMQVkNjZtEfRIJAaRumOBGpL8qJcHQHd0w+MAuig1HzkTJcWVdPY8SPC8OkRoAbV3SKxWg0UQHPHnor7frlshd+3AiPy7IGibue2g2C6zQgecCDEhr0QPnhPV/Ti8/Q9RW6UHJ4JUOoBTHaoDf8OvvA7x74u5CHOGtOUsu2kL1WjgZ36jn7iOwZcxSGTKHGJDtXuckSYWB0ua5uc/HYzabn4dxS4Sxro4dpEg/kicFeeIiUoHBoosgKrIGkUhKY3/x6CnJklJ0+2oc6W/K1H5SKODRceoVLOtNjZXj6IK6hVTyumOW8T7/lanvHM8AnpK7EjRTW9xt/njNs1nVdaThX+KyLkU=', 1);
insert into profesor (codigo, persona_id) values ('p-52213548',52213548);

-- 3_estudiante.sql

insert into usuario (id, rol_id, email, contrasena, token) values( 19, 4, 'Carlosestudiante@gmail.com', '$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono) values (19,15408, 'Carlos', 'Ramirez', 'Urb. La Concordia', 6309710917);
insert into estudiante (id, persona_id) values ('e-15408',15408);

insert into usuario (id, rol_id, email, contrasena, token) values( 20, 4, 'Saraiestudiante@gmail.com', '$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono) values (20,63578, 'Sarai', 'Perez', '4th Floor', 5994995192);
insert into estudiante (id, persona_id) values ('e-63578',63578);

insert into usuario (id, rol_id, email, contrasena, token) values( 21, 4, 'Kevinestudiante@gmail.com', '$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono) values (21,39263, 'Kevin', 'Heredia', 'Suite 3', 8337046607);
insert into estudiante (id, persona_id) values ('e-39263',39263);


-- 4_periodo.sql
delete from periodo where true;
insert into periodo (id, fecha_inicio, fecha_cierre) values (1, '2023-03-01', '2024-02-01');

-- 5_trayecto-fase.sql
insert into trayecto (codigo, periodo_id, nombre, calificacion_minima, siguiente_trayecto) values ('TR4',1,'Trayecto IV',80, NULL);
insert into fase (codigo, trayecto_id, nombre) values ('TR4_2','TR4','Fase 2'); 
insert into fase (codigo, trayecto_id, nombre, siguiente_fase) values ('TR4_1','TR4','Fase 1', 'TR4_2');

insert into trayecto (codigo, periodo_id, nombre, calificacion_minima, siguiente_trayecto) values ('TR3',1,'Trayecto III',80, 'TR4');
insert into fase (codigo, trayecto_id, nombre) values ('TR3_2','TR3','Fase 2'); 
insert into fase (codigo, trayecto_id, nombre, siguiente_fase) values ('TR3_1','TR3','Fase 1', 'TR3_2'); 

insert into trayecto (codigo, periodo_id, nombre, calificacion_minima, siguiente_trayecto) values ('TR2',1,'Trayecto II',80, 'TR3');
insert into fase (codigo, trayecto_id, nombre) values ('TR2_2','TR2','Fase 2');
insert into fase (codigo, trayecto_id, nombre,siguiente_fase) values ('TR2_1','TR2','Fase 1', 'TR2_2');

insert into trayecto (codigo, periodo_id, nombre, calificacion_minima, siguiente_trayecto) values ('TR1',1,'Trayecto I',80, 'TR2');
insert into fase (codigo, trayecto_id, nombre) values ('TR1_2','TR1','Fase 2');
insert into fase (codigo, trayecto_id, nombre, siguiente_fase) values ('TR1_1','TR1','Fase 1', 'TR1_2');

-- 6_seccion.sql
-- // Trayecto 1
insert into seccion (trayecto_id, codigo, observacion) values ('TR1','IN1104', '');
insert into seccion (trayecto_id, codigo, observacion) values ('TR1','IN1114', '');
insert into seccion (trayecto_id, codigo, observacion) values ('TR1','IN1124', '');
insert into seccion (trayecto_id, codigo, observacion) values ('TR1','IN1134', 'REPITENCIA');

insert into seccion (trayecto_id, codigo, observacion) values ('TR1','IN1203', '');
insert into seccion (trayecto_id, codigo, observacion) values ('TR1','IN1213', '');
insert into seccion (trayecto_id, codigo, observacion) values ('TR1','IN1202', '');

-- // Trayecto 2
insert into seccion (trayecto_id, codigo, observacion) values ('TR2','IN2103', '');
insert into seccion (trayecto_id, codigo, observacion) values ('TR2','IN2113', '');
insert into seccion (trayecto_id, codigo, observacion) values ('TR2','IN2102', '');
insert into seccion (trayecto_id, codigo, observacion) values ('TR2','IN2112', '');

-- // Trayecto 3
insert into seccion (trayecto_id, codigo, observacion) values ('TR3','IN3301', '');
insert into seccion (trayecto_id, codigo, observacion) values ('TR3','IN3302', '');
insert into seccion (trayecto_id, codigo, observacion) values ('TR3','IN3102', '');
insert into seccion (trayecto_id, codigo, observacion) values ('TR3','IN3103', '');
insert into seccion (trayecto_id, codigo, observacion) values ('TR3','IN3104', '');

-- // trayecto 4
insert into seccion (trayecto_id, codigo, observacion) values ('TR4','IN4401', '');
insert into seccion (trayecto_id, codigo, observacion) values ('TR4','IN4402', '');
insert into seccion (trayecto_id, codigo, observacion) values ('TR4','IN4403', 'IUJO');

-- materias-malla.sql

delete from malla_curricular where true;
delete from materias where true;

-- ------------------ TRAYECTO I -------------------------------
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje, cursable) values ('ASESOR3078554', 'Tutor Asesor Proyecto I', 72, 6, 3, 4, '',0);
insert into malla_curricular (codigo, fase_id, materia_id) values ('ASESOR3078554_1', 'TR1_1','ASESOR3078554');
insert into malla_curricular (codigo, fase_id, materia_id) values ('ASESOR3078554_2', 'TR1_2','ASESOR3078554');

-- arquitectura del computador
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('ARQUIT1254578', 'Arquitectura del Computador', 72, 6, 3, 4, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('ARQUIT1254578_1', 'TR1_1','ARQUIT1254578');
insert into malla_curricular (codigo, fase_id, materia_id) values ('ARQUIT1254578_2', 'TR1_2','ARQUIT1254578');
-- proyecto
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIPST548751', 'Proyecto Socio Tecnológico', 216, 18, 9, 6, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIPST548751_1', 'TR1_1','PIPST548751');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIPST548751_2', 'TR1_2','PIPST548751');
-- electiva
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIELE548756', 'Electiva I', 72, 6, 3, 4, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIELE548756_1', 'TR1_1','PIELE548756');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIELE548756_2', 'TR1_2','PIELE548756');

-- ------------------ TRAYECTO II -------------------------------
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje, cursable) values ('ASESOR3078845', 'Tutor Asesor Proyecto II', 72, 6, 3, 4, '',0);
insert into malla_curricular (codigo, fase_id, materia_id) values ('ASESOR3078845_1', 'TR2_1','ASESOR3078845');
insert into malla_curricular (codigo, fase_id, materia_id) values ('ASESOR3078845_2', 'TR2_2','ASESOR3078845');

-- base de datos
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIBAD090203', 'Base de Datos', 72, 6, 3, 4, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIBAD090203_1', 'TR2_1','PIBAD090203');

-- ing de software
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIINS090203', 'Ingenieria del Software I', 72, 6, 3, 4, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIINS090203_1', 'TR2_1','PIINS090203');
-- proyecto
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIPST234209', 'Proyecto Socio Tecnológico II', 72, 6, 3, 4, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIPST234209_1', 'TR2_1','PIPST234209');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIPST234209_2', 'TR2_2','PIPST234209');

-- programacion II
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIPRO306212', 'Programación II', 72, 6, 3, 4, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIPRO306212_1', 'TR2_1','PIPRO306212');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIPRO306212_2', 'TR2_2','PIPRO306212');
-- ------------------ TRAYECTO III -------------------------------
-- Matemática Aplicada anual trayecto 3
-- insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIMAT156306', 'Matemática Aplicada', 120, 36, 6, 3, '');
-- insert into malla_curricular (codigo, fase_id, materia_id) values ('PIMAT156306_1', 'TR3_1','PIMAT156306');
-- insert into malla_curricular (codigo, fase_id, materia_id) values ('PIMAT156306_2', 'TR3_2','PIMAT156306');


-- modelado de bases de datos fase 1 trayecto 3
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIMOB078303', 'Modelado de bases de datos', 72, 6, 3, 2, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIMOB078303_1','TR3_1','PIMOB078303');
-- vincula a proyecto por lo que se crean dimensiones e indicadores
-- ....


-- Proyecto Solcio Tecnológico III anual trayecto 3
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIPST078303', 'Proyecto Socio Tecnológico', 216, 18, 9, 6, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIPST078303_1', 'TR3_1','PIPST078303');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIPST078303_2', 'TR3_2','PIPST078303');


-- Sistemas Operativos fase 1 trayecto 3
-- insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PISIO078303', 'Sistemas Operativos', 72, 6, 3, 4, '');
-- insert into malla_curricular (codigo, fase_id, materia_id) values ('PISIO078303_1', 'TR3_1','PISIO078303');
-- vincula a proyecto por lo que se crean dimensiones e indicadores
-- ....

-- Ingenieria de software anual trayecto 3
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PINGSO078303', 'Ingenieria de Software', 72, 6, 3, 4, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PINGSO078303_1', 'TR3_1','PINGSO078303');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PINGSO078303_2', 'TR3_2','PINGSO078303');
-- vincula a proyecto por lo que se crean dimensiones e indicadores
-- ....


-- Tutor Asesor Proyecto anual trayecto 3
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje, cursable) values ('ASESOR3078303', 'Tutor Asesor Proyecto III', 72, 6, 3, 4, '',0);
insert into malla_curricular (codigo, fase_id, materia_id) values ('ASESOR3078303_1', 'TR3_1','ASESOR3078303');
insert into malla_curricular (codigo, fase_id, materia_id) values ('ASESOR3078303_2', 'TR3_2','ASESOR3078303');
-- vincula a proyecto por lo que se crean dimensiones e indicadores
-- ....

-- ------------ TRAYECTO IV ------------------------

-- Actividades acreditables IV anual trayecto 4 
-- insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIACA078303', 'Actividades acreditables IV', 72, 6, 3, 4, '');
-- insert into malla_curricular (codigo, fase_id, materia_id) values ('PIACA078303_1', 'TR4_1','PIACA078303');
-- insert into malla_curricular (codigo, fase_id, materia_id) values ('PIACA078303_2', 'TR4_2','PIACA078303');

-- Administración de bases de datos
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIABD078303', 'Administración de bases de datos', 72, 6, 3, 4, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIABD078303_1','TR4_1','PIABD078303');


-- Auditoria Informática
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIAUI078303', 'Auditoria Informática', 72, 6, 3, 4, '');

insert into malla_curricular (codigo, fase_id, materia_id) values ('PIAUI078303_2','TR4_2','PIAUI078303');

-- Electiva IV
-- insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIELE078303', 'Electiva IV', 72, 6, 3, 4, '');

-- insert into malla_curricular (codigo, fase_id, materia_id) values ('PIELE078303_2', 'TR4_2','PIELE078303');

-- Formación Crítica IV
-- insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIFOC078303', 'Formación Crítica IV', 72, 6, 3, 4, '');
-- insert into malla_curricular (codigo, fase_id, materia_id) values ('PIFOC078303_1', 'TR4_1','PIFOC078303');
-- insert into malla_curricular (codigo, fase_id, materia_id) values ('PIFOC078303_2', 'TR4_2','PIFOC078303');

-- Gestión de proyecto informático
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIGPI078303', 'Gestión de proyecto informático', 72, 6, 3, 4, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIGPI078303_1', 'TR4_1','PIGPI078303');


-- Idiomas II
-- insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIIDI078303', 'Idiomas II', 72, 6, 3, 4, '');
-- insert into malla_curricular (codigo, fase_id, materia_id) values ('PIIDI078303_1', 'TR4_1','PIIDI078303');
-- insert into malla_curricular (codigo, fase_id, materia_id) values ('PIIDI078303_2', 'TR4_2','PIIDI078303');

-- Proyecto Socio Tecnológico IV 
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIPST078304', 'Proyecto Socio Tecnológico IV', 72, 6, 3, 4, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIPST078304_1', 'TR4_1','PIPST078304');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIPST078304_2', 'TR4_2','PIPST078304');

-- Redes Avanzadas 
-- insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIREA078303', 'Redes Avanzadas', 72, 6, 3, 4, '');
-- insert into malla_curricular (codigo, fase_id, materia_id) values ('PIREA078303_2', 'TR4_2','PIREA078303');

-- Seguridad Informática
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PISEI078303', 'Seguridad Informática', 72, 6, 3, 4, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PISEI078303_1', 'TR4_1','PISEI078303');


-- Tutor Asesor Proyecto IV
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje, cursable) values ('ASESOR4078303', 'Tutor Asesor Proyecto IV', 72, 6, 3, 4, '',0);
insert into malla_curricular (codigo, fase_id, materia_id) values ('ASESOR4078303_1', 'TR4_1','ASESOR4078303');
insert into malla_curricular (codigo, fase_id, materia_id) values ('ASESOR4078303_2', 'TR4_2','ASESOR4078303');

-- baremos.sql

delete from indicadores where true;
delete from dimension where true;
-- --------------------- trayecto 4 fase 1 ---------------------------
-- TUTORA
insert into dimension (id, unidad_id, nombre, grupal) values(1,'ASESOR4078303_1','Desempeño Individual',0);

insert into indicadores (dimension_id, nombre, ponderacion) values(1, 'Responsabilidad', 1.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(1, 'Activo y participativo', 0.25);
insert into indicadores (dimension_id, nombre, ponderacion) values(1, 'Integración al grupo', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(1, 'Sensibilidad Social', 0.25);

insert into dimension (id, unidad_id, nombre, grupal) values(2,'ASESOR4078303_1','Desempeño Grupal', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(2, 'Manejo de conflictos', 0.25);
insert into indicadores (dimension_id, nombre, ponderacion) values(2, 'Proactividad', 0.25);
insert into indicadores (dimension_id, nombre, ponderacion) values(2, 'Recibe de su equipo de proyecto los entregables de trayecto IV', 2);

insert into dimension (id, unidad_id, nombre, grupal) values(3,'ASESOR4078303_1','Avance del Producto Final', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(3, 'Se evidencia que los riesgos presentados en el proyecto están vinculados con la comunidad.', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(3, 'Se verifica la existencia de elementos técnicos en cuanto a la base de datos, están aplicados en el proyecto', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(3, 'Los aspectos relacionados a seguridad informática (Métodos de cifrado) están presentes en el proyecto', 2);

-- Gestión de proyecto informatico
insert into dimension (id, unidad_id, nombre, grupal) values(4,'PIGPI078303_1','Evaluación Tecnica Individual', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(4, 'Gestiona los riesgos del proyecto', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(4, 'Analiza y crea estrategias para la administración de riesgo', 1.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(4, 'Controla el proyecto mediante rutas críticas en PERT/CPM', 2.5);

-- Administración de base de datos
insert into dimension (id, unidad_id, nombre, grupal) values(5,'PIABD078303_1','Evaluación Tecnica Individual', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(5, 'Presenta plan de optimización de la base de datos.', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(5, 'Presenta plan de monitoreo del rendimiento de la base de datos', 3);
insert into indicadores (dimension_id, nombre, ponderacion) values(5, 'Presenta plan de control de seguridad de la base de datos', 4);
insert into indicadores (dimension_id, nombre, ponderacion) values(5, 'Presenta plan de respaldos y recuperación de la base de datos', 4);
insert into indicadores (dimension_id, nombre, ponderacion) values(5, 'Presenta plan de cambios de la base de datos, para la integración de sistemas.', 2);

-- Docente de proyecto
insert into dimension (id, unidad_id, nombre, grupal) values(6,'PIPST078304_1','Evaluación Del Docente de Proyecto', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(6, 'Presenta en forma coherente el diagnóstico del proyecto instalado en la comunidad.', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(6, 'El objetivo general se relaciona con los alcances requeridos en Trayecto IV.', .5);
insert into indicadores (dimension_id, nombre, ponderacion) values(6, 'Los objetivos específicos reflejan el alcance del proyecto y se relacionan con la propuesta del objetivo general.', .5);
insert into indicadores (dimension_id, nombre, ponderacion) values(6, 'Aborda teorías y conocimientos relacionados al Trayecto respectivo y su acreditación', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(6, 'Presenta la planificación de actividades del proyecto. (Gestión de Proyecto, Base de Datos y Seguridad Informática)', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(6, 'Identifican, analizan y valoran los riesgos del proyecto con propuestas de administración, monitoreo o mitigación.', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(6, 'Presenta la evaluación de la base de datos del proyecto considerando las transacciones, la concurrencia, el volumen de crecimiento con planes de administración; además de la integración del sistema.', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(6, 'Incorpora el análisis de la seguridad física y lógica donde está ubicado el proyecto en la comunidad.', .5);
insert into indicadores (dimension_id, nombre, ponderacion) values(6, 'Describe la aplicación de métodos de cifrado al sistema con su respectivo algoritmo y establecen políticas de seguridad del proyecto de acuerdo a los resultados generados en el diagnóstico.', .5);
insert into indicadores (dimension_id, nombre, ponderacion) values(6, 'Evidencia el cumplimiento de las tareas y actividades Programadas. (Entregaron Plan de trabajo y avances del Proyecto de acuerdo a sus requerimientos).', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(6, 'Presenta de forma correcta la sistematizaciónde los Capítulos I, II y III en conjunto con las páginas preliminares, de acuerdo a los requerimientos exigidos', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(6, 'La redacción, análisis y ortografía se adecua a las características de un informe técnico.', 1);

-- seguridad informatica
insert into dimension (id, unidad_id, nombre, grupal) values(7,'PISEI078303_1','Evaluación Tecnica Individual', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(7, 'Explica como realizo el Diagnóstico sobre la Seguridad Física, Lógica, Redes y Estaciones de Trabajo, BD en proyecto.', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(7, 'Demuestra que el Algoritmo asimétrico fue el empleado según el método de cifrado seleccionado en el sistema.', 11);
insert into indicadores (dimension_id, nombre, ponderacion) values(7, 'Analiza la matriz de riesgo de seguridad.', 2);

-- --------------------- trayecto 4 fase 2 ---------------------------

-- Tutor Asesor
insert into dimension (id, unidad_id, nombre, grupal) values(8,'ASESOR4078303_2','Desempeño Individual', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(8, 'Responsabilidad', 1.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(8, 'Activo y participativo', 0.25);
insert into indicadores (dimension_id, nombre, ponderacion) values(8, 'Integración al grupo', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(8, 'Sensibilidad Social', 0.25);

insert into dimension (id, unidad_id, nombre, grupal) values(9,'ASESOR4078303_2','Desempeño Grupal', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(9, '', .5);
insert into indicadores (dimension_id, nombre, ponderacion) values(9, '', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(9, '', 1);

insert into dimension (id, unidad_id, nombre, grupal) values(10,'ASESOR4078303_2','Evaluacion Tecnica Individual', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(10, '', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(10, '', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(10, '', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(10, '', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(10, '', 2);

insert into dimension (id, unidad_id, nombre, grupal) values(11,'ASESOR4078303_2','Plan de Mantenimiento al sistema', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(11, '', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(11, '', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(11, '', 2);


-- Docente de proyecto 
insert into dimension (id, unidad_id, nombre, grupal) values(13,'PIPST078304_2','Aspectos a Evaluar en el Informe de Proyecto', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(13, 'Refleja la planificación de actividades del proyecto. Auditoría informática y plan de mantenimiento al sistema)', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(13, 'Plasma la Identificación, análisis y aplicación de la auditoría al sistema. ', 1.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(13, 'Presenta el análisis del tipo de mantenimiento que deben aplicar y resultados del plan de mantenimiento', 1.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(13, 'Se evidencia el cumplimiento de las tareas y actividades programadas. (Entregaron Plan de trabajo y avances del Proyecto de acuerdo a sus requerimientos). ', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(13, 'Presenta la sistematización de los Capítulos IV, V y VI', 1.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(13, 'Presenta las Conclusiones y Recomendaciones, Referencias y Anexos.', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(13, 'La redacción, análisis y ortografía se adecuan a las características de un informe técnico.', 1.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(13, 'Se entrega, en el tiempo indicado,  el informe final de proyecto IV con todos los requerimientos exigidos', 1);

-- Auditoria Informatica 
insert into dimension (id, unidad_id, nombre, grupal) values(14,'PIAUI078303_2','Tipo de Auditoria', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(14, 'Auditoría aplicada al sistema (Explicación del módulo auditado) Tipo de auditoría seleccionada.', 1.25);
insert into indicadores (dimension_id, nombre, ponderacion) values(14, 'Herramienta utilizada. ¿Cuál Utilizo?', 1.25);
insert into indicadores (dimension_id, nombre, ponderacion) values(14, 'Metodología y técnica empleada.', 2.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(14, 'Resultado en el sistema. (Visualizarlo).', 2.5);

insert into dimension (id, unidad_id, nombre, grupal) values(15,'PIAUI078303_2','Plan de Mantenimiento', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(15, 'Explicar  el propósito del mantenimiento', 1.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(15, 'Equipos, periféricos, servidores,  sistemas y documentación. ', 1.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(15, 'Tipo de mantenimiento. (Predictivo, correctivo, preventivo). (A corto y largo plazo). ', 1.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(15, 'Establecimiento del plan de mantenimiento Informe de resultados del Mantenimiento.', 1.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(15, 'Visualizar en el sistema cuál fue el mantenimiento aplicado.', 1.5);


-- -------------------- trayecto 3 fase 1 ---------------------------
-- TUTOR
insert into dimension (id, unidad_id, nombre, grupal) values(16,'ASESOR3078303_1','Sistema', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(16, 'Interfaz de menú amigable al usuario', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(16, 'Interfaz de inserción o captura de datos', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(16, 'Interfaz de confirmación de eliminación de datos', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(16, 'Interfaz de consultar con filtros de búsqueda', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(16, 'Demuestra conocimiento en la programación modular del Sistema', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(16, 'Modulo de reportes básicos', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(16, 'Utiliza modelo vista-controlador', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(16, 'Codifica basado en el Diseño', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(16, 'Justifica la Metodología', 1);

insert into dimension (id, unidad_id, nombre, grupal) values(17,'ASESOR3078303_1','Informe', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(17, 'Capitulo 1', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(17, 'Capitulo 2', 2);

insert into dimension (id, unidad_id, nombre, grupal) values(18,'ASESOR3078303_1','Manejo de Equipo', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(18, 'Manejo de conflictos', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(18, 'Responsabilidad', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(18, 'Hábitos de trabajo', 2);

-- INGENIERIA DEL SOFTWARE
insert into dimension (id, unidad_id, nombre, grupal) values(19,'PINGSO078303_1','Modelado del Negocio', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(19, 'Documento de Requisitos S.R.S', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(19, 'Diagramas y Plantilla IBM', 5);

insert into dimension (id, unidad_id, nombre, grupal) values(20,'PINGSO078303_1','Modelado del Sistema', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(20, 'Diagrama de Casos de Uso', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(20, 'Diagrama de Actividad', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(20, 'Descripción de casos de uso en Plantillas IBM', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(20, 'Diagrama de clase', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(20, 'Mapa Navegacional', 1);


-- Modelado de base de datos 
insert into dimension (id, unidad_id, nombre, grupal) values(21,'PIMOB078303_1','Diseño de la Base de datos', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(21, 'Modelo Entidad Relacion', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(21, 'Modelo Logico Relacional', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(21, 'Modelo Fisico', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(21, 'Utiliza postgres para el diseño fisico de la base de datos', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(21, 'Diccionario de datos', 1);

-- Docente de proyecto
insert into dimension (id, unidad_id, nombre, grupal) values(22,'PIPST078303_1','Aspectos a evaluar', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(22, 'Titulo del proyecto', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(22, 'La descripcion del diagnostico situacional', 0.75);
insert into indicadores (dimension_id, nombre, ponderacion) values(22, 'Aplica e interpreta instrumentos para el levantamiento de la niformación y captura de requisitos', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(22, 'Presenta una propuesta de solución coherente', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(22, 'Objetivo general se relaciona con la propuesta de solución', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(22, 'Objetivos especificos: reflejan el alcance del proyecto y se relacionan con la propuesta de solución del objetivo general', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(22, 'Justifica las razones para el uso de la propuesta de solución', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(22, 'El proyecto describe los procesos llevados a cabo dentro de la comunidad', 0.75);
insert into indicadores (dimension_id, nombre, ponderacion) values(22, 'Aborda teorías y conocimientos cónsonos al trayecto respectivo y su acreditación', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(22, 'Se aborda el marco legal', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(22, 'Realiza planificación de actividades del proyecto', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(22, 'Entrega a tiempo de artefactos correspondientes al diseño del sistema', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(22, 'Sistematiza Capitulo 1 y 2 del proyecto', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(22, 'Aplica normas para representar cuadros y figuras', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(22, 'Redacción, analisis y ortografia', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(22, 'Los participantes se integraron como equipo de trabajo para la resolución de conflictos', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(22, 'Los participantes aplicaron instrumentos de recolección de información', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(22, 'Los participantes cumplieron con las tareas y actividades programadas', 0.5);

-- --------------------- trayecto 3 fase 2 ------------------------------

-- TUTORA
insert into dimension (id, unidad_id, nombre, grupal) values(23,'ASESOR3078303_2','Desempeño Individual',0);
insert into indicadores (dimension_id, nombre, ponderacion) values(23, 'CRUD del sistema. (Por Modulo)', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(23, 'Validación de datos. (Por Modulo)', 1);

insert into dimension (id, unidad_id, nombre, grupal) values(24,'ASESOR3078303_2','Desempeño grupal',1);
insert into indicadores (dimension_id, nombre, ponderacion) values(24, 'Responsabilidad', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(24, 'Integración al grupo', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(24, 'proactividad', 0.5);

insert into dimension (id, unidad_id, nombre, grupal) values(25,'ASESOR3078303_2','Avances de programación (Por Modulo)', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(25, 'Instalación del software necesario para la ejecución de la aplicación o componentes', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(25, 'Pantallas bien conectadas con la Base de datos', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(25, 'Los módulos de modificación de base de datos garantizan la integridad referencial', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(25, 'Desarrollo de todos los modulos diseñados en los diagramas de casos de uso', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(25, 'Módulos acordes al Diagrama de clases', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(25, 'Funcionamiento completo de los módulos de automatización', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(25, 'Correctitud en los reportes estadisticos', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(25, 'Cumplimiento del estandar de programación entregado', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(25, 'Control de errores', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(25, 'Gestión de bitácora', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(25, 'Manejo de sesiones respecto a concurrencia de usuarios', 1);

insert into dimension (id, unidad_id, nombre, grupal) values(26,'ASESOR3078303_2','Interfaz y estilo', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(26, 'Uso adecuado de los colores en la aplicación', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(26, 'Fondos claros y sencillos', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(26, 'Uso de iamgenes', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(26, 'Distribución de la interfaz', 2);

-- Ingeniera de Software
insert into dimension (id, unidad_id, nombre, grupal) values(27,'PINGSO078303_2','Desempeño Tecnico', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(27, 'Cumple con actividades Asignadas', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(27, 'Conoce con exactitud el Sistema', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(27, 'Conoce el uso de Bitacora', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(27, 'Codifica los requerimientos dados por el docente', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(27, 'Desarrollo y programo el módulo asignado', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(27, 'Integro el módulo desarrollado', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(27, 'Planifica el proceso de Desarrollo del software', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(27, 'Identifica los escenarios y casos de prueba en el sistema', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(27, 'Detecta errores, fallas, defectos en el sistema', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(27, 'Planifica las activdades de capacitación', 1);

insert into dimension (id, unidad_id, nombre, grupal) values(28,'PINGSO078303_2','Usabilidad', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(28, 'Facilidad de uso', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(28, 'Tiempos de respuesta del sistema', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(28, 'Interactividad con el usuario', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(28, 'Ayuda al Usuario', 1);

-- -- Docente de Proyecto
insert into dimension (id, unidad_id, nombre, grupal) values(29,'PIPST078303_2','Capitulo III', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(29, 'Manual de usuario', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(29, 'Manual de Sistema', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(29, 'Plan de Pruebas', 3);
insert into indicadores (dimension_id, nombre, ponderacion) values(29, 'Plan de Instalación', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(29, 'Plan de Capacitación', 2);

insert into dimension (id, unidad_id, nombre, grupal) values(30,'PIPST078303_2','Capitulo IV', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(30, 'Recomendaciones y Evolución Previsible del sistema.', 2);

insert into dimension (id, unidad_id, nombre, grupal) values(31,'PIPST078303_2','Capitulo V', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(31, 'Anexos y Referencias', 2);

-- --------------------- trayecto 2 fase 1 ---------------------------

-- base de datos 10%
insert into dimension (id, unidad_id, nombre, grupal) values(32,'PIBAD090203_1','Diseño de la Base de Datos', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(32, 'BD contempla lo expuesto en el alcance del Sistema', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(32, 'Modelo Lógico Relacional', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(32, 'Diccionario de Datos', .5);
insert into indicadores (dimension_id, nombre, ponderacion) values(32, 'Modelo Físico', .5);

insert into dimension (id, unidad_id, nombre, grupal) values(33,'PIBAD090203_1','Diseño de la Base de Datos', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(33, 'Exporta e Importa BD', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(33, 'Explica la Estructura de Tabla (tipos de datos, clave primaria, clave foránea, integridad referencial)', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(33, 'Explica Sentencias SQL (Inserción de datos, consulta de datos de una tabla)', 2);

-- ingernia del software 10%
insert into dimension (id, unidad_id, nombre, grupal) values(34,'PIINS090203_1','Desempeño Grupal', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(34, 'Cuadro de Procesos (análisis de los instrumentos de recolección de datos)', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(34, 'Modelado del Negocio', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(34, 'Documento SRS', .5);
insert into indicadores (dimension_id, nombre, ponderacion) values(34, 'Casos de Usos del Sistema', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(34, 'Mapa de Navegación del Sistema', .5);

insert into dimension (id, unidad_id, nombre, grupal) values(35,'PIINS090203_1','Desempeño individual', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(35, 'Explica con detalle el diagrama de actividades del Negocio', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(35, 'Explica RF y RNF del sistema', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(35, 'Explica con detalle el Casos de Uso de su modulo', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(35, 'Diagrama de Actividad relacionado directamente con su modulo', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(35, 'Descripción Plantilla de procesos IBM', 1);

-- proyecto - 10%
insert into dimension (id, unidad_id, nombre, grupal) values(36,'PIPST234209_1','Desempeño Individual', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(36, 'Dominio de la información referente a la comunidad', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(36, 'Asistencia al EVA de PSTII', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(36, 'Demuestra facilidad de transmitir y dominio del tema en la presentación de su proyecto', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(36, 'Realiza Correcciones', 2);

insert into dimension (id, unidad_id, nombre, grupal) values(37,'PIPST234209_1','Desempeño Grupal', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(37, 'Capítulo I', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(37, 'Capítulo II', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(37, 'Análisis, Redacción y Ortografía del Informe', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(37, 'Aplican las Reglas APA', 1);

-- Programación II 10%
insert into dimension (id, unidad_id, nombre, grupal) values(38,'PIPRO306212_1','Prototipo', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(38, 'Integración Sistema –Casos de Usos', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(38, 'Integración Sistema –Mapa Navegación', .5);
insert into indicadores (dimension_id, nombre, ponderacion) values(38, 'Conexión con BD ( registra-consulta)', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(38, 'Alojamiento en el Servidor Web', .5);

insert into dimension (id, unidad_id, nombre, grupal) values(39,'PIPRO306212_1','Desempeño Individual', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(39, 'Analiza los RF para codificar el sistema', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(39, 'Demuestra conocimiento en la sintaxis de PHP', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(39, 'Explica el uso de clases y Objetos', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(39, 'Explica detalladamente el Patrón MVC', 1);

-- tutor asesor - 10%

insert into dimension (id, unidad_id, nombre, grupal) values(40,'ASESOR3078845_1','Desempeño Individual', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(40, 'Cumple con el Rol Analista, Diseñador y Programador de Software', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(40, 'Demuestra Conocimiento sobre la Comunidad', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(40, 'Demuestra conocimiento en cuanto al análisis de los requerimientos del sistema', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(40, 'Integración al grupo, responsabilidad y desempeño', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(40, 'Realiza Correcciones tanto del sistema como al informe.', 1);

insert into dimension (id, unidad_id, nombre, grupal) values(41,'ASESOR3078845_1','Desempeño Individual', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(41, 'Informe de Proyecto Capítulos I,II ', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(41, 'Distribución de la interfaz, uso adecuado de los colores institucionales en la aplicación (Fondos claros y sencillos)', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(41, 'Usabilidad y Navegabilidad del Sistema', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(41, 'La aplicación cumple con la necesidad de la Comunidad.', 1);



-- --------------------- trayecto 2 fase 2 ---------------------------
-- Tutor Asesor 
-- insert into dimension (id, unidad_id, nombre, grupal) values(29,'ASESOR3078845_2','Desempeño Grupal', 1);
-- insert into indicadores (dimension_id, nombre, ponderacion) values(29, 'Manejo de Conflictos', 0.5);
-- insert into indicadores (dimension_id, nombre, ponderacion) values(29, 'Proactividad', 1);
-- insert into indicadores (dimension_id, nombre, ponderacion) values(29, 'Hábitos de Trabajo', 1);

-- --------------------- trayecto 1 fase 1 ---------------------------
-- tutor 15%
insert into dimension (id, unidad_id, nombre, grupal) values(42,'ASESOR3078554_1','Desempeño Individual', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(42, 'Proactividad', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(42, 'Responsabilidad / Asesorías', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(42, 'Hábitos de trabajo', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(42, 'Integración al grupo', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(42, 'Puntualidad en la entrega de las correcciones.', 1);

insert into dimension (id, unidad_id, nombre, grupal) values(43,'ASESOR3078554_1','Evaluación Técnica Grupal', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(43, 'Presentación de los Capítulos según las normas establecidas en el manual.', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(43, 'Redacción, ortografía y lenguaje técnico.', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(43, 'El Título del Proyecto define el alcance del mismo.', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(43, 'Expone la problemática y su alternativa de solución.', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(43, 'Definen Objetivo General', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(43, 'Los Objetivos Específicos son consonó con el objetivo General.', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(43, 'Aplicación del Instrumento de Recolección de Datos en la comunidad.', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(43, 'El Cronograma de actividades refleja las tareas para el alcance de los objetivos específicos.', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(43, 'Inventario Tecnológico.', 1);

-- Docente de proyecto
insert into dimension (id, unidad_id, nombre, grupal) values(44,'PIPST548751_1','Impacto Social', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(44, 'Integración Grupal', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(44, 'Proactividad', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(44, 'Asistencia e Integración al EVA', 1);

insert into dimension (id, unidad_id, nombre, grupal) values(45,'PIPST548751_1','Desenvolvimiento de los Ponentes', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(45, 'Manejo correcto del lenguaje', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(45, 'Presentación Vocabulario Técnico adecuado', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(45, 'Manejo del tiempo adecuado', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(45, 'Uso y manejo del material', 0.5);

insert into dimension (id, unidad_id, nombre, grupal) values(46,'PIPST548751_1','Evaluación Técnica Grupal', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(46, 'Título del proyecto: presenta en forma general el tema de estudio, relacionándose con el objetivo general.', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(46, 'La descripción del diagnóstico situacional: refleja el Problema investigativo de acuerdo a las necesidades de la comunidad abordada.',0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(46, 'Aplica instrumentos para el levantamiento de la información.',0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(46, 'El objetivo general y específico: reflejan el alcance del proyecto, y se relacionan con el título y la propuesta de solución del objetivo general.',0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(46, 'Aborda la Metodología de Investigación',0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(46, 'Diseña Instrumentos de Recolección de Datos así como la interpretación de la información recaba', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(46, 'Redacción, ortografía y lenguaje técnico', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(46, 'Presentan sus referencias Bibliográficas y Electrónicas Siguiendo las Normas APA', 0.5);

-- docente arquitectura - 25%
insert into dimension (id, unidad_id, nombre, grupal) values(47,'ARQUIT1254578_1','Evaluación Técnica Individual', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(47, 'Reconoce periféricos de E/S/A del computador.', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(47, 'Reconoce los componentes Internos del computador (Tarjeta Madre, CPU, Fuente, Memorias, Puertos E/S, D.D, entre otros).', 3);
insert into indicadores (dimension_id, nombre, ponderacion) values(47, 'Conoce cómo Ensamblar y Desarmar un equipo.', 3);
insert into indicadores (dimension_id, nombre, ponderacion) values(47, 'Demuestra dominio del lenguaje técnico durante el diagnostico.', 3);
insert into indicadores (dimension_id, nombre, ponderacion) values(47, 'Detecta y corrige las fallas de hardware en una computadora.', 4);
insert into indicadores (dimension_id, nombre, ponderacion) values(47, 'Aplica normas y procedimientos para el mantenimiento preventivo de la PC.', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(47, 'Identifica y Configura la BIOS.', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(47, 'Posee Conocimiento acerca del software necesario para el uso del computador requerido por el usuario.', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(47, 'Participa en el levantamiento del Inventario Tecnológico.', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(47, 'Participa de forma activa en las Jornadas de Arquitectura del computador (Prácticas profesionales de soporte técnico)', 3);

-- Electiva I - 5%
insert into dimension (id, unidad_id, nombre, grupal) values(48,'PIELE548756_1','Desempeño Grupal', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(48, 'Diseño sitio Web Básico (etiquetas básicas, css)', 2);
insert into dimension (id, unidad_id, nombre, grupal) values(49,'PIELE548756_1','Desempeño Individual', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(49, 'Asistencia a Talleres', 3);

-- --------------------- trayecto 1 fase 2 ---------------------------

-- Electiva
insert into dimension (id, unidad_id, nombre, grupal) values(50,'PIELE548756_2','Evaluación Técnica Individual', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(50, 'Creatividad en el Diseño (colores, imágenes, textos, cuadros entre otros)', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(50, 'Dominio de HTML5', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(50, 'Aplicación de Atributos Responsive', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(50, 'Aplicación de menú desplegable', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(50, 'Dominio de clases e identificadores', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(50, 'Diseña Maquetación Web Aplicación de header, nav, footer y section', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(50, 'Dominio de uso de atributos CSS3 y media-min y media-max CSS3', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(50, 'Diseña Formularios con diferentes tipos de elementos', 2);

-- Proyecto - 10%
insert into dimension (id, unidad_id, nombre, grupal) values(51,'PIPST548751_2','Evaluación Técnica Individual', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(51, 'Responsabilidad y Proactividad', 2);
insert into dimension (id, unidad_id, nombre, grupal) values(52,'PIPST548751_2','Exposición', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(52, 'Se presenta adecuadamente, señala el tema a exponer y viste de manera adecuada', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(52, 'Se expresa con claridad, firmeza y precisión', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(52, 'Demuestra Dominio en el desarrollo del Tema', 2);
insert into dimension (id, unidad_id, nombre, grupal) values(53,'PIPST548751_2','Desempeño Grupal Informe', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(53, 'Presenta Conclusiones y Recomendaciones según el desarrollo del Proyecto', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(53, 'Las bases teóricas están bien fundamentadas en la propuesta presentada.', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(53, 'Describen el Impacto Social del Proyecto para la comunidad', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(53, 'Redacción, ortografía , lenguaje técnico y aplicación de las normas APA', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(53, 'Presentación de Referencias Bibliográficas y electrónicas', 1);

-- docente arquitectura - 10%
insert into dimension (id, unidad_id, nombre, grupal) values(54,'ARQUIT1254578_1','Evaluación Técnica Individual', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(54, 'Instala sistemas operativos libres y propietarios en la computadora', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(54, 'Configurar driver y paquetes de instalación básicos luego de instalar el sistema operativo', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(54, 'Aplica normas y procedimientos para el mantenimiento preventivo de la Computadora', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(54, 'Reconoce y detecta las fallas de Hardware y software de un PC', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(54, 'Resuelve las fallas de Hardware y software detectadas.', 2);

-- TUTOR
insert into dimension (id, unidad_id, nombre, grupal) values(55,'ASESOR3078554_2','Evaluación Técnica del Plan de Soporte Técnico a Equipos y Usuarios', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(55, '', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(55, '', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(55, '', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(55, '', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(55, '', 0.5);
insert into indicadores (dimension_id, nombre, ponderacion) values(55, '', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(55, '', 1);

insert into dimension (id, unidad_id, nombre, grupal) values(56,'ASESOR3078554_2','Evaluación Técnica Grupal', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(56, '', .5);
insert into indicadores (dimension_id, nombre, ponderacion) values(56, '', .5);
insert into indicadores (dimension_id, nombre, ponderacion) values(56, '', 2);
insert into indicadores (dimension_id, nombre, ponderacion) values(56, '', 2);

-- Proyecto


-- 9_clases.sql

delete from inscripcion where true;
-- delete from clase where true;
-- actividades acrediables fase 1
-- prof: hermes 

-- fase 2
-- insert into inscripcion (profesor_id, seccion_id, unidad_curricular_id, estudiante_id) values ('p-23154875', 'IN4401', 'PIACA078303_2', 'e-15408');
-- insert into inscripcion (profesor_id, seccion_id, unidad_curricular_id, estudiante_id) values ('p-23154875', 'IN4401', 'PIACA078303_2', 'e-63578');
-- insert into inscripcion (profesor_id, seccion_id, unidad_curricular_id, estudiante_id) values ('p-23154875', 'IN4401', 'PIACA078303_2', 'e-39263');

-- administración de base de datos
insert into inscripcion (profesor_id, seccion_id, unidad_curricular_id, estudiante_id) values ('p-654854354', 'IN4401', 'PIABD078303_1', 'e-15408');
insert into inscripcion (profesor_id, seccion_id, unidad_curricular_id, estudiante_id) values ('p-654854354', 'IN4401', 'PIABD078303_1', 'e-63578');
insert into inscripcion (profesor_id, seccion_id, unidad_curricular_id, estudiante_id) values ('p-654854354', 'IN4401', 'PIABD078303_1', 'e-39263');

-- gestión de proyecto informatico
insert into inscripcion (profesor_id, seccion_id, unidad_curricular_id, estudiante_id) values ('p-234565423','IN4401', 'PIGPI078303_1', 'e-15408');
insert into inscripcion (profesor_id, seccion_id, unidad_curricular_id, estudiante_id) values ('p-234565423','IN4401', 'PIGPI078303_1', 'e-63578');
insert into inscripcion (profesor_id, seccion_id, unidad_curricular_id, estudiante_id) values ('p-234565423','IN4401', 'PIGPI078303_1', 'e-39263');

-- idiomas II
-- insert into inscripcion (profesor_id, seccion_id, unidad_curricular_id, estudiante_id) values ('p-52213548','IN4401', 'PIIDI078303_1', 'e-15408');
-- insert into inscripcion (profesor_id, seccion_id, unidad_curricular_id, estudiante_id) values ('p-52213548','IN4401', 'PIIDI078303_1', 'e-63578');
-- insert into inscripcion (profesor_id, seccion_id, unidad_curricular_id, estudiante_id) values ('p-52213548','IN4401', 'PIIDI078303_1', 'e-39263');

-- Seguridad Informatica
insert into inscripcion (profesor_id, seccion_id, unidad_curricular_id, estudiante_id) values ('p-5428468','IN4401', 'PISEI078303_1', 'e-15408');
insert into inscripcion (profesor_id, seccion_id, unidad_curricular_id, estudiante_id) values ('p-5428468','IN4401', 'PISEI078303_1', 'e-63578');
insert into inscripcion (profesor_id, seccion_id, unidad_curricular_id, estudiante_id) values ('p-5428468','IN4401', 'PISEI078303_1', 'e-39263');

-- 10_proyectos.sql
delete from integrante_proyecto where true;
delete from proyecto where true;
delete from parroquias where true;
delete from municipios where true;

insert into municipios(id,nombre) values (1, 'Iribarren');
insert into parroquias(id,municipio,nombre) values (1,1, 'Ana Soto');
insert into parroquias(id,municipio,nombre) values (2,1, 'Santa Rosa');
insert into parroquias(id,municipio,nombre) values (3,1, 'Tamaca');
insert into parroquias(id,municipio,nombre) values (4,1, 'Catedral');
insert into parroquias(id,municipio,nombre) values (5,1, 'Concepción');
insert into parroquias(id,municipio,nombre) values (6,1, 'El Cují');
insert into parroquias(id,municipio,nombre) values (7,1, 'Buena Vista');
insert into parroquias(id,municipio,nombre) values (8,1, 'Aguedo Felipe Alvarado');
insert into parroquias(id,municipio,nombre) values (9,1, 'Unión');

insert into municipios(id,nombre) values (2, 'Jiménez');
insert into parroquias(id,municipio,nombre) values (10,2, 'Coronel Mariano Peraza');
insert into parroquias(id,municipio,nombre) values (11,2, 'Juan Bautista Rodríguez');
insert into parroquias(id,municipio,nombre) values (12,2, 'Cuara');
insert into parroquias(id,municipio,nombre) values (13,2, 'Diego de Lozada');
insert into parroquias(id,municipio,nombre) values (14,2, 'Paraíso de San José');
insert into parroquias(id,municipio,nombre) values (15,2, 'San Miguel');
insert into parroquias(id,municipio,nombre) values (16,2, 'Tintorero');
insert into parroquias(id,municipio,nombre) values (17,2, 'José Bernardo Dorante');

insert into sector_consejo_comunal(id, parroquia_id, nombre) VALUES (1, 1, 'Eje 1');

insert into consejo_comunal(id, nombre, nombre_vocero, telefono, sector_id) VALUES (1, 'Consejo Comunal Pueblo Nuevo', 'Carlos Ramirez', 0426545456, 1);

insert into sector_consejo_comunal(id, parroquia_id, nombre) VALUES (2, 4, 'Eje 3');

insert into consejo_comunal(id, nombre, nombre_vocero, telefono, sector_id) VALUES (2, 'Consejo Comunal Concordia', 'Angela', 0426545456, 2);


-- TRAYECTO 4 PROYECTO GESTION DE PROYECTOS
insert into proyecto (
  id, 
  fase_id, 
  parroquia_id, 
  nombre, 
  comunidad, 
  motor_productivo, 
  resumen, 
  direccion, 
  consejo_comunal_id,
  tutor_in,
  tutor_ex,
  tlf_tin,
  tlf_tex,
  cerrado,
  estatus
)
values (
  1,
  'TR1_1', 
  1,
  'Gestion de proyectos sociotecnologicos', 
  'UPTAEB', 
  'Informática', 
  'Gestión de proyectos para el PNF en informática', 
  'Av. Los Horcones, Av. La Salle, Barquisimeto 3001, Lara', 
  1,
  'p-135482354',
  'Jose Sequera',  
  '041254875',  
  '041255478',   
  0,
  1);
insert into integrante_proyecto (proyecto_id, estudiante_id) values (1,'e-15408');
insert into integrante_proyecto (proyecto_id, estudiante_id) values (1,'e-63578');
insert into integrante_proyecto (proyecto_id, estudiante_id) values (1,'e-39263');

-- TRAYECTO 4 PROYECTO LA ROCA
-- insert into proyecto (id, fase_id, nombre, comunidad, area, motor_productivo, resumen, direccion, municipio, parroquia)
-- values (2,'TR3_1', 'La Roca', 'Iglesia', '','','','','','');
-- insert into integrante_proyecto (proyecto_id, estudiante_id) values (2,'e-60621');
-- insert into integrante_proyecto (proyecto_id, estudiante_id) values (2,'e-61587');

INSERT INTO `pregunta` (`id`, `pregunta` ) VALUES (NULL, 'Nombre de tu mascota?'), (NULL, 'Donde estudiaste?'), (NULL, 'Color favorito?');
INSERT INTO `respuestas` (`id`, `respuesta`, `pregunta_id`, `usuario_id`) VALUES (NULL, 'onix', '1', '1'), (NULL, 'juan jose landaeta', '2', '1'), (NULL, 'azul', '3', '1');
-- vistas
DROP VIEW IF EXISTS detalles_inscripciones;
CREATE VIEW detalles_inscripciones AS
SELECT 
  inscripcion.id as id_inscripcion, 
  inscripcion.seccion_id, 
  inscripcion.unidad_curricular_id, 
  estudiante.id as estudiante_id, 
  persona.cedula, 
  CONCAT(persona.nombre,' ',persona.apellido)  as nombre_estudiante, 
  materias.codigo as codigo_materia, 
  materias.nombre as nombre_materia, 
  fase.nombre as nombre_fase,
  round(sum(inscripcion.calificacion),2) as calificacion
FROM `estudiante`
INNER JOIN persona ON persona.cedula = estudiante.persona_id 
INNER JOIN inscripcion ON inscripcion.estudiante_id = estudiante.id 
INNER JOIN malla_curricular on malla_curricular.codigo = inscripcion.unidad_curricular_id
INNER JOIN materias ON materias.codigo = malla_curricular.materia_id
INNER JOIN fase ON fase.codigo = malla_curricular.fase_id
GROUP BY persona.cedula, materias.codigo;

DROP VIEW IF EXISTS detalles_inscripciones_malla;
CREATE VIEW detalles_inscripciones_malla AS
SELECT 
  inscripcion.id as id_inscripcion, 
  inscripcion.seccion_id, 
  inscripcion.unidad_curricular_id, 
  estudiante.id as estudiante_id, 
  persona.cedula, 
  CONCAT(persona.nombre,' ',persona.apellido)  as nombre_estudiante, 
  materias.codigo as codigo_materia, 
  materias.nombre as nombre_materia, 
  fase.nombre as nombre_fase,
  round(sum(inscripcion.calificacion),2) as calificacion
FROM `estudiante`
INNER JOIN persona ON persona.cedula = estudiante.persona_id 
INNER JOIN inscripcion ON inscripcion.estudiante_id = estudiante.id 
INNER JOIN malla_curricular on malla_curricular.codigo = inscripcion.unidad_curricular_id
INNER JOIN materias ON materias.codigo = malla_curricular.materia_id
INNER JOIN fase ON fase.codigo = malla_curricular.fase_id
GROUP BY persona.cedula, inscripcion.unidad_curricular_id ;

DROP VIEW IF EXISTS detalles_estudiantes;
CREATE VIEW detalles_estudiantes AS
SELECT 
  estudiante.id, 
  persona.*, 
  usuario.email, 
  count(detalles_inscripciones.id_inscripcion) as clases, 
  detalles_inscripciones.seccion_id, 
  integrante_proyecto.id as integrante_id,
  integrante_proyecto.proyecto_id,
  trayecto.codigo as trayecto_id
FROM persona
INNER JOIN estudiante ON estudiante.persona_id = persona.cedula
LEFT JOIN usuario ON usuario.id = persona.usuario_id
LEFT JOIN detalles_inscripciones ON detalles_inscripciones.id_inscripcion = estudiante.id
LEFT JOIN integrante_proyecto ON integrante_proyecto.estudiante_id = estudiante.id
LEFT JOIN seccion ON seccion.codigo = detalles_inscripciones.seccion_id
LEFT JOIN trayecto ON trayecto.codigo = seccion.trayecto_id
GROUP BY persona.cedula, detalles_inscripciones.seccion_id;


DROP VIEW IF EXISTS estudiantes_pendientes_a_proyecto;
CREATE VIEW estudiantes_pendientes_a_proyecto AS
select *  from detalles_estudiantes de  where de.id not in (select estudiante_id from integrante_proyecto ip);

DROP VIEW IF EXISTS detalles_profesores;
CREATE VIEW detalles_profesores AS
SELECT profesor.codigo, persona.*, usuario.email
FROM persona
INNER JOIN profesor ON profesor.persona_id = persona.cedula
LEFT JOIN usuario ON usuario.id = persona.usuario_id;

DROP VIEW IF EXISTS detalles_trayecto;
CREATE VIEW detalles_trayecto AS
SELECT trayecto.*, periodo.fecha_inicio, periodo.fecha_cierre
FROM trayecto
INNER JOIN periodo ON periodo.id = trayecto.periodo_id;

DROP VIEW IF EXISTS detalles_seccion;
CREATE VIEW detalles_seccion AS
SELECT seccion.*, trayecto.nombre as trayecto
FROM seccion
INNER JOIN trayecto ON trayecto.codigo = seccion.trayecto_id;

DROP VIEW IF EXISTS detalles_dimension;
CREATE VIEW detalles_dimension AS
SELECT dimension.*, materias.codigo as codigo_materia,materias.nombre as nombre_materia, fase.nombre as nombre_fase, fase.codigo as codigo_fase, trayecto.nombre as nombre_trayecto, trayecto.codigo as codigo_trayecto, round(SUM(indicadores.ponderacion),2) as ponderacion_items
FROM dimension
INNER JOIN malla_curricular ON malla_curricular.codigo = dimension.unidad_id
INNER JOIN fase ON fase.codigo = malla_curricular.fase_id 
INNER JOIN trayecto ON trayecto.codigo = fase.trayecto_id 
INNER JOIN materias ON  materias.codigo = malla_curricular.materia_id
LEFT JOIN indicadores ON indicadores.dimension_id = dimension.id
GROUP BY indicadores.dimension_id;

DROP VIEW IF EXISTS detalles_proyecto;
CREATE VIEW detalles_proyecto AS

SELECT 
  proyecto.id, 
  proyecto.fase_id, 
  proyecto.nombre, 
  proyecto.comunidad, 
  proyecto.motor_productivo, 
  proyecto.resumen, 
  proyecto.direccion, 
  cc.id as consejo_comunal_id,
  cc.nombre as nombre_consejo_comunal,
  cc.nombre_vocero as nombre_vocero_consejo_comunal,
  cc.telefono as telefono_consejo_comunal,
  scc.nombre as sector_consejo_comunal,
  municipios.nombre as municipio, 
  parroquias.nombre as parroquia, 
  parroquias.id as parroquia_id, 
  proyecto.tutor_ex,
  proyecto.tlf_tex,
  proyecto.tutor_in,
  proyecto.cerrado,
  proyecto.estatus,
  proyecto.observaciones,
  concat(tutor_info.nombre, ' ', tutor_info.apellido) as tutor_in_nombre,
  tutor_info.cedula as tutor_in_cedula,
  tutor_info.telefono as tutor_in_telefono,
  trayecto.nombre as nombre_trayecto,
  trayecto.codigo as codigo_trayecto, 
  trayecto.siguiente_trayecto as codigo_siguiente_trayecto, 
  fase.nombre as nombre_fase, 
  fase.codigo as codigo_fase, 
  count(integrante_proyecto.id) as integrantes,
  sum(CASE
    WHEN integrante_proyecto.estatus = 0 THEN 1
    ELSE 0
  END) AS reprobados,
  periodo.fecha_inicio,
  periodo.fecha_cierre
FROM proyecto
INNER JOIN fase ON fase.codigo = proyecto.fase_id 
INNER JOIN trayecto ON trayecto.codigo = fase.trayecto_id 
INNER JOIN periodo ON periodo.id = trayecto.periodo_id
INNER JOIN profesor as tutor ON tutor.codigo = proyecto.tutor_in
INNER JOIN persona as tutor_info ON tutor_info.cedula = tutor.persona_id
INNER JOIN parroquias ON parroquias.id = proyecto.parroquia_id 
INNER JOIN municipios ON municipios.id = parroquias.municipio
LEFT join consejo_comunal cc on cc.id = proyecto.consejo_comunal_id 
LEFT join sector_consejo_comunal scc on scc.id = cc.sector_id 
LEFT OUTER JOIN integrante_proyecto ON integrante_proyecto.proyecto_id = proyecto.id
GROUP BY proyecto_id;

DROP VIEW IF EXISTS detalles_materias;
CREATE VIEW detalles_materias AS
SELECT 
  trayecto.nombre as nombre_trayecto,
  trayecto.codigo as codigo_trayecto,
  materias.codigo as codigo_materia,
  materias.nombre as nombre_materia,
  fase.nombre as nombre_fase,
  fase.codigo as codigo_fase,
  materias.eje,
  materias.htasist,
  materias.htind,
  materias.ucredito,
  materias.hrs_acad,
  materias.cursable,
  count(malla_curricular.codigo) as count_malla,
  count(dimension.id) as dimensiones,
  round(sum(indicadores.ponderacion)) as ponderado,
  count(inscripcion.id) as inscripciones
FROM materias
LEFT JOIN malla_curricular on malla_curricular.materia_id = materias.codigo
INNER JOIN fase ON fase.codigo = malla_curricular.fase_id
INNER JOIN trayecto ON trayecto.codigo = fase.trayecto_id 
LEFT OUTER JOIN dimension ON dimension.unidad_id = malla_curricular.codigo
LEFT OUTER JOIN indicadores on indicadores.dimension_id = dimension.id
LEFT OUTER JOIN inscripcion ON inscripcion.unidad_curricular_id = malla_curricular.codigo

GROUP BY materias.codigo
ORDER BY codigo_trayecto;

DROP VIEW IF EXISTS detalles_integrantes;

CREATE VIEW detalles_integrantes AS
SELECT integrante_proyecto.id, proyecto.id as proyecto_id, estudiante.id as estudiante_id, proyecto.nombre as proyecto_nombre, persona.nombre, persona.apellido, persona.cedula, round(SUM(notas_integrante_proyecto.calificacion),2) as calificaciones, round(trayecto.calificacion_minima,2) as calificacion_minima_trayecto,
integrante_proyecto.estatus
FROM integrante_proyecto
INNER JOIN estudiante ON estudiante.id = integrante_proyecto.estudiante_id
INNER JOIN persona on persona.cedula = estudiante.persona_id
INNER JOIN proyecto on proyecto.id = integrante_proyecto.proyecto_id
INNER JOIN fase ON fase.codigo = proyecto.fase_id
INNER JOIN trayecto on trayecto.codigo = fase.trayecto_id
LEFT JOIN notas_integrante_proyecto ON notas_integrante_proyecto.integrante_id = integrante_proyecto.id
GROUP BY integrante_proyecto.id, notas_integrante_proyecto.integrante_id;

DROP VIEW IF EXISTS detalles_fase;

DROP VIEW IF EXISTS detalles_fase;
CREATE VIEW detalles_fase AS
SELECT 
  fase.codigo as codigo_fase, 
  fase.nombre as nombre_fase, 
  fase.siguiente_fase, 
  trayecto.codigo as codigo_trayecto, 
  trayecto.nombre as nombre_trayecto, 
  periodo.fecha_inicio, periodo.fecha_cierre,
  ROUND(SUM(indicadores.ponderacion),2) as ponderado_baremos
FROM `fase` 
INNER JOIN trayecto ON trayecto.codigo = fase.trayecto_id 
INNER JOIN periodo ON periodo.id = trayecto.periodo_id
LEFT JOIN malla_curricular ON malla_curricular.fase_id = fase.codigo
LEFT OUTER JOIN dimension ON dimension.unidad_id = malla_curricular.codigo
LEFT OUTER JOIN indicadores ON indicadores.dimension_id = dimension.id
GROUP BY fase.codigo;

DROP VIEW IF EXISTS detalles_baremos;

CREATE VIEW detalles_baremos AS
SELECT 
    indicadores.id, 
    indicadores.nombre as nombre_indicador,
    indicadores.ponderacion as ponderacion,
    indicadores.dimension_id,
    dimension.nombre as nombre_dimension,
    dimension.grupal,
    materias.codigo as codigo_materia,
    materias.nombre as nombre_materia, 
    fase.nombre as nombre_fase, 
    fase.codigo as codigo_fase, 
    trayecto.nombre as nombre_trayecto, 
    trayecto.codigo as codigo_trayecto
FROM `indicadores` 
INNER JOIN dimension ON dimension.id = indicadores.dimension_id
INNER JOIN malla_curricular ON malla_curricular.codigo = dimension.unidad_id
INNER JOIN fase ON fase.codigo = malla_curricular.fase_id 
INNER JOIN trayecto ON trayecto.codigo = fase.trayecto_id 
INNER JOIN materias ON  materias.codigo = malla_curricular.materia_id
GROUP BY indicadores.id;

DROP VIEW IF EXISTS detalles_notas_baremos;

CREATE VIEW detalles_notas_baremos AS
SELECT 
  malla_curricular.fase_id,
  fase.nombre as nombre_fase,
  persona.cedula,
  persona.nombre,
  integrante_proyecto.proyecto_id,
  integrante_proyecto.id as integrante_id,
  ROUND(sum(indicadores.ponderacion),2) as ponderado,
  ROUND(sum(nip.calificacion), 2) as calificacion,
  trayecto.calificacion_minima as calificacion_minima_trayecto
FROM notas_integrante_proyecto as nip
INNER JOIN indicadores ON indicadores.id = nip.indicador_id
INNER JOIN integrante_proyecto ON integrante_proyecto.id = nip.integrante_id
INNER JOIN estudiante ON estudiante.id = integrante_proyecto.estudiante_id
INNER JOIN persona ON persona.cedula = estudiante.persona_id
INNER JOIN dimension ON dimension.id = indicadores.dimension_id
INNER JOIN malla_curricular ON dimension.unidad_id = malla_curricular.codigo
INNER JOIN fase ON fase.codigo = malla_curricular.fase_id
INNER JOIN trayecto ON trayecto.codigo = fase.trayecto_id
GROUP BY persona.cedula, malla_curricular.fase_id;

DROP VIEW IF EXISTS detalles_malla;
CREATE VIEW detalles_malla AS
SELECT
trayecto.codigo as codigo_trayecto,
trayecto.nombre as nombre_trayecto,
materias.codigo as codigo_materia,
materias.nombre,
malla_curricular.codigo,
fase.codigo as codigo_fase,
fase.nombre as nombre_fase,
count(dimension.id) as dimensiones,
ROUND(SUM(indicadores.ponderacion),2) as ponderado_baremos
FROM malla_curricular
INNER JOIN materias ON materias.codigo =  malla_curricular.materia_id
INNER JOIN fase ON fase.codigo = malla_curricular.fase_id
INNER JOIN trayecto ON trayecto.codigo = fase.trayecto_id 
LEFT OUTER JOIN dimension ON dimension.unidad_id = malla_curricular.codigo
LEFT OUTER JOIN indicadores ON indicadores.dimension_id = dimension.id
GROUP BY malla_curricular.codigo;


DROP VIEW IF EXISTS detalles_historico_proyecto;
CREATE VIEW detalles_historico_proyecto AS
SELECT
proyecto_historico.*,
concat(persona.nombre, ' ', persona.apellido) as nombre_tutor_in,
persona.telefono as telefono_tutor_in,
round(proyecto_historico.nota_fase_1 + proyecto_historico.nota_fase_2, 2) as calificacion
FROM proyecto_historico
LEFT JOIN profesor ON profesor.codigo = proyecto_historico.tutor_in
LEFT JOIN persona on persona.cedula = profesor.persona_id
ORDER BY periodo_final DESC;

DROP VIEW IF EXISTS detalles_usuarios;
CREATE VIEW detalles_usuarios AS
SELECT u.id,u.rol_id, u.email, u.contrasena, p.nombre, p.apellido, p.cedula FROM `usuario`  as u INNER JOIN persona as p ON p.usuario_id = u.id;

DROP VIEW IF EXISTS detalles_parroquia;
CREATE VIEW detalles_parroquia AS
SELECT parroquias.id as parroquia_id, parroquias.nombre as parroquia_nombre, municipios.id as municipio_id, municipios.nombre as municipio_nombre FROM `parroquias` INNER JOIN municipios ON municipios.id = parroquias.municipio;

DROP VIEW IF EXISTS detalles_consejo_comunal;
CREATE VIEW detalles_consejo_comunal AS
select 
cc.id as consejo_comunal_id,
cc.nombre as consejo_comunal_nombre,
cc.telefono as consejo_comunal_telefono,
cc.nombre_vocero,
scc.id as sector_id,
scc.nombre  as sector_nombre,
p.id as parroquia_id,
p.nombre as parroquia_nombre,
m.nombre as municipio_nombre
from consejo_comunal cc inner join sector_consejo_comunal scc ON scc.id = cc.sector_id 
inner join parroquias p on p.id = scc.parroquia_id 
inner join municipios m on m.id = p.municipio;


DROP VIEW IF EXISTS detalles_sector;
CREATE VIEW detalles_sector AS
select 
cc.id as consejo_comunal_id,
cc.nombre as consejo_comunal_nombre,
cc.telefono as consejo_comunal_telefono,
scc.id as sector_id,
scc.nombre  as sector_nombre,
p.id as parroquia_id,
p.nombre as parroquia_nombre,
m.nombre as municipio_nombre
from consejo_comunal cc inner join sector_consejo_comunal scc ON scc.id = cc.sector_id 
inner join parroquias p on p.id = scc.parroquia_id 
inner join municipios m on m.id = p.municipio;
