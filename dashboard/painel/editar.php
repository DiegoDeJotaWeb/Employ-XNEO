<?php
require_once './class/User-class.php';

require_once "./verificar.php";

$usuario = new User();


$userId = $_SESSION['id_admin'];
$userNome = $usuario->ver($userId)['nomeUsuario'];
$userAvatar = $usuario->ver($userId)['avatarUsuario'];





// print_r($usuario -> ver($_POST['id'])['nomeUsuario']);
$nome = $usuario->ver($_POST['id'])['nomeUsuario'];
$email = $usuario->ver($_POST['id'])['emailUsuario'];
$senha = $usuario->ver($_POST['id'])['senhaUsuario'];
$idnome = $usuario->ver($_POST['id'])['idUsuario'];
$avatar = $usuario->ver($_POST['id'])['avatarUsuario'];

$salt = md5($email . $senha);
$custo = "06";
$senhaHash = crypt($senha, "$2b$" . $custo . "$" . $salt . "$");



// print_r($usuario['name']);
// var_dump($usuario['name']);
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        .avatar {
            width: 50px;
        }
        nav {
            background: linear-gradient(100deg, #ffe53bd8, #ff2525da);
            box-shadow: 0px 8px 10px rgba(0, 0, 0, .5);
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="criar.php">Criar</a>
                    </li>

                </ul>
                <span class="navbar-text">
                    <img src="./assets/images/<?= $userAvatar ?>" alt="" class="img-fluid avatar">
                    <?php echo $userNome; ?>
                </span>
                <a href="./../logout.php" class="btn btn-primary mx-4">sair</a>
            </div>
        </div>
    </nav>

    <h1 class="text-center py-5">Editar usuário</h1>

    <div class="container">
        <form action="index.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" value="<?= $nome; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= $email; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Senha</label>
                <input type="password" class="form-control" name="senha" value="" placeholder="*****">
            </div>

            <div class="mb-3">
                <label class="form-label">Avatar</label>
                <input type="file" class="form-control" placeholder="Enter Name here" name="avatar" value="<?php echo $avatar ?>" id="img-capa" onchange="trocarCapa()">
            </div>
            <input type="hidden" name="action" value="update">
            <div class="col-md-3">
                <div class="form-floating mb-3">
                    <img src="assets/images/<?php echo $avatar ?>" class="img-fluid avatar" alt="" id="target-capa">
                </div>
            </div>


            <input type="text" name="id" value="<?= $idnome; ?>">
            <button type="submit" class="btn btn-primary">Editar</button>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
        function trocarCapa() {
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
</body>

</html>