DROP VIEW IF EXISTS detalles_profesores;
CREATE VIEW detalles_profesores AS
SELECT persona.*, usuario.email
FROM persona
INNER JOIN profesor ON profesor.persona_id = persona.cedula
LEFT JOIN usuario ON usuario.id = persona.usuario_id