<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        .tooltip {
            position: relative;
        }

        .tooltip .tooltiptext {
            /* visibility: hidden;
            width: 120px;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -60px;
            opacity: 0;
            transition: opacity 0.3s; */

            visibility: hidden;
            position: absolute;
            width: 120px;
            background-color: #555;
            color: #fff;
            text-align: center;
            padding: 5px 0;
            border-radius: 6px;
            z-index: 1;
            opacity: 0;
            transition: opacity 0.3s;
        }

        /* .tooltip .tooltiptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;


            
        } */

        .tooltip-left::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 100%;
            margin-top: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: transparent transparent transparent #555;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }

        .tooltip-left {
            top: -5px;
            bottom: auto;
            right: 128%;
        }

        nav ul li {
            margin: 0 20px;
        }

        .logo img {
            width: 50px;
        }
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

$checkbox = isset($_POST['checkbox']) ? $_POST['checkbox'] : "";
// echo "<script>alert('$checkbox')</script>";

$valor = isset($_POST['valor']) ? $_POST['valor'] : "";
// echo "<script>alert('$valor')</script>";
$marcado = isset($_POST['marcado']) ? $_POST['marcado'] : "";
// echo "<script>alert('$marcado')</script>";
if ($marcado == "true") {
    $marcado = 1;

    $querytarefa->status($marcado, $valor);
    // header("Location:index.php");
} else if ($marcado == "false") {
    $marcado = 0;

    $querytarefa->status($marcado, $valor);
    // header("Location:index.php");
}


if (isset($_POST['idTarefaEditar'])) {
    $idTarefaEditar = $_POST['idTarefaEditar'];
    $queryVerTarefa = new Tarefa();
    $verTarefa = $queryVerTarefa->ver($idTarefaEditar);
}


?>

<body>

    <nav>
        <div class="flex space-between">
            <div class="logo"><a href="index.php"><img src="assets/img/logo.png" alt=""></a> </div>
            <ul class="flex">

                <li class="">

                    <div class="tooltip flex">
                        <a href="editar-conta.php">

                            <div class="avatar flex ">
                                <img src="assets/img/<?= $avatarNome ?>" alt="">
                                <?= $userNome; ?>
                            </div>


                            <span class="tooltiptext tooltip-left ">Clique para alterar sua conta </span>
                        </a>



                    </div>


                </li>


                <li><a href="../logout.php"><i class="fa-solid fa-power-off"></i></a></li>

            </ul>
        </div>

    </nav>
    <?php
    // $checkbox = isset($_POST['checkbox']) ? $_POST['checkbox'] : "";

    // $marcado = isset($_POST['marcado']) ? $_POST['marcado'] : "";

    // if($marcado == "true") {
    //     $marcado = 1;
    // }else if($marcado == "false") {
    //     $marcado = 0;
    // }

    // $statusTarefa = $querytarefa->status($marcado);

    // $status = new Tarefa();

    // else{
    //    echo "erro";
    //     return;
    // }

    ?>


    <div class="container ">
        <h1>Minha lista de tarefas</h1>
        <div class="flex lista">
            <ul>
                <?php
                foreach ($tarefas as $tarefa) :
                ?>
                    <li class="flex ">
                        <div class="flex">

                            <script>
                                function checkStatus(checkbox) {
                                    var data = new FormData();
                                    data.append("checkbox", checkbox.name);
                                    data.append("marcado", checkbox.checked);
                                    data.append("valor", checkbox.value);

                                    fetch('index.php', {
                                            method: 'POST',
                                            body: data
                                        })
                                        .then(retorno => {
                                            console.log("sucesso" + checkbox.name + checkbox.checked + checkbox.value);
                                        })
                                        .catch(
                                            retorno => {
                                                console.error(retorno);
                                            }
                                        )
                                }
                            </script>

                            <?php
                            // if($tarefa['status_tarefa'] == 1){
                            //     $ck = "true";
                            // }else if($tarefa['status_tarefa'] == 0){
                            //     $ck = "false";
                            // }

                            // echo $tarefa['status_tarefa'];
                            // echo "  <input type='checkbox' name='status" . $tarefa['id_tarefa'] . "' onclick='checkStatus(this)' value='" . $tarefa['id_tarefa'] . "' checked={$ck}>";
                            // echo "<p class='line'>" . $tarefa['descricao_tafera'] . "</p>";


                            if ($tarefa['status_tarefa'] == 1) {
                                echo "  <input type='checkbox'    class='meuCheckbox' name='status" . $tarefa['id_tarefa'] . "' onclick='checkStatus(this)' value='" . $tarefa['id_tarefa'] . "' checked>";
                                echo "<p class='line meuParagrafo'>" . $tarefa['descricao_tafera'] . "</p>";
                            } 

//                             class="meuCheckbox"
// class="meuParagrafo"
                            
                            if ($tarefa['status_tarefa'] == 0) { 
                                echo "  <input type='checkbox'  class='meuCheckbox' name='status" . $tarefa['id_tarefa'] . "' onclick='checkStatus(this)' value='" . $tarefa['id_tarefa'] . "'>";
                                echo "<p class='meuParagrafo'> " . $tarefa['descricao_tafera'] . "</p>";
                            }

                            

                            // echo "  <input type='checkbox' name='status" . $tarefa['id_tarefa'] . "' onclick='checkStatus(this)' value='" . $tarefa['id_tarefa'] . "'>";
                            // echo "<p>" . $tarefa['descricao_tafera'] . "</p>";
                            ?>


                            

                        </div>
                        <div class="flex">

                            <form method="post">
                                <input type="hidden" name="idTarefaEditar" value="<?= $tarefa['id_tarefa']; ?>" />

                                <a href="#editar<?= $tarefa['id_tarefa']; ?>" rel="Modal"><i class="fa-solid fa-pen-to-square"></i></a>
                            </form>

                            <a href="#deletar<?= $tarefa['id_tarefa']; ?>" rel="Modal"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </li>


                    <div class="window" id="editar<?= $tarefa['id_tarefa']; ?>">

                        <a href="#" class="fechar"><i class="fa-solid fa-xmark"></i></a>

                        <form method="POST" class="flex flex-collun">
                            <h1 class="text-center">Editar tarefa <?= $tarefa['id_tarefa']; ?></h1>
                            <label for="">Tarefa</label>
                            <textarea name="descricao" id="" cols="30" rows="10"><?= $tarefa['descricao_tafera'] ?></textarea>
                            <input type="text" value="<?= $tarefa['id_tarefa'] ?>" name="idTarefa">
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
                                <a href="index.php" class="btn">Cancelar</a>
                                <input type="submit" class="btn" value="Deletar">
                            </div>
                        </form>
                    </div>




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

    <div id="mascara"></div>


    <script src="https://kit.fontawesome.com/a342c01441.js" crossorigin="anonymous"></script>

    <!-- <script src="assets/js/jquery-3.2.1.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/janela.js"></script>

   
<script>

$(document).ready(function() {
  $(".meuCheckbox").click(function() {
    var index = $(".meuCheckbox").index(this);
    var paragrafo = $(".meuParagrafo").eq(index);

    if ($(this).is(":checked")) {
      paragrafo.addClass("marcado");
    } else {
      paragrafo.removeClass("marcado");
    }
  });
});

</script>

<style>
 .marcado {
  text-decoration: line-through;
}
</style>
</body>

</html>