DROP VIEW IF EXISTS detalles_usuarios;
CREATE VIEW detalles_usuarios AS
SELECT u.id,u.rol_id, u.email, u.contrasena, p.nombre, p.apellido, p.cedula FROM `usuario`  as u INNER JOIN persona as p ON p.usuario_id = u.id;