DROP VIEW IF EXISTS detalles_inscripciones;
CREATE VIEW detalles_inscripciones AS
SELECT estudiante.id, clase.codigo, clase.unidad_curricular_id, inscripcion.calificacion
FROM `estudiante`
INNER JOIN inscripcion ON inscripcion.estudiante_id = estudiante.id 
INNER JOIN clase ON clase.codigo = inscripcion.clase_id;