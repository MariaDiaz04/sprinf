-- MySQL dump 10.13  Distrib 8.0.35, for Linux (x86_64)
--
-- Host: localhost    Database: sprinf_bd
-- ------------------------------------------------------
-- Server version	8.0.35-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bitacora` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `fecha` date NOT NULL,
  `navegador` varchar(105) COLLATE utf8mb4_general_ci NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_cierre` time DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `apellido` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(85) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_bitacora_usuario1_idx` (`usuario_id`),
  CONSTRAINT `fk_bitacora_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacora`
--

LOCK TABLES `bitacora` WRITE;
/*!40000 ALTER TABLE `bitacora` DISABLE KEYS */;
INSERT INTO `bitacora` VALUES (1,1,'2023-11-20','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0\n\n','16:35:42',NULL,'Admin','admin','f947384a5aad9ac2b041ec5d4fcbcca374c3bfc3f561b25a610f67dbf11f4db4'),(2,1,'2023-11-21','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0\n\n','20:05:20',NULL,'Admin','admin','b38a31e7781294bfcf9dba771aa41c98b06e95653e51c7e6fa510769661ef0ee'),(3,1,'2023-11-21','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0\n\n','09:57:34',NULL,'Admin','admin','f6cb1ab74bf09c2088a75aadb59c4256eac4425890d2931c7bffe4c52dbde06a'),(4,1,'2023-11-21','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0\n\n','09:58:24',NULL,'Admin','admin','63fa669da5d37e0da82d13a432b35eb4dedbaba24f0a54d89aa39d1a81f08939'),(5,1,'2023-11-22','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0\n\n','23:42:40',NULL,'Admin','admin','2906972227c1d44c4a090730d4b36fe4218c1829f9edb4ce98a6a52e30305f60'),(6,1,'2023-11-22','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0\n\n','06:19:45',NULL,'Admin','admin','7c2c9073134a1b36e8e473bae5fe3cdb7aa75d2f1f932eea85e201926ba87d72'),(7,1,'2023-11-22','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0\n\n','07:51:38',NULL,'Admin','admin','9150c585e034fa5d752fbf4870b9601fd6fdf8f9a9b8d2eed90275414d8d5423');
/*!40000 ALTER TABLE `bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consejo_comunal`
--

DROP TABLE IF EXISTS `consejo_comunal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `consejo_comunal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `nombre_vocero` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `sector_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `sector_id` (`sector_id`),
  CONSTRAINT `consejo_comunal_ibfk_1` FOREIGN KEY (`sector_id`) REFERENCES `sector_consejo_comunal` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consejo_comunal`
--

LOCK TABLES `consejo_comunal` WRITE;
/*!40000 ALTER TABLE `consejo_comunal` DISABLE KEYS */;
INSERT INTO `consejo_comunal` VALUES (1,'Consejo Comunal Pueblo Nuevo','Carlos Ramirez','426545456',1),(2,'Consejo Comunal Concordia','Angela','426545456',2);
/*!40000 ALTER TABLE `consejo_comunal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `detalles_baremos`
--

