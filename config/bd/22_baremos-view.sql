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
GROUP BY indicadores.id