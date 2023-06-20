<?php
require_once "./painel/vendor/class/User.php";
$class = new User();
$class->criarUser();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="painel/assets/css/style.css">
  
</head>
<body>

<div class="container ">
    <div class="flex flex-center h-100">
        
    <form action="autenticar.php" method="POST" class="form-login flex flex-collun">
    <h1 class="text-center">To-do list</h1>
        <label for="">Login</label>
        <input type="text" name="email">
        <label for="">Senha</label>
        <input type="password" name="senha">
        <input type="submit" value="Entrar" class="btn">
        <a href="painel/criar-conta.php" class="text-center">Criar conta</a>
    </form>
    </div>
</div>
    
</body>
</html>