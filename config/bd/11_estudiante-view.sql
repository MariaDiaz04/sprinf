DROP VIEW IF EXISTS detalles_estudiantes;
CREATE VIEW detalles_estudiantes AS
SELECT estudiante.id, persona.*, usuario.email
FROM persona
INNER JOIN estudiante ON estudiante.persona_id = persona.cedula
LEFT JOIN usuario ON usuario.id = persona.usuario_id