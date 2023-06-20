CREATE DATABASE usuario;
USE usuario;
CREATE TABLE usuarios(
  idUsuario INT PRIMARY KEY AUTO_INCREMENT,
  nomeUsuario varchar(255),
  emailUsuario varchar(255),
  senhaUsuario varchar(255),
  avatarUsuario varchar(255)
);

select *from usuarios;