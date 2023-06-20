<?php
require_once './class/User-class.php';

require_once "./verificar.php";

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'create') {
        $create = new User();
        $create->criar();
    }

    if ($_POST['action'] == 'update') {
        $update = new User();
        $update->editar();
    }

    if ($_POST['action'] == 'delete') {
        $delete = new User();
        $delete->deletar();
    }
}

$class = new User();
$usuarios = $class->verTudo();

$userId = $_SESSION['id_admin'];
$userNome = $class->ver($userId)['nomeUsuario'];
$avatarNome = $class->ver($userId)['avatarUsuario'];
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
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="criar.php">Criar</a>
                    </li>

                </ul>
                <span class="navbar-text">
                    <img src="./assets/images/<?= $avatarNome ?>" alt="" class="img-fluid avatar">
                    <?php echo $userNome; ?>
                </span>
                <a href="./../logout.php" class="btn btn-primary mx-4">sair</a>
            </div>
        </div>
    </nav>

    <h1 class="text-center py-5">Todos os usuários</h1>


    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Avartar</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($usuarios as $usuario) :
                ?>
                    <tr>
                        <th scope="row"><?= $usuario['idUsuario']; ?></th>
                        <td><img src="assets/images/<?= $usuario['avatarUsuario']; ?>" alt="" class="img-fluid avatar"></td>
                        <td><?= $usuario['nomeUsuario']; ?></td>
                        <td><?= $usuario['emailUsuario']; ?></td>
                        <td>
                            <form action="editar.php" method="post" class="d-inline">
                                <input type="hidden" name="id" value="<?= $usuario['idUsuario']; ?>" />
                                <button class="btn btn-warning my-3">Atualizar</button>
                            </form>

                            <?php if ($usuario['idUsuario'] == $userId) {
                            } else {
                            ?>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $usuario['idUsuario']; ?>">
                                    Deletar
                                </button>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                 
                    
                    <div class="modal fade" id="exampleModal<?= $usuario['idUsuario']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tem certeza que deseja excluir este usuário permanentemente?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                   <p> Usuário: <?= $usuario['nomeUsuario']; ?></p> 
                                   <p> E-mail: <?= $usuario['emailUsuario']; ?></p> 
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="index.php" method="post" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $usuario['idUsuario']; ?>">
                                        <input type="hidden" name="action" value="delete">
                                        <button class="btn btn-danger my-3">Deletar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>