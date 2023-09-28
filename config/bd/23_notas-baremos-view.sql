DROP VIEW IF EXISTS detalles_notas_baremos;
CREATE VIEW detalles_notas_baremos AS
SELECT 
  malla_curricular.fase_id,
  fase.nombre as nombre_fase,
  persona.cedula,
  persona.nombre,
  integrante_proyecto.proyecto_id,
  sum(indicadores.ponderacion) as ponderado,
  sum(nip.calificacion) as calificacion
FROM notas_integrante_proyecto as nip
INNER JOIN indicadores ON indicadores.id = nip.indicador_id
INNER JOIN integrante_proyecto ON integrante_proyecto.id = nip.integrante_id
INNER JOIN estudiante ON estudiante.id = integrante_proyecto.estudiante_id
INNER JOIN persona ON persona.cedula = estudiante.persona_id
INNER JOIN dimension ON dimension.id = indicadores.dimension_id
INNER JOIN malla_curricular ON dimension.unidad_id = malla_curricular.codigo
INNER JOIN fase ON fase.codigo = malla_curricular.fase_id
GROUP BY persona.cedula, malla_curricular.fase_id