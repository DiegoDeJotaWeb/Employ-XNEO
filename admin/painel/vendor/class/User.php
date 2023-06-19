<?php

include_once "Database.php";

class User extends Database
{

    public function __construct()
    {
        parent::getInstancia();
    }


    public function criarUser()
    {
        parent::getInstancia();
        $database = Database::getInstancia();

        $database = $this->getInstancia();
        //criar um usuario administrador
       
        $query = $database->query("select * from tbl_usuario");

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $total_result = count((array)$result);
        if ($total_result == 0) {
            $email = "admin@admin.com.br";
            $senha = "admin";

            $salt = md5($email . $senha);

            $custo = "06";
            $senhaHash = crypt($senha, "$2b$" . $custo . "$" . $salt . "$");

            $database->query("insert into tbl_usuario(nome_user,email_user,senha_user,avatar_user)
      values
      ('admin','$email', '$senhaHash','avatar.jpg');");
        }
    }

    public function login()
    {
    
        $database = Database::getInstancia();

        $database = $this->getInstancia();
        session_cache_limiter('private');
        $cache_limiter = session_cache_limiter();

        session_cache_expire(120);
        $cache_expire = session_cache_expire();


        @session_start();
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $salt = md5($email . $senha);
        $custo = "06";
        $senhaHash = crypt($senha, "$2b$" . $custo . "$" . $salt . "$");


        $query = $database->prepare("select * from tbl_usuario where (emailUsuario = :email) and senhaUsuario = :senha");



        $query->bindValue(":email", "$email");
        $query->bindValue(":senha", "$senhaHash");
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        $total_result = @count($result);


        if ($total_result > 0) {
            echo $_SESSION['id_admin'] = $result[0]['idUsuario'];
            echo  $_SESSION['nome_admin'] = $result[0]['nomeUsuario'];
            $_SESSION['email_admin'] = $result[0]['emailUsuario'];
            $_SESSION['avatar_admin'] = $result[0]['avatarUsuario'];
            echo "<script>window.location.href='painel';</script>";
        } else {
            echo "<script>window.alert('Dados incoretos');</script>";
            echo "<script>window.location='index.php';</script>";
        }
    }
}
