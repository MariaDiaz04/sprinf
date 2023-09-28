DROP VIEW IF EXISTS detalles_estudiantes;
CREATE VIEW detalles_estudiantes AS
SELECT 
  estudiante.id, 
  persona.*, 
  usuario.email, 
  count(detalles_inscripciones.codigo) as clases, 
  detalles_inscripciones.seccion_id, 
  integrante_proyecto.proyecto_id,
  trayecto.codigo as trayecto_id
FROM persona
INNER JOIN estudiante ON estudiante.persona_id = persona.cedula
LEFT JOIN usuario ON usuario.id = persona.usuario_id
LEFT JOIN detalles_inscripciones ON detalles_inscripciones.id = estudiante.id
LEFT JOIN integrante_proyecto ON integrante_proyecto.estudiante_id = estudiante.id
LEFT JOIN seccion ON seccion.codigo = detalles_inscripciones.seccion_id
LEFT JOIN trayecto ON trayecto.codigo = seccion.trayecto_id
GROUP BY persona.cedula, detalles_inscripciones.seccion_id