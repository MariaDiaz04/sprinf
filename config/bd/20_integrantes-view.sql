DROP VIEW IF EXISTS detalles_integrantes;
CREATE VIEW detalles_integrantes AS
SELECT integrante_proyecto.id, proyecto.id as proyecto_id, estudiante.id as estudiante_id, proyecto.nombre as proyecto_nombre, persona.nombre, persona.cedula
FROM integrante_proyecto
INNER JOIN estudiante ON estudiante.id = integrante_proyecto.estudiante_id
INNER JOIN persona on persona.cedula = estudiante.persona_id
INNER JOIN proyecto on proyecto.id = integrante_proyecto.proyecto_id