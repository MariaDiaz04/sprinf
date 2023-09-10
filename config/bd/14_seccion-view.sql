DROP VIEW IF EXISTS detalles_seccion;
CREATE VIEW detalles_seccion AS
SELECT seccion.*, trayecto.nombre as trayecto
FROM seccion
INNER JOIN trayecto ON trayecto.codigo = seccion.trayecto_id;