DROP VIEW IF EXISTS detalles_inscripciones;
CREATE VIEW detalles_inscripciones AS
SELECT 
  inscripcion.id as id_inscripcion, 
  inscripcion.seccion_id, 
  estudiante.id as estudiante_id, 
  persona.cedula, 
  CONCAT(persona.nombre,' ',persona.apellido)  as nombre_estudiante, 
  materias.codigo as codigo_materia, 
  materias.nombre as nombre_materia, 
  sum(inscripcion.calificacion) as calificacion
FROM `estudiante`
INNER JOIN persona ON persona.cedula = estudiante.persona_id 
INNER JOIN inscripcion ON inscripcion.estudiante_id = estudiante.id 
INNER JOIN malla_curricular on malla_curricular.codigo = inscripcion.unidad_curricular_id
INNER JOIN materias ON materias.codigo = malla_curricular.materia_id
INNER JOIN fase ON fase.codigo = malla_curricular.fase_id
GROUP BY persona.cedula, materias.codigo;