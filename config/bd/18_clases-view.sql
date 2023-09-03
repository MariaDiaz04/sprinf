DROP VIEW IF EXISTS detalles_clases;
CREATE VIEW detalles_clases AS
SELECT clase.*, persona.nombre as profesor,detalles_materias.materia_id,detalles_materias.nombre, detalles_materias.nombre_fase, detalles_materias.nombre_trayecto, count(inscripcion.id) as estudiantes
FROM clase
INNER JOIN profesor ON profesor.codigo = clase.profesor_id
INNER JOIN persona ON persona.cedula = profesor.persona_id
INNER JOIN detalles_materias ON detalles_materias.codigo = clase.unidad_curricular_id
LEFT OUTER JOIN inscripcion ON inscripcion.clase_id = clase.codigo
GROUP BY clase.codigo