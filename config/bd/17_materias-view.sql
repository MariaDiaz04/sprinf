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
  count(dimension.id) as dimensiones
FROM materias
LEFT JOIN malla_curricular on malla_curricular.materia_id = materias.codigo
INNER JOIN fase ON fase.codigo = malla_curricular.fase_id
INNER JOIN trayecto ON trayecto.codigo = fase.trayecto_id 
LEFT OUTER JOIN dimension ON dimension.unidad_id = malla_curricular.codigo
GROUP BY materias.codigo
ORDER BY codigo_trayecto

