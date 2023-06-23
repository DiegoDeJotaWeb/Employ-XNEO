<style>
    body {
  font-family: Arial, sans-serif;
  background-color: #f1f1f1;
  margin: 0;
  padding: 0;
}


h2 {
  text-align: center;
}

input {
  display: block;
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

button {
  display: block;
  width: 100%;
  padding: 10px;
  background-color: #4CAF50;
  color: #fff;
  border: none;
  border-radius: 3px;
  cursor: pointer;
  
}

.link{
  text-align: center;
  padding: 10px 0;
}
a{
  text-decoration: none;
}
@media (max-width: 480px) {
  .login {
    padding: 20px;
  }

  .login-form {
    width: 100%;
  }
}
</style>
<?php
require_once "./painel/vendor/class/User.php";
$class = new User();
$class->criarUser();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="painel/assets/css/style.css">
  <title>Página de Login</title>
</head>

<body>
  <div class="login">
    <form  action="autenticar.php" method="POST"  class="login-form">
      <h2>Login</h2>
      <input type="text" name="email" placeholder="Nome de usuário">
      <input type="password"  name="senha"placeholder="Senha">
      <button type="submit">Entrar</button>
      <div class="link">
      <a href="cadastro-conta.php" class="text-center">Criar conta</a>
      </div>
    </form>
    
  </div>
</body>

</html>