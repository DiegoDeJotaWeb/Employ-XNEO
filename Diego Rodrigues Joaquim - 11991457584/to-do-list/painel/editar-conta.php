<?php
require_once './vendor/class/User.php';

require_once "./verificar.php";

$usuario = new User();

$userId = $_SESSION['id_admin'];
$userNome = $usuario->ver($userId)['nome_user'];
$userAvatar = $usuario->ver($userId)['avatar_user'];
$userId = $usuario->ver($userId)['id_user'];

$nome = $usuario->ver($userId)['nome_user'];
$email = $usuario->ver($userId)['email_user'];
$senha = $usuario->ver($userId)['senha_user'];
$idnome = $usuario->ver($userId)['id_user'];
$avatar = $usuario->ver($userId)['avatar_user'];

$salt = md5($email . $senha);
$custo = "06";
$senhaHash = crypt($senha, "$2b$" . $custo . "$" . $salt . "$");


if (isset($_POST['action'])) {
  if ($_POST['action'] == 'editarUser') {

    $update = new User();
    $update->editar();

    echo $_POST['nome'];
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/style.css">
  <title>Cadastro de Usuário</title>
</head>

<body>
<?php include "vendor/include/_header.php";?>
    
                  
  <div class="container">
    <h1>Cadastro de Usuário</h1>
     <form method="POST" class="flex flex-collun" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="nome"  value="<?= $nome ?>" >
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= $email ?>"  >
      </div>
      <div class="form-group">
        <label for="password">Senha:</label>
        <input type="password" id="password" name="senha" placeholder="******" >
      </div>
      <div class="form-group">
        <label for="photo">Foto de Perfil:</label>
        <input type="file" class="form-control" placeholder="Enter Name here" name="avatar" value="<?php echo $avatar ?>" id="img-capa" onchange="trocarAvatar()">
      </div>


      <input type="hidden" name="id" value="<?= $userId ?>">
      <input type="hidden" name="action" value="editarUser">

      <div class="form-group">
        <label for="photo">Foto atual:</label>
      <img src="assets/img/<?php echo $avatar ?>" class="img-fluid avatar avatar-img" alt="" id="target-capa">
      </div>
      <button type="submit">Alterar</button>
    </form>
  </div>


  <script>
    function trocarAvatar() {
      var target = document.getElementById('target-capa');
      var file = document.querySelector('#img-capa').files[0];

      var reader = new FileReader();

      reader.onloadend = function() {
        target.src = reader.result;
      }

      if (file) {
        reader.readAsDataURL(file);
      } else {
        target.src = "";
      }
    }
  </script>

  <script src="script.js"></script>
</body>

</html>
