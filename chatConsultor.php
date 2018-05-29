<?php 
	$assinaturaId = $_GET['id'];

	include ('_class/conexao.php');
	include('_class/chatClasses.php');

	$chatClasse = new ChatClass;
	
	if (!$login->islogincon() || !$chatClasse->casoAberto($assinaturaId)) {
	 	header('Location: logout.php');
	}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="_js/jquery-3.2.1.js"></script>
	<meta charset="utf-8">
	<title>Chat | Consultoria MEI</title>
	<link rel="stylesheet" type="text/css" href="_css/chatStyle.css">
</head>
<body onload="updateScroll()">
	

	<div id="alertUpdt" onload="makeFade();" class="alert alert-success" role="alert">
		<span> <strong>Alerta:</strong> As mensagens foram atualizadas com sucesso</span>
	</div>

	<div id="container-master">
		<div id="container-menu">
			<h3>Menu</h3>
			<a href="inicioConsultor.php"><button class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> Voltar</button></a>
			<a href="logout.php"><button id="logout-button">SAIR</button></a>
		</div>
		<div id="container-chat">
			<div class="col-sm-11" id="chat-box" >
				<div id="control-div" >
					<?php 
						//Chama a função showTextOnScreen() para que o texto possa ser enviado e encapsulado em divs
						$chatClasse->showConsultorTextOnScreen($assinaturaId);
	    			?>
	    		</div>
			</div>
			<span class="col-xs-11">
				<form class="" class="" method="post" action="">
					<div class="col-sm-9">
						<input class="form-control" id="chat-send" type="text" name="sendText" onkeyup="countChar(this)" autocomplete="off">
					</div> 
					<div class="btn-group col-sm-3" role="group" aria-label="...">
						<button class="btn btn-primary col-sm-6" type="submit" name="submit" onclick="">Enviar</button>
						<button class="btn btn-basic col-sm-6" type="button" name="bt-updateTextBox" onclick="reloadDiv()">Atualizar</button>
					</div>
				</form>
				<?php 
					//Verifica se o botão foi clicado e envia oque está na caixa para a função insertText() que está em chatClasses.php
					if(isset($_POST['submit']) && isset($_POST['sendText'])) {
						$txt = $_POST['sendText'];
						$chatClasse->insertConsultorText($txt, $assinaturaId);
					}
					if(isset($_POST['submit']) && isset($_POST['sendText'])){
												
					}
				?>
			</span>
		</div>
	</div>

<script src="_js/chatJS.js"></script>

	<!-- glyphicon glyphicon-ok-circle -->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>