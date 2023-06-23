<header>
        <nav>
            <div class="flex space-between">
                <div class="logo"><a href="index.php"><img src="assets/img/logo.png" alt=""></a> </div>
                <ul class="flex">
                    <li class="">
                        <div class="tooltip flex">
                            <a href="editar-conta.php">
                                <div class=" flex flex-center">
                                    <div class="avatar">
                                        <img src="assets/img/<?php echo $avatar ?>" alt="">
                                    </div>
                                    <p><?= $userNome; ?></p>
                                </div>
                                <span class="tooltiptext tooltip-left ">Clique para alterar sua conta </span>
                            </a>
                        </div>
                    </li>
                    <li><a href="../logout.php" class="btn btn-sair">Sair</a></li>
                </ul>
            </div>
        </nav>
    </header>