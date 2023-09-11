DROP VIEW IF EXISTS detalles_fase;
CREATE VIEW detalles_fase AS
SELECT 
  fase.codigo as codigo_fase, 
  fase.nombre as nombre_fase, 
  fase.siguiente_fase, 
  trayecto.codigo as codigo_trayecto, 
  trayecto.nombre as nombre_trayecto, 
  periodo.fecha_inicio, periodo.fecha_cierre 
FROM `fase` 
INNER JOIN trayecto ON trayecto.codigo = fase.trayecto_id 
INNER JOIN periodo ON periodo.id = trayecto.periodo_id; 