create database aztk;
use aztk;
create table Usuarios(
ID_usuario int primary key auto_increment,
Nombre varchar(50) not null,
Apellido varchar(50) not null,
Correo varchar(50) not null unique,
Contrasena varchar(50) not null,
Administrador bool not null,
Telefono varchar(20),
Direccion varchar(50) NOT NULL
);

create table Productos(
ID_producto int primary key auto_increment,
Nombre varchar(50) not null,
Precio double not null
);

create table Ingredientes(
ID_ingrediente int primary key auto_increment,
Nombre varchar(50)
);




create table Pedidos(
ID_pedido int primary key auto_increment,
ID_usuario int not null,
Fecha date not  null,
Total double not null,
Direccion varchar(50) not null,
Telefono varchar (20) not null,
Estado varchar(10) not null,
Comentarios varchar(50),
CONSTRAINT `ID_usuario` FOREIGN KEY (`ID_usuario`) REFERENCES `Usuarios` (`ID_usuario`)
);
create table Detalle_Pedidos(
ID_pedido int not null,
ID_producto int not null,
ID_ingrediente int not null,
Nombre varchar(50) not null,
Precio double not null,
Cantidad int not null,
CONSTRAINT `ID_pedido` FOREIGN KEY (`ID_pedido`) REFERENCES `Pedidos` (`ID_pedido`),
CONSTRAINT `ID_producto` FOREIGN KEY (`ID_producto`) REFERENCES `Productos` (`ID_producto`),
CONSTRAINT `ID_ingrediente` FOREIGN KEY (`ID_ingrediente`) REFERENCES `Ingredientes` (`ID_ingrediente`)
);
select * from ingredientes;
delete from productos where ID_producto=2;
insert into usuarios values(1,"Getse","Reyes","getsy98@gmail.com","123456",true,"4451323685","fdf");
select *from usuarios;
insert into pedidos values(1,2,"2019-11-10",136,"1","4451323685","Realizado","Mandelo a las 8:00pm");

select ID_pedido, (Select Nombre from usuarios where usuarios.ID_usuario=pedidos.ID_usuario)  as Nombre, Fecha,Total,Direccion,
Telefono, Estado,Comentarios
 from pedidos;
 
 