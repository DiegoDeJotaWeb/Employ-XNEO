<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
    
    </style>

</head>
<?php
require_once './vendor/class/Tarefa.php';
require_once './vendor/class/User.php';
require_once "./verificar.php";

$userId = $_SESSION['id_admin'];

$class = new User();
$usuarios = $class->ver($userId);


$userNome = $class->ver($userId)['nome_user'];
$avatarNome = $class->ver($userId)['avatar_user'];

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'criarTarefa') {
        $create = new Tarefa();
        $create->criarTarefa($userId);
    }

    if ($_POST['action'] == 'editarTarefa') {

        $update = new Tarefa();
        $update->editarTarefa();
    }

    if ($_POST['action'] == 'deletarTarefa') {
        $delete = new Tarefa();
        $delete->deletarTarefa();
    }
}

$querytarefa = new Tarefa();
$tarefas = $querytarefa->verTudo($userId);

if (isset($_POST['idTarefaEditar'])) {
    $idTarefaEditar = $_POST['idTarefaEditar'];
    $queryVerTarefa = new Tarefa();
    $verTarefa = $queryVerTarefa->ver($idTarefaEditar);
}

echo $_POST['idTarefaEditar'];
?>

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
        <h1>Minha lista de tarefas</h1>
        <div class="flex lista">
            <ul>
                <?php
                foreach ($tarefas as $tarefa) :
                ?>
                    <li class="flex ">
                        <div class="flex">
                            <input type="checkbox" name="" id="">


                            <?php
                            if ($tarefa['status_tarefa'] == 0) {
                                echo "<p class='line'>" . $tarefa['descricao_tafera'] . "</p>";
                            } else {
                                echo "<p >" . $tarefa['descricao_tafera'] . "</p>";
                            }
                            ?>

                        </div>
                        <div class="flex">

                            <form method="post">
                                <input type="hidden" name="idTarefaEditar" value="</?= $tarefa['id_tarefa']; ?>" />

                                <a href="#editar<?= $tarefa['id_tarefa']; ?>" rel="Modal"><i class="fa-solid fa-pen-to-square"></i></a>
                            </form>
                            
                            <a href="#deletar<?= $tarefa['id_tarefa']; ?>" rel="Modal"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </li>
                    <div class="window" id="editar<?= $tarefa['id_tarefa']; ?>">

                        <a href="#" class="fechar"><i class="fa-solid fa-xmark"></i></a>

                        <form method="POST" class="flex flex-collun">
                            <h1 class="text-center">Editar tarefa</h1>
                            <label for="">Tarefa</label>
                            <textarea name="descricao" id="" cols="30" rows="10"><?= $verTarefa['descricao_tafera'] ?></textarea>
                            <input type="text" value="<?= $verTarefa['id_tarefa'] ?>" name="idTarefa">
                            <input type="hidden" name="action" value="editarTarefa">
                            <input type="submit" value="Entrar" class="btn">

                        </form>

                    </div>




                    <div class="window" id="deletar<?= $tarefa['id_tarefa']; ?>">
                        <a href="#" class="fechar"><i class="fa-solid fa-xmark"></i></a>
                        <form method="POST" class="flex flex-collun">
                            <h1 class="text-center">Deletar tarefa</h1>
                            <hr>
                            <label for="">Tarefa: <?= $tarefa['descricao_tafera']; ?></label>
                            <input type="hidden" name="action" value="deletarTarefa">
                            <input type="hidden" name="idDeletar" value="<?= $tarefa['id_tarefa']; ?>">
                            <hr>
                            <div class="flex ">
                                <a href="#" class="btn">Cancelar</a>
                                <input type="submit" class="btn" value="Deletar">
                            </div>
                        </form>
                    </div>



                    <div id="mascara"></div>
                <?php
                endforeach;
                ?>


            </ul>



        </div>


    </div>

    <div class="window" id="criar">

        <a href="#" class="fechar"><i class="fa-solid fa-xmark"></i></a>

        <form method="post" class="flex flex-collun">

            <h2 class="text-center">Adicionar tarefa</h2>
            <hr>
            <label for="">Digite a nova tarefa</label>
            <textarea name="descricao" id="" cols="30" rows="10"></textarea>
            <input type="hidden" name="action" value="criarTarefa">
            <hr>
            <input type="submit" value="Adicionar" class="btn">

        </form>

    </div>


    <a href="#criar" class="btn-criar flex  flex-center" rel="Modal">+</a>




    <script src="https://kit.fontawesome.com/a342c01441.js" crossorigin="anonymous"></script>

    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/janela.js"></script>
</body>

</html>