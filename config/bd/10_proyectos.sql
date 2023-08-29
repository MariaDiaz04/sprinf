delete from integrante_proyecto where true;
delete from proyecto where true;
-- TRAYECTO 4 PROYECTO GESTION DE PROYECTOS
insert into proyecto (id, fase_id, nombre, comunidad, area, motor_productivo, resumen, direccion, municipio, parroquia)
values (1,'TR4_1', 'Gestion de proyectos sociotecnologicos', 'UPTAEB', '','','','','','');
insert into integrante_proyecto (proyecto_id, estudiante_id) values (1,'e-15408');
insert into integrante_proyecto (proyecto_id, estudiante_id) values (1,'e-63578');
insert into integrante_proyecto (proyecto_id, estudiante_id) values (1,'e-39263');

-- TRAYECTO 4 PROYECTO LA ROCA
insert into proyecto (id, fase_id, nombre, comunidad, area, motor_productivo, resumen, direccion, municipio, parroquia)
values (2,'TR4_1', 'La Roca', 'Iglesia', '','','','','','');
insert into integrante_proyecto (proyecto_id, estudiante_id) values (2,'e-60621');
insert into integrante_proyecto (proyecto_id, estudiante_id) values (2,'e-61587');