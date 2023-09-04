DROP VIEW IF EXISTS detalles_estudiantes;
CREATE VIEW detalles_estudiantes AS
SELECT estudiante.id, persona.*, usuario.email, count(detalles_inscripciones.codigo) as clases, detalles_inscripciones.seccion_id
FROM persona
INNER JOIN estudiante ON estudiante.persona_id = persona.cedula
LEFT JOIN usuario ON usuario.id = persona.usuario_id
LEFT JOIN detalles_inscripciones ON detalles_inscripciones.id = estudiante.id
GROUP BY persona.cedula, detalles_inscripciones.seccion_id