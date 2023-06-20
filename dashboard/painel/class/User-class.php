<?php
require_once 'Database.php';

class User extends PdoConexao
{

  public function __construct()
  {
    parent::getInstancia();
  }



  public function criar()
  {
    parent::getInstancia();
    $database = PdoConexao::getInstancia();

    $database = $this->getInstancia();

    $sqlUser = "select * from usuarios where emailUsuario = '{$_POST['email']}'";

    $read = $database->query($sqlUser);
    $result = $read->fetchAll(PDO::FETCH_ASSOC);
    $total_result = @count($result);

    if ($total_result < 1) {
      $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);

      if ($ext == 'jpg' || $ext == 'png') {

        $nomeNovo = md5(date('dmYHiimg') . $_FILES['avatar']['tmp_name']);

        $destino = 'assets/images/' . $nomeNovo . "." . $ext;

        $avatar = $nomeNovo . "." . $ext;

        $arquivo_tmp = $_FILES['avatar']['tmp_name'];

        move_uploaded_file($arquivo_tmp, $destino);

        $salt = md5($_POST['email'] . $_POST['senha']);
        $custo = "06";
        $senhaHash = crypt($_POST['senha'], "$2b$" . $custo . "$" . $salt . "$");

        $sql = "insert into usuarios(nomeUsuario,emailUsuario,senhaUsuario,avatarUsuario) values ('{$_POST['nome']}','{$_POST['email']}','{$senhaHash}','{$avatar}')";
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

  public function verTudo()
  {
    parent::getInstancia();
    $database = PdoConexao::getInstancia();
    $database = $this->getInstancia();

    $sql = "select * from usuarios";
    $read = $database->query($sql);

    $usuarios = [];


    while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
      $usuarios[] = $row;
    }
    return $usuarios;
  }

  public function ver($id)
  {
    parent::getInstancia();
    $database = PdoConexao::getInstancia();

    $database = $this->getInstancia();
    $sql = "select * from usuarios where idUsuario = '{$id}'";
    $read = $database->query($sql);
    $usuario = $read->fetch(PDO::FETCH_ASSOC);
    return $usuario;
  }


  public function editar()
  {
    parent::getInstancia();
    $database = PdoConexao::getInstancia();

    $database = $this->getInstancia();


    $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);

    if ($ext == 'jpg' || $ext == 'png') {

      $nomeNovo = md5(date('dmYHiimg') . $_FILES['avatar']['tmp_name']);

      $destino = 'assets/images/' . $nomeNovo . "." . $ext;

      $avatar = $nomeNovo . "." . $ext;

      $arquivo_tmp = $_FILES['avatar']['tmp_name'];

      move_uploaded_file($arquivo_tmp, $destino);
    }

    $salt = md5($_POST['email'] . $_POST['senha']);
    $custo = "06";
    $senhaHash = crypt($_POST['senha'], "$2b$" . $custo . "$" . $salt . "$");

    if ($_POST['senha'] == "" && $_FILES['avatar']['name'] == '') {
      $sql = "update usuarios set 
      nomeUsuario = '{$_POST['nome']}', 
      emailUsuario = '{$_POST['email']}'     
      where idUsuario = '{$_POST['id']}'";
      $database->query($sql);
    } elseif ($_FILES['avatar']['name'] == "") {
      $sql = "update usuarios set 
      nomeUsuario = '{$_POST['nome']}', 
      emailUsuario = '{$_POST['email']}',
      senhaUsuario = '$senhaHash'   
      where idUsuario = '{$_POST['id']}'";
      $database->query($sql);
    } elseif ($_POST['senha'] == "") {
      $sql = "update usuarios set 
      nomeUsuario = '{$_POST['nome']}', 
      emailUsuario = '{$_POST['email']}',
      avatarUsuario = '{$avatar}'      
      where idUsuario = '{$_POST['id']}'";
      $database->query($sql);
    } else {
      $sql = "update usuarios set 
      nomeUsuario = '{$_POST['nome']}', 
      emailUsuario = '{$_POST['email']}', 
      senhaUsuario = '$senhaHash',
      avatarUsuario = '{$avatar}'
      
      where idUsuario = '{$_POST['id']}'";
      $database->query($sql);
    }
  }

  public function deletar()
  {
    parent::getInstancia();
    $database = PdoConexao::getInstancia();

    $database = $this->getInstancia();
    $sql = "delete from usuarios where idUsuario='{$_POST['id']}'";
    $database->query($sql);
  }

  public function criarUser()
  {
    parent::getInstancia();
    $database = PdoConexao::getInstancia();

    $database = $this->getInstancia();
    //criar um usuario administrador
    $senha_crip = md5('admin');
    //echo $senha_crip;
    $query = $database->query("select * from usuarios");

    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_result = count((array)$result);
    if ($total_result == 0) {
      $email = "admin@admin.com";
      $senha = "admin";

      $salt = md5($email . $senha);

      $custo = "06";
      $senhaHash = crypt($senha, "$2b$" . $custo . "$" . $salt . "$");

      $database->query("insert into usuarios(nomeUsuario,emailusuario,senhaUsuario,avatarUsuario)
    values
    ('admin','$email', '$senhaHash','avatar.png');");
    }
  }

  public function login()
  {
    // parent::getInstancia();
    $database = PdoConexao::getInstancia();

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


    $query = $database->prepare("select * from usuarios where (emailUsuario = :email) and senhaUsuario = :senha");



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
