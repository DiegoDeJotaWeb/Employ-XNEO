<?php
require_once './vendor/class/User.php';
if (isset($_POST['action'])) {
    if ($_POST['action'] == 'criarUser') {
        $create = new User();
        $create->criar();
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
  
</head>
<body>

<div class="container ">
    <div class="flex flex-center h-100">
        
    <form method="POST" class="form-login flex flex-collun" enctype="multipart/form-data">
    <h1 class="text-center">Criar conta</h1>
        <label for="">Nome</label>
        <input type="text" name="nome">
        <label for="">Senha</label>
        <input type="password" name="senha">
        <label for="">Email</label>
        <input type="text" name="email">
        <label for="">Avatar</label>
        <input type="file" name="avatar">
        <input type="hidden" name="action" value="criarUser">
        <input type="submit" value="Cadastrar" class="btn">
        <a href="./../index.php" class="text-center">Já tenho conta</a>
    </form>
    </div>
</div>
    
</body>
</html>