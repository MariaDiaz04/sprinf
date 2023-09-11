DROP VIEW IF EXISTS detalles_baremos;
CREATE VIEW detalles_baremos AS
SELECT  
	indicadores.id as indicador_id,
    indicadores.nombre as nombre_indicador,
    detalles_dimension.*
FROM `indicadores`
INNER JOIN detalles_dimension ON detalles_dimension.id = indicadores.id;