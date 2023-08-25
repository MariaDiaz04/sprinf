
-- sprinf_bd.modulo definition

CREATE TABLE `modulo` (
  `modulo_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`modulo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- sprinf_bd.roles definition

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- sprinf_bd.permisos definition
-- hace referencia a roles y permisos
CREATE TABLE `permisos` (
  `idpermisos` int(11) NOT NULL AUTO_INCREMENT,
  `consultar` int(11) NOT NULL,
  `actualizar` int(1) NOT NULL,
  `crear` int(1) NOT NULL,
  `eliminar` int(1) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `modulo_id` int(11) NOT NULL,
  PRIMARY KEY (`idpermisos`),
  KEY `modulo_id` (`modulo_id`),
  CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`modulo_id`) REFERENCES `modulo` (`modulo_id`),
  CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Gestion de permisos de interaciones entre usuario  modullo';


-- hace referencia a roles

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_id` int(11) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `token` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `rol_id` (`rol_id`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- hace referencia a usuarios

CREATE TABLE `bitacora` (
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


-- Hace referencia a usuarios
CREATE TABLE `pregunta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta` varchar(75) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Hace referencia a pregunta
CREATE TABLE `respuesta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `respuesta` varchar(45) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `pregunta_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pregunta_id` (`pregunta_id`),
  CONSTRAINT `pregunta_id` FOREIGN KEY (`pregunta_id`) REFERENCES `pregunta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- sprinf_bd.persona definition
-- hace referencia a usuarios

CREATE TABLE `persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `cedula` varchar(45) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `nacimiento` varchar(45) DEFAULT NULL,
  `estatus` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_persona_usuarios1_idx` (`usuario_id`),
  CONSTRAINT `fk_persona_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- sprinf_bd.profesor definition
-- hace referencia a persona

CREATE TABLE `profesor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_profesor_persona1_idx` (`persona_id`),
  CONSTRAINT `fk_profesor_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- sprinf_bd.respuesta definition


-- sprinf_bd.tutor definition
-- hace referencia a persona

CREATE TABLE `tutor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tutor_persona1` (`persona_id`),
  CONSTRAINT `fk_tutor_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- estudiante
-- hace referencia a persona

CREATE TABLE `estudiante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_estudiante_persona1_idx` (`persona_id`),
  CONSTRAINT `fk_estudiante_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- PERIODOS
CREATE TABLE `periodos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_cierre` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- TRAYECTOS

CREATE TABLE `trayecto` (
  `id` integer UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `periodo_id` int,
  `numero_trayecto` string,
  `estatus` int
);
ALTER TABLE `trayecto` ADD FOREIGN KEY (`periodo_id`) REFERENCES `periodo` (`id`);

-- SECCIONES
-- hace referencia a trayecto
CREATE TABLE `secciones` (
  `id` integer,
  `trayecto_id` int,
  `codigo_seccion` string,
  `OBS` string
);
ALTER TABLE `secciones` ADD FOREIGN KEY (`trayecto_id`) REFERENCES `trayecto` (`id`);

-- config sistema
--  hace referencia a trayecto
CREATE TABLE `config_sistema` (
  `periodo_actual` int
);
ALTER TABLE `config_sistema` ADD FOREIGN KEY (`periodo_actual`) REFERENCES `periodo` (`id`);


CREATE TABLE `materias` (
  `codigo` varchar(255) UNIQUE PRIMARY KEY,
  `nombre` varchar(255),
  `trayecto` int,
  `periodo` ENUM ('fase_1', 'fase_2', 'anual'),
  `vinculacion` int,
  `htasist` int,
  `htind` int,
  `ucredito` int,
  `hrs_acad` int,
  `eje` varchar(255)
);


CREATE TABLE `dimension` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `evaluador` varchar(255),
  `nombre` varchar(255),
  `trayecto` int,
  `fase` ENUM ('1', '2'),
  `individual` bool
);

CREATE TABLE `items` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `dimension_id` int,
  `ponderacion` float
);
ALTER TABLE `items` ADD FOREIGN KEY (`dimension_id`) REFERENCES `dimension` (`id`);



-- #####################################################################################
-- DATA DUMP
-- DATA DUMP
-- DATA DUMP
-- DATA DUMP
-- #####################################################################################



-- ROLES

INSERT INTO sprinf_bd.roles (nombre) VALUES
	 ('administrador'),
	 ('profesor'),
	 ('coordinador'),
	 ('estudiante');

-- MODULOS

INSERT INTO sprinf_bd.modulo (nombre) VALUES
	 ('Proyecto');


-- PERMISOS

INSERT INTO sprinf_bd.permisos (consultar,actualizar,crear,eliminar,rol_id,modulo_id) VALUES
	 (1,1,1,1,1,1);

-- USUARIOS

INSERT INTO sprinf_bd.usuarios (rol_id,email,contrasena,token) VALUES
	 (1,'root@gmail.com','$2y$10$M29XwSiuLE.N3nj0RzbgqO4myQffclHtXMhP3OzVXM6VbdvXv4PH6','6c565914de83fa213f8c926420f75f9f9744bbf4f365db18be05581d5699302f'),
	 (3,'ligia@gmail.com','$2y$10$Psu0XjJME.erxJAAPoFS7u8e9p7VFGhUx.HWJDUtXDXcYw/vogVUa','8fd286b2ea661b2a24a9bb058b6faf43fc1df023bedf256325f8056514799ac8'),
	 (3,'lisset@gmail.com','$2y$10$Psu0XjJME.erxJAAPoFS7u8e9p7VFGhUx.HWJDUtXDXcYw/vogVUa','8fd286b2ea661b2a24a9bb058b6faf43fc1df023bedf256325f8056514799ac8'),
	 (3,'orlando@gmail.com','$2y$10$Psu0XjJME.erxJAAPoFS7u8e9p7VFGhUx.HWJDUtXDXcYw/vogVUa','8fd286b2ea661b2a24a9bb058b6faf43fc1df023bedf256325f8056514799ac8'),
	 (3,'ingrid@gmail.com','$2y$10$Psu0XjJME.erxJAAPoFS7u8e9p7VFGhUx.HWJDUtXDXcYw/vogVUa','8fd286b2ea661b2a24a9bb058b6faf43fc1df023bedf256325f8056514799ac8'),
	 (3,'pura@gmail.com','$2y$10$Psu0XjJME.erxJAAPoFS7u8e9p7VFGhUx.HWJDUtXDXcYw/vogVUa','8fd286b2ea661b2a24a9bb058b6faf43fc1df023bedf256325f8056514799ac8'),
	 (3,'miguel@gmail.com','$2y$10$Psu0XjJME.erxJAAPoFS7u8e9p7VFGhUx.HWJDUtXDXcYw/vogVUa','8fd286b2ea661b2a24a9bb058b6faf43fc1df023bedf256325f8056514799ac8'),
	 (3,'jose@gmail.com','$2y$10$Psu0XjJME.erxJAAPoFS7u8e9p7VFGhUx.HWJDUtXDXcYw/vogVUa','8fd286b2ea661b2a24a9bb058b6faf43fc1df023bedf256325f8056514799ac8'),
	 (3,'carlos@gmail.com','$2y$10$Psu0XjJME.erxJAAPoFS7u8e9p7VFGhUx.HWJDUtXDXcYw/vogVUa','8fd286b2ea661b2a24a9bb058b6faf43fc1df023bedf256325f8056514799ac8'),
	 (3,'maria@gmail.com','$2y$10$Psu0XjJME.erxJAAPoFS7u8e9p7VFGhUx.HWJDUtXDXcYw/vogVUa','8fd286b2ea661b2a24a9bb058b6faf43fc1df023bedf256325f8056514799ac8');
INSERT INTO sprinf_bd.usuarios (rol_id,email,contrasena,token) VALUES
	 (3,'pedro@gmail.com','$2y$10$Psu0XjJME.erxJAAPoFS7u8e9p7VFGhUx.HWJDUtXDXcYw/vogVUa','8fd286b2ea661b2a24a9bb058b6faf43fc1df023bedf256325f8056514799ac8'),
	 (3,'pablo@gmail.com','$2y$10$Psu0XjJME.erxJAAPoFS7u8e9p7VFGhUx.HWJDUtXDXcYw/vogVUa','8fd286b2ea661b2a24a9bb058b6faf43fc1df023bedf256325f8056514799ac8'),
	 (3,'jesus@gmail.com','$2y$10$Psu0XjJME.erxJAAPoFS7u8e9p7VFGhUx.HWJDUtXDXcYw/vogVUa','8fd286b2ea661b2a24a9bb058b6faf43fc1df023bedf256325f8056514799ac8'),
	 (3,'carla@gmail.com','$2y$10$Psu0XjJME.erxJAAPoFS7u8e9p7VFGhUx.HWJDUtXDXcYw/vogVUa','8fd286b2ea661b2a24a9bb058b6faf43fc1df023bedf256325f8056514799ac8'),
	 (2,'tillero@gmail.com','$2y$10$Psu0XjJME.erxJAAPoFS7u8e9p7VFGhUx.HWJDUtXDXcYw/vogVUa','8fd286b2ea661b2a24a9bb058b6faf43fc1df023bedf256325f8056514799ac8'),
	 (2,'usuario@gmail.com','$2y$10$4KHW9IUXghqiJtC0UzaIxOhxZWEypvgPz9aP8A5kjndb9JWg468Iq',''),
	 (4,'sadfsda@gmail.com','$2y$10$l5CJk5MgGFN9fU246ZlC4OUG9ZC4eYitvsvR9hVqNV0HZtmxflACe','');

-- PERSONA

   INSERT INTO sprinf_bd.persona (usuario_id,cedula,nombre,apellido,direccion,telefono,nacimiento,estatus) VALUES
	 (1,'548745','Root','root','uptaeb','424555555','01-01-2000','1'),
	 (2,'454851','Ligia','','uptaeb','424555555','01-01-2000','1'),
	 (3,'454851','Lisset','','uptaeb','424555555','01-01-2000','1'),
	 (4,'454851','Orlando','','uptaeb','424555555','01-01-2000','1'),
	 (5,'454851','Ingrid','Figeroa','uptaeb','424555555','01-01-2000','1'),
	 (6,'454851','Pura','Castillo','uptaeb','424555555','01-01-2000','1'),
	 (7,'454851','Miguel','Figeroa','uptaeb','424555555','01-01-2000','1'),
	 (8,'454851','Jose','Figeroa','uptaeb','424555555','01-01-2000','1'),
	 (9,'454851','Carlos','Figeroa','uptaeb','424555555','01-01-2000','1'),
	 (10,'454851','Maria','Figeroa','uptaeb','424555555','01-01-2000','1');
INSERT INTO sprinf_bd.persona (usuario_id,cedula,nombre,apellido,direccion,telefono,nacimiento,estatus) VALUES
	 (11,'454851','Pedro','Figeroa','uptaeb','424555555','01-01-2000','1'),
	 (12,'454851','Pablo','Figeroa','uptaeb','424555555','01-01-2000','1'),
	 (13,'454851','Jesus','Figeroa','uptaeb','424555555','01-01-2000','1'),
	 (14,'454851','Carla','Figeroa','uptaeb','424555555','01-01-2000','1'),
	 (15,'454851','Ricardo','Tillero','uptaeb','424555555','01-01-2000','1'),
	 (16,'23423','sfsdf','sadfasd','fasdfa','123123','2023-07-19','1'),
	 (17,'324234','sadfa','sdfasdfsad','dfsad','213213213','2023-07-15','1');

