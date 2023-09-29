DROP VIEW IF EXISTS detalles_historico_proyecto;
CREATE VIEW detalles_historico_proyecto AS
SELECT
* 
FROM proyecto_historico
ORDER BY periodo_final DESC