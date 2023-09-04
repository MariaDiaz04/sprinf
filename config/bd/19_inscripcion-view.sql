DROP VIEW IF EXISTS detalles_inscripciones;
CREATE VIEW detalles_inscripciones AS
SELECT estudiante.id, persona.nombre as nombre_estudiante,clase.codigo, clase.seccion_id, clase.unidad_curricular_id, materias.nombre as nombre_materia, inscripcion.calificacion
FROM `estudiante`
INNER JOIN persona ON persona.cedula = estudiante.persona_id 
INNER JOIN inscripcion ON inscripcion.estudiante_id = estudiante.id 
INNER JOIN clase ON clase.codigo = inscripcion.clase_id
INNER JOIN malla_curricular on malla_curricular.codigo = clase.unidad_curricular_id
INNER JOIN materias ON materias.codigo = malla_curricular.materia_id;