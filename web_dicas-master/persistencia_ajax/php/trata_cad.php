
<?php
	// inclui arquivo com dados e string de conexão com a base de dados
	include "conexao.php";

	// declarando variáveis e atribuindo os valores do form para as mesmas
	$nome     = $_POST['nome'];
	$email    = $_POST['email'];
	$telefone = $_POST['telefone'];

	// tratando os dados enviados via form com php, ajax e mysql
	if($_POST['acao'] == 'inserir')
	{

		// testando se algum valor veio em branco
		if( empty($nome) || empty(email) || empty($telefone) )	
		{

			print("Preencha todos os campos!"); exit();
		}
		
		// instrução sql para inserir os dados no banco de dados
		$sql = "INSERT INTO contato (nome, email, telefone)VALUES('{$nome}','{$email}','{$telefone}')";

		$insert = mysqli_query($conn, $sql);

		if($insert)
		{
			// fechando a conexão
			mysqli_close($conn); 

			echo "Dados inseridos com sucesso!";

		}
		else
		{ 
			// fechando a conexão
			mysqli_close($conn); 

			echo "Erro ao inser os dados.";
		}


	}
	else
	{ 
		// fechando a conexão
		mysql_close($conn); 

		echo "Nenhuma acao submetida";

	}

?>