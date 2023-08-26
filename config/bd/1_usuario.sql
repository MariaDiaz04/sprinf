delete from permisos where true;
delete from modulo where true;
delete from roles where true;
delete from persona where true;
delete from usuario where true;

-- ROLES
insert into roles (id, nombre) values (1, 'administrador'), (2, 'profesor'), (3, 'coordinador'), (4, 'estudiante');

-- modulos
insert into modulo (id, nombre) values (1, 'Proyecto');

-- permisos
insert into permisos (id, consultar, actualizar, crear, eliminar, rol_id, modulo_id) values (1, 1, 1, 1, 1, 1, 1);



-- usuarios
insert into usuario (email, contrasena, token) values ('carlos@gmail.com',"$10$M29XwSiuLE.N3nj0RzbgqO4myQffclHtXMhP3OzVXM6VbdvXv4PH6", 'fsadfsadfsadf');

insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (1, '28566432', 'Carlos', 'Ramirez', 'Urb. La Concordia', '04247777777', 1);

-- usuarios roles
insert into roles_usuarios (rol_id, usuario_id) values (1,1);

