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
       
        $query = $database->query("select * from tbl_user");

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $total_result = count((array)$result);
        if ($total_result == 0) {
            $email = "admin@admin.com.br";
            $senha = "admin";

            $salt = md5($email . $senha);

            $custo = "06";
            $senhaHash = crypt($senha, "$2b$" . $custo . "$" . $salt . "$");

            $database->query("insert into tbl_user(nome_user,email_user,senha_user,avatar_user)
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


        $query = $database->prepare("select * from tbl_user where (email_user = :email) and senha_user = :senha");



        $query->bindValue(":email", "$email");
        $query->bindValue(":senha", "$senhaHash");
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        $total_result = @count($result);


        if ($total_result > 0) {
            echo $_SESSION['id_admin'] = $result[0]['id_user'];
            echo  $_SESSION['nome_admin'] = $result[0]['nome_user'];
            $_SESSION['email_admin'] = $result[0]['email_user'];
            $_SESSION['avatar_admin'] = $result[0]['avatar_user'];
            echo "<script>window.location.href='painel';</script>";
        } else {
            echo "<script>window.alert('Dados incoretos');</script>";
            echo "<script>window.location='index.php';</script>";
        }
    }

    public function ver($id)
  {
    $database = Database::getInstancia();

        $database = $this->getInstancia();
    $sql = "select * from tbl_user where id_user = '{$id}'";
    $read = $database->query($sql);
    $usuario = $read->fetch(PDO::FETCH_ASSOC);
    return $usuario;
  }


  public function criar()
  {
    $database = Database::getInstancia();

        $database = $this->getInstancia();

    $sqlUser = "select * from tbl_user where email_user = '{$_POST['email']}'";

    $read = $database->query($sqlUser);
    $result = $read->fetchAll(PDO::FETCH_ASSOC);
    $total_result = @count($result);

    if ($total_result < 1) {
      $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);

      if ($ext == 'jpg' || $ext == 'png') {

        $nomeNovo = md5(date('dmYHiimg') . $_FILES['avatar']['tmp_name']);

        $destino = 'assets/img/' . $nomeNovo . "." . $ext;

        $avatar = $nomeNovo . "." . $ext;

        $arquivo_tmp = $_FILES['avatar']['tmp_name'];

        move_uploaded_file($arquivo_tmp, $destino);

        $salt = md5($_POST['email'] . $_POST['senha']);
        $custo = "06";
        $senhaHash = crypt($_POST['senha'], "$2b$" . $custo . "$" . $salt . "$");

        $sql = "insert into tbl_user (nome_user,email_user,senha_user,avatar_user) values ('{$_POST['nome']}','{$_POST['email']}','{$senhaHash}','{$avatar}')";
        $database->query($sql);
      } else {
        echo "<script>alert('Erro na exteção do arquivo')</script>";
        echo "<script>window.location.href = 'criar.php'</script>";
      }
    } else {
      echo "<script>alert('E-mail já cadastrado!');</script>";
      echo "<script>window.location.href = 'criar.php'</script>";
    }
  }
}
