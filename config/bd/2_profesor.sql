delete from profesor where true;
delete from persona where usuario_id != 1;
delete from usuario where id != 1;


-- Profesora Sonia
insert into usuario (id,email, contrasena, token)
values (2,'sonia@gmail.com','$10$M29XwSiuLE.N3nj0RzbgqO4myQffclHtXMhP3OzVXM6VbdvXv4PH6', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (2, '135482354', 'Sonia', '', 'Barquisimeto', '04247777777', 1);
insert into profesor (codigo, persona_id) values ('p-135482354',135482354);

-- Profesor Ricardo Tillero
insert into usuario (id,email, contrasena, token)
values (3,'ricardo@gmail.com','$10$M29XwSiuLE.N3nj0RzbgqO4myQffclHtXMhP3OzVXM6VbdvXv4PH6', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (3, '654854354', 'Ricardo', 'Tillero', 'Barquisimeto', '04247777777', 1);
insert into profesor (codigo, persona_id) values ('p-654854354',654854354);


-- Profesor Orlando 
insert into usuario (id,email, contrasena, token)
values (4,'orlando@gmail.com','$10$M29XwSiuLE.N3nj0RzbgqO4myQffclHtXMhP3OzVXM6VbdvXv4PH6', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (4, '234565423', 'Orlando', '', 'Barquisimeto', '04247777777', 1);
insert into profesor (codigo, persona_id) values ('p-234565423',234565423);

-- Profesora Lisset
insert into usuario (id,email, contrasena, token)
values (5,'lisset@gmail.com','$10$M29XwSiuLE.N3nj0RzbgqO4myQffclHtXMhP3OzVXM6VbdvXv4PH6', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (5, '5482315748', 'Lisset', '', 'Barquisimeto', '04247777777', 1);
insert into profesor (codigo, persona_id) values ('p-5482315748',5482315748);

-- Profesor orlando 
insert into usuario (id,email, contrasena, token)
values (6,'oswaldo@gmail.com','$10$M29XwSiuLE.N3nj0RzbgqO4myQffclHtXMhP3OzVXM6VbdvXv4PH6', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (6, '132654318', 'Oswaldo', '', 'Barquisimeto', '04247777777', 1);
insert into profesor (codigo, persona_id) values ('p-132654318',132654318);

-- Profesora pura
insert into usuario (id,email, contrasena, token)
values (7,'pura@gmail.com','$10$M29XwSiuLE.N3nj0RzbgqO4myQffclHtXMhP3OzVXM6VbdvXv4PH6', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (7, '52844735', 'Pura', '', 'Barquisimeto', '04247777777', 1);
insert into profesor (codigo, persona_id) values ('p-52844735',52844735);

-- profesora sonia
insert into usuario (id,email, contrasena, token)
values (8,'sonia@gmail.com','$10$M29XwSiuLE.N3nj0RzbgqO4myQffclHtXMhP3OzVXM6VbdvXv4PH6', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (8, '354485234', 'Sonia', '', 'Barquisimeto', '04247777777', 1);
insert into profesor (codigo, persona_id) values ('p-354485234',354485234);

-- profesora Ligia
insert into usuario (id,email, contrasena, token)
values (9,'ligia@gmail.com','$10$M29XwSiuLE.N3nj0RzbgqO4myQffclHtXMhP3OzVXM6VbdvXv4PH6', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (9, '354487534', 'Ligia', '', 'Barquisimeto', '04247777777', 1);
insert into profesor (codigo, persona_id) values ('p-354487534',354487534);


-- profesora Ingrid
insert into usuario (id,email, contrasena, token)
values (10,'ingrid@gmail.com','$10$M29XwSiuLE.N3nj0RzbgqO4myQffclHtXMhP3OzVXM6VbdvXv4PH6', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (10, '3542874', 'Ingrid', '', 'Barquisimeto', '04247777777', 1);
insert into profesor (codigo, persona_id) values ('p-3542874',3542874);

-- profesora Lerida
insert into usuario (id,email, contrasena, token)
values (11,'lerida@gmail.com','$10$M29XwSiuLE.N3nj0RzbgqO4myQffclHtXMhP3OzVXM6VbdvXv4PH6', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (11, '54875538', 'Lerida', '', 'Barquisimeto', '04247777777', 1);
insert into profesor (codigo, persona_id) values ('p-54875538',54875538);

-- profesora Ruben
insert into usuario (id,email, contrasena, token)
values (12,'ruben@gmail.com','$10$M29XwSiuLE.N3nj0RzbgqO4myQffclHtXMhP3OzVXM6VbdvXv4PH6', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (12, '5487531', 'Ruben', '', 'Barquisimeto', '04247777777', 1);
insert into profesor (codigo, persona_id) values ('p-5487531',5487531);

-- profesora Indira
insert into usuario (id,email, contrasena, token)
values (13,'indira@gmail.com','$10$M29XwSiuLE.N3nj0RzbgqO4myQffclHtXMhP3OzVXM6VbdvXv4PH6', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (13, '523156847', 'Indira', '', 'Barquisimeto', '04247777777', 1);
insert into profesor (codigo, persona_id) values ('p-523156847',523156847);

-- profesora Indira
insert into usuario (id,email, contrasena, token)
values (14,'marling@gmail.com','$10$M29XwSiuLE.N3nj0RzbgqO4myQffclHtXMhP3OzVXM6VbdvXv4PH6', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (14, '2658475', 'Marling', '', 'Barquisimeto', '04247777777', 1);
insert into profesor (codigo, persona_id) values ('p-2658475',2658475);

-- profesora hermes
insert into usuario (id,email, contrasena, token)
values (15,'hermes@gmail.com','$10$M29XwSiuLE.N3nj0RzbgqO4myQffclHtXMhP3OzVXM6VbdvXv4PH6', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (15, '23154875', 'Hermes', '', 'Barquisimeto', '04247777777', 1);
insert into profesor (codigo, persona_id) values ('p-23154875',23154875);

insert into usuario (id,email, contrasena, token)
values (16,'josesequera@gmail.com','$10$M29XwSiuLE.N3nj0RzbgqO4myQffclHtXMhP3OzVXM6VbdvXv4PH6', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (16, '5428468', 'Jose', '', 'Barquisimeto', '04247777777', 1);
insert into profesor (codigo, persona_id) values ('p-5428468',5428468);


insert into usuario (id,email, contrasena, token)
values (17,'pedro@gmail.com','$10$M29XwSiuLE.N3nj0RzbgqO4myQffclHtXMhP3OzVXM6VbdvXv4PH6', '');
insert into persona (usuario_id, cedula, nombre, apellido, direccion, telefono, estatus) 
values (17, '52213548', 'Pedro', '', 'Barquisimeto', '04247777777', 1);
insert into profesor (codigo, persona_id) values ('p-52213548',52213548);