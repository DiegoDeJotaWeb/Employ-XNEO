
$(document).ready(function(){


	$("#enviar").click(function(){

		var acao     = $("#acao").val();
		var nome     = $("#nome").val();
		var email    = $("#email").val();
		var telefone = $("#telefone").val();

		$.post("php/trata_cad.php", {acao:acao, nome:nome, email:email, 
			telefone:telefone}, function(data){

				//$("#resposta").html(data);
				alert(data);
			}
				, "html"
		);
		
		$("#acao").val('');
		$("#nome").val('');
		$("#email").val('');
		$("#telefone").val('');


	});
});