DROP TABLE IF EXISTS `detalles_baremos`;
/*!50001 DROP VIEW IF EXISTS `detalles_baremos`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `detalles_baremos` AS SELECT 
 1 AS `id`,
 1 AS `nombre_indicador`,
 1 AS `ponderacion`,
 1 AS `dimension_id`,
 1 AS `nombre_dimension`,
 1 AS `grupal`,
 1 AS `codigo_materia`,
 1 AS `nombre_materia`,
 1 AS `nombre_fase`,
 1 AS `codigo_fase`,
 1 AS `nombre_trayecto`,
 1 AS `codigo_trayecto`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `detalles_consejo_comunal`
--

DROP TABLE IF EXISTS `detalles_consejo_comunal`;
/*!50001 DROP VIEW IF EXISTS `detalles_consejo_comunal`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `detalles_consejo_comunal` AS SELECT 
 1 AS `consejo_comunal_id`,
 1 AS `consejo_comunal_nombre`,
 1 AS `consejo_comunal_telefono`,
 1 AS `nombre_vocero`,
 1 AS `sector_id`,
 1 AS `sector_nombre`,
 1 AS `parroquia_id`,
 1 AS `parroquia_nombre`,
 1 AS `municipio_nombre`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `detalles_dimension`
--

DROP TABLE IF EXISTS `detalles_dimension`;
/*!50001 DROP VIEW IF EXISTS `detalles_dimension`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `detalles_dimension` AS SELECT 
 1 AS `id`,
 1 AS `unidad_id`,
 1 AS `nombre`,
 1 AS `grupal`,
 1 AS `codigo_materia`,
 1 AS `nombre_materia`,
 1 AS `nombre_fase`,
 1 AS `codigo_fase`,
 1 AS `nombre_trayecto`,
 1 AS `codigo_trayecto`,
 1 AS `ponderacion_items`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `detalles_estudiantes`
--

DROP TABLE IF EXISTS `detalles_estudiantes`;
/*!50001 DROP VIEW IF EXISTS `detalles_estudiantes`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `detalles_estudiantes` AS SELECT 
 1 AS `id`,
 1 AS `cedula`,
 1 AS `usuario_id`,
 1 AS `nombre`,
 1 AS `apellido`,
 1 AS `direccion`,
 1 AS `telefono`,
 1 AS `estatus`,
 1 AS `email`,
 1 AS `clases`,
 1 AS `seccion_id`,
 1 AS `integrante_id`,
 1 AS `proyecto_id`,
 1 AS `trayecto_id`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `detalles_fase`
--

DROP TABLE IF EXISTS `detalles_fase`;
/*!50001 DROP VIEW IF EXISTS `detalles_fase`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `detalles_fase` AS SELECT 
 1 AS `codigo_fase`,
 1 AS `nombre_fase`,
 1 AS `siguiente_fase`,
 1 AS `codigo_trayecto`,
 1 AS `nombre_trayecto`,
 1 AS `fecha_inicio`,
 1 AS `fecha_cierre`,
 1 AS `ponderado_baremos`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `detalles_historico_proyecto`
--

DROP TABLE IF EXISTS `detalles_historico_proyecto`;
/*!50001 DROP VIEW IF EXISTS `detalles_historico_proyecto`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `detalles_historico_proyecto` AS SELECT 
 1 AS `id`,
 1 AS `id_proyecto`,
 1 AS `consejo_comunal_id`,
 1 AS `codigo_trayecto`,
 1 AS `codigo_siguiente_trayecto`,
 1 AS `nombre_estudiante`,
 1 AS `cedula_estudiante`,
 1 AS `nombre_proyecto`,
 1 AS `nombre_trayecto`,
 1 AS `resumen`,
 1 AS `direccion`,
 1 AS `comunidad`,
 1 AS `motor_productivo`,
 1 AS `nombre_consejo_comunal`,
 1 AS `nombre_vocero_consejo_comunal`,
 1 AS `telefono_consejo_comunal`,
 1 AS `sector_consejo_comunal`,
 1 AS `municipio`,
 1 AS `parroquia_id`,
 1 AS `parroquia`,
 1 AS `observaciones`,
 1 AS `tutor_in`,
 1 AS `tutor_ex`,
 1 AS `tlf_tex`,
 1 AS `nota_fase_1`,
 1 AS `nota_fase_2`,
 1 AS `estatus`,
 1 AS `periodo_inicio`,
 1 AS `periodo_final`,
 1 AS `nombre_tutor_in`,
 1 AS `telefono_tutor_in`,
 1 AS `calificacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `detalles_inscripciones`
--

DROP TABLE IF EXISTS `detalles_inscripciones`;
/*!50001 DROP VIEW IF EXISTS `detalles_inscripciones`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `detalles_inscripciones` AS SELECT 
 1 AS `id_inscripcion`,
 1 AS `seccion_id`,
 1 AS `unidad_curricular_id`,
 1 AS `estudiante_id`,
 1 AS `cedula`,
 1 AS `nombre_estudiante`,
 1 AS `codigo_materia`,
 1 AS `nombre_materia`,
 1 AS `nombre_fase`,
 1 AS `calificacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `detalles_inscripciones_malla`
--

DROP TABLE IF EXISTS `detalles_inscripciones_malla`;
/*!50001 DROP VIEW IF EXISTS `detalles_inscripciones_malla`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `detalles_inscripciones_malla` AS SELECT 
 1 AS `id_inscripcion`,
 1 AS `seccion_id`,
 1 AS `unidad_curricular_id`,
 1 AS `estudiante_id`,
 1 AS `cedula`,
 1 AS `nombre_estudiante`,
 1 AS `codigo_materia`,
 1 AS `nombre_materia`,
 1 AS `nombre_fase`,
 1 AS `calificacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `detalles_integrantes`
--

DROP TABLE IF EXISTS `detalles_integrantes`;
/*!50001 DROP VIEW IF EXISTS `detalles_integrantes`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `detalles_integrantes` AS SELECT 
 1 AS `id`,
 1 AS `proyecto_id`,
 1 AS `estudiante_id`,
 1 AS `proyecto_nombre`,
 1 AS `nombre`,
 1 AS `apellido`,
 1 AS `cedula`,
 1 AS `calificaciones`,
 1 AS `calificacion_minima_trayecto`,
 1 AS `estatus`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `detalles_malla`
--

DROP TABLE IF EXISTS `detalles_malla`;
/*!50001 DROP VIEW IF EXISTS `detalles_malla`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `detalles_malla` AS SELECT 
 1 AS `codigo_trayecto`,
 1 AS `nombre_trayecto`,
 1 AS `codigo_materia`,
 1 AS `nombre`,
 1 AS `codigo`,
 1 AS `codigo_fase`,
 1 AS `nombre_fase`,
 1 AS `dimensiones`,
 1 AS `ponderado_baremos`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `detalles_materias`
--

DROP TABLE IF EXISTS `detalles_materias`;
/*!50001 DROP VIEW IF EXISTS `detalles_materias`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `detalles_materias` AS SELECT 
 1 AS `nombre_trayecto`,
 1 AS `codigo_trayecto`,
 1 AS `codigo_materia`,
 1 AS `nombre_materia`,
 1 AS `nombre_fase`,
 1 AS `codigo_fase`,
 1 AS `eje`,
 1 AS `htasist`,
 1 AS `htind`,
 1 AS `ucredito`,
 1 AS `hrs_acad`,
 1 AS `cursable`,
 1 AS `count_malla`,
 1 AS `dimensiones`,
 1 AS `ponderado`,
 1 AS `inscripciones`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `detalles_notas_baremos`
--

DROP TABLE IF EXISTS `detalles_notas_baremos`;
/*!50001 DROP VIEW IF EXISTS `detalles_notas_baremos`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `detalles_notas_baremos` AS SELECT 
 1 AS `fase_id`,
 1 AS `nombre_fase`,
 1 AS `cedula`,
 1 AS `nombre`,
 1 AS `proyecto_id`,
 1 AS `integrante_id`,
 1 AS `ponderado`,
 1 AS `calificacion`,
 1 AS `calificacion_minima_trayecto`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `detalles_parroquia`
--

DROP TABLE IF EXISTS `detalles_parroquia`;
/*!50001 DROP VIEW IF EXISTS `detalles_parroquia`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `detalles_parroquia` AS SELECT 
 1 AS `parroquia_id`,
 1 AS `parroquia_nombre`,
 1 AS `municipio_id`,
 1 AS `municipio_nombre`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `detalles_profesores`
--

DROP TABLE IF EXISTS `detalles_profesores`;
/*!50001 DROP VIEW IF EXISTS `detalles_profesores`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `detalles_profesores` AS SELECT 
 1 AS `codigo`,
 1 AS `cedula`,
 1 AS `usuario_id`,
 1 AS `nombre`,
 1 AS `apellido`,
 1 AS `direccion`,
 1 AS `telefono`,
 1 AS `estatus`,
 1 AS `email`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `detalles_proyecto`
--

DROP TABLE IF EXISTS `detalles_proyecto`;
/*!50001 DROP VIEW IF EXISTS `detalles_proyecto`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `detalles_proyecto` AS SELECT 
 1 AS `id`,
 1 AS `fase_id`,
 1 AS `nombre`,
 1 AS `comunidad`,
 1 AS `motor_productivo`,
 1 AS `resumen`,
 1 AS `direccion`,
 1 AS `consejo_comunal_id`,
 1 AS `nombre_consejo_comunal`,
 1 AS `nombre_vocero_consejo_comunal`,
 1 AS `telefono_consejo_comunal`,
 1 AS `sector_consejo_comunal`,
 1 AS `municipio`,
 1 AS `parroquia`,
 1 AS `parroquia_id`,
 1 AS `tutor_ex`,
 1 AS `tlf_tex`,
 1 AS `tutor_in`,
 1 AS `cerrado`,
 1 AS `estatus`,
 1 AS `observaciones`,
 1 AS `tutor_in_nombre`,
 1 AS `tutor_in_cedula`,
 1 AS `tutor_in_telefono`,
 1 AS `nombre_trayecto`,
 1 AS `codigo_trayecto`,
 1 AS `codigo_siguiente_trayecto`,
 1 AS `nombre_fase`,
 1 AS `codigo_fase`,
 1 AS `integrantes`,
 1 AS `reprobados`,
 1 AS `fecha_inicio`,
 1 AS `fecha_cierre`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `detalles_seccion`
--

DROP TABLE IF EXISTS `detalles_seccion`;
/*!50001 DROP VIEW IF EXISTS `detalles_seccion`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `detalles_seccion` AS SELECT 
 1 AS `codigo`,
 1 AS `trayecto_id`,
 1 AS `observacion`,
 1 AS `trayecto`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `detalles_sector`
--

DROP TABLE IF EXISTS `detalles_sector`;
/*!50001 DROP VIEW IF EXISTS `detalles_sector`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `detalles_sector` AS SELECT 
 1 AS `consejo_comunal_id`,
 1 AS `consejo_comunal_nombre`,
 1 AS `consejo_comunal_telefono`,
 1 AS `sector_id`,
 1 AS `sector_nombre`,
 1 AS `parroquia_id`,
 1 AS `parroquia_nombre`,
 1 AS `municipio_nombre`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `detalles_trayecto`
--

DROP TABLE IF EXISTS `detalles_trayecto`;
/*!50001 DROP VIEW IF EXISTS `detalles_trayecto`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `detalles_trayecto` AS SELECT 
 1 AS `codigo`,
 1 AS `periodo_id`,
 1 AS `calificacion_minima`,
 1 AS `nombre`,
 1 AS `siguiente_trayecto`,
 1 AS `fecha_inicio`,
 1 AS `fecha_cierre`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `detalles_usuarios`
--

DROP TABLE IF EXISTS `detalles_usuarios`;
/*!50001 DROP VIEW IF EXISTS `detalles_usuarios`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `detalles_usuarios` AS SELECT 
 1 AS `id`,
 1 AS `rol_id`,
 1 AS `email`,
 1 AS `contrasena`,
 1 AS `nombre`,
 1 AS `apellido`,
 1 AS `cedula`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `dimension`
--

DROP TABLE IF EXISTS `dimension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dimension` (
  `id` int NOT NULL AUTO_INCREMENT,
  `unidad_id` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `grupal` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `unidad_id` (`unidad_id`),
  CONSTRAINT `dimension_ibfk_1` FOREIGN KEY (`unidad_id`) REFERENCES `malla_curricular` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=57 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dimension`
--

LOCK TABLES `dimension` WRITE;
/*!40000 ALTER TABLE `dimension` DISABLE KEYS */;
INSERT INTO `dimension` VALUES (1,'ASESOR4078303_1','Desempeño Individual',0),(2,'ASESOR4078303_1','Desempeño Grupal',1),(3,'ASESOR4078303_1','Avance del Producto Final',1),(4,'PIGPI078303_1','Evaluación Tecnica Individual',0),(5,'PIABD078303_1','Evaluación Tecnica Individual',0),(6,'PIPST078304_1','Evaluación Del Docente de Proyecto',1),(7,'PISEI078303_1','Evaluación Tecnica Individual',0),(8,'ASESOR4078303_2','Desempeño Individual',0),(9,'ASESOR4078303_2','Desempeño Grupal',1),(10,'ASESOR4078303_2','Evaluacion Tecnica Individual',0),(11,'ASESOR4078303_2','Plan de Mantenimiento al sistema',0),(13,'PIPST078304_2','Aspectos a Evaluar en el Informe de Proyecto',1),(14,'PIAUI078303_2','Tipo de Auditoria',1),(15,'PIAUI078303_2','Plan de Mantenimiento',1),(16,'ASESOR3078303_1','Sistema',0),(17,'ASESOR3078303_1','Informe',1),(18,'ASESOR3078303_1','Manejo de Equipo',1),(19,'PINGSO078303_1','Modelado del Negocio',1),(20,'PINGSO078303_1','Modelado del Sistema',0),(21,'PIMOB078303_1','Diseño de la Base de datos',0),(22,'PIPST078303_1','Aspectos a evaluar',1),(23,'ASESOR3078303_2','Desempeño Individual',0),(24,'ASESOR3078303_2','Desempeño grupal',1),(25,'ASESOR3078303_2','Avances de programación (Por Modulo)',0),(26,'ASESOR3078303_2','Interfaz y estilo',0),(27,'PINGSO078303_2','Desempeño Tecnico',0),(28,'PINGSO078303_2','Usabilidad',1),(29,'PIPST078303_2','Capitulo III',1),(30,'PIPST078303_2','Capitulo IV',1),(31,'PIPST078303_2','Capitulo V',1),(32,'PIBAD090203_1','Diseño de la Base de Datos',1),(33,'PIBAD090203_1','Diseño de la Base de Datos',0),(34,'PIINS090203_1','Desempeño Grupal',1),(35,'PIINS090203_1','Desempeño individual',1),(36,'PIPST234209_1','Desempeño Individual',0),(37,'PIPST234209_1','Desempeño Grupal',1),(38,'PIPRO306212_1','Prototipo',1),(39,'PIPRO306212_1','Desempeño Individual',0),(40,'ASESOR3078845_1','Desempeño Individual',1),(41,'ASESOR3078845_1','Desempeño Individual',1),(42,'ASESOR3078554_1','Desempeño Individual',0),(43,'ASESOR3078554_1','Evaluación Técnica Grupal',1),(44,'PIPST548751_1','Impacto Social',0),(45,'PIPST548751_1','Desenvolvimiento de los Ponentes',0),(46,'PIPST548751_1','Evaluación Técnica Grupal',1),(47,'ARQUIT1254578_1','Evaluación Técnica Individual',0),(48,'PIELE548756_1','Desempeño Grupal',1),(49,'PIELE548756_1','Desempeño Individual',0),(50,'PIELE548756_2','Evaluación Técnica Individual',0),(51,'PIPST548751_2','Evaluación Técnica Individual',0),(52,'PIPST548751_2','Exposición',1),(53,'PIPST548751_2','Desempeño Grupal Informe',1),(54,'ARQUIT1254578_1','Evaluación Técnica Individual',0),(55,'ASESOR3078554_2','Evaluación Técnica del Plan de Soporte Técnico a Equipos y Usuarios',0),(56,'ASESOR3078554_2','Evaluación Técnica Grupal',1);
/*!40000 ALTER TABLE `dimension` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estudiante`
--

DROP TABLE IF EXISTS `estudiante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estudiante` (
  `id` varchar(255) NOT NULL,
  `persona_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `persona_id` (`persona_id`),
  CONSTRAINT `estudiante_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`cedula`)
) ENGINE=InnoDB ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estudiante`
--

LOCK TABLES `estudiante` WRITE;
/*!40000 ALTER TABLE `estudiante` DISABLE KEYS */;
INSERT INTO `estudiante` VALUES ('e-15408',15408),('e-39263',39263),('e-63578',63578),('e-17227723',17227723),('e-19432505',19432505),('e-20009949',20009949),('e-24399094',24399094),('e-24417327',24417327),('e-25526317',25526317),('e-25526435',25526435),('e-25541868',25541868),('e-25894780',25894780),('e-25956573',25956573),('e-25961485',25961485),('e-26076982',26076982),('e-26141422',26141422),('e-26197135',26197135),('e-26555637',26555637),('e-26779660',26779660),('e-26800302',26800302),('e-26831466',26831466),('e-26945388',26945388),('e-26976737',26976737),('e-27025337',27025337),('e-27120700',27120700),('e-27198786',27198786),('e-27199177',27199177),('e-27210776',27210776),('e-27388616',27388616),('e-27397112',27397112),('e-27411195',27411195),('e-27436179',27436179),('e-27554490',27554490),('e-27586482',27586482),('e-27629456',27629456),('e-27629581',27629581),('e-27666555',27666555),('e-27667928',27667928),('e-27736558',27736558),('e-27737198',27737198),('e-27737458',27737458),('e-27828169',27828169),('e-27831369',27831369),('e-28019244',28019244),('e-28020203',28020203),('e-28055655',28055655),('e-28113106',28113106),('e-28150004',28150004),('e-28204985',28204985),('e-28256789',28256789),('e-28286982',28286982),('e-28297900',28297900),('e-28338690',28338690),('e-28363656',28363656),('e-28363772',28363772),('e-28363903',28363903),('e-28381831',28381831),('e-28406215',28406215),('e-28406618',28406618),('e-28406661',28406661),('e-28406924',28406924),('e-28453954',28453954),('e-28454122',28454122),('e-28466973',28466973),('e-28493197',28493197),('e-28516209',28516209),('e-28528588',28528588),('e-28539728',28539728),('e-28591973',28591973),('e-28609972',28609972),('e-28646706',28646706),('e-28661484',28661484),('e-28672771',28672771),('e-28699599',28699599),('e-29442380',29442380),('e-29506241',29506241),('e-29506862',29506862),('e-29506932',29506932),('e-29517871',29517871),('e-29531465',29531465),('e-29531677',29531677),('e-29560584',29560584),('e-29604245',29604245),('e-29623228',29623228),('e-29623277',29623277),('e-29624646',29624646),('e-29624981',29624981),('e-29654148',29654148),('e-29707067',29707067),('e-29707117',29707117),('e-29778208',29778208),('e-29795114',29795114),('e-29805941',29805941),('e-29831184',29831184),('e-29851122',29851122),('e-29873164',29873164),('e-29873456',29873456),('e-29873538',29873538),('e-29880397',29880397),('e-29880973',29880973),('e-29895827',29895827),('e-29896041',29896041),('e-29913125',29913125),('e-29913199',29913199),('e-29944858',29944858),('e-29945099',29945099),('e-29945119',29945119),('e-29957469',29957469),('e-29972530',29972530),('e-29976008',29976008),('e-29976514',29976514),('e-29976685',29976685),('e-29997704',29997704),('e-29997994',29997994),('e-30014771',30014771),('e-30071615',30071615),('e-30072062',30072062),('e-30074007',30074007),('e-30087582',30087582),('e-30088197',30088197),('e-30095928',30095928),('e-30105192',30105192),('e-30105575',30105575),('e-30125965',30125965),('e-30128473',30128473),('e-30128602',30128602),('e-30129964',30129964),('e-30130281',30130281),('e-30130317',30130317),('e-30145565',30145565),('e-30145618',30145618),('e-30205068',30205068),('e-30218425',30218425),('e-30218482',30218482),('e-30218708',30218708),('e-30218990',30218990),('e-30226558',30226558),('e-30266398',30266398),('e-30266400',30266400),('e-30266577',30266577),('e-30300960',30300960),('e-30304373',30304373),('e-30317355',30317355),('e-30317478',30317478),('e-30318222',30318222),('e-30324703',30324703),('e-30324954',30324954),('e-30335417',30335417),('e-30344763',30344763),('e-30353397',30353397),('e-30353577',30353577),('e-30376386',30376386),('e-30396029',30396029),('e-30396184',30396184),('e-30405566',30405566),('e-30405571',30405571),('e-30405793',30405793),('e-30434563',30434563),('e-30448190',30448190),('e-30454597',30454597),('e-30479630',30479630),('e-30485795',30485795),('e-30528058',30528058),('e-30529335',30529335),('e-30529448',30529448),('e-30553759',30553759),('e-30554053',30554053),('e-30554088',30554088),('e-30554145',30554145),('e-30554404',30554404),('e-30554657',30554657),('e-30560144',30560144),('e-30560426',30560426),('e-30560560',30560560),('e-30587563',30587563),('e-30587785',30587785),('e-30588476',30588476),('e-30591237',30591237),('e-30591468',30591468),('e-30601403',30601403),('e-30601663',30601663),('e-30601666',30601666),('e-30621800',30621800),('e-30621851',30621851),('e-30621894',30621894),('e-30657597',30657597),('e-30657852',30657852),('e-30664122',30664122),('e-30664596',30664596),('e-30664778',30664778),('e-30668285',30668285),('e-30672886',30672886),('e-30675539',30675539),('e-30694379',30694379),('e-30716220',30716220),('e-30716405',30716405),('e-30716541',30716541),('e-30753799',30753799),('e-30753955',30753955),('e-30753995',30753995),('e-30754113',30754113),('e-30754260',30754260),('e-30759776',30759776),('e-30803098',30803098),('e-30803623',30803623),('e-30845389',30845389),('e-30846149',30846149),('e-30873409',30873409),('e-30880746',30880746),('e-30894865',30894865),('e-30894974',30894974),('e-30895294',30895294),('e-30916580',30916580),('e-30979558',30979558),('e-30979684',30979684),('e-30979806',30979806),('e-30987377',30987377),('e-31018207',31018207),('e-31018229',31018229),('e-31026149',31026149),('e-31027477',31027477),('e-31066439',31066439),('e-31066519',31066519),('e-31111539',31111539),('e-31117996',31117996),('e-31118074',31118074),('e-31162171',31162171),('e-31169313',31169313),('e-31194917',31194917),('e-31212573',31212573),('e-31212599',31212599),('e-31212740',31212740),('e-31233952',31233952),('e-31244876',31244876),('e-31258935',31258935),('e-31271852',31271852),('e-31272034',31272034),('e-31300939',31300939),('e-31366952',31366952),('e-31388606',31388606),('e-31401678',31401678),('e-31464007',31464007),('e-31492771',31492771),('e-31493172',31493172),('e-31544822',31544822),('e-31550201',31550201),('e-31766216',31766216),('e-31835884',31835884),('e-31842780',31842780),('e-31843937',31843937),('e-31926201',31926201),('e-31986901',31986901),('e-32023069',32023069),('e-32029094',32029094),('e-32593540',32593540),('e-34234234',34234234),('e-63578247',63578247);
/*!40000 ALTER TABLE `estudiante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `estudiantes_pendientes_a_proyecto`
--

DROP TABLE IF EXISTS `estudiantes_pendientes_a_proyecto`;
/*!50001 DROP VIEW IF EXISTS `estudiantes_pendientes_a_proyecto`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `estudiantes_pendientes_a_proyecto` AS SELECT 
 1 AS `id`,
 1 AS `cedula`,
 1 AS `usuario_id`,
 1 AS `nombre`,
 1 AS `apellido`,
 1 AS `direccion`,
 1 AS `telefono`,
 1 AS `estatus`,
 1 AS `email`,
 1 AS `clases`,
 1 AS `seccion_id`,
 1 AS `integrante_id`,
 1 AS `proyecto_id`,
 1 AS `trayecto_id`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `fase`
--

DROP TABLE IF EXISTS `fase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fase` (
  `codigo` varchar(255) NOT NULL,
  `trayecto_id` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `siguiente_fase` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `trayecto_id` (`trayecto_id`),
  KEY `siguiente_fase` (`siguiente_fase`),
  CONSTRAINT `fase_ibfk_1` FOREIGN KEY (`trayecto_id`) REFERENCES `trayecto` (`codigo`),
  CONSTRAINT `fase_ibfk_2` FOREIGN KEY (`siguiente_fase`) REFERENCES `fase` (`codigo`)
) ENGINE=InnoDB ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fase`
--

LOCK TABLES `fase` WRITE;
/*!40000 ALTER TABLE `fase` DISABLE KEYS */;
INSERT INTO `fase` VALUES ('TR1_1','TR1','Fase 1','TR1_2'),('TR1_2','TR1','Fase 2',NULL),('TR2_1','TR2','Fase 1','TR2_2'),('TR2_2','TR2','Fase 2',NULL),('TR3_1','TR3','Fase 1','TR3_2'),('TR3_2','TR3','Fase 2',NULL),('TR4_1','TR4','Fase 1','TR4_2'),('TR4_2','TR4','Fase 2',NULL);
/*!40000 ALTER TABLE `fase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `indicadores`
--

DROP TABLE IF EXISTS `indicadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `indicadores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dimension_id` int DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `ponderacion` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `dimension_id` (`dimension_id`),
  CONSTRAINT `indicadores_ibfk_1` FOREIGN KEY (`dimension_id`) REFERENCES `dimension` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=267 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `indicadores`
--

LOCK TABLES `indicadores` WRITE;
/*!40000 ALTER TABLE `indicadores` DISABLE KEYS */;
INSERT INTO `indicadores` VALUES (1,1,'Responsabilidad',1.5),(2,1,'Activo y participativo',0.25),(3,1,'Integración al grupo',0.5),(4,1,'Sensibilidad Social',0.25),(5,2,'Manejo de conflictos',0.25),(6,2,'Proactividad',0.25),(7,2,'Recibe de su equipo de proyecto los entregables de trayecto IV',2),(8,3,'Se evidencia que los riesgos presentados en el proyecto están vinculados con la comunidad.',1),(9,3,'Se verifica la existencia de elementos técnicos en cuanto a la base de datos, están aplicados en el proyecto',2),(10,3,'Los aspectos relacionados a seguridad informática (Métodos de cifrado) están presentes en el proyecto',2),(11,4,'Gestiona los riesgos del proyecto',1),(12,4,'Analiza y crea estrategias para la administración de riesgo',1.5),(13,4,'Controla el proyecto mediante rutas críticas en PERT/CPM',2.5),(14,5,'Presenta plan de optimización de la base de datos.',2),(15,5,'Presenta plan de monitoreo del rendimiento de la base de datos',3),(16,5,'Presenta plan de control de seguridad de la base de datos',4),(17,5,'Presenta plan de respaldos y recuperación de la base de datos',4),(18,5,'Presenta plan de cambios de la base de datos, para la integración de sistemas.',2),(19,6,'Presenta en forma coherente el diagnóstico del proyecto instalado en la comunidad.',1),(20,6,'El objetivo general se relaciona con los alcances requeridos en Trayecto IV.',0.5),(21,6,'Los objetivos específicos reflejan el alcance del proyecto y se relacionan con la propuesta del objetivo general.',0.5),(22,6,'Aborda teorías y conocimientos relacionados al Trayecto respectivo y su acreditación',1),(23,6,'Presenta la planificación de actividades del proyecto. (Gestión de Proyecto, Base de Datos y Seguridad Informática)',1),(24,6,'Identifican, analizan y valoran los riesgos del proyecto con propuestas de administración, monitoreo o mitigación.',1),(25,6,'Presenta la evaluación de la base de datos del proyecto considerando las transacciones, la concurrencia, el volumen de crecimiento con planes de administración; además de la integración del sistema.',1),(26,6,'Incorpora el análisis de la seguridad física y lógica donde está ubicado el proyecto en la comunidad.',0.5),(27,6,'Describe la aplicación de métodos de cifrado al sistema con su respectivo algoritmo y establecen políticas de seguridad del proyecto de acuerdo a los resultados generados en el diagnóstico.',0.5),(28,6,'Evidencia el cumplimiento de las tareas y actividades Programadas. (Entregaron Plan de trabajo y avances del Proyecto de acuerdo a sus requerimientos).',1),(29,6,'Presenta de forma correcta la sistematizaciónde los Capítulos I, II y III en conjunto con las páginas preliminares, de acuerdo a los requerimientos exigidos',1),(30,6,'La redacción, análisis y ortografía se adecua a las características de un informe técnico.',1),(31,7,'Explica como realizo el Diagnóstico sobre la Seguridad Física, Lógica, Redes y Estaciones de Trabajo, BD en proyecto.',2),(32,7,'Demuestra que el Algoritmo asimétrico fue el empleado según el método de cifrado seleccionado en el sistema.',11),(33,7,'Analiza la matriz de riesgo de seguridad.',2),(34,8,'Responsabilidad',1.5),(35,8,'Activo y participativo',0.25),(36,8,'Integración al grupo',0.5),(37,8,'Sensibilidad Social',0.25),(38,9,'',0.5),(39,9,'',1),(40,9,'',1),(41,10,'',2),(42,10,'',2),(43,10,'',2),(44,10,'',2),(45,10,'',2),(46,11,'',1),(47,11,'',2),(48,11,'',2),(49,13,'Refleja la planificación de actividades del proyecto. Auditoría informática y plan de mantenimiento al sistema)',1),(50,13,'Plasma la Identificación, análisis y aplicación de la auditoría al sistema. ',1.5),(51,13,'Presenta el análisis del tipo de mantenimiento que deben aplicar y resultados del plan de mantenimiento',1.5),(52,13,'Se evidencia el cumplimiento de las tareas y actividades programadas. (Entregaron Plan de trabajo y avances del Proyecto de acuerdo a sus requerimientos). ',1),(53,13,'Presenta la sistematización de los Capítulos IV, V y VI',1.5),(54,13,'Presenta las Conclusiones y Recomendaciones, Referencias y Anexos.',1),(55,13,'La redacción, análisis y ortografía se adecuan a las características de un informe técnico.',1.5),(56,13,'Se entrega, en el tiempo indicado,  el informe final de proyecto IV con todos los requerimientos exigidos',1),(57,14,'Auditoría aplicada al sistema (Explicación del módulo auditado) Tipo de auditoría seleccionada.',1.25),(58,14,'Herramienta utilizada. ¿Cuál Utilizo?',1.25),(59,14,'Metodología y técnica empleada.',2.5),(60,14,'Resultado en el sistema. (Visualizarlo).',2.5),(61,15,'Explicar  el propósito del mantenimiento',1.5),(62,15,'Equipos, periféricos, servidores,  sistemas y documentación. ',1.5),(63,15,'Tipo de mantenimiento. (Predictivo, correctivo, preventivo). (A corto y largo plazo). ',1.5),(64,15,'Establecimiento del plan de mantenimiento Informe de resultados del Mantenimiento.',1.5),(65,15,'Visualizar en el sistema cuál fue el mantenimiento aplicado.',1.5),(66,16,'Interfaz de menú amigable al usuario',2),(67,16,'Interfaz de inserción o captura de datos',1),(68,16,'Interfaz de confirmación de eliminación de datos',1),(69,16,'Interfaz de consultar con filtros de búsqueda',1),(70,16,'Demuestra conocimiento en la programación modular del Sistema',1),(71,16,'Modulo de reportes básicos',1),(72,16,'Utiliza modelo vista-controlador',2),(73,16,'Codifica basado en el Diseño',1),(74,16,'Justifica la Metodología',1),(75,17,'Capitulo 1',2),(76,17,'Capitulo 2',2),(77,18,'Manejo de conflictos',1),(78,18,'Responsabilidad',2),(79,18,'Hábitos de trabajo',2),(80,19,'Documento de Requisitos S.R.S',2),(81,19,'Diagramas y Plantilla IBM',5),(82,20,'Diagrama de Casos de Uso',2),(83,20,'Diagrama de Actividad',2),(84,20,'Descripción de casos de uso en Plantillas IBM',2),(85,20,'Diagrama de clase',1),(86,20,'Mapa Navegacional',1),(87,21,'Modelo Entidad Relacion',1),(88,21,'Modelo Logico Relacional',1),(89,21,'Modelo Fisico',1),(90,21,'Utiliza postgres para el diseño fisico de la base de datos',1),(91,21,'Diccionario de datos',1),(92,22,'Titulo del proyecto',0.5),(93,22,'La descripcion del diagnostico situacional',0.75),(94,22,'Aplica e interpreta instrumentos para el levantamiento de la niformación y captura de requisitos',0.5),(95,22,'Presenta una propuesta de solución coherente',0.5),(96,22,'Objetivo general se relaciona con la propuesta de solución',0.5),(97,22,'Objetivos especificos: reflejan el alcance del proyecto y se relacionan con la propuesta de solución del objetivo general',0.5),(98,22,'Justifica las razones para el uso de la propuesta de solución',0.5),(99,22,'El proyecto describe los procesos llevados a cabo dentro de la comunidad',0.75),(100,22,'Aborda teorías y conocimientos cónsonos al trayecto respectivo y su acreditación',1),(101,22,'Se aborda el marco legal',0.5),(102,22,'Realiza planificación de actividades del proyecto',0.5),(103,22,'Entrega a tiempo de artefactos correspondientes al diseño del sistema',0.5),(104,22,'Sistematiza Capitulo 1 y 2 del proyecto',0.5),(105,22,'Aplica normas para representar cuadros y figuras',0.5),(106,22,'Redacción, analisis y ortografia',0.5),(107,22,'Los participantes se integraron como equipo de trabajo para la resolución de conflictos',0.5),(108,22,'Los participantes aplicaron instrumentos de recolección de información',0.5),(109,22,'Los participantes cumplieron con las tareas y actividades programadas',0.5),(110,23,'CRUD del sistema. (Por Modulo)',1),(111,23,'Validación de datos. (Por Modulo)',1),(112,24,'Responsabilidad',1),(113,24,'Integración al grupo',0.5),(114,24,'proactividad',0.5),(115,25,'Instalación del software necesario para la ejecución de la aplicación o componentes',1),(116,25,'Pantallas bien conectadas con la Base de datos',1),(117,25,'Los módulos de modificación de base de datos garantizan la integridad referencial',1),(118,25,'Desarrollo de todos los modulos diseñados en los diagramas de casos de uso',1),(119,25,'Módulos acordes al Diagrama de clases',1),(120,25,'Funcionamiento completo de los módulos de automatización',1),(121,25,'Correctitud en los reportes estadisticos',1),(122,25,'Cumplimiento del estandar de programación entregado',1),(123,25,'Control de errores',1),(124,25,'Gestión de bitácora',1),(125,25,'Manejo de sesiones respecto a concurrencia de usuarios',1),(126,26,'Uso adecuado de los colores en la aplicación',1),(127,26,'Fondos claros y sencillos',1),(128,26,'Uso de iamgenes',1),(129,26,'Distribución de la interfaz',2),(130,27,'Cumple con actividades Asignadas',1),(131,27,'Conoce con exactitud el Sistema',2),(132,27,'Conoce el uso de Bitacora',1),(133,27,'Codifica los requerimientos dados por el docente',1),(134,27,'Desarrollo y programo el módulo asignado',1),(135,27,'Integro el módulo desarrollado',1),(136,27,'Planifica el proceso de Desarrollo del software',1),(137,27,'Identifica los escenarios y casos de prueba en el sistema',1),(138,27,'Detecta errores, fallas, defectos en el sistema',1),(139,27,'Planifica las activdades de capacitación',1),(140,28,'Facilidad de uso',1),(141,28,'Tiempos de respuesta del sistema',1),(142,28,'Interactividad con el usuario',1),(143,28,'Ayuda al Usuario',1),(144,29,'Manual de usuario',2),(145,29,'Manual de Sistema',2),(146,29,'Plan de Pruebas',3),(147,29,'Plan de Instalación',2),(148,29,'Plan de Capacitación',2),(149,30,'Recomendaciones y Evolución Previsible del sistema.',2),(150,31,'Anexos y Referencias',2),(151,32,'BD contempla lo expuesto en el alcance del Sistema',2),(152,32,'Modelo Lógico Relacional',2),(153,32,'Diccionario de Datos',0.5),(154,32,'Modelo Físico',0.5),(155,33,'Exporta e Importa BD',1),(156,33,'Explica la Estructura de Tabla (tipos de datos, clave primaria, clave foránea, integridad referencial)',2),(157,33,'Explica Sentencias SQL (Inserción de datos, consulta de datos de una tabla)',2),(158,34,'Cuadro de Procesos (análisis de los instrumentos de recolección de datos)',1),(159,34,'Modelado del Negocio',1),(160,34,'Documento SRS',0.5),(161,34,'Casos de Usos del Sistema',1),(162,34,'Mapa de Navegación del Sistema',0.5),(163,35,'Explica con detalle el diagrama de actividades del Negocio',1),(164,35,'Explica RF y RNF del sistema',1),(165,35,'Explica con detalle el Casos de Uso de su modulo',1),(166,35,'Diagrama de Actividad relacionado directamente con su modulo',2),(167,35,'Descripción Plantilla de procesos IBM',1),(168,36,'Dominio de la información referente a la comunidad',1),(169,36,'Asistencia al EVA de PSTII',1),(170,36,'Demuestra facilidad de transmitir y dominio del tema en la presentación de su proyecto',1),(171,36,'Realiza Correcciones',2),(172,37,'Capítulo I',1),(173,37,'Capítulo II',1),(174,37,'Análisis, Redacción y Ortografía del Informe',2),(175,37,'Aplican las Reglas APA',1),(176,38,'Integración Sistema –Casos de Usos',1),(177,38,'Integración Sistema –Mapa Navegación',0.5),(178,38,'Conexión con BD ( registra-consulta)',2),(179,38,'Alojamiento en el Servidor Web',0.5),(180,39,'Analiza los RF para codificar el sistema',1),(181,39,'Demuestra conocimiento en la sintaxis de PHP',2),(182,39,'Explica el uso de clases y Objetos',2),(183,39,'Explica detalladamente el Patrón MVC',1),(184,40,'Cumple con el Rol Analista, Diseñador y Programador de Software',1),(185,40,'Demuestra Conocimiento sobre la Comunidad',1),(186,40,'Demuestra conocimiento en cuanto al análisis de los requerimientos del sistema',1),(187,40,'Integración al grupo, responsabilidad y desempeño',1),(188,40,'Realiza Correcciones tanto del sistema como al informe.',1),(189,41,'Informe de Proyecto Capítulos I,II ',2),(190,41,'Distribución de la interfaz, uso adecuado de los colores institucionales en la aplicación (Fondos claros y sencillos)',1),(191,41,'Usabilidad y Navegabilidad del Sistema',1),(192,41,'La aplicación cumple con la necesidad de la Comunidad.',1),(193,42,'Proactividad',1),(194,42,'Responsabilidad / Asesorías',1),(195,42,'Hábitos de trabajo',1),(196,42,'Integración al grupo',1),(197,42,'Puntualidad en la entrega de las correcciones.',1),(198,43,'Presentación de los Capítulos según las normas establecidas en el manual.',1),(199,43,'Redacción, ortografía y lenguaje técnico.',1),(200,43,'El Título del Proyecto define el alcance del mismo.',1),(201,43,'Expone la problemática y su alternativa de solución.',1),(202,43,'Definen Objetivo General',1),(203,43,'Los Objetivos Específicos son consonó con el objetivo General.',1),(204,43,'Aplicación del Instrumento de Recolección de Datos en la comunidad.',1),(205,43,'El Cronograma de actividades refleja las tareas para el alcance de los objetivos específicos.',2),(206,43,'Inventario Tecnológico.',1),(207,44,'Integración Grupal',1),(208,44,'Proactividad',1),(209,44,'Asistencia e Integración al EVA',1),(210,45,'Manejo correcto del lenguaje',0.5),(211,45,'Presentación Vocabulario Técnico adecuado',0.5),(212,45,'Manejo del tiempo adecuado',0.5),(213,45,'Uso y manejo del material',0.5),(214,46,'Título del proyecto: presenta en forma general el tema de estudio, relacionándose con el objetivo general.',0.5),(215,46,'La descripción del diagnóstico situacional: refleja el Problema investigativo de acuerdo a las necesidades de la comunidad abordada.',0.5),(216,46,'Aplica instrumentos para el levantamiento de la información.',0.5),(217,46,'El objetivo general y específico: reflejan el alcance del proyecto, y se relacionan con el título y la propuesta de solución del objetivo general.',0.5),(218,46,'Aborda la Metodología de Investigación',0.5),(219,46,'Diseña Instrumentos de Recolección de Datos así como la interpretación de la información recaba',1),(220,46,'Redacción, ortografía y lenguaje técnico',1),(221,46,'Presentan sus referencias Bibliográficas y Electrónicas Siguiendo las Normas APA',0.5),(222,47,'Reconoce periféricos de E/S/A del computador.',2),(223,47,'Reconoce los componentes Internos del computador (Tarjeta Madre, CPU, Fuente, Memorias, Puertos E/S, D.D, entre otros).',3),(224,47,'Conoce cómo Ensamblar y Desarmar un equipo.',3),(225,47,'Demuestra dominio del lenguaje técnico durante el diagnostico.',3),(226,47,'Detecta y corrige las fallas de hardware en una computadora.',4),(227,47,'Aplica normas y procedimientos para el mantenimiento preventivo de la PC.',2),(228,47,'Identifica y Configura la BIOS.',2),(229,47,'Posee Conocimiento acerca del software necesario para el uso del computador requerido por el usuario.',1),(230,47,'Participa en el levantamiento del Inventario Tecnológico.',2),(231,47,'Participa de forma activa en las Jornadas de Arquitectura del computador (Prácticas profesionales de soporte técnico)',3),(232,48,'Diseño sitio Web Básico (etiquetas básicas, css)',2),(233,49,'Asistencia a Talleres',3),(234,50,'Creatividad en el Diseño (colores, imágenes, textos, cuadros entre otros)',2),(235,50,'Dominio de HTML5',2),(236,50,'Aplicación de Atributos Responsive',2),(237,50,'Aplicación de menú desplegable',1),(238,50,'Dominio de clases e identificadores',2),(239,50,'Diseña Maquetación Web Aplicación de header, nav, footer y section',2),(240,50,'Dominio de uso de atributos CSS3 y media-min y media-max CSS3',2),(241,50,'Diseña Formularios con diferentes tipos de elementos',2),(242,51,'Responsabilidad y Proactividad',2),(243,52,'Se presenta adecuadamente, señala el tema a exponer y viste de manera adecuada',0.5),(244,52,'Se expresa con claridad, firmeza y precisión',1),(245,52,'Demuestra Dominio en el desarrollo del Tema',2),(246,53,'Presenta Conclusiones y Recomendaciones según el desarrollo del Proyecto',1),(247,53,'Las bases teóricas están bien fundamentadas en la propuesta presentada.',1),(248,53,'Describen el Impacto Social del Proyecto para la comunidad',1),(249,53,'Redacción, ortografía , lenguaje técnico y aplicación de las normas APA',1),(250,53,'Presentación de Referencias Bibliográficas y electrónicas',1),(251,54,'Instala sistemas operativos libres y propietarios en la computadora',2),(252,54,'Configurar driver y paquetes de instalación básicos luego de instalar el sistema operativo',2),(253,54,'Aplica normas y procedimientos para el mantenimiento preventivo de la Computadora',2),(254,54,'Reconoce y detecta las fallas de Hardware y software de un PC',2),(255,54,'Resuelve las fallas de Hardware y software detectadas.',2),(256,55,'',1),(257,55,'',0.5),(258,55,'',0.5),(259,55,'',0.5),(260,55,'',0.5),(261,55,'',1),(262,55,'',1),(263,56,'',0.5),(264,56,'',0.5),(265,56,'',2),(266,56,'',2);
/*!40000 ALTER TABLE `indicadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inscripcion`
--

DROP TABLE IF EXISTS `inscripcion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inscripcion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `profesor_id` varchar(255) DEFAULT NULL,
  `seccion_id` varchar(255) DEFAULT NULL,
  `unidad_curricular_id` varchar(255) DEFAULT NULL,
  `estudiante_id` varchar(255) DEFAULT NULL,
  `calificacion` float DEFAULT NULL,
  `estatus` int DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `profesor_id` (`profesor_id`),
  KEY `seccion_id` (`seccion_id`),
  KEY `unidad_curricular_id` (`unidad_curricular_id`),
  KEY `estudiante_id` (`estudiante_id`),
  CONSTRAINT `inscripcion_ibfk_1` FOREIGN KEY (`profesor_id`) REFERENCES `profesor` (`codigo`),
  CONSTRAINT `inscripcion_ibfk_2` FOREIGN KEY (`seccion_id`) REFERENCES `seccion` (`codigo`),
  CONSTRAINT `inscripcion_ibfk_3` FOREIGN KEY (`unidad_curricular_id`) REFERENCES `malla_curricular` (`codigo`),
  CONSTRAINT `inscripcion_ibfk_4` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiante` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscripcion`
--

LOCK TABLES `inscripcion` WRITE;
/*!40000 ALTER TABLE `inscripcion` DISABLE KEYS */;
INSERT INTO `inscripcion` VALUES (1,'p-654854354','IN4401','PIABD078303_1','e-15408',NULL,1),(2,'p-654854354','IN4401','PIABD078303_1','e-63578',NULL,1),(3,'p-654854354','IN4401','PIABD078303_1','e-39263',NULL,1),(4,'p-234565423','IN4401','PIGPI078303_1','e-15408',NULL,1),(5,'p-234565423','IN4401','PIGPI078303_1','e-63578',NULL,1),(6,'p-234565423','IN4401','PIGPI078303_1','e-39263',NULL,1),(7,'p-5428468','IN4401','PISEI078303_1','e-15408',NULL,1),(8,'p-5428468','IN4401','PISEI078303_1','e-63578',NULL,1),(9,'p-5428468','IN4401','PISEI078303_1','e-39263',NULL,1),(10,'p-234565423','IN4401','PIAUI078303_2','e-15408',NULL,1),(11,'p-234565423','IN4401','PIAUI078303_2','e-39263',NULL,1),(12,'p-234565423','IN4401','PIAUI078303_2','e-63578',NULL,1),(13,'p-234565423','IN4401','PIAUI078303_2','e-29913125',NULL,1);
/*!40000 ALTER TABLE `inscripcion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `integrante_proyecto`
--

DROP TABLE IF EXISTS `integrante_proyecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `integrante_proyecto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estudiante_id` varchar(255) DEFAULT NULL,
  `proyecto_id` int DEFAULT NULL,
  `estatus` int DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `estudiante_id` (`estudiante_id`),
  KEY `proyecto_id` (`proyecto_id`),
  CONSTRAINT `integrante_proyecto_ibfk_1` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiante` (`id`),
  CONSTRAINT `integrante_proyecto_ibfk_2` FOREIGN KEY (`proyecto_id`) REFERENCES `proyecto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `integrante_proyecto`
--

LOCK TABLES `integrante_proyecto` WRITE;
/*!40000 ALTER TABLE `integrante_proyecto` DISABLE KEYS */;
INSERT INTO `integrante_proyecto` VALUES (1,'e-15408',1,1),(2,'e-63578',1,1),(3,'e-39263',1,1);
/*!40000 ALTER TABLE `integrante_proyecto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `malla_curricular`
--

DROP TABLE IF EXISTS `malla_curricular`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `malla_curricular` (
  `codigo` varchar(255) NOT NULL,
  `materia_id` varchar(255) DEFAULT NULL,
  `fase_id` varchar(255) DEFAULT NULL,
  `ponderacion` float DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `materia_id` (`materia_id`),
  KEY `fase_id` (`fase_id`),
  CONSTRAINT `malla_curricular_ibfk_1` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`codigo`),
  CONSTRAINT `malla_curricular_ibfk_2` FOREIGN KEY (`fase_id`) REFERENCES `fase` (`codigo`)
) ENGINE=InnoDB ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `malla_curricular`
--

LOCK TABLES `malla_curricular` WRITE;
/*!40000 ALTER TABLE `malla_curricular` DISABLE KEYS */;
INSERT INTO `malla_curricular` VALUES ('ARQUIT1254578_1','ARQUIT1254578','TR1_1',NULL),('ARQUIT1254578_2','ARQUIT1254578','TR1_2',NULL),('ASESOR3078303_1','ASESOR3078303','TR3_1',NULL),('ASESOR3078303_2','ASESOR3078303','TR3_2',NULL),('ASESOR3078554_1','ASESOR3078554','TR1_1',NULL),('ASESOR3078554_2','ASESOR3078554','TR1_2',NULL),('ASESOR3078845_1','ASESOR3078845','TR2_1',NULL),('ASESOR3078845_2','ASESOR3078845','TR2_2',NULL),('ASESOR4078303_1','ASESOR4078303','TR4_1',NULL),('ASESOR4078303_2','ASESOR4078303','TR4_2',NULL),('PIABD078303_1','PIABD078303','TR4_1',NULL),('PIAUI078303_2','PIAUI078303','TR4_2',NULL),('PIBAD090203_1','PIBAD090203','TR2_1',NULL),('PIELE548756_1','PIELE548756','TR1_1',NULL),('PIELE548756_2','PIELE548756','TR1_2',NULL),('PIGPI078303_1','PIGPI078303','TR4_1',NULL),('PIINS090203_1','PIINS090203','TR2_1',NULL),('PIMOB078303_1','PIMOB078303','TR3_1',NULL),('PINGSO078303_1','PINGSO078303','TR3_1',NULL),('PINGSO078303_2','PINGSO078303','TR3_2',NULL),('PIPRO306212_1','PIPRO306212','TR2_1',NULL),('PIPRO306212_2','PIPRO306212','TR2_2',NULL),('PIPST078303_1','PIPST078303','TR3_1',NULL),('PIPST078303_2','PIPST078303','TR3_2',NULL),('PIPST078304_1','PIPST078304','TR4_1',NULL),('PIPST078304_2','PIPST078304','TR4_2',NULL),('PIPST234209_1','PIPST234209','TR2_1',NULL),('PIPST234209_2','PIPST234209','TR2_2',NULL),('PIPST548751_1','PIPST548751','TR1_1',NULL),('PIPST548751_2','PIPST548751','TR1_2',NULL),('PISEI078303_1','PISEI078303','TR4_1',NULL);
/*!40000 ALTER TABLE `malla_curricular` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materias`
--

DROP TABLE IF EXISTS `materias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materias` (
  `codigo` varchar(255) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `htasist` int DEFAULT NULL,
  `htind` int DEFAULT NULL,
  `ucredito` int DEFAULT NULL,
  `hrs_acad` int DEFAULT NULL,
  `eje` varchar(255) DEFAULT NULL,
  `cursable` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materias`
--

LOCK TABLES `materias` WRITE;
/*!40000 ALTER TABLE `materias` DISABLE KEYS */;
INSERT INTO `materias` VALUES ('ARQUIT1254578','Arquitectura del Computador',72,6,3,4,'',1),('ASESOR3078303','Tutor Asesor Proyecto III',72,6,3,4,'',0),('ASESOR3078554','Tutor Asesor Proyecto I',72,6,3,4,'',0),('ASESOR3078845','Tutor Asesor Proyecto II',72,6,3,4,'',0),('ASESOR4078303','Tutor Asesor Proyecto IV',72,6,3,4,'',0),('PIABD078303','Administración de bases de datos',72,6,3,4,'',1),('PIAUI078303','Auditoria Informática',72,6,3,4,'',1),('PIBAD090203','Base de Datos',72,6,3,4,'',1),('PIELE548756','Electiva I',72,6,3,4,'',1),('PIGPI078303','Gestión de proyecto informático',72,6,3,4,'',1),('PIINS090203','Ingenieria del Software I',72,6,3,4,'',1),('PIMOB078303','Modelado de bases de datos',72,6,3,2,'',1),('PINGSO078303','Ingenieria de Software',72,6,3,4,'',1),('PIPRO306212','Programación II',72,6,3,4,'',1),('PIPST078303','Proyecto Socio Tecnológico',216,18,9,6,'',1),('PIPST078304','Proyecto Socio Tecnológico IV',72,6,3,4,'',1),('PIPST234209','Proyecto Socio Tecnológico II',72,6,3,4,'',1),('PIPST548751','Proyecto Socio Tecnológico',216,18,9,6,'',1),('PISEI078303','Seguridad Informática',72,6,3,4,'',1);
/*!40000 ALTER TABLE `materias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulo`
--

DROP TABLE IF EXISTS `modulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `modulo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulo`
--

LOCK TABLES `modulo` WRITE;
/*!40000 ALTER TABLE `modulo` DISABLE KEYS */;
INSERT INTO `modulo` VALUES (1,'Proyecto'),(2,'Materias');
/*!40000 ALTER TABLE `modulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `municipios`
--

DROP TABLE IF EXISTS `municipios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `municipios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `municipios`
--

LOCK TABLES `municipios` WRITE;
/*!40000 ALTER TABLE `municipios` DISABLE KEYS */;
INSERT INTO `municipios` VALUES (1,'Iribarren'),(2,'Jiménez');
/*!40000 ALTER TABLE `municipios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notas_integrante_proyecto`
--

DROP TABLE IF EXISTS `notas_integrante_proyecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notas_integrante_proyecto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `indicador_id` int DEFAULT NULL,
  `integrante_id` int DEFAULT NULL,
  `calificacion` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `indicador_id` (`indicador_id`),
  KEY `integrante_id` (`integrante_id`),
  CONSTRAINT `notas_integrante_proyecto_ibfk_1` FOREIGN KEY (`indicador_id`) REFERENCES `indicadores` (`id`) ON DELETE CASCADE,
  CONSTRAINT `notas_integrante_proyecto_ibfk_2` FOREIGN KEY (`integrante_id`) REFERENCES `integrante_proyecto` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notas_integrante_proyecto`
--

LOCK TABLES `notas_integrante_proyecto` WRITE;
/*!40000 ALTER TABLE `notas_integrante_proyecto` DISABLE KEYS */;
/*!40000 ALTER TABLE `notas_integrante_proyecto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parroquias`
--

DROP TABLE IF EXISTS `parroquias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `parroquias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `municipio` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `municipio` (`municipio`),
  CONSTRAINT `parroquias_ibfk_1` FOREIGN KEY (`municipio`) REFERENCES `municipios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parroquias`
--

LOCK TABLES `parroquias` WRITE;
/*!40000 ALTER TABLE `parroquias` DISABLE KEYS */;
INSERT INTO `parroquias` VALUES (1,'Ana Soto',1),(2,'Santa Rosa',1),(3,'Tamaca',1),(4,'Catedral',1),(5,'Concepción',1),(6,'El Cují',1),(7,'Buena Vista',1),(8,'Aguedo Felipe Alvarado',1),(9,'Unión',1),(10,'Coronel Mariano Peraza',2),(11,'Juan Bautista Rodríguez',2),(12,'Cuara',2),(13,'Diego de Lozada',2),(14,'Paraíso de San José',2),(15,'San Miguel',2),(16,'Tintorero',2),(17,'José Bernardo Dorante',2);
/*!40000 ALTER TABLE `parroquias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodo`
--

DROP TABLE IF EXISTS `periodo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `periodo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_cierre` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodo`
--

LOCK TABLES `periodo` WRITE;
/*!40000 ALTER TABLE `periodo` DISABLE KEYS */;
INSERT INTO `periodo` VALUES (1,'2023-03-01','2024-02-01');
/*!40000 ALTER TABLE `periodo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permisos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rol_id` int DEFAULT NULL,
  `modulo_id` int DEFAULT NULL,
  `crear` tinyint(1) DEFAULT NULL,
  `consultar` tinyint(1) DEFAULT NULL,
  `actualizar` tinyint(1) DEFAULT NULL,
  `eliminar` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `rol_id` (`rol_id`),
  KEY `modulo_id` (`modulo_id`),
  CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`modulo_id`) REFERENCES `modulo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos`
--

LOCK TABLES `permisos` WRITE;
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
INSERT INTO `permisos` VALUES (1,1,1,1,1,1,1),(2,1,2,1,1,1,1);
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `persona` (
  `cedula` int NOT NULL,
  `usuario_id` int DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `direccion` text,
  `telefono` text,
  `estatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`cedula`),
  UNIQUE KEY `cedula` (`cedula`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona`
--

LOCK TABLES `persona` WRITE;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` VALUES (15408,19,'Carlos','Ramirez','Urb. La Concordia','6309710917',NULL),(39263,21,'Kevin','Heredia','Suite 3','8337046607',NULL),(63578,20,'Sarai','Perez','4th Floor','5994995192',NULL),(125487,5,'Lissette','Torrealba','ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=','2548475154',1),(5428468,17,'Jose','Sequera','ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=','WXsjxxCSSjrih+s2QwNSEUPPoE/D+jUqfv0W33mehLZjThcOO34Gpz/FxGACG+ivQOKrbgLnYoIpQm0npRBMtL9ZMpqzAkcXLMErvMXJED8IXXfJG0aBDH6JFKkqZSFCbNofpPI8ieEn+iiJ2QZryH/h4X3SgVlBGROWMlNboh8wX5HzihPoat8u976BT85RfUfzC1KJ+/hEJV7U2AA4z8+qXJwj+fmE2GuiIGsmZ8R1xkcDlZyqzVUPxoagxJSwJtoD9H3/cSYJJSwrd5pe/JQmxxRMdRydD78aEMxh9Y+aZX5XIZb0x9s+VLiR/3kUA3GSJ5gw/c0n5QpMQVkNjZtEfRIJAaRumOBGpL8qJcHQHd0w+MAuig1HzkTJcWVdPY8SPC8OkRoAbV3SKxWg0UQHPHnor7frlshd+3AiPy7IGibue2g2C6zQgecCDEhr0QPnhPV/Ti8/Q9RW6UHJ4JUOoBTHaoDf8OvvA7x74u5CHOGtOUsu2kL1WjgZ36jn7iOwZcxSGTKHGJDtXuckSYWB0ua5uc/HYzabn4dxS4Sxro4dpEg/kicFeeIiUoHBoosgKrIGkUhKY3/x6CnJklJ0+2oc6W/K1H5SKODRceoVLOtNjZXj6IK6hVTyumOW8T7/lanvHM8AnpK7EjRTW9xt/njNs1nVdaThX+KyLkU=',1),(7392496,7,'Pura','Castillo','ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=','WXsjxxCSSjrih+s2QwNSEUPPoE/D+jUqfv0W33mehLZjThcOO34Gpz/FxGACG+ivQOKrbgLnYoIpQm0npRBMtL9ZMpqzAkcXLMErvMXJED8IXXfJG0aBDH6JFKkqZSFCbNofpPI8ieEn+iiJ2QZryH/h4X3SgVlBGROWMlNboh8wX5HzihPoat8u976BT85RfUfzC1KJ+/hEJV7U2AA4z8+qXJwj+fmE2GuiIGsmZ8R1xkcDlZyqzVUPxoagxJSwJtoD9H3/cSYJJSwrd5pe/JQmxxRMdRydD78aEMxh9Y+aZX5XIZb0x9s+VLiR/3kUA3GSJ5gw/c0n5QpMQVkNjZtEfRIJAaRumOBGpL8qJcHQHd0w+MAuig1HzkTJcWVdPY8SPC8OkRoAbV3SKxWg0UQHPHnor7frlshd+3AiPy7IGibue2g2C6zQgecCDEhr0QPnhPV/Ti8/Q9RW6UHJ4JUOoBTHaoDf8OvvA7x74u5CHOGtOUsu2kL1WjgZ36jn7iOwZcxSGTKHGJDtXuckSYWB0ua5uc/HYzabn4dxS4Sxro4dpEg/kicFeeIiUoHBoosgKrIGkUhKY3/x6CnJklJ0+2oc6W/K1H5SKODRceoVLOtNjZXj6IK6hVTyumOW8T7/lanvHM8AnpK7EjRTW9xt/njNs1nVdaThX+KyLkU=',1),(7404027,6,'Oswaldo','Aparicio','ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=','WXsjxxCSSjrih+s2QwNSEUPPoE/D+jUqfv0W33mehLZjThcOO34Gpz/FxGACG+ivQOKrbgLnYoIpQm0npRBMtL9ZMpqzAkcXLMErvMXJED8IXXfJG0aBDH6JFKkqZSFCbNofpPI8ieEn+iiJ2QZryH/h4X3SgVlBGROWMlNboh8wX5HzihPoat8u976BT85RfUfzC1KJ+/hEJV7U2AA4z8+qXJwj+fmE2GuiIGsmZ8R1xkcDlZyqzVUPxoagxJSwJtoD9H3/cSYJJSwrd5pe/JQmxxRMdRydD78aEMxh9Y+aZX5XIZb0x9s+VLiR/3kUA3GSJ5gw/c0n5QpMQVkNjZtEfRIJAaRumOBGpL8qJcHQHd0w+MAuig1HzkTJcWVdPY8SPC8OkRoAbV3SKxWg0UQHPHnor7frlshd+3AiPy7IGibue2g2C6zQgecCDEhr0QPnhPV/Ti8/Q9RW6UHJ4JUOoBTHaoDf8OvvA7x74u5CHOGtOUsu2kL1WjgZ36jn7iOwZcxSGTKHGJDtXuckSYWB0ua5uc/HYzabn4dxS4Sxro4dpEg/kicFeeIiUoHBoosgKrIGkUhKY3/x6CnJklJ0+2oc6W/K1H5SKODRceoVLOtNjZXj6IK6hVTyumOW8T7/lanvHM8AnpK7EjRTW9xt/njNs1nVdaThX+KyLkU=',1),(7423485,10,'Ingrid','Figueroa','ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=','WXsjxxCSSjrih+s2QwNSEUPPoE/D+jUqfv0W33mehLZjThcOO34Gpz/FxGACG+ivQOKrbgLnYoIpQm0npRBMtL9ZMpqzAkcXLMErvMXJED8IXXfJG0aBDH6JFKkqZSFCbNofpPI8ieEn+iiJ2QZryH/h4X3SgVlBGROWMlNboh8wX5HzihPoat8u976BT85RfUfzC1KJ+/hEJV7U2AA4z8+qXJwj+fmE2GuiIGsmZ8R1xkcDlZyqzVUPxoagxJSwJtoD9H3/cSYJJSwrd5pe/JQmxxRMdRydD78aEMxh9Y+aZX5XIZb0x9s+VLiR/3kUA3GSJ5gw/c0n5QpMQVkNjZtEfRIJAaRumOBGpL8qJcHQHd0w+MAuig1HzkTJcWVdPY8SPC8OkRoAbV3SKxWg0UQHPHnor7frlshd+3AiPy7IGibue2g2C6zQgecCDEhr0QPnhPV/Ti8/Q9RW6UHJ4JUOoBTHaoDf8OvvA7x74u5CHOGtOUsu2kL1WjgZ36jn7iOwZcxSGTKHGJDtXuckSYWB0ua5uc/HYzabn4dxS4Sxro4dpEg/kicFeeIiUoHBoosgKrIGkUhKY3/x6CnJklJ0+2oc6W/K1H5SKODRceoVLOtNjZXj6IK6hVTyumOW8T7/lanvHM8AnpK7EjRTW9xt/njNs1nVdaThX+KyLkU=',1),(9619518,2,'Sonia','Cordoba','ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=','2548475154',1),(9629702,12,'Ruben','Godoy','ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=','WXsjxxCSSjrih+s2QwNSEUPPoE/D+jUqfv0W33mehLZjThcOO34Gpz/FxGACG+ivQOKrbgLnYoIpQm0npRBMtL9ZMpqzAkcXLMErvMXJED8IXXfJG0aBDH6JFKkqZSFCbNofpPI8ieEn+iiJ2QZryH/h4X3SgVlBGROWMlNboh8wX5HzihPoat8u976BT85RfUfzC1KJ+/hEJV7U2AA4z8+qXJwj+fmE2GuiIGsmZ8R1xkcDlZyqzVUPxoagxJSwJtoD9H3/cSYJJSwrd5pe/JQmxxRMdRydD78aEMxh9Y+aZX5XIZb0x9s+VLiR/3kUA3GSJ5gw/c0n5QpMQVkNjZtEfRIJAaRumOBGpL8qJcHQHd0w+MAuig1HzkTJcWVdPY8SPC8OkRoAbV3SKxWg0UQHPHnor7frlshd+3AiPy7IGibue2g2C6zQgecCDEhr0QPnhPV/Ti8/Q9RW6UHJ4JUOoBTHaoDf8OvvA7x74u5CHOGtOUsu2kL1WjgZ36jn7iOwZcxSGTKHGJDtXuckSYWB0ua5uc/HYzabn4dxS4Sxro4dpEg/kicFeeIiUoHBoosgKrIGkUhKY3/x6CnJklJ0+2oc6W/K1H5SKODRceoVLOtNjZXj6IK6hVTyumOW8T7/lanvHM8AnpK7EjRTW9xt/njNs1nVdaThX+KyLkU=',1),(11264888,11,'Lerida','Figueroa','ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=','WXsjxxCSSjrih+s2QwNSEUPPoE/D+jUqfv0W33mehLZjThcOO34Gpz/FxGACG+ivQOKrbgLnYoIpQm0npRBMtL9ZMpqzAkcXLMErvMXJED8IXXfJG0aBDH6JFKkqZSFCbNofpPI8ieEn+iiJ2QZryH/h4X3SgVlBGROWMlNboh8wX5HzihPoat8u976BT85RfUfzC1KJ+/hEJV7U2AA4z8+qXJwj+fmE2GuiIGsmZ8R1xkcDlZyqzVUPxoagxJSwJtoD9H3/cSYJJSwrd5pe/JQmxxRMdRydD78aEMxh9Y+aZX5XIZb0x9s+VLiR/3kUA3GSJ5gw/c0n5QpMQVkNjZtEfRIJAaRumOBGpL8qJcHQHd0w+MAuig1HzkTJcWVdPY8SPC8OkRoAbV3SKxWg0UQHPHnor7frlshd+3AiPy7IGibue2g2C6zQgecCDEhr0QPnhPV/Ti8/Q9RW6UHJ4JUOoBTHaoDf8OvvA7x74u5CHOGtOUsu2kL1WjgZ36jn7iOwZcxSGTKHGJDtXuckSYWB0ua5uc/HYzabn4dxS4Sxro4dpEg/kicFeeIiUoHBoosgKrIGkUhKY3/x6CnJklJ0+2oc6W/K1H5SKODRceoVLOtNjZXj6IK6hVTyumOW8T7/lanvHM8AnpK7EjRTW9xt/njNs1nVdaThX+KyLkU=',1),(13527711,14,'Marling','Brito','ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=','WXsjxxCSSjrih+s2QwNSEUPPoE/D+jUqfv0W33mehLZjThcOO34Gpz/FxGACG+ivQOKrbgLnYoIpQm0npRBMtL9ZMpqzAkcXLMErvMXJED8IXXfJG0aBDH6JFKkqZSFCbNofpPI8ieEn+iiJ2QZryH/h4X3SgVlBGROWMlNboh8wX5HzihPoat8u976BT85RfUfzC1KJ+/hEJV7U2AA4z8+qXJwj+fmE2GuiIGsmZ8R1xkcDlZyqzVUPxoagxJSwJtoD9H3/cSYJJSwrd5pe/JQmxxRMdRydD78aEMxh9Y+aZX5XIZb0x9s+VLiR/3kUA3GSJ5gw/c0n5QpMQVkNjZtEfRIJAaRumOBGpL8qJcHQHd0w+MAuig1HzkTJcWVdPY8SPC8OkRoAbV3SKxWg0UQHPHnor7frlshd+3AiPy7IGibue2g2C6zQgecCDEhr0QPnhPV/Ti8/Q9RW6UHJ4JUOoBTHaoDf8OvvA7x74u5CHOGtOUsu2kL1WjgZ36jn7iOwZcxSGTKHGJDtXuckSYWB0ua5uc/HYzabn4dxS4Sxro4dpEg/kicFeeIiUoHBoosgKrIGkUhKY3/x6CnJklJ0+2oc6W/K1H5SKODRceoVLOtNjZXj6IK6hVTyumOW8T7/lanvHM8AnpK7EjRTW9xt/njNs1nVdaThX+KyLkU=',1),(13991250,9,'Ligia','Durán','ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=','WXsjxxCSSjrih+s2QwNSEUPPoE/D+jUqfv0W33mehLZjThcOO34Gpz/FxGACG+ivQOKrbgLnYoIpQm0npRBMtL9ZMpqzAkcXLMErvMXJED8IXXfJG0aBDH6JFKkqZSFCbNofpPI8ieEn+iiJ2QZryH/h4X3SgVlBGROWMlNboh8wX5HzihPoat8u976BT85RfUfzC1KJ+/hEJV7U2AA4z8+qXJwj+fmE2GuiIGsmZ8R1xkcDlZyqzVUPxoagxJSwJtoD9H3/cSYJJSwrd5pe/JQmxxRMdRydD78aEMxh9Y+aZX5XIZb0x9s+VLiR/3kUA3GSJ5gw/c0n5QpMQVkNjZtEfRIJAaRumOBGpL8qJcHQHd0w+MAuig1HzkTJcWVdPY8SPC8OkRoAbV3SKxWg0UQHPHnor7frlshd+3AiPy7IGibue2g2C6zQgecCDEhr0QPnhPV/Ti8/Q9RW6UHJ4JUOoBTHaoDf8OvvA7x74u5CHOGtOUsu2kL1WjgZ36jn7iOwZcxSGTKHGJDtXuckSYWB0ua5uc/HYzabn4dxS4Sxro4dpEg/kicFeeIiUoHBoosgKrIGkUhKY3/x6CnJklJ0+2oc6W/K1H5SKODRceoVLOtNjZXj6IK6hVTyumOW8T7/lanvHM8AnpK7EjRTW9xt/njNs1nVdaThX+KyLkU=',1),(15693145,13,'Indira','Gonzáles','ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=','WXsjxxCSSjrih+s2QwNSEUPPoE/D+jUqfv0W33mehLZjThcOO34Gpz/FxGACG+ivQOKrbgLnYoIpQm0npRBMtL9ZMpqzAkcXLMErvMXJED8IXXfJG0aBDH6JFKkqZSFCbNofpPI8ieEn+iiJ2QZryH/h4X3SgVlBGROWMlNboh8wX5HzihPoat8u976BT85RfUfzC1KJ+/hEJV7U2AA4z8+qXJwj+fmE2GuiIGsmZ8R1xkcDlZyqzVUPxoagxJSwJtoD9H3/cSYJJSwrd5pe/JQmxxRMdRydD78aEMxh9Y+aZX5XIZb0x9s+VLiR/3kUA3GSJ5gw/c0n5QpMQVkNjZtEfRIJAaRumOBGpL8qJcHQHd0w+MAuig1HzkTJcWVdPY8SPC8OkRoAbV3SKxWg0UQHPHnor7frlshd+3AiPy7IGibue2g2C6zQgecCDEhr0QPnhPV/Ti8/Q9RW6UHJ4JUOoBTHaoDf8OvvA7x74u5CHOGtOUsu2kL1WjgZ36jn7iOwZcxSGTKHGJDtXuckSYWB0ua5uc/HYzabn4dxS4Sxro4dpEg/kicFeeIiUoHBoosgKrIGkUhKY3/x6CnJklJ0+2oc6W/K1H5SKODRceoVLOtNjZXj6IK6hVTyumOW8T7/lanvHM8AnpK7EjRTW9xt/njNs1nVdaThX+KyLkU=',1),(17227723,280,'Esleidys','Rodriguez','direccion','04261234567',1),(19432505,160,'Arturo','Vila','Dirección','04141234567',1),(20009949,227,'Lenny','Yépez','direccion','04261234567',1),(24399094,89,'Gerardo ','Bravo','Dirección','04141234567',1),(24417327,190,'Daniel','Mujica','direccion','04126461698',1),(25526317,281,'Jhonny','Alvarado','direccion','04261234567',1),(25526435,126,'Hermes Millo','Hernández Arias','direccion','04166550234',1),(25541868,276,'Gabriel','Márquez','direccion','04261234567',1),(25894780,57,'Sarai','Perez','Direccion','04245128963',1),(25956573,147,'Hennys Enrique','Perez Perez','Dirección','04163140197',1),(25961485,185,'Edixon','Torres','direccion','04261234567',1),(26076982,70,'Yonny Jesus','Pargas','direccion','04245339829',1),(26141422,45,'Frank','Pineda','direccion','04122687417',1),(26197135,33,'Maria Jose','Diaz','direccion','04245044351',1),(26555637,115,'Daniel Josue','Arenas Peñaloza','Dirección','04141234567',1),(26779660,239,'Daniel','Rojas','direccion','04261234567',1),(26800302,213,'Gustavo','Mendoza','direccion','04261234567',1),(26831466,138,'Guy Castillo','Albert Daniel','direccion','04261234567',1),(26945388,78,'Jesus Alejandro','Martinez Escobar','Dirección','04141234567',1),(26976737,277,'Diana','Escalona','direccion','04261234567',1),(27025337,83,'Leonardo Jose','Melendez','Dirección','04141234567',1),(27120700,285,'JESUS ALBERTO','BORZELLINO GUEDEZ','direccion','04266586616',1),(27198786,117,'Gabriel Alejandro','Fernandez Arrieche','Dirección','04141234567',1),(27199177,60,'Jesus','Canelon','direccion','04143545920',1),(27210776,30,'Robert','Luna','Dirección','04141234567',1),(27388616,67,'Jesus Alexander','Perdomo Perdomo','direccion','04245772272',1),(27397112,98,'Anny Geraldine','Reyes Rivero','direccion','04261234567',1),(27411195,212,'Jesús','Calderas','direccion','04261234567',1),(27436179,82,'Jose Angel ','Morales Gonzalez','Dirección','04141234567',1),(27554490,279,'Joverly','Díaz','direccion','04261234567',1),(27586482,121,'Rosbely ','Guedez','Dirección','04120502474',1),(27629456,146,'Adrian Jose','Quintero Rojas','Dirección','04245996332',1),(27629581,39,'Arianna','Colmenarez','direccion','04267346011',1),(27666555,58,'Jesus','Aguirre','direccion','04122689578',1),(27667928,282,'DARLA ANGELINA','PERAZA ESPINOZA','direccion','04166546047',1),(27736558,199,'Angie','Bayona','direccion','04261234567',1),(27737198,113,'Luis','Yepez','Dirección','04141234567',1),(27737458,56,'Ricardo Andres','Hernandez Gonzalez','Dirección','04141234567',1),(27828169,119,'Heyker David','Vargas Fernandez','Dirección','04141234567',1),(27831369,100,'Abraham Isaac','Amaro Camejo','direccion','04261234567',1),(28019244,211,'Daniel','López','direccion','04261234567',1),(28020203,106,'Joseph','Suarez','Dirección','04141234567',1),(28055655,29,'Cesar','Vides','direccion','04120318406',1),(28113106,32,'Jose','Vasquez','Dirección','04141234567',1),(28150004,66,'Juan Ernesto','Silva Linarez','direccion','04121338031',1),(28204985,31,'Luis','Quevedo','direccion','04125247872',1),(28256789,179,'Erian Antonio','Arrechera Bello','direccion','04261234567',1),(28286982,144,'Jose','De Marzo','Dirección','04245359186',1),(28297900,171,'Angel Daniel','García Pérez','direccion','04261234567',1),(28338690,145,'Benito Antonio','Uzcategui Rodriguez','Dirección','04161393796',1),(28363656,49,'Kevin','Falcon','direccion','04245506186',1),(28363772,44,'Gabriel','Garcia','direccion','04145514422',1),(28363903,172,'Josmer','Cueri','Dirección','04120582637',1),(28381831,64,'Kelvin Joel','Mendez Frankiz','Dirección','04141234567',1),(28406215,112,'Nathan','Mendoza','Dirección','04141234567',1),(28406618,80,'Yonaiker Francisco','Peña Matos','Dirección','04141234567',1),(28406661,65,'Fernando Jose','Alvarado Alvarado','Dirección','04141234567',1),(28406924,169,'Braynt de Jesús ','Medina Briseño','direccion','04261234567',1),(28453954,193,'Angel','Oliveira','direccion','04120535207',1),(28454122,156,'Danielson','Goyo','Dirección','04141234567',1),(28466973,91,'Manuel Alejandro','Rojas Soteldo','Dirección','04141234567',1),(28493197,201,'Daniel','Corro','direccion','04261234567',1),(28516209,244,'Manuela','Mujica','direccion','04261234567',1),(28528588,109,'Javier','Rojas','Dirección','04141234567',1),(28539728,140,'Hernan Alejandro','Meza Perez','Dirección','04245679063',1),(28566432,1,'Admin','admin','Urb. La Concordia','04247777777',1),(28591973,35,'Jesus David','Regalado Torrealba','d','04141234567',1),(28609972,97,'Ariangel Stefany','Valladares Pérez','direccion','04261234567',1),(28646706,157,'Engels David','Grau Arias ','direccion','04261234567',1),(28661484,114,'Zenon','Barradas','direccion','04261234567',1),(28672771,50,'Miguel','Pacini','direccion','04245647236',1),(28699599,275,'Samuel','Arriechi','direccion','04261234567',1),(29442380,51,'Kevin','Heredia','direccion','04263076322',1),(29506241,88,'Jesus Santiago','Hernandez Perez','direccion','04120549313',1),(29506862,79,'Surelys Cristina','Perez Estrada','direccion','04244982882',1),(29506932,59,'Moises Jesus','Torrellas Colmenarez','Dirección','04141234567',1),(29517871,62,'Leonardo Antonio','Medina Garcia','Dirección','04141234567',1),(29531465,142,'Yonathan Joseph','Mogollon Duran','Dirección','04123652677',1),(29531677,116,'Gerson Jesus','Ballestero Salcedo','Dirección','04141234567',1),(29560584,192,'Enderson','Medina','direccion','04261234567',1),(29604245,42,'Ruander','Cuello','direccion','04241234567',1),(29623228,52,'Yonjarman Jesus','Perez Alvarez','Dirección','04141234567',1),(29623277,274,'Jesús','Pérez','direccion','04261234567',1),(29624646,278,'Micchelle','Sánchez','direccion','04261234567',1),(29624981,200,'Cesar Antonio','Carrera Días ','direccion','04261234567',1),(29654148,118,'Bedalys Coromoto','Vivas Gil','Dirección','04141234567',1),(29707067,107,'Freiderth','Alvarado ','Dirección','04141234567',1),(29707117,48,'Carlos','Gomez','direccion','04245336144',1),(29778208,36,'Daniela','Veliz','direccion','04245009023',1),(29795114,46,'Angel','Mujica','direccion','04245599069',1),(29805941,250,'Nachor','Ollarves','direccion','04261234567',1),(29831184,41,'Diego','Aguilar','direccion','04122448721',1),(29851122,28,'Stephan','Vilchez','Dirección','04141234567',1),(29873164,283,'ROXANA RIZETH','RAMOS SERRANO','direccion','04143531978',1),(29873456,68,'José Rafael','Escalona Benitez','direccion','04122648727',1),(29873538,94,'Miguel Alejandro','Perez Leal','direccion','04262661913',1),(29880397,86,'Victor ','Guaramato','Dirección','04141234567',1),(29880973,90,'Jesus David','Rojas Cuello','Dirección','04141234567',1),(29895827,95,'Gustavo José ','Jiménez Torres','direccion','04261234567',1),(29896041,173,'Adrian','Duin','Dirección','04266041184',1),(29913125,23,'Gonzalo','Pineda','Dirección','04141234567',1),(29913199,99,'Francisco Javier','Mendoza Domínguez','direccion','04261234567',1),(29944858,215,'Jhonnel','González','direccion','04261234567',1),(29945099,43,'Cirez','Barriga','direccion','04145229435',1),(29945119,133,'Lisseth Annarella','Silva Valera','Dirección','04167581180',1),(29957469,125,'Gabriel Enrique','Mujica Chirinos','direccion','04261234567',1),(29972530,73,'Edouard Rafael','Sandoval Querales','direccion','04122943118',1),(29976008,220,'Brian','Escalona','direccion','04261234567',1),(29976514,141,'Gustavo Antonio','Heredia Baldayo','direccion','04265575858',1),(29976685,143,'Wilden Jesús','Rodríguez Bravo','direccion','04124836610',1),(29997704,165,'Daniel Arturo','Farías Puerta','direccion','04261234567',1),(29997994,92,'Yessica Valentina','Melendez Chirinos','Dirección','04141234567',1),(30014771,221,'Angel','Martínez','direccion','04261234567',1),(30071615,61,'Nestor Alonso ','Vergas Pire','Dirección','04141234567',1),(30072062,37,'Yohander Jose','Dorantes Gomez','Dirección','04141234567',1),(30074007,47,'Angel','Delgado','direccion','04145529632',1),(30087582,72,'Luis Alejandro','Garnica Vargas','direccion','04126742231',1),(30088197,284,'FRANK LUIS','YEPEZ OLIVA','direccion','04161571721',1),(30095928,187,'Jesus Enrique','Fernandez Perozo','Dirección','04141234567',1),(30105192,225,'Yhensy','Melendez','direccion','04261234567',1),(30105575,120,'Niccol Daniel','Rodriguez Sabaleta','Dirección','04122974275',1),(30125965,174,'Paula Yeanmary','Rivero Paiva','direccion','04261234567',1),(30128473,163,'Diego Andrés','López Vivas','direccion','04261234567',1),(30128602,196,'Leslimar','Rivero','direccion','04261234567',1),(30129964,176,'Anderson Arévalo','Perozo Domínguez','direccion','04261234567',1),(30130281,122,'Endhismarot','Peralta','Dirección','04161218297',1),(30130317,183,'Wilker Gabriel','Alburjas Agüero','direccion','04245674040',1),(30145565,38,'Gabriel Alejandro','Perez Mendez','Dirección','04141234567',1),(30145618,159,'Jorge Luis','Mora García','direccion','04261234567',1),(30205068,137,'Jesus Gabriel','Daza Garcia','Dirección','04262638476',1),(30218425,101,'Francheska Karelys','Monsalve Medina','direccion','04261234567',1),(30218482,132,'Robert Sabino','Vargas Cañizalez','direccion','04120552258',1),(30218708,71,'Yarelys Yoleida','Ramos Ramos','direccion','04164940217',1),(30218990,93,'Jose Guillermo','Perez Soto','direccion','04260563224',1),(30226558,84,'Gabriela Alejandra','Palma Adjunta','Dirección','04141234567',1),(30266398,161,'Leizer Gabriel','Torrealba Aponte','direccion','04261234567',1),(30266400,216,'Mariangel','Escobar','direccion','04261234567',1),(30266577,27,'Jeremy','Piñero','Dirección','04141234567',1),(30300960,131,'Juan Manuel','Colmenzarez Mendoza','direccion','04245811822',1),(30304373,166,'Raymari','Romero','Dirección','04245849724',1),(30317355,135,'Marcos ','Arrieche','Dirección','04245130149',1),(30317478,139,'Saddiel Alejandro','Reyes Soto','direccion','04261234567',1),(30318222,154,'Diego','Barreto','Dirección','04141234567',1),(30324703,255,'María','Pérez','direccion','04261234567',1),(30324954,167,'Eliecer Fernando','Hernández Juárez','direccion','04261234567',1),(30335417,180,'Simón José ','Freitez Díaz','direccion','04241587101',1),(30344763,136,'Ely José','Sivira Natera','direccion','04261234567',1),(30353397,164,'Rafael Daniel','Gutiérrez Rojas ','direccion','04261234567',1),(30353577,251,'Yancarlos','Camacaro','direccion','04261234567',1),(30376386,87,'Josmarlex Antonieta','Alvarado Perez','direccion','04125175091',1),(30396029,111,'Orlando Antonio','Barrientos Monasterios','direccion','04261234567',1),(30396184,226,'Kevin','Medina','direccion','04261234567',1),(30405566,148,'Abrahan','Rodriguez','Dirección','04141234567',1),(30405571,168,'Moises','Contreras','Dirección','04120483397',1),(30405793,222,'Reichel','Morales','direccion','04261234567',1),(30434563,189,'Karen','Herrera','direccion','04261234567',1),(30448190,261,'Elianyibeth','Colmenarez','direccion','04261234567',1),(30454597,204,'Franklin Javier','Fonseca Vásquez','direccion','04261234567',1),(30479630,218,'Jeremias','Arrieche','direccion','04261234567',1),(30485795,110,'Rafael Alfonzo','Jiménez Colina','direccion','04165165583',1),(30528058,191,'Freider','Guédez','direccion','04267955615',1),(30529335,128,'Jhonder','Abreu','Dirección','04169554296',1),(30529448,134,'Edixón José','Zambrano Echeverría','direccion','04261234567',1),(30553759,170,'Frangher','Pereira','Dirección','04125126988',1),(30554053,75,'Wilmer Daniel','Baez Rivero','direccion','04244151331',1),(30554088,81,'Luciano Salvador','Guedez Perez','direccion','04265259901',1),(30554145,76,'Dixon Daniel','Bastias Hernandez','direccion','04165378241',1),(30554404,74,'Felix Aaron','Dominguez Colmenares','direccion','04121506791',1),(30554657,69,'Rosimar Angelis','Pernalete Alvarado','direccion','04160592168',1),(30560144,209,'Joaquin','Mendoza','direccion','04261234567',1),(30560426,177,'Angel David','Mendoza Pérez','direccion','04261234567',1),(30560560,210,'Johan','Montero','direccion','04261234567',1),(30587563,150,'Ruby Florismar','Pérez Quintero','direccion','04245271448',1),(30587785,202,'Mariangel Carolina','Bokor Vargas','direccion','04261234567',1),(30588476,219,'Stefany','Bello','direccion','04261234567',1),(30591237,40,'LUIS','PERDOMO','direccion','04141392278',1),(30591468,197,'Jose','Martinez','direccion','04261234567',1),(30601403,96,'Jesús Gabriel','Escalona','direccion','04261234567',1),(30601663,184,'Rosa Isabel ','Pérez Gómez ','direccion','04161855110',1),(30601666,257,'Alan','Montilla','direccion','04261234567',1),(30621800,256,'Mairelys','Marín','direccion','04261234567',1),(30621851,232,'Michell','Urra','direccion','04261234567',1),(30621894,105,'Yosibel de los Angeles','Castillo Díaz','direccion','04128236732',1),(30657597,248,'Daniel','Lucena','direccion','04261234567',1),(30657852,108,'Ricardo Josué','Barradas Justo','direccion','04245903491',1),(30664122,104,'Ricardo David','Villegas Viana','direccion','04121986875',1),(30664596,181,'Juan Tomas ','Angulo Mendoza','direccion','04127278473',1),(30664778,195,'Janin','Aboutraba','direccion','04261234567',1),(30668285,158,'Helianta Reimar','Guevara Valera','direccion','04261234567',1),(30672886,77,'Jerwin Gabriel','Teran Yanez','direccion','04120605676',1),(30675539,247,'Isai','Páez','direccion','04261234567',1),(30694379,217,'Johan','Montes','direccion','04261234567',1),(30716220,129,'Juan Gabriel','Valera Godoy','direccion','04263555904',1),(30716405,230,'Dayner','Torrealba','direccion','04261234567',1),(30716541,130,'Daniel Eduardo','Sanchez Rojas','Dirección','04149739941',1),(30753799,102,'José Gregorio','Carrillo Carmona','direccion','04261234567',1),(30753955,178,'Jesús Miguel','Calderón Barón','direccion','04261234567',1),(30753995,205,'Rhichard','Virguez','direccion','04261234567',1),(30754113,162,'José Gregorio','Mujica Escalona','direccion','04261234567',1),(30754260,207,'Briayan','Pernis','direccion','04261234567',1),(30759776,186,'Verónica','Villamizar','direccion','04261234567',1),(30803098,194,'Fenix','Román','direccion','04245261797',1),(30803623,260,'Genesis','Rodríguez','direccion','04261234567',1),(30845389,264,'Johan','Sandrea','direccion','04261234567',1),(30846149,234,'Miguel','Valbuena','direccion','04261234567',1),(30873409,85,'Maykel Jose','Escalona','direccion','04266495997',1),(30880746,123,'Samuel Alejandro','Belzares Peña','direccion','04261234567',1),(30894865,155,'Liam Xavier ','Morillo Bastidas','direccion','04261234567',1),(30894974,246,'Angela','Rojas','direccion','04261234567',1),(30895294,149,'Juan Antonio','García Gutiérrez','direccion','04145701851',1),(30916580,269,'Leonel','Piña','direccion','04261234567',1),(30979558,175,'Zharick Nicole','Guedez Colmenares','direccion','04261234567',1),(30979684,266,'Kairovis','Hernández','direccion','04261234567',1),(30979806,223,'Yeescarlys','Prado','direccion','04261234567',1),(30987377,270,'Jeremy','Rodríguez','direccion','04261234567',1),(31018207,259,'Emmanuel','Hernández','direccion','04261234567',1),(31018229,254,'Víctor','Giménez','direccion','04261234567',1),(31026149,233,'Emmanuel','Suárez','direccion','04261234567',1),(31027477,263,'Jenhson','Meléndez','direccion','04261234567',1),(31066439,153,'Rijals Moises','Carrasquero Delgado','direccion','04261234567',1),(31066519,235,'Arturo','Cabrita','direccion','04261234567',1),(31111539,237,'José','Colombo','direccion','04261234567',1),(31117996,241,'Kleydis','García','direccion','04261234567',1),(31118074,262,'Jhonatan','Barrios','direccion','04261234567',1),(31162171,249,'Brandon','Sánchez','direccion','04261234567',1),(31169313,265,'David','Ortíz','direccion','04261234567',1),(31194917,203,'Fredyorgeth Humberto','Rivas Anselmi','direccion','04261234567',1),(31212573,267,'Jhoander','Aguilar','direccion','04261234567',1),(31212599,182,'Jhon Angel','Arrieche Díaz','direccion','04261234567',1),(31212740,152,'Juanangel','Mendez','Dirección','04141234567',1),(31233952,228,'Adrián','Aguirre','direccion','04261234567',1),(31244876,272,'Olinto','Silva','direccion','04261234567',1),(31258935,188,'Eliot','Puerta','direccion','04261234567',1),(31271852,206,'Miguel','Torres','direccion','04261234567',1),(31272034,258,'Alfredo','Martínez','direccion','04261234567',1),(31300939,103,'Brigid Alexandra','Parra Zambrano','direccion','04261234567',1),(31366952,240,'Cirielis','Rojas','direccion','04261234567',1),(31388606,229,'Angel','Rojo','direccion','04261234567',1),(31401678,245,'Ridan','Al Chair','direccion','04261234567',1),(31464007,208,'Edwin','Mollejas','direccion','04261234567',1),(31492771,124,'Jesus David','Viloria Olivar','direccion','04261234567',1),(31493172,273,'Edgmairis','Apóstol','direccion','04261234567',1),(31544822,127,'Jhonger Alicxon','Barroeta Soler','direccion','04120424415',1),(31550201,224,'Santiago','Oviedo','direccion','04261234567',1),(31766216,231,'Omar','Saraiedin','direccion','04261234567',1),(31835884,253,'Leonardo','Torres','direccion','04261234567',1),(31842780,268,'Danny','Vásquez','direccion','04261234567',1),(31843937,151,'Jorge Andrés','Cabrera Meléndez','direccion','04245567016',1),(31926201,271,'Nellisbeth','Luna','direccion','04261234567',1),(31986901,238,'Snehyberth','Omaña','direccion','04261234567',1),(32023069,214,'Andreina','Soto','direccion','04261234567',1),(32029094,63,'Luis Angel','Ceballos Rodriguez','Dirección','04141234567',1),(32593540,252,'Diosnel','Vargas','direccion','04261234567',1),(34234234,243,'asasd','asdasd','asdaasd','04244154245',1),(52213548,18,'Pedro','Castillo','ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=','WXsjxxCSSjrih+s2QwNSEUPPoE/D+jUqfv0W33mehLZjThcOO34Gpz/FxGACG+ivQOKrbgLnYoIpQm0npRBMtL9ZMpqzAkcXLMErvMXJED8IXXfJG0aBDH6JFKkqZSFCbNofpPI8ieEn+iiJ2QZryH/h4X3SgVlBGROWMlNboh8wX5HzihPoat8u976BT85RfUfzC1KJ+/hEJV7U2AA4z8+qXJwj+fmE2GuiIGsmZ8R1xkcDlZyqzVUPxoagxJSwJtoD9H3/cSYJJSwrd5pe/JQmxxRMdRydD78aEMxh9Y+aZX5XIZb0x9s+VLiR/3kUA3GSJ5gw/c0n5QpMQVkNjZtEfRIJAaRumOBGpL8qJcHQHd0w+MAuig1HzkTJcWVdPY8SPC8OkRoAbV3SKxWg0UQHPHnor7frlshd+3AiPy7IGibue2g2C6zQgecCDEhr0QPnhPV/Ti8/Q9RW6UHJ4JUOoBTHaoDf8OvvA7x74u5CHOGtOUsu2kL1WjgZ36jn7iOwZcxSGTKHGJDtXuckSYWB0ua5uc/HYzabn4dxS4Sxro4dpEg/kicFeeIiUoHBoosgKrIGkUhKY3/x6CnJklJ0+2oc6W/K1H5SKODRceoVLOtNjZXj6IK6hVTyumOW8T7/lanvHM8AnpK7EjRTW9xt/njNs1nVdaThX+KyLkU=',1),(63578247,242,'Nombre','Apellido','aasdasd','04244154245',1),(234565423,4,'Orlando','Guerra','ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=','2548475154',1),(654854354,3,'Ricardo','Tillero','ZoV52kTa1gsiY4C37GxsEUz1PPSEB7l3EWTrsLmPMkdElicxxx/X1iTzEY9v3T3S/b0YgDano3dNQwpdtLgHd4mL8dqEbaogXO5rZ7SdQIdP2mbamjq2lchTzzJiWEaTAs/S60fjoqBTM6dH9R6W5QgjHBXdrybwjnXvZl3doRzlTqJAr7rt/jnRDtiAZbAwxWJ6Q1/8u6p8dEK0ZPmeGYiXRPPMT6D3zG6RzoARHYzPeWAsTIiLCZi/Cn5j1E7cOoY1or9xsNxDL8IlUMCF6ljL0KNrn1wYLJ35kAycUEPm4JZqTcP4Y5F1K5ftCHwbQxwhvQHMoIdaYY05gaZOnyU2uwHKuf1JuGa8805sB3hOIl9IWjuhBh5CtbHFPwVn9oB7neR6qxmtARPozSXaou3GM5bc98OAlKiP48BaQ01ktxu9Wzr20nFDiMn+H3wVqYoTkQZ3eikrN2rrVyV9ixKrp0AkppoJUAXb9qMCqdP+UHAOIIwLAMiVuOx0ki+hZvPJTRx//NnpcHC+PrGEQSDMVBFj7ai+nFIjBnjRKvwRgu0Cw26e7l6Xa2dXrx92W4vZPgGO2bMWQ7KXgSeseOIbprS/iw+XsAEEH5WZMRx0Nai/YG4wCD3x9a7OkJQiIy92AJgarO0FOtvvUXjlIMf/1E8iJn3pecY5E+Y1msM=','2548475154',1);
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pregunta`
--

DROP TABLE IF EXISTS `pregunta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pregunta` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pregunta` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pregunta`
--

LOCK TABLES `pregunta` WRITE;
/*!40000 ALTER TABLE `pregunta` DISABLE KEYS */;
INSERT INTO `pregunta` VALUES (1,'Nombre de tu mascota?'),(2,'Donde estudiaste?'),(3,'Color favorito?');
/*!40000 ALTER TABLE `pregunta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profesor`
--

DROP TABLE IF EXISTS `profesor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profesor` (
  `codigo` varchar(255) NOT NULL,
  `persona_id` int DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `persona_id` (`persona_id`),
  CONSTRAINT `profesor_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`cedula`)
) ENGINE=InnoDB ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesor`
--

LOCK TABLES `profesor` WRITE;
/*!40000 ALTER TABLE `profesor` DISABLE KEYS */;
INSERT INTO `profesor` VALUES ('p-125487',125487),('p-5428468',5428468),('p-52844735',7392496),('p-132654318',7404027),('p-3542874',7423485),('p-135482354',9619518),('p-5487531',9629702),('p-54875538',11264888),('p-2658475',13527711),('p-354487534',13991250),('p-523156847',15693145),('p-52213548',52213548),('p-234565423',234565423),('p-654854354',654854354);
/*!40000 ALTER TABLE `profesor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyecto`
--

DROP TABLE IF EXISTS `proyecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proyecto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fase_id` varchar(255) NOT NULL,
  `parroquia_id` int NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `comunidad` varchar(255) NOT NULL,
  `motor_productivo` varchar(255) DEFAULT NULL,
  `resumen` text,
  `direccion` varchar(255) DEFAULT NULL,
  `consejo_comunal_id` int DEFAULT NULL,
  `observaciones` text,
  `tutor_in` varchar(255) DEFAULT NULL,
  `tutor_ex` varchar(255) DEFAULT NULL,
  `tlf_tin` varchar(12) DEFAULT NULL,
  `tlf_tex` varchar(12) DEFAULT NULL,
  `estatus` int DEFAULT NULL,
  `cerrado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fase_id` (`fase_id`),
  KEY `tutor_in` (`tutor_in`),
  KEY `consejo_comunal_id` (`consejo_comunal_id`),
  KEY `parroquia_id` (`parroquia_id`),
  CONSTRAINT `proyecto_ibfk_1` FOREIGN KEY (`fase_id`) REFERENCES `fase` (`codigo`),
  CONSTRAINT `proyecto_ibfk_2` FOREIGN KEY (`tutor_in`) REFERENCES `profesor` (`codigo`),
  CONSTRAINT `proyecto_ibfk_3` FOREIGN KEY (`consejo_comunal_id`) REFERENCES `consejo_comunal` (`id`),
  CONSTRAINT `proyecto_ibfk_4` FOREIGN KEY (`parroquia_id`) REFERENCES `parroquias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyecto`
--

LOCK TABLES `proyecto` WRITE;
/*!40000 ALTER TABLE `proyecto` DISABLE KEYS */;
INSERT INTO `proyecto` VALUES (1,'TR1_1',1,'Gestion de proyectos sociotecnologicos','UPTAEB','Informática','Gestión de proyectos para el PNF en informática','Av. Los Horcones, Av. La Salle, Barquisimeto 3001, Lara',1,NULL,'p-135482354','Jose Sequera','041254875','041255478',1,0);
/*!40000 ALTER TABLE `proyecto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyecto_historico`
--

DROP TABLE IF EXISTS `proyecto_historico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proyecto_historico` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_proyecto` int DEFAULT NULL,
  `consejo_comunal_id` int DEFAULT NULL,
  `codigo_trayecto` varchar(255) DEFAULT NULL,
  `codigo_siguiente_trayecto` varchar(255) DEFAULT NULL,
  `nombre_estudiante` varchar(255) DEFAULT NULL,
  `cedula_estudiante` int DEFAULT NULL,
  `nombre_proyecto` varchar(255) DEFAULT NULL,
  `nombre_trayecto` varchar(255) DEFAULT NULL,
  `resumen` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `comunidad` varchar(255) DEFAULT NULL,
  `motor_productivo` varchar(255) DEFAULT NULL,
  `nombre_consejo_comunal` varchar(255) DEFAULT NULL,
  `nombre_vocero_consejo_comunal` varchar(255) DEFAULT NULL,
  `telefono_consejo_comunal` varchar(255) DEFAULT NULL,
  `sector_consejo_comunal` varchar(255) DEFAULT NULL,
  `municipio` varchar(255) DEFAULT NULL,
  `parroquia_id` int DEFAULT NULL,
  `parroquia` varchar(255) DEFAULT NULL,
  `observaciones` text,
  `tutor_in` varchar(255) DEFAULT NULL,
  `tutor_ex` varchar(255) DEFAULT NULL,
  `tlf_tex` varchar(255) DEFAULT NULL,
  `nota_fase_1` float DEFAULT NULL,
  `nota_fase_2` float DEFAULT NULL,
  `estatus` int DEFAULT NULL,
  `periodo_inicio` date DEFAULT NULL,
  `periodo_final` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyecto_historico`
--

LOCK TABLES `proyecto_historico` WRITE;
/*!40000 ALTER TABLE `proyecto_historico` DISABLE KEYS */;
/*!40000 ALTER TABLE `proyecto_historico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `respuestas`
--

DROP TABLE IF EXISTS `respuestas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `respuestas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `respuesta` varchar(255) NOT NULL,
  `pregunta_id` int NOT NULL,
  `usuario_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `pregunta_id` (`pregunta_id`),
  CONSTRAINT `respuestas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  CONSTRAINT `respuestas_ibfk_2` FOREIGN KEY (`pregunta_id`) REFERENCES `pregunta` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `respuestas`
--

LOCK TABLES `respuestas` WRITE;
/*!40000 ALTER TABLE `respuestas` DISABLE KEYS */;
INSERT INTO `respuestas` VALUES (1,'onix',1,1),(2,'juan jose landaeta',2,1),(3,'azul',3,1);
/*!40000 ALTER TABLE `respuestas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'administrador'),(2,'profesor'),(3,'coordinador'),(4,'estudiante');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seccion`
--

DROP TABLE IF EXISTS `seccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seccion` (
  `codigo` varchar(255) NOT NULL,
  `trayecto_id` varchar(255) DEFAULT NULL,
  `observacion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `trayecto_id` (`trayecto_id`),
  CONSTRAINT `seccion_ibfk_1` FOREIGN KEY (`trayecto_id`) REFERENCES `trayecto` (`codigo`)
) ENGINE=InnoDB ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seccion`
--

LOCK TABLES `seccion` WRITE;
/*!40000 ALTER TABLE `seccion` DISABLE KEYS */;
INSERT INTO `seccion` VALUES ('IN1104','TR1','hjhgj'),('IN1114','TR1',''),('IN1124','TR1',''),('IN1134','TR1','REPITENCIA'),('IN1202','TR1',''),('IN1203','TR1',''),('IN1213','TR1',''),('IN2102','TR2',''),('IN2103','TR2',''),('IN2112','TR2',''),('IN2113','TR2',''),('IN3102','TR3',''),('IN3103','TR3',''),('IN3104','TR3',''),('IN3301','TR3',''),('IN3302','TR3',''),('IN4401','TR4',''),('IN4402','TR4',''),('IN4403','TR4','IUJO');
/*!40000 ALTER TABLE `seccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sector_consejo_comunal`
--

DROP TABLE IF EXISTS `sector_consejo_comunal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sector_consejo_comunal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parroquia_id` int DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `parroquia_id` (`parroquia_id`),
  CONSTRAINT `sector_consejo_comunal_ibfk_1` FOREIGN KEY (`parroquia_id`) REFERENCES `parroquias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sector_consejo_comunal`
--

LOCK TABLES `sector_consejo_comunal` WRITE;
/*!40000 ALTER TABLE `sector_consejo_comunal` DISABLE KEYS */;
INSERT INTO `sector_consejo_comunal` VALUES (1,1,'Eje 1'),(2,4,'Eje 3');
/*!40000 ALTER TABLE `sector_consejo_comunal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trayecto`
--

DROP TABLE IF EXISTS `trayecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trayecto` (
  `codigo` varchar(255) NOT NULL,
  `periodo_id` int DEFAULT NULL,
  `calificacion_minima` float DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `siguiente_trayecto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `periodo_id` (`periodo_id`),
  KEY `siguiente_trayecto` (`siguiente_trayecto`),
  CONSTRAINT `trayecto_ibfk_1` FOREIGN KEY (`periodo_id`) REFERENCES `periodo` (`id`),
  CONSTRAINT `trayecto_ibfk_2` FOREIGN KEY (`siguiente_trayecto`) REFERENCES `trayecto` (`codigo`)
) ENGINE=InnoDB ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trayecto`
--

LOCK TABLES `trayecto` WRITE;
/*!40000 ALTER TABLE `trayecto` DISABLE KEYS */;
INSERT INTO `trayecto` VALUES ('TR1',1,80,'Trayecto I','TR2'),('TR2',1,80,'Trayecto II','TR3'),('TR3',1,80,'Trayecto III','TR4'),('TR4',1,80,'Trayecto IV',NULL);
/*!40000 ALTER TABLE `trayecto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rol_id` int DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `rol_id` (`rol_id`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=286 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,1,'root@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72','475c86c4b4921f3c49ff1fb828ca779e6530069e02e37f955de58265f093c96c'),(2,2,'sonia@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72',''),(3,2,'ricardo@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72',''),(4,2,'orlando@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72',''),(5,2,'lisset@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72',''),(6,2,'oswaldo@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72',''),(7,2,'pura@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72',''),(9,2,'ligia@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72',''),(10,2,'ingrid@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72',''),(11,2,'lerida@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72',''),(12,2,'ruben@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72',''),(13,2,'indira@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72',''),(14,2,'marling@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72',''),(17,2,'josesequera@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72',''),(18,2,'pedro@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72',''),(19,4,'Carlosestudiante@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72',''),(20,4,'Saraiestudiante@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72',''),(21,4,'Kevinestudiante@gmail.com','$2y$10$rLBxGygGRsLKk.nNNhbs1OD5PeH4ST/.LNG/93b49/lUA2/iaeM72',''),(23,4,'29913125@gmail.com','$2y$10$VWNZzdnE09Q.8Vqfo1VsLeNtizGrYHYGH4oRIMVPdrHCE1BZFcsd.',NULL),(24,4,'29913125@gmail.com','$2y$10$iwisWkUxZ4UOUA2QJI2PlOIrfcV53knu92nPTIHaBtSkSFOzmKYQ2',NULL),(25,4,'29913125@gmail.com','$2y$10$Yu../0j38Fd9MHA3kFLckeqlWseWCVWnp/RKF4CchVfnieokcojFK',NULL),(26,4,'29913125@gmail.com','$2y$10$Y6YGbJL8KMjLi/lVoLMDHOtWuj0AjF5LCyYyoGDEUnJGgmN.BIIsS',NULL),(27,4,'30266577@gmail.com','$2y$10$895VKHWv/AiOYi7ZPxR4T.jH29Q2pcxBa9J55HZ1XG.yGOO3ABOz6',NULL),(28,4,'29851122@gmail.com','$2y$10$XZg/BkDUz7jf9gX6yJMABORf0mbDPB2NSzfLFfqO..kH4Y5.I1U12',NULL),(29,4,'jbrcesarvides2018@gmail.com','$2y$10$eBJk8t2YkXN0GOJ0a7g8sefm9S3G6FKpo7OTuxcgC/0PX1oLkPdrq',NULL),(30,4,'27210776@gmail.com','$2y$10$c2dGyRJtnPUWuY/qufypMumsIWAqJrlEW9wEAAbW.Iql0eK6vyNHW',NULL),(31,4,'28204985@gmail.com','$2y$10$2hcvavUZyfTp9fS7sne4f.lPBboJP3B1Mw1xV1SMNhmYBru/9bBqi',NULL),(32,4,'28113106@gmail.com','$2y$10$1eBAVTLdwqhWgn.JTbH6lu88bMVSPuyh3xYdCYbqxjpy4D9Dq2Qqa',NULL),(33,4,'mjcazorla1997@gmail.com','$2y$10$mdsl6AnazKe6ScCqI8EYoO.XjzrvCuWx.Yu3u.SqLCeBzQB1hnSnK',NULL),(34,4,'danisalo2910@gmail.com','$2y$10$aP8Z3J7hBFvobF9SazO3aeolroyI/PJ1f2QBRQv93ihINRO5GHHb6',NULL),(35,4,'28591973@gmail.com','$2y$10$YzTdRSjsj/r/zSeCvDHnAOqI8p7xpAYXj4sOc/JyzGQtLRPmVJvUO',NULL),(36,4,'danisalo2910@gmail.com','$2y$10$AV2Ly7ApcwNcS2Lt38cEIeHKKtUUj8l2bYIB/5S3WOkVq4v3qB.uC',NULL),(37,4,'30072062@gmail.com','$2y$10$iXsfB6DdxPKzR/xTtgjeTOGzcEyFpl9S7YFtxw/Mr3xgxkr8FEAIK',NULL),(38,4,'30145565@gmail.com','$2y$10$lgRcdrfg2L1NEt/GHo19Le2CLZIyARAwePCpv/UHQAlc79R8IDDe.',NULL),(39,4,'27629581@gmail.com','$2y$10$BnXkB8HoM/E/7yOWIwqgUuQMG46BdPXqfRpjrSxe/wSSEdUZEBugy',NULL),(40,4,'lustavoguis@gmail.com','$2y$10$3XFwQYMzaAcsZPEpLQOOXuIyrSMdDoMGfVAF6JMJGA0W85BRhuXzO',NULL),(41,4,'diegoaguilar221202@gmail.com','$2y$10$W8iBMhdCe3oW2ZT5c1q6MefMtQy3XhhInERhl2bQWDsgcd5dH/IfG',NULL),(42,4,'ruander05@gmail.com','$2y$10$rAoG9UEP1a7R/ceddQp8RuiSFwY5mSoCHiAyiL8H90GwUeD1Qze9C',NULL),(43,4,'cirezeduardo10@gmail.com','$2y$10$8nDTxnzKV1d9d83gv0biwuFCVxK17/fvIEk0eFiKXSKpshmfdMTJm',NULL),(44,4,'gabrielthetito24@gmail.com','$2y$10$/kVsrBSXqT5CldbTEO1TiOxtCWmaX7alDM86hJATrFQzqfYji7jsG',NULL),(45,4,'frankpineda98@gmail.com','$2y$10$legAKXdvkqTDu1o5LcpIX.0TxXCQFDHGJvzhIUiJ.s9jbo8TciMTC',NULL),(46,4,'angelmujica2001@gmail.com','$2y$10$de86ePXFIE3BMA7eX7/28.uQPpfo/NudyU/Ca25fbHx.kkXnOr2Xq',NULL),(47,4,'angeleduardo200213@gmail.com','$2y$10$e7Wtaoz7.JjDtPenVPjxFu4WKD9LDs0srvcz1Q0nxpGiKGu68MBPG',NULL),(48,4,'carlos.gomez29707117@gmail.com','$2y$10$k6n3VBanHgrdeKKAhFOQN.Rb3TvJHX2V5zuQMhSawBQDu2gO2v8yS',NULL),(49,4,'kevin.af09@gmail.com','$2y$10$4NKIkdI.vVAjp0wkH6PbdOW6HdkNuqjnPTmnQU157QSF7PUrF.8O6',NULL),(50,4,'miguel.pacini2016@gmail.com','$2y$10$x7igK41wU7/ECyI1lCXbEuLX33xOuUC3ulGt6ZZ/mwg1HKQnf4R96',NULL),(51,4,'herediackevin@gmail.com','$2y$10$13rVgEbjAuT3GDpzLJQWFOgNC9sNOWtFH64TtU6iYHmAqwf/Bkwza',NULL),(52,4,'29623228@gmail.com','$2y$10$h2qgzDwB.rclMXapIdIrVu/khWvEe0xQcSYdTNfXO2ES0YTGpKrAO',NULL),(53,4,'ramirezcarc06@gmail.com','$2y$10$pOojGjuzAUDn/s6vl.jIauU8dXw6oM/YdVg40Vo2sAE/vXC7hPh/S',NULL),(54,4,'ramirezcarc06@gmail.com','$2y$10$EISItbmgnmwcxhJ1tYK46ekaIKctaB.76maU1RWNrAJ2x3VYGRca6',NULL),(55,4,'ramirezcarc06@gmail.com','$2y$10$AwEl8B0eY7N5SRLTS8alD.F4AAWCunuKqKDBedc70pT1rKA6ZXgz6',NULL),(56,4,'27737458@gmail.com','$2y$10$CdPGMYlwqgwYFp83YM1T.O56jzkUjqCb2JHkwmp4klrpjbhMx9oF.',NULL),(57,4,'perezpsarij@gmail.com','$2y$10$rgzXgmbUevzvn9rQG9NNwuX/z4RadFfj9zdOajC9X3.3SDTGhbpbq',NULL),(58,4,'quijess6@gmail.com','$2y$10$oijRke.for7nBZZZHs4nMuWQRp20Iy1LFBm20WW/FDXCKnesSw4mC',NULL),(59,4,'29506932@gmail.com','$2y$10$F5TO9MrpQ2zLLKqGBJG4nu0PFiAruZZkaDED8KQhyrry9iX2BRiJa',NULL),(60,4,'can3lon3000@gmail.com','$2y$10$4EatDdMXmgW/kgD/awkepOWsmBnsnGrdaQZpmBRUuvm7ErxZk.5zq',NULL),(61,4,'30071615@gmail.com','$2y$10$iFX1JfY.tsYPnDieQj8zJeosN6b5rydzkwnGGRc9Wj3vjJFFv7Wm6',NULL),(62,4,'29517871@gmail.com','$2y$10$dzuNnJ2MT1rDBgTymrIAfurD4JIpGPcuETIlMcgm0Ztmimb0aYNZe',NULL),(63,4,'32029094@gmail.com','$2y$10$dIOugx6THv5yCj85sNFu5e.s5ygz2wc4U8owQ0A8.xN5QjvFTt.K.',NULL),(64,4,'28381831@gmail.com','$2y$10$.bD9cI.RmeahM.Gwa/9xCOWEj1Ya/43.1ONKozPcQTqxXlVV34UXO',NULL),(65,4,'28406661@gmail.com','$2y$10$AUa6KN3ycn4kFX4v3UCE6.Bj7G49EpUE6qi4Vx.iuoPSxsaXoNxDy',NULL),(66,4,'dpanajuaner@gmail.com','$2y$10$b98.W5hrsX7W9vS7VFoFNeMCUocWvatKuDbd/RgsMnECb1YDoObzC',NULL),(67,4,'alexanderperdomo3001@gmail.com','$2y$10$2jKbwXbWUMDxdj7XpNMWLu8N9RRDK49oHWpA6aehnYeoDTbNVW37y',NULL),(68,4,'rafaeljeb@gmail.com','$2y$10$yAhN5AjcXRWBTvCUx7GtRe9WynJl0I5YcBt1M7SbtGmX0IGRscgx.',NULL),(69,4,'pernaleterosii@gmail.com','$2y$10$tKyNOB.RoYheiz1wktmYKuAEReKk1oMhpaEbH6vlXJUyumdTiWE.K',NULL),(70,4,'yonny.pargas@gmail.com','$2y$10$P.qeXSRki/JLLWUMeJtRpu.TWaIFQHxZBtazKtTm5wlMdBnIfEFgS',NULL),(71,4,'yarelysyramos@gmail.com','$2y$10$12HkggqCnimJp4exCIn3Ien2hG1iKR43hjT72J4woGB9YJt81Z3Ca',NULL),(72,4,'garnicaluis391@gmail.com','$2y$10$0SRndCSzeKo8q/yoZpj55OM8nnqXCD.cm2ybLiX.SNz955FVNh.3e',NULL),(73,4,'pinchos792003@gmail.com','$2y$10$Y8CyOTvyRSFuWPWo2kj9xub.VUjo2U9JLn3usMLrdoxeWxWoHJLFa',NULL),(74,4,'felix30554@gmail.com','$2y$10$Gu5gRCd5yiyX0djz60Jjn.qrc1mMEJuSVmAiVuwTp4qRy994p7rTO',NULL),(75,4,'wbaez975@gmail.com','$2y$10$cSc5wI5OO9ACQ0De4/o37u5zx2aPlAzA3B11wY6Ux1nDuSce4X8.6',NULL),(76,4,'dixondanielbastias@gmail.com','$2y$10$4gj4Bmoh7lR14gUo/.1r8ur6FHsVZdFHTgFLnOLINJ.cPSeol5iba',NULL),(77,4,'jerwin888teran@gmail.com','$2y$10$k3MDJkEp1.W6twb8MybvDuPj2UYYK.kDtM.ddZseKVAdNCGaCRMhO',NULL),(78,4,'26945388@gmail.com','$2y$10$G2/Ox.Xgn.3Sovg9eiwsRelgSJua058yW2DHXCkNfDzgiRJA.s.76',NULL),(79,4,'psurelys@gmail.com','$2y$10$XRbmnQLWb6382izwLC/d4e4IjxN.ZIThn4KSyP4ZS.OtQUJQB/rny',NULL),(80,4,'28406618@gmail.com','$2y$10$m8TPKPj//Nvi/9soENv2xepLbTsxV6m5FDkGlPEbYlI3Gelk7/tZq',NULL),(81,4,'lucianogp2004@gmail.com','$2y$10$1Sj/anE244IDFURYhV20VeXaMo0sNTCiPm25NXCZBGEbIQALOMy42',NULL),(82,4,'27436179@gmail.com','$2y$10$uxhQ.jadS1avUDrfP5NUB.CnKfUW5b8a3./Jt9zwLQ4613bzyi27C',NULL),(83,4,'27025337@gmail.com','$2y$10$W.zZrCTcs2HuRr7E2enXregt8FI.eHXnkEmdM97I13z6R.84/m28C',NULL),(84,4,'30226558@gmail.com','$2y$10$WgM.H/L22yKIV2rgt6rTx.3cKxfMr/1TVvNVOfKi5YYPbCrFx79P6',NULL),(85,4,'maykelescalona08@gmail.com','$2y$10$XKZTuWlbNGAcWqoI7wozzOp0Dl/xX7ohkmYNClv9m6RhZy1CxxUDO',NULL),(86,4,'29880397@gmail.com','$2y$10$MrF2NHlSfH6eiHU5ZtMrRuJT19wl7ENi11Cm3TKYVH91krmPjWOHW',NULL),(87,4,'josmaant@gmail.com','$2y$10$4tKz4odmkMbUnsmPdE2V/.uwh97w2zAfUlNYuqgrtnvILaB3.LuQu',NULL),(88,4,'jesus19pm@gmail.com','$2y$10$jCqwQJ51RVQv2u6d/SuOne01v5AobxeQRNlb5YjXXqn4nvS.XK7NG',NULL),(89,4,'24399094@gmail.com','$2y$10$RBFbXPTrfHNR3evwuaU5r.ez7.k1SAPb32Q4L9VldTszAPGOKT/AC',NULL),(90,4,'29880973@gmail.com','$2y$10$YPxeEJiqlU6Zj6d54uWDDu6BsMDd2dTW2lMYfPozAwTZDbGrnbx4C',NULL),(91,4,'28466973@gmail.com','$2y$10$B3XWv8DINzMMIjmpztxNk.cQn/58OSJW9a/nAV06l/KfjoOVDke/q',NULL),(92,4,'29997994@gmail.com','$2y$10$FceMe9xz3jySqJd7SUNLq.oKuJl4T.RjaldeGNK4Qa..1GakrY0bS',NULL),(93,4,'joseguillermojoseos@gmail.com','$2y$10$niwxUC1KzCeqx/we8RIWsOp7WFcOvHCVJLDlvuv.sQR7wBTUrAftC',NULL),(94,4,'perezlealmiguelalejandro@gmail.com','$2y$10$VJM4qdrO5L6TcfuA8p36u.nj60R6Nm8Vbvy3WQ52tn8QFrQvY3cwK',NULL),(95,4,'29895827@gmail.com','$2y$10$s4mgVV7VH62WT4anQdPjSOQMP7LORCUwj4r73CrcoCEKcEAIQPu76',NULL),(96,4,'30601403@gmail.com','$2y$10$JhZDU0PSZe2btzXdDwZWOen.kfIR0KKjs.P5/9alvOittaQ0Gy.3W',NULL),(97,4,'28609972@gmail.com','$2y$10$iNuJVn/AA6tQobXZ3yqM3OxeIovdaYtK.dPm/mrfsrk1us4HSME2u',NULL),(98,4,'27397112@gmail.com','$2y$10$661qJpBXJNbsH0ZiX6AF.ODG3tVsBOO5CAA8kn71ONmWhkJcFeEH.',NULL),(99,4,'29913199@gmail.com','$2y$10$1zRXOonPcFnIYtNwJnuFBODlMmlCZcuaWgYKirZLc9PcK5etnTOWy',NULL),(100,4,'27831369@gmail.com','$2y$10$quOdhLnHkt1rWpp5XqTWL.Ziz.x8dyxEIQXvQ2SZfaiLkQRHKUlkK',NULL),(101,4,'30218425@gmail.com','$2y$10$kOVQLBTmmXxfYbKmBEmm0.onx9IVEj0ASuaQsXdsP8UgGcUozSIGC',NULL),(102,4,'30753799@gmail.com','$2y$10$1GrbqWUxMrO7Xoh75hyVz.ONE5LIgkYPFTOyaNn0AJ5ngobAu0VV6',NULL),(103,4,'31300939@gmail.com','$2y$10$5Pjk3hBxz6KUkKLN2.dPsOFL9PvNuw8Ori2jDXb9XWwST2XlOJ/8y',NULL),(104,4,'30664122@gmail.com','$2y$10$0f3bp7c8Cwt4oSY.ICBPCOZIBekRiryd30EiVO1GaCB1sgveJXBoG',NULL),(105,4,'Yosibelc13@gmail.com','$2y$10$A.W/naZCYgbqbshudx6iSuoOOkksFTCL5TTbDYFtkBG2s4E/EKzg.',NULL),(106,4,'28020203@gmail.com','$2y$10$03LTSyFmy8ZE7WHgcaR81OWxjlAb9p/iNtpKFgWtxBLW6iqYgiQdq',NULL),(107,4,'29707067@gmail.com','$2y$10$NUC9QHAcF9LTw7SUtLrOI.IdaZXf4./4usQt.vFWwWve4ajpFIyrS',NULL),(108,4,'barradasjustoricardojosue@gmail.com','$2y$10$tERVehwudOFOb0Bzg6Mv0Oa3DmEQK.tHlnbkyyX6rGkCwJdPb8UuO',NULL),(109,4,'28528588@gmail.com','$2y$10$96NXEVl3uAH.6qrJquPZ8.H7LJOMA2.Wac.JypcTbK3awz00RbKVe',NULL),(110,4,'rafaeljimeesrajc@gmail.com','$2y$10$aQKPt6tQ1zl6K4vgFxMhXOhr24Au/oSfgX7hYCiBQRpQIF/sHTxB6',NULL),(111,4,'30396029@gmail.com','$2y$10$xTyI/.3tE8ZFrF8aoPqvw.fi4AaDXjZ.77NUgXxU7SuNKdaZoG/aS',NULL),(112,4,'28406215@gmail.com','$2y$10$rTQjLPYIY8TbOHTAd7jgwOPZwHKW31feUYM1sa42wGDUmWrWywogG',NULL),(113,4,'27737198@gmail.com','$2y$10$SNxkGDwtM4kXA1.Qb7GYVewpE8K0XZl.lXOkhaYKb.NxegVv38UGK',NULL),(114,4,'28661484@gmail.com','$2y$10$yHFXst2KP7gtz553dVKAXepr7vJK5CKnQhQeqvhgIp.XyaKRTZb3K',NULL),(115,4,'26555637@gmail.com','$2y$10$Rk.RhbhRA6bWMTPnS9K.7eAaMiatuxs.U4ToU0Nm9n.HMurSIRwlS',NULL),(116,4,'29531677@gmail.com','$2y$10$Bg8aFA9oZODpfIwHl90G4udYTgYt.XHI7V.qIJgY5LsmG5ugbDFVi',NULL),(117,4,'27198786@gmail.com','$2y$10$XluC4Xqjs08j/wty/NM2leWBQeIm449NdgNWlV/zqS0kzgVXjfjki',NULL),(118,4,'29654148@gmail.com','$2y$10$EEOkRtE5F2nCnceoUq1jLecX7FI55NsD0osn6nYbO4hH/ug.VbVGu',NULL),(119,4,'27828169@gmail.com','$2y$10$lHxP9Zx/A1GQvdUriVeO2e77NVMwbIqhHhc/UMjcK4n4RitMN7ixy',NULL),(120,4,'rodrigueznicol319@gmail.com','$2y$10$CcXp8nAM08FSK/jITC/RvuArtAhpXqDHMyUpNsXborR6SGOeKkFPq',NULL),(121,4,'rosbelyguedez@gmail.com','$2y$10$sd44ved7TNu6XCEm9Bi33eqGu6ajXDc/CFRdPy748CyhtXgvCYvyu',NULL),(122,4,'endhismarot.17@gmail.com','$2y$10$NP5qRkNFc0wr3eMXQ6IXcOaOp1a1L0kd05Ck91D/5ohYaKsmt8mpy',NULL),(123,4,'30880746@gmail.com','$2y$10$KwNgrLSjB8GZe8lWPKaHkeGsRrbdHfVu1ZSMS7IJ4WZh8em9Z7olm',NULL),(124,4,'31492771@gmail.com','$2y$10$B79nWuUR1gpqnBeZA17qWuWhv550BAUMVaS0psAVzCvKIu6qdM.ry',NULL),(125,4,'29957469@gmail.com','$2y$10$OuvNGKxt39kou71M0tqw.u/tk2fPS1HIYMixZcrcdHhOlDgQSQ09.',NULL),(126,4,'hermes.milio03@gmail.com','$2y$10$ZUu.jNaAyL2yFXhYSPftYeEgtHhDNCBCc1hfdzJ6Q8NOYNAYPVhRq',NULL),(127,4,'jhonger.alicxon@gmail.com','$2y$10$n3KFBPWqKmT0MC9HasyILer148vbWCNKZ.lZliUgknXqclcWa823G',NULL),(128,4,'jhonderdavid17@gmail.com','$2y$10$n16J5TiDCB9MJ/3cDLBRGOTSZ6NqFdAQsSJDOLOsPuAFpTTJXPEN2',NULL),(129,4,'juangvg2004@gmail.com','$2y$10$ZP.rPhz3dPsY6yzCzaQ1TexFn4reETsoY3Gz29CzzcN00YhU22HOa',NULL),(130,4,'danielsanchez7875@gmail.com','$2y$10$2CNNLXy7RTEzF0BDLMIV7.UzU/Y80HjTnnDgtW7QGvlbyJYThSGoC',NULL),(131,4,'juancol292@gmail.com','$2y$10$OMevV02oPBecU2uGTJhh8uBTid0kIXGQDK1t/kAKdtaVtjFO9eieW',NULL),(132,4,'robertvargascanizalez@gmail.com','$2y$10$UTEI5oonhWRyhRiU4PeD/eSbFp.d35wkqWwUUbkfjGjklmfZfMMFO',NULL),(133,4,'lissethsilva921@gmail.com','$2y$10$hFlCFRs5VW6rANR2BwsEUeXnyKo9SJ8XzQtK1zE5J1cwcnrcKhtcG',NULL),(134,4,'30529448@gmail.com','$2y$10$d7hKVxd80oxTetHoDfrJsOMK2W6hr5j968BDr/420XqS5XLQBn8L.',NULL),(135,4,'marcoarrieche.a1@gmail.com','$2y$10$5/nEIqT.VMy6NaBgZwgjd.6JfdyUn7qTJcU/5U7DHueIFVaG6KZ3.',NULL),(136,4,'30344763@gmail.com','$2y$10$3MWWyBGcvwjoeAYaxXcOvurrfKaJqv0JWxvCiwnB2dQ2Vxw95KAMy',NULL),(137,4,'jesusgabrieldg03@gmail.com','$2y$10$XUBTvvlUlgm3D2xh7ORthefOrB/jf5jfJj9kJhLGNau6uj.mSvW8G',NULL),(138,4,'26831466@gmail.com','$2y$10$xyW.IX.mG211UwkCOPFB3u8nSvrdhjAZfCvAgPYW7Ax6q7Buu9PD6',NULL),(139,4,'30317478@gmail.com','$2y$10$b2LCP6zzBiOCjSpQghgFneI6UPGyKpEjC.s.ShuN5WfsJOfNsZEIW',NULL),(140,4,'hernan.meza246@gmail.com','$2y$10$AE0fDOTEPTDxe1F7qJJ.eeMVbNLsp5cNpXSeTCWKnDVlLnIH4R8Ga',NULL),(141,4,'gusher2997@gmail.com','$2y$10$h3tA9yThG9dEFGH0dV4nf..8s.wW9mnPDut4.RuOv7.l8wyDR0ItO',NULL),(142,4,'yonathanmogollon2002@gmail.com','$2y$10$H1mdiwoch0sm7xeyOI/pwOKMXcnglOzvBdTq9nHoETUsj.7wW6Wzq',NULL),(143,4,'wildenjrodriguezb@gmail.com','$2y$10$v6FRzJSHTSy57Oz2e8OwgudbTqa.te9z3HlU2ZtahdD.eJrNDdaBK',NULL),(144,4,'demarzomonterojose@gmail.com','$2y$10$9eqjpoY.y3FAzfxh1QApC.JRrn/XrlyYXcOn4L6UNZ8ya.VSSwPSu',NULL),(145,4,'benitoantonio2000@gmail.com','$2y$10$z5j2zSN/xXVR8tM8iBE6yus6La./lQOVWBoLaQN1PqLaD7sx1G/E6',NULL),(146,4,'adrianjqr2000@gmail.com','$2y$10$FlZu8ndjAs6HxM2KsmggvuL/iuUStOCDbXwYl2yK5Sx30hC08mmHC',NULL),(147,4,'henprz18@gmail.com','$2y$10$ShklAkFJKGSyxqXV23whOO9ex/bEwPmUjK7wqR/xM9pvCLFEU4Nqm',NULL),(148,4,'30405566@gmail.com','$2y$10$vZ4kWcCo1gv7R7Y1CeWEpOFP21tQkE1nfcy9e83EKZFfmUQRJt0gm',NULL),(149,4,'juan.antonio14g@gmail.com','$2y$10$3p5iRdmglNvHaATlmHDVD.sWMqXvWT61f0DB3wGUyaB49foiW85Ke',NULL),(150,4,'rubyperezliceo@gmail.com','$2y$10$9EkcmMnRIRQFZ43BSND.6.EsanMsIAQCU4w10FanHiq8BP6woFiA6',NULL),(151,4,'cabrerajorge2003@gmail.com','$2y$10$L9UUIOpYlxtGgkxDOgXq0e7K39mAxabfdUzEcMMEl2jJgsaXE5Ziq',NULL),(152,4,'31212740@gmail.com','$2y$10$ws4w/wCMYxwEZmt4cj2Hc.xCSJ0JwVLxrHP23w6Qe8baG2Jnxy9MS',NULL),(153,4,'31066439@gmail.com','$2y$10$69cdyEytZJPXLRk0OAIfFeV1vNnDYdC.6moeOAsfXIwRpnB0wib4m',NULL),(154,4,'30318222@gmail.com','$2y$10$d/k4hg6AOAwSWCFOAWxbWOuy67TveDfoiQI4T6QVQ7lcKgcUW3Sty',NULL),(155,4,'30894865@gmail.com','$2y$10$KPf/09cVri744okPl/J5ZeKF.aqrExNCh597TH9/79EtGB6p3V8yS',NULL),(156,4,'28454122@gmail.com','$2y$10$A0s1PbGfsQSI.yqYF3Aviecj.Pkn/CiyWWgQMiy5i0LPgv7xt8RVe',NULL),(157,4,'28646706@gmail.com','$2y$10$Ws/dvLie4ty6HmAaTIeuJuhrd8Y0uFRC34C0vyUFT9MUxzapbpPl6',NULL),(158,4,'30668285@gmail.com','$2y$10$TbAe5MaesH.SscSZzPr3M.O4x/U8qDB2XPNxcxCEbtPDKxVsw7I3O',NULL),(159,4,'30145618@gmail.com','$2y$10$cqhCNwMwXJn/pD5Vxis1qe6OJSUG/tQy2mmqF0yG/mqhjuCSkNNQ6',NULL),(160,4,'19432505@gmail.com','$2y$10$0FTGun8PVay1ImuiYRo6Z.bLSSzniZzYqyPYCAemQfUzPSP3x6nfO',NULL),(161,4,'30266398@gmail.com','$2y$10$IBkDiMWx02aMtegdMvyjwu69nUq.TGYNJuppzVhkEJulM/5b2ulZ6',NULL),(162,4,'30754113@gmail.com','$2y$10$kIyfs5KD7Us1DH27VliVA.R/m/497w2SbQtVrLWmplgeHpg7O/XQq',NULL),(163,4,'30128473@gmail.com','$2y$10$vC9qQY8JgNTLDDkyPaN1v.FTQrJutumglYInyEEbKthC.C4HTFng6',NULL),(164,4,'30353397@gmail.com','$2y$10$afLm1ufVdwVv35VaT9FBquanHMVFsSVvkO.TeVgkbPuHEZZV3sjT.',NULL),(165,4,'29997704@gmail.com','$2y$10$RhUxAWWAgbDGSFQO3ZbDEuhQ52IlAAZp1.zpfU3rUtQQsHro0b0ta',NULL),(166,4,'raymaripaolaromero@gmail.com','$2y$10$cLDz4pVUl4mz7upC77HUHuQHbbpeK.cFjpbfcF7SHeLSFe6h4gGLq',NULL),(167,4,'30324954@gmail.com','$2y$10$8zbr.AzrJCPiQckDj/0EaeIuMDrmaIHbNmld0Zf3UYox/hujAbuw.',NULL),(168,4,'moisescontrerasxde@gmail.com','$2y$10$PdMNt4364KlEmBeK.XechuEzyFmgASb7T7fttach3rCa5r83Pn7T.',NULL),(169,4,'28406924@gmail.com','$2y$10$T69rMW7h7Nr/ehxcTeOgx.xH8A04oYfGjAX2LcMvhaFvAsIgnJVKK',NULL),(170,4,'frangher200@gmail.com','$2y$10$2QAplVZ6bYweNdD7XZQHreX.dlymtIugsAAIBy7PoUI6/8mwc3Faq',NULL),(171,4,'28297900@gmail.com','$2y$10$kfCsdxtAMnMlP4FVnF./QO/qLiSyV6TBI5FRYhnswxIadZYVXj.iu',NULL),(172,4,'josmercueri@gmail.com','$2y$10$j6Q9uuI7GrdEG8iei2Go2OidgEXZoquGL2zfXKISD67JPKGQ1uUdG',NULL),(173,4,'adriantdp.123@gmail.com','$2y$10$eCpJL2VyCJpVFFzFKq/s7eeccs9m/L2BdOJ5uNINNBQwQgAcY./JK',NULL),(174,4,'30125965@gmail.com','$2y$10$xLe3ADDpqF4j1BL2uaIFjuSJh0oZFdvA9NdBc49O0HlBn1Lkq6BPe',NULL),(175,4,'30979558@gmail.com','$2y$10$fJthCNWtopDGoJaI9trD/OnFWNe5pgLiRhhmS3Lgou1tADhLN2XPe',NULL),(176,4,'30129964@gmail.com','$2y$10$1gEiml1iWu9CP710/lQkvOk.KJg23kBzv6Z0U1NQFzdcgQ6v7uZEi',NULL),(177,4,'30560426@gmail.com','$2y$10$6s3/qnoO6qLxLjoFeCDB1.FBTDrAVSO/KbQLjZ1.D8osQBY0O.p2W',NULL),(178,4,'30753955@gmail.com','$2y$10$g.XACNhsEeiO0y0mmIYKkuZomIlhKCy63fNgSt0dPgjf29Jk4gZBS',NULL),(179,4,'28256789@gmail.com','$2y$10$c2gQyxqVC4AWMVHbSRFQ8uuMKVJoAX30fIeh9WMoKHOYYyhnHxN4W',NULL),(180,4,'simonjfd21103@gmail.com','$2y$10$VSgoEYBmKQygIY2HxQp6XeYBM0DSWOUy.gbt4u03Y9lp48hwXOfci',NULL),(181,4,'30664596@gmail.com','$2y$10$M9NVa.sdX7o20OAtDVWoK.20s0M6o//HY0as1pjPYcAOEs5SQqjia',NULL),(182,4,'arriechejhonangel@gmail.com','$2y$10$7Ysv1CiXBhLv5Dwgj6LHE.lwquo1lbPsDJCAc1vvCjQg73sGBmDP2',NULL),(183,4,'aguerowilker@gmail.com','$2y$10$q1Jhp2fttf1rUYcwg5joJuRfMQ4f.3fg2s19Z2o0Ph2FIUpqomd/u',NULL),(184,4,'rosaisabelperezgom@gmail.com','$2y$10$Rzy9rqlrNnSehcxwNM4nc.JQvtI9fE.lZRPvDxjozK.emPWb.KFVS',NULL),(185,4,'25961485@gmail.com','$2y$10$0co2SERFBbo8Za.sCliYrOPnw5y9IclrrUfdoKuv2Mh4aCywl9VJW',NULL),(186,4,'30759776@gmail.com','$2y$10$760ga/m36ms3aRaULI1xtuW3GRcOH7LBcZl07Z.6Wtb9IeZZW1mPy',NULL),(187,4,'30095928@gmail.com','$2y$10$ipRDpfRRciMMrwcsgtNfseGLPN.Zm/8QGUU9em./XKps3aXhosN16',NULL),(188,4,'31258935@gmail.com','$2y$10$ONwhEBxVK5RMV6pIFbGhv.IueArcqjcLQA6npgzK1jqMHeE7VuYAu',NULL),(189,4,'30434563@gmail.com','$2y$10$9eCbhMP1RF1IElGaRgfUEOoSmJqn8OZM.bNkOtVRQyvdKnubZReLS',NULL),(190,4,'danielmujica755@gdamail.com','$2y$10$9YCqJqCJsifFuIngROJ25ei6WGWYUzjd7aECNe/USBIywa/ZqEH7a',NULL),(191,4,'freiderstevenguedezherrera@gmail.com','$2y$10$P3Ravd0k8RfCo7Lba0Eh4O2mgq2g86sRBIoZI8AWQxaUIoLhl5xvO',NULL),(192,4,'raptorgames1234@gmail.com','$2y$10$ZFTtsR/4jsqLYZtabq2beu5HjfgHMbJ5Kmb0DaJfONBNorLO00fXW',NULL),(193,4,'david.oliveira201612@gmail.com','$2y$10$7rVSSNh/JjGqgIl.UZzFgu1bMGc71eznNTOkrvJ252n47liqELR2S',NULL),(194,4,'fenixromanramirez@gmail.com','$2y$10$v/yLGOCflTsSTT5iHLS2Ie28/El0VOYHuE/tSdgabj0nDiCzN1JhO',NULL),(195,4,'30664778@gmail.com','$2y$10$UWbd3P4wepfhQJCem366QeE9et/KfYyn3sCJfSaeSe.aSR1hziYn2',NULL),(196,4,'30128602@gmail.com','$2y$10$oNo7rq8rBs87OfMkiN2cJeAlcAKp9WNah5tWwEHc4sW26aA5zm95i',NULL),(197,4,'30591468@gmail.com','$2y$10$HL6JkylMNj5LS9NnmuV/YOoZPheutwH17B58gU7yNlkZKVH5LKgSK',NULL),(198,4,'30591468@gmail.com','$2y$10$wzs9Qm/B0g7kdSoPhLfbY.dcWWQQdMHlvmnQI6w.yM5Sp0mD3moCW',NULL),(199,4,'27736558@gmail.com','$2y$10$cV.F1FqhHD7rawoTuo58H.Gyjza71vUWai.umUVKykFz.IomJT2VW',NULL),(200,4,'29624981@gmail.com','$2y$10$iMRtIaZbtAkAHz.Zfse7..EAY5EUM4M6dYiwQaqHhhtqhoGonP6S6',NULL),(201,4,'28493197@gmail.com','$2y$10$ftIDYQJB5vYALWoA1WwQfOGxGSrzOcNTTRB6HhFlcLNQTbphOKswS',NULL),(202,4,'30587785@gmail.com','$2y$10$B.xySZkhMsUgbZ3l3ME/xeQi5M4guEGrFyPXwiDtvW8KPKWVowcIm',NULL),(203,4,'31194917@gmail.com','$2y$10$KdX7jTV3HCvmbtoPARCCZ.EivHHaHpJUuN7VtaAUgBnnMtiA.uzem',NULL),(204,4,'30454597@gmail.com','$2y$10$fwbnzd98jTir.laxSkkNQuLbDNNx5X8SwlJlF1rCrRe7V2cRUIIOi',NULL),(205,4,'30753995@GMAIL.COM','$2y$10$uD7tPm1cnqN4O66XizYKMOFCS4IuoW0zRfKTFEFHTB/kxAF6iJsje',NULL),(206,4,'31271852@gmail.com','$2y$10$thmQNPCPodw5LbFK4bGt1utYQX7aSnKjHENHvgVbIO9XxePoI5x22',NULL),(207,4,'30754260@gmail.com','$2y$10$o.2ckk77OyK71WeXVeUMp.SiinkHQoYvIrtg7Y6SDzH8PUjVrSRPK',NULL),(208,4,'31464007@gmail.com','$2y$10$UevC/d3DZv8FkGLgCy9Bmuy433srI4KUf.PpGrfTB4.tsBJakUd7O',NULL),(209,4,'30560144@gmail.com','$2y$10$N7Hf9uI4L9YiJWiUt7KlQea4gtUV5XP68bQpB4p/SB334GwcxT7QO',NULL),(210,4,'30560560@gmail.com','$2y$10$5qv9UPyn1nAPMwyqS01j2.pP3kvrNtFINBqAqCGEiUq7kKQPaVbRS',NULL),(211,4,'28019244@gmail.com','$2y$10$jOZa5GVava4ugp8OcOk56uFFdUzIWKk0YqpInvRvnVQBBa2nyHEp2',NULL),(212,4,'27411195@gmail.com','$2y$10$LaAEerM7w34fE/3DZkyzn.yF4.HX0o8CLLDhkaQ8Csf8CF7YZflA.',NULL),(213,4,'26800302@gmail.com','$2y$10$QRKZkSDrMyADBgzmCg/ZQeD17IOiyNXs2rHcnWbTzfTD58vcEeeFS',NULL),(214,4,'32023069@gmail.com','$2y$10$68AWOUyA9n68YwxuKBWnMOE3ae/tHdLYZKQien6Xy0zdru.4/Tfy6',NULL),(215,4,'29944858@gmail.com','$2y$10$nM1M5S0TVLTLfbd8vEq0IezIFVPfLn6X9eOPdTZlmNm309h8Eqyt.',NULL),(216,4,'30266400@gmail.com','$2y$10$r1MYN4qq0T0E9DH2y/pbCumSDaI9soMsh04GP.eZKuVyiavI8/hFq',NULL),(217,4,'30694379@gmail.com','$2y$10$7pCAWGd/VRKiu8k0kDE1Tu67ZfY2T9lUqDGrla6Kn890tR1uOOqD6',NULL),(218,4,'30479630@gmail.com','$2y$10$GZeetOCITBPTeRXc2STQDe2PKJuDo2fsDTSIk6S/vvWv5Fw4W2rgK',NULL),(219,4,'30588476@gmail.com','$2y$10$hkV.cM4jpsIGvJznfQe5fegWnTKfwHCUW4jpnbDZSXTNqeo8xeIFu',NULL),(220,4,'29976008@gmail.com','$2y$10$HpGb7b8zNOJ9RSYgmBZOBeqCyf9O90xNhz5QSE2haOwoKpMaHsv5a',NULL),(221,4,'30014771@gmail.com','$2y$10$JaU56cHEwdh5nYDvqLTpyekhaF..bo7JHVtJy9JdXtajpeJasTQuG',NULL),(222,4,'30405793@gmail.com','$2y$10$zjgLhdz4thr2/JNZXmgj/uOT62fyBT/CKhoXnTf3SbaG1MawEoDta',NULL),(223,4,'30979806@gmail.com','$2y$10$p.JgRQzm7bsIEWnqYgkGcum1do3U7pYjXY/821qKPof8fSE6WI.TG',NULL),(224,4,'31550201@gmail.com','$2y$10$UsdcyXfkbsBZoJ6V8sYXkeo7qW1WYkaS551LdT7LRL7j7uM9Z2Ss2',NULL),(225,4,'30105192@gmail.com','$2y$10$6zYC3OFmq8sPVbF2BuswZe2Z11nOIaI4RP/hHFinDDwwCWJ17QsZi',NULL),(226,4,'30396184@gmail.com','$2y$10$oIePmwqKac7cSx/IlhrktOXkYtxbna66QXgttZA2QrpLvP8djra3S',NULL),(227,4,'20009949@gmail.com','$2y$10$VfldbALcMvW9sfbYVF2xLuKcpz29dHXML3hDIhYWwKO3dmNF0zkIK',NULL),(228,4,'31233952@gmail.com','$2y$10$5hEjUOmfc0tMVPgUIfWeAeojQVa07RsuqBsYXendorxGiaXWqdny.',NULL),(229,4,'31388606@gmail.com','$2y$10$6IplYvBkqO0juwucCg3VWO09NWdOQPHSVN8k.VEjsTfbAOmAkbITC',NULL),(230,4,'30716405@gmail.com','$2y$10$hrewEXqxOEB/EhASi7eFW.lou/6a/BntbRKGdJkRtLeMwHVau2zra',NULL),(231,4,'31766216@gmail.com','$2y$10$6/5wb6cimUw4F35aNI2g0OeBIWvCMvMe6/rjjKqO7n3.yPV1u.DmO',NULL),(232,4,'30621851@gmail.com','$2y$10$NIBvMwhB8R.Fou9TOLQ8i.iWw3oAdsY58e91WP33UzOCyG2jAtce6',NULL),(233,4,'31026149@gmail.com','$2y$10$qS3rutuI3faHi1ED8KMvo.0HVzq1wAB77nkvks79sb7VIiU8VljNK',NULL),(234,4,'30846149@gmail.com','$2y$10$OY3.UZ0SgfUZCRsqjNHUNejCWhKGCCVZCeHfky6lyTyaAAKl70KHe',NULL),(235,4,'31066519@gmail.com','$2y$10$UuHE8PYOouQSiIGxQEz6cenuY/ispCWRGpjyBfgv/iXFVENIXEv..',NULL),(236,4,'31066519@gmail.com','$2y$10$ecOi1I.Wh7jweYoI0bsasOt8/iue3nZQ4w4gPP23u/MZNq8TF1Vfy',NULL),(237,4,'31111539@gmail.com','$2y$10$brsayW2YhlPmfWOzenxdO.GYqtqmtw/XlTOuZdP3GNA2xXYIJGnK2',NULL),(238,4,'31986901@gmail.com','$2y$10$lOZ2hrc2k9V5VdydhSRt0OMPAyEXUvjnuAVEyiCj3NlL3ona8CG7W',NULL),(239,4,'26779660@gmail.com','$2y$10$zyB9ipx2QwLoHVRV9dFroOmDp6jOchAbUxPE2oOMCeVTqOfO8nsNW',NULL),(240,4,'31366952@gmail.com','$2y$10$MGbFR3zpd1g3eg2pAMWXlORMUU2aww6lqKwlMEmNQXnZg32sJbTs.',NULL),(241,4,'31117996@gmail.com','$2y$10$dc/GP6iyumXMQw1A1ltNxeZ/20jSqlhyzexKhUsJAiXlLLF2xdi7m',NULL),(242,4,'635782@gmail.com','$2y$10$R.7tsAOicKDTdGmUkA13AuPRG28Pzs/108uWm9/XAEH8hm6st5lBy',NULL),(243,4,'adsasdasq@gmail.com','$2y$10$Kj.ThznJ2F24pg3skrfN8O4Oq5dRbz66HPH5LozV0glnyYnamO.Rm',NULL),(244,4,'28516209@gmail.com','$2y$10$mn9m.lZSCYmoYHsWm5azieMu9MZqOB0BN.FxCQXNESGwGHfKzpIC6',NULL),(245,4,'31401678@gmail.com','$2y$10$FVlIdrTAVFDcS9AhzmAN3uqJyTcWMJYwEStgJU/d.mX5Mfae9N/eq',NULL),(246,4,'30894974@gmail.com','$2y$10$75GQKbl/c.1Wx3Z6XDGTb.pB1RV7Gm28zFQv3tbLh4qawSbS48Liu',NULL),(247,4,'30675539@gmail.com','$2y$10$.rNjYFKwgy9/iF.6rwcwAeZOiHUF6JnACdEG2RglUOxlGLbwwRr62',NULL),(248,4,'30657597@gmail.com','$2y$10$6NNdWnUqF4/z0.ls80jYXe9JqfvKQLS7DZewLeCuGhod.TdTApbA2',NULL),(249,4,'31162171@gmail.com','$2y$10$TdadS9ju4w8pAID3wh/Xhu3Zi8t8gvMU20bNzTqiOskoqUaqHugn6',NULL),(250,4,'29805941@gmail.com','$2y$10$UdcpYiW9Sx9kmuXRDXF4J.IwFjPtasMpTw.eTHr4yMrers2yRqnua',NULL),(251,4,'30353577@gmail.com','$2y$10$7IRY1xtXoa5vTR4VUOr9ROwUxeapT96tKMYQSRhzkH6kSxChDal4u',NULL),(252,4,'32593540@gmail.com','$2y$10$kFI9idXlqLGY0mSNdONJneV6MfMGnw6e5KDJe8cU22XFbX2b6YOz2',NULL),(253,4,'31835884@gmail.com','$2y$10$Q5h3T4QxBp6B93PITebzKOUCWQB3SBAEIrKzekPajcKGlH1HWa9qi',NULL),(254,4,'31018229@gmail.com','$2y$10$/B3j7MM5Km/CaeUa3wOmgevR7wwpWSgRn7uKK4zpyrgvnmWAQD6Zy',NULL),(255,4,'30324703@gmail.com','$2y$10$FEs.6hAK8apscxjcMCUr2eCI/WaQQ34S1WjFzJCUZp9H9tc.7H162',NULL),(256,4,'30621800@gmail.com','$2y$10$unnJbAzrRCr/lxIquXo6K.ZIk5OHk2tM9aCaRI73BtzPCco9pUsm.',NULL),(257,4,'30601666@gmail.com','$2y$10$uIkcCOPn0GGw8VeTAj/irOjZaqfJR6FPG5p.owLNpaCusPLYrANqu',NULL),(258,4,'31272034@gmail.com','$2y$10$1mTfjD8Btc8ST.2xTE2fM.Pt7u2Wi9d1Zy2AMl8uZ90kjUMTBxrS6',NULL),(259,4,'31018207@gmail.com','$2y$10$tu.h1VijawsDsZFgg2GO.udJ3gYdi55BL15CRWdNwjV9WlB/1WwVS',NULL),(260,4,'30803623@gmail.com','$2y$10$HDjcpxFc1EK8CuVtzMO/zOnSwrmg6Wj1kAvbXXrkEnWSKnMU/n9Bi',NULL),(261,4,'30448190@gmail.com','$2y$10$FnsYi2t9Lq4ZQ7SIarEDOeK6FnYEeoXO8BHkZHhbckKNjlQ7J/uPy',NULL),(262,4,'31118074@gmail.com','$2y$10$cs5Uwf4yxgXQtOTxMWDXfum9Sr17EMVi1uZteYbQUyEjcL9/8WXwe',NULL),(263,4,'31027477@gmail.com','$2y$10$QyFx3JcKnS4MKLW6TLQXue7ZE8474mQHLcCxrlnoR6Z.A5Dnbak9K',NULL),(264,4,'30845389@gmail.com','$2y$10$2y0oy7ho.O1PdbjCdgrMwe9QBxbkD0h7uAxV1O.VP/xyGCVyzEQG2',NULL),(265,4,'31169313@gmail.com','$2y$10$Bcxvb9OIOUSSlLc9rqRPueJLp5NKhClZdQA5plyDHWIqn23PTekZe',NULL),(266,4,'30979684@gmail.com','$2y$10$wwqW701.CJ5N6vnBpSxbZO9z9209pZ6GBQSzJDPEkEGFKADv1cnS6',NULL),(267,4,'31212573@gmail.com','$2y$10$sC6bAjnJGCxMexxHljW0v.gjnCCF8iPx.SNP/bEp4KFl6q8b4s9Sy',NULL),(268,4,'31842780@gmail.com','$2y$10$ahkYjxfCWW88YZCMPpFcvemYz2X3ALDqdG3y5nYiJA1fd2yI9jBEm',NULL),(269,4,'30916580@gmail.com','$2y$10$KKtNgaaNshq6yzd0fPxbFeUnVyzq9HKwkGyBxiXicIUFfPP/3a7g2',NULL),(270,4,'30987377@gmail.com','$2y$10$yeS0fu3VyIDR/G3GVylhIu5IccSUxf4K9wAbA50QZ/2Gx0ZgCI6qW',NULL),(271,4,'31926201@gmail.com','$2y$10$UKmicUm7tfJsdNYRemRG3.7Tb9xx.Q88khFFCqbKon5J9F1TeiuEW',NULL),(272,4,'31244876@gmail.com','$2y$10$9ECe98RrXq2Q6sh8z0df0exG9Fw7OKlf2h9DpAtlG192AbDO934Ye',NULL),(273,4,'31493172@gmail.com','$2y$10$tfLwZANj54GKhMpY2KeGOu8JKcU4OyETvS6L2eSX7c/y71Jc1a4nC',NULL),(274,4,'29623277@gmail.com','$2y$10$2u7JfxtDl9bp/gbZrBZsaOmWtYsDBpZBSCejqno8nTo9r6SNVhI/e',NULL),(275,4,'28699599@gmail.com','$2y$10$rV1at5bJxjkNNBovqcoKQ.Ejzh1j7NaXXtJVVOvh/kLInMOExAQhC',NULL),(276,4,'25541868@gmail.com','$2y$10$5TV5lu1KEKW.wuw/7JZFm.Hl7uTL.DgOAJgHP2JAd9GE2camdWVgi',NULL),(277,4,'26976737@gmail.com','$2y$10$x.ijdGBxoiVUDeaKj/s4Du3woFYX0mzg.y3VgfHR8mSBIcaRBeOOu',NULL),(278,4,'29624646@gmail.com','$2y$10$1ad6mCuoTkIyB6.BgAt14eaKOpAa5WphS1KbVAdDFQD4A2Gggrffe',NULL),(279,4,'27554490@gmail.com','$2y$10$01WP6DQ/VgKcw55c/N8JgeVU2BCDpaKaFHtu3vVdCiYjeIdW8dvuy',NULL),(280,4,'17227723@gmail.com','$2y$10$rbpqM1JKTYDiwpWkdU2WOeUe8hbdJq.ddSsAubtIUPARQntsMIAkK',NULL),(281,4,'25526317@gmail.com','$2y$10$MtsXc1RYLcfcutE8wWbqxOCzVnC7rrpUpsf/Sj1gFlZwY1Nivr83S',NULL),(282,4,'darlangelinap@gmail.com','$2y$10$F8GT1AGNyTUXcd2NXAM/Ru5Hh836XJusdsMsJoojEU.vIw014XG/C',NULL),(283,4,'rizeth16@gmail.com','$2y$10$nKjTRhndUI75vad71WCBRu8epcapCEQiRpZ2paYbWxN6Hzz4KeNl6',NULL),(284,4,'fran30kluis@gmail.com','$2y$10$DEVQLi43ZgnzjvyB1S7GCefyccqMYgI97RKKXMW4bw3jZpxg739X.',NULL),(285,4,'jesusborzellino@gmail.com','$2y$10$JGvAqJAVLRcSeX8mMIlAceoUumjbxsV5SUZb4TZVrbZdOJ7b76g3i',NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

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
  round(sum(inscripcion.calificacion),2) as calificacion,
  count(inscripcion.calificacion) as inscripciones,
  count(malla_curricular.codigo) as mallas,
  CASE
	WHEN count(inscripcion.calificacion) = count(malla_curricular.codigo)
    THEN 'Evaluado'
	WHEN count(inscripcion.calificacion) != 0 AND count(malla_curricular.codigo) > count(inscripcion.calificacion)
    THEN 'Pendiente a evaluar segunda fase'
    ELSE 'Pendiente a evaluar'
   END AS estatus
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
  proyecto.nombre as nombre_proyecto,
  trayecto.codigo as trayecto_id
FROM persona
INNER JOIN estudiante ON estudiante.persona_id = persona.cedula
LEFT JOIN usuario ON usuario.id = persona.usuario_id
LEFT JOIN detalles_inscripciones ON detalles_inscripciones.id_inscripcion = estudiante.id
LEFT JOIN integrante_proyecto ON integrante_proyecto.estudiante_id = estudiante.id
LEFT JOIN proyecto ON proyecto.id = integrante_proyecto.proyecto_id
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
SELECT trayecto.*, periodo.fecha_inicio, periodo.fecha_cierre,
ROUND(SUM(indicadores.ponderacion),2) as ponderado_baremos
FROM trayecto
INNER JOIN periodo ON periodo.id = trayecto.periodo_id
INNER JOIN fase ON fase.trayecto_id = trayecto.codigo
LEFT JOIN malla_curricular ON malla_curricular.fase_id = fase.codigo
LEFT OUTER JOIN dimension ON dimension.unidad_id = malla_curricular.codigo
LEFT OUTER JOIN indicadores ON indicadores.dimension_id = dimension.id
GROUP BY trayecto.codigo;

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
  tutor_usuario.email as tutor_in_email,
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
LEFT JOIN usuario as tutor_usuario on tutor_usuario.id = tutor_info.usuario_id
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