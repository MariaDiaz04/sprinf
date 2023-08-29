delete from indicadores where true;
delete from dimension where true;
-- --------------------- trayecto 4 fase 1 ---------------------------
-- TUTORA
insert into dimension (id, unidad_id, nombre, grupal) values(1,'ASESOR4078303_1','Desempeño Individual',0);

insert into indicadores (dimension_id, nombre, ponderacion) values(1, 'indicador', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(1, 'indicador', 1);

insert into dimension (id, unidad_id, nombre, grupal) values(2,'ASESOR4078303_1','Desempeño Grupal', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(2, 'indicador grupal', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(2, 'indicador grupal', 1);

insert into dimension (id, unidad_id, nombre, grupal) values(3,'ASESOR4078303_1','Avance del Producto Final', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(3, 'indicador avance', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(3, 'indicador avance', 1);

-- Gestión de proyecto informatico
insert into dimension (id, unidad_id, nombre, grupal) values(4,'PIGPI078303_1','Evaluación Tecnica Individual', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(4, 'indicador Tecnica Individual', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(4, 'indicador Tecnica Individual', 1);

-- Administración de base de datos
insert into dimension (id, unidad_id, nombre, grupal) values(5,'PIABD078303_1','Evaluación Tecnica Individual', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(5, 'indicador Tecnica Individual', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(5, 'indicador Tecnica Individual', 1);

-- Docente de proyecto
insert into dimension (id, unidad_id, nombre, grupal) values(6,'PIPST078304_1','Evaluación Del Docente de Proyecto', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(6, 'indicador Docente de Proyecto', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(6, 'indicador Docente de Proyecto', 1);

-- -------------------- trayecto 3 fase 1 ---------------------------
-- TUTOR
insert into dimension (id, unidad_id, nombre, grupal) values(7,'ASESOR3078303_1','Sistema', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(7, 'indicador', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(7, 'indicador', 1);

insert into dimension (id, unidad_id, nombre, grupal) values(8,'ASESOR3078303_1','Informe', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(8, 'indicador', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(8, 'indicador', 1);

insert into dimension (id, unidad_id, nombre, grupal) values(9,'ASESOR3078303_1','Manejo de Equipo', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(9, 'indicador', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(9, 'indicador', 1);

insert into dimension (id, unidad_id, nombre, grupal) values(10,'ASESOR3078303_1','Modelado del negocio', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(10, 'indicador', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(10, 'indicador', 1);

insert into dimension (id, unidad_id, nombre, grupal) values(11,'ASESOR3078303_1','Modelado del sistema', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(11, 'indicador', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(11, 'indicador', 1);


-- Modelado de base de datos 
insert into dimension (id, unidad_id, nombre, grupal) values(12,'PIMOB078303_1','Diseño de la Base de datos', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(12, 'indicador', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(12, 'indicador', 1);

-- Docente de proyecto
insert into dimension (id, unidad_id, nombre, grupal) values(13,'PIPST078303_1','Evaluación Del Docente de Proyecto', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(13, 'indicador', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(13, 'indicador', 1);

-- --------------------- trayecto 3 fase 2 ------------------------------

-- TUTORA
insert into dimension (id, unidad_id, nombre, grupal) values(14,'ASESOR4078303_2','Desempeño Individual',0);
insert into indicadores (dimension_id, nombre, ponderacion) values(14, 'indicador', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(14, 'indicador', 1);

insert into dimension (id, unidad_id, nombre, grupal) values(15,'ASESOR4078303_2','Desempeño grupal',1);
insert into indicadores (dimension_id, nombre, ponderacion) values(15, 'indicador', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(15, 'indicador', 1);

insert into dimension (id, unidad_id, nombre, grupal) values(16,'ASESOR4078303_2','Avances de programación', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(16, 'indicador', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(16, 'indicador', 1);

insert into dimension (id, unidad_id, nombre, grupal) values(17,'ASESOR4078303_2','Interfaz y estilo', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(17, 'indicador', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(17, 'indicador', 1);

-- Ingeniera de Software
insert into dimension (id, unidad_id, nombre, grupal) values(18,'PINGSO078303_2','Desempeño Tecnico', 0);
insert into indicadores (dimension_id, nombre, ponderacion) values(18, 'indicador', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(18, 'indicador', 1);

insert into dimension (id, unidad_id, nombre, grupal) values(19,'PINGSO078303_2','Usabilidad', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(19, 'indicador', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(19, 'indicador', 1);

-- Docente de Proyecto
insert into dimension (id, unidad_id, nombre, grupal) values(20,'PIPST078303_2','Informe', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(20, 'indicador', 1);
insert into indicadores (dimension_id, nombre, ponderacion) values(20, 'indicador', 1);

