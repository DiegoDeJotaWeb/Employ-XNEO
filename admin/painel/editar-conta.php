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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <style>
        .avatar {
            width: 100%;
        }
    </style> -->
</head>

<body>
    <nav>
        <div class="flex space-between">
            <div class="logo"><a href="index.php">To-Do-List</a> </div>
            <ul class="flex">
                <li class="avatar">
                    <img src="assets/img/avatar.png" alt="">

                </li>
                <li><a href="editar-conta.php"><?= $userNome; ?></a></li>


                <li><a href="../logout.php"><i class="fa-solid fa-power-off"></i></a></li>

            </ul>
        </div>

    </nav>
    <div class="container ">
        <div class="flex flex-center h-100">

            <form method="POST" class="form-login flex flex-collun" enctype="multipart/form-data">
                <h1 class="text-center">Editar conta</h1>
                <label for="">Nome</label>
                <input type="text" name="nome" value="<?= $nome ?>">
                <label for="">Email</label>
                <input type="text" name="email" value="<?= $email ?>">
                <label for="">Senha</label>
                <input type="password" name="senha" placeholder="*******">

                <label class="form-label">Avatar</label>
                <input type="file" class="form-control" placeholder="Enter Name here" name="avatar" value="<?php echo $avatar ?>" id="img-capa" onchange="trocarAvatar()">
                <input type="hidden" name="id" value="<?=$userId?>">
                <input type="hidden" name="action" value="editarUser">

                <img src="assets/img/<?php echo $avatar ?>" class="img-fluid avatar" alt="" id="target-capa">

                <input type="submit" value="Alterar" class="btn">

            </form>
        </div>
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
    <script src="https://kit.fontawesome.com/a342c01441.js" crossorigin="anonymous"></script>
</body>

</html>