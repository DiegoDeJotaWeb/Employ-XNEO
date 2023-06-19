CREATE DATABASE todolist;

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

ALTER TABLE tbl_tarefa ADD FOREIGN KEY(user_id) REFERENCES tbl_user (id_user);


