
<?php 
	include "php/conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<title>Persistência com Ajax, jQuery, PHP e MySQL - Clayton da Silva Rodrigues</title>
</head>

<body>

<form name="formCadastro" action="#" method="post">
	<input type="hidden" name="acao" id="acao" value="inserir" />
	<label>Nome: <input type="text" name="nome" id="nome" /></label><br>
	<label>Email: <input type="text" name="email" id="email" /></label><br>
	<label>Telefone: <input type="text" name="telefone" id="telefone" /></label><br>
	<input type="button" value="Enviar" id="enviar" />
</form>

<div id="resposta"></div>

<?php 
	
	$sql   = "SELECT * FROM contato";

	$query = mysqli_query($conn, $sql);

	// testa se a isntrução sql retorna algum dado cadastrado no banco
	// se sim imprime o(s) valor(es). Caso contrário imprime uma mensagem
	// informando que não existe nem um valor inserido na tabela do banco de dados
	if( mysqli_num_rows($query) > 0)
	{ 
		
		echo "<h4>Listagem dos contatos da Agenda</h4>";

		// Efetua um loop listando e imprimindo os valores cadastrados
		while( $linha = mysqli_fetch_assoc($query) )
		{ 
			echo "" .$linha['nome']. " - " .$linha['email']. " - ".$linha['telefone']. "<br/>";
		}
	} 
	else
	{ 
		echo "<h4>Agenda vazia</h4>";
	}

	// fechando conexão com o banco
	mysqli_close($conn);
?>


<script src="js/jquery-3.2.1.min.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" language="javascript" src="js/ajaxpost.js"></script>


</body>
</html>