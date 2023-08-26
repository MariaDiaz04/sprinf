delete from malla_curricular where true;
delete from materias where true;

-- ------------------ TRAYECTO III -------------------------------
-- Matemática Aplicada anual trayecto 3
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIMAT156306', 'Matemática Aplicada', 120, 36, 6, 3, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIMAT156306_1', 'TR3_1','PIMAT156306');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIMAT156306_2', 'TR3_2','PIMAT156306');


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
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PISIO078303', 'Sistemas Operativos', 72, 6, 3, 4, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PISIO078303_1', 'TR3_1','PISIO078303');
-- vincula a proyecto por lo que se crean dimensiones e indicadores
-- ....

-- Ingenieria de software anual trayecto 3
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PINGSO078303', 'Ingenieria de Software', 72, 6, 3, 4, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PINGSO078303_1', 'TR3_1','PINGSO078303');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PINGSO078303_2', 'TR3_2','PINGSO078303');
-- vincula a proyecto por lo que se crean dimensiones e indicadores
-- ....


-- Tutor Asesor Proyecto anual trayecto 3
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('ASESOR3078303', 'Tutor Asesor Proyecto III', 72, 6, 3, 4, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('ASESOR3078303_1', 'TR3_1','ASESOR3078303');
insert into malla_curricular (codigo, fase_id, materia_id) values ('ASESOR3078303_2', 'TR3_2','ASESOR3078303');
-- vincula a proyecto por lo que se crean dimensiones e indicadores
-- ....

-- ------------ TRAYECTO IV ------------------------

-- Actividades acreditables IV anual trayecto 4 
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIACA078303', 'Actividades acreditables IV', 72, 6, 3, 4, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIACA078303_1', 'TR4_1','PIACA078303');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIACA078303_2', 'TR4_2','PIACA078303');

-- Administración de bases de datos
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIABD078303', 'Administración de bases de datos', 72, 6, 3, 4, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIABD078303_1','TR4_1','PIABD078303');


-- Auditoria Informática
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIAUI078303', 'Auditoria Informática', 72, 6, 3, 4, '');

insert into malla_curricular (codigo, fase_id, materia_id) values ('PIAUI078303_2','TR4_2','PIAUI078303');

-- Electiva IV
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIELE078303', 'Electiva IV', 72, 6, 3, 4, '');

insert into malla_curricular (codigo, fase_id, materia_id) values ('PIELE078303_2', 'TR4_2','PIELE078303');

-- Formación Crítica IV
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIFOC078303', 'Formación Crítica IV', 72, 6, 3, 4, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIFOC078303_1', 'TR4_1','PIFOC078303');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIFOC078303_2', 'TR4_2','PIFOC078303');

-- Gestión de proyecto informático
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIGPI078303', 'Gestión de proyecto informático', 72, 6, 3, 4, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIGPI078303_1', 'TR4_1','PIGPI078303');


-- Idiomas II
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIIDI078303', 'Idiomas II', 72, 6, 3, 4, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIIDI078303_1', 'TR4_1','PIIDI078303');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIIDI078303_2', 'TR4_2','PIIDI078303');

-- Proyecto Socio Tecnológico IV 
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIPST078304', 'Proyecto Socio Tecnológico IV', 72, 6, 3, 4, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIPST078304_1', 'TR4_1','PIPST078304');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PIPST078304_2', 'TR4_2','PIPST078304');

-- Redes Avanzadas 
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PIREA078303', 'Redes Avanzadas', 72, 6, 3, 4, '');

insert into malla_curricular (codigo, fase_id, materia_id) values ('PIREA078303_2', 'TR4_2','PIREA078303');

-- Seguridad Informática
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('PISEI078303', 'Seguridad Informática', 72, 6, 3, 4, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('PISEI078303_1', 'TR4_1','PISEI078303');


-- Tutor Asesor Proyecto IV
insert into materias (codigo, nombre, htasist, htind, ucredito, hrs_acad, eje) values ('ASESOR4078303', 'Tutor Asesor Proyecto IV', 72, 6, 3, 4, '');
insert into malla_curricular (codigo, fase_id, materia_id) values ('ASESOR4078303_1', 'TR4_1','ASESOR4078303');
insert into malla_curricular (codigo, fase_id, materia_id) values ('ASESOR4078303_2', 'TR4_2','ASESOR4078303');
