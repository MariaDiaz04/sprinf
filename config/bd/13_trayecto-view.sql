DROP VIEW IF EXISTS detalles_trayecto;
CREATE VIEW detalles_trayecto AS
SELECT trayecto.*, periodo.fecha_inicio, periodo.fecha_cierre
FROM trayecto
INNER JOIN periodo ON periodo.id = trayecto.periodo_id