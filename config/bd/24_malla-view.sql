DROP VIEW IF EXISTS detalles_malla;
CREATE VIEW detalles_malla AS
SELECT
trayecto.codigo as codigo_trayecto,
materias.nombre,
malla_curricular.codigo,
fase.codigo as codigo_fase,
fase.nombre as nombre_fase,
count(dimension.id) as dimensiones
FROM malla_curricular
INNER JOIN materias ON materias.codigo =  malla_curricular.materia_id
INNER JOIN fase ON fase.codigo = malla_curricular.fase_id
INNER JOIN trayecto ON trayecto.codigo = fase.trayecto_id 
LEFT OUTER JOIN dimension ON dimension.unidad_id = malla_curricular.codigo
GROUP BY malla_curricular.codigo;