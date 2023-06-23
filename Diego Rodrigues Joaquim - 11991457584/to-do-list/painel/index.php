<?php
require_once './vendor/class/Tarefa.php';
require_once './vendor/class/User.php';
require_once "./verificar.php";

$userId = $_SESSION['id_admin'];

$class = new User();
$usuarios = $class->ver($userId);


$userNome = $class->ver($userId)['nome_user'];
$avatar = $class->ver($userId)['avatar_user'];
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

$checkbox = isset($_POST['checkbox']) ? $_POST['checkbox'] : "";
$valor = isset($_POST['valor']) ? $_POST['valor'] : "";
$marcado = isset($_POST['marcado']) ? $_POST['marcado'] : "";
if ($marcado == "true") {
    $marcado = 1;

    $querytarefa->status($marcado, $valor);
} else if ($marcado == "false") {
    $marcado = 0;

    $querytarefa->status($marcado, $valor);
}


if (isset($_POST['idTarefaEditar'])) {
    $idTarefaEditar = $_POST['idTarefaEditar'];
    $queryVerTarefa = new Tarefa();
    $verTarefa = $queryVerTarefa->ver($idTarefaEditar);
}


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Lista de Tarefas</title>
</head>

<body>

<?php include "vendor/include/_header.php";?>
  

    <div class="container">
        <h1>Lista de Tarefas</h1>
        <ul class="task-list">
            <?php
            foreach ($tarefas as $tarefa) :
            ?>
                <li>

                    <?php
                    if ($tarefa['status_tarefa'] == 1) {
                        echo "  <input type='checkbox'    class='meuCheckbox' name='status" . $tarefa['id_tarefa'] . "' onclick='checkStatus(this)' value='" . $tarefa['id_tarefa'] . "' checked>";
                        echo "<span class='task-text'><p class=' marcado meuParagrafo'>" . $tarefa['descricao_tarefa'] . "</p></span>";
                    }
                    if ($tarefa['status_tarefa'] == 0) {
                        echo "  <input type='checkbox'  class='meuCheckbox' name='status" . $tarefa['id_tarefa'] . "' onclick='checkStatus(this)' value='" . $tarefa['id_tarefa'] . "'>";
                        echo "<span class='task-text'><p class=' meuParagrafo'>" . $tarefa['descricao_tarefa'] . "</p></span>";
                    }
                    ?>


                    <a href="#editar<?= $tarefa['id_tarefa']; ?>" rel="Modal" class="btn btn-editar"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="#deletar<?= $tarefa['id_tarefa']; ?>" rel="Modal" class="btn btn-sair"><i class="fa-solid fa-trash"></i></a>
                </li>

                <!-- modal editar -->
                <div class="window" id="editar<?= $tarefa['id_tarefa']; ?>">

                    <a href="#" class="fechar"><i class="fa-solid fa-xmark"></i></a>

                    <form method="POST" class="flex flex-collun">
                        <h1 class="text-center">Editar tarefa</h1>
                        <label for="">Tarefa</label>
                        <input type="hidden" name="idTarefa" value="<?= $tarefa['id_tarefa']; ?>">
                        <textarea name="descricao" id="" cols="30" rows="10"><?= $tarefa['descricao_tarefa'] ?></textarea>
                      
                        <input type="hidden" name="action" value="editarTarefa">
                        <input type="submit" value="Editar" class="btn btn-salvar">

                    </form>

                </div>

                <!-- modal deletar -->
                <div class="window" id="deletar<?= $tarefa['id_tarefa']; ?>">
                    <a href="#" class="fechar"><i class="fa-solid fa-xmark"></i></a>
                    <form method="POST" class="flex flex-collun">
                        <h1 class="text-center">Deletar tarefa</h1>
                        <hr>
                        <label for="">Tarefa: <?= $tarefa['descricao_tarefa']; ?></label>
                        <input type="hidden" name="action" value="deletarTarefa">
                        <input type="hidden" name="idDeletar" value="<?= $tarefa['id_tarefa']; ?>">
                        <hr>
                        <div class="flex space-between">
                            <a href="index.php" class="btn btn-salvar">Cancelar</a>
                            <input type="submit" class="btn btn-sair" value="Deletar">
                        </div>
                    </form>
                </div>
            <?php
            endforeach;
            ?>
        </ul>
    </div>

    <!-- modal criar tarefa -->
    <div class="window" id="criar">

        <a href="#" class="fechar"><i class="fa-solid fa-xmark"></i></a>

        <form method="post" class="flex flex-collun">
            <h2 class="text-center">Adicionar tarefa</h2>
            <hr>
            <label for="">Digite a nova tarefa</label>
            <textarea name="descricao" id="" cols="30" rows="10"></textarea>
            <input type="hidden" name="action" value="criarTarefa">
            <hr>
            <input type="submit" value="Adicionar" class="btn btn-salvar">
        </form>

    </div>

    <a href="#criar" class="btn-criar flex  flex-center" rel="Modal">+</a>


    <div id="mascara"></div>


    <script src="https://kit.fontawesome.com/a342c01441.js" crossorigin="anonymous"></script>

    <!-- <script src="assets/js/jquery-3.2.1.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/modal.js"></script>


    <script>
       
    </script>

    <script src="assets/js/checkbox.js"></script>
    <script src="assets/js/tarefa.js"></script>

    <style>
        .marcado {
            text-decoration: line-through;
        }
    </style>
</body>

</html>