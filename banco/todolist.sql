CREATE DATABASE todolist;
-- drop database todolist;
use todolist;

CREATE TABLE tbl_user 
( 
 id_user INT PRIMARY KEY AUTO_INCREMENT,  
 nome_user VARCHAR(180),  
 senha_user VARCHAR(255),  
 email_user VARCHAR(180),  
 avatar_user VARCHAR(255)
); 

CREATE TABLE tbl_tarefa 
( 
 id_tarefa INT PRIMARY KEY AUTO_INCREMENT,  
 titulo_tarefa VARCHAR(255),  
 descricao_tafera TEXT,  
 status_tarefa INT,  
 user_id INT
); 

insert into tbl_user
(nome_user,senha_user,email_user,avatar_user)value
('admin','1234','admin@admin.com','avatar.png');

insert into tbl_tarefa
( descricao_tafera,status_tarefa,user_id)value
('descricao tare6 ',0,1);

ALTER TABLE tbl_tarefa ADD FOREIGN KEY(user_id) REFERENCES tbl_user (id_user);

select * from tbl_user;

select * from tbl_tarefa;
