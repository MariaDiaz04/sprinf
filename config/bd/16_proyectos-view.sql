DROP VIEW IF EXISTS detalles_proyecto;
CREATE VIEW detalles_proyecto AS
SELECT proyecto.*, trayecto.nombre as nombre_trayecto,trayecto.codigo as codigo_trayecto, fase.nombre as nombre_fase, fase.codigo as codigo_fase, count(integrante_proyecto.id) as integrantes,
periodo.fecha_inicio, periodo.fecha_cierre
FROM proyecto
INNER JOIN fase ON fase.codigo = proyecto.fase_id 
INNER JOIN trayecto ON trayecto.codigo = fase.trayecto_id 
INNER JOIN periodo ON periodo.id = trayecto.periodo_id
LEFT OUTER JOIN integrante_proyecto ON integrante_proyecto.proyecto_id = proyecto.id
GROUP BY proyecto_id;