<?php include '_config/debug.php'; ?>
<?php
	include('_class/conexao.php');
	include('_class/chatClasses.php');

	$chatClasse = new ChatClass;

	if (!$login->islogin()) { //Caso o usuário não esteja logado
	 	header('Location: entrar.php'); //Redireciona ele para a pagina de login
	}

	$_SESSION['userAssId'] = intval($_GET['id']);
	$msgs = $chatClasse->getMessages($_SESSION['user'], $_SESSION['userAssId']);

	if(!$chatClasse->validateUserByAssId($_SESSION['user'], $_SESSION['userAssId'])){
		header('Location: userDashboard');
	}
	echo '<script>var tipo = 0</script>';
?>

<!DOCTYPE html>
<html>
<head>
	<!-- FAVICONS -->
	<link rel="apple-touch-icon" sizes="144x144" href="favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicons/favicon-16x16.png">
	<link rel="manifest" href="favicons/manifest.json">
	<link rel="mask-icon" href="favicons/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="theme-color" content="#000000">
	<!-- FIM DOS FAVICONS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="_js/jquery-3.2.1.js"></script>
	<meta charset="utf-8">
	<title>Chat | Consultoria MEI</title>
	<link rel="stylesheet" type="text/css" href="_css/chatStyle.css">
	<script src="_js/chatJS.js"></script>
</head>
<body onload="updateScroll()">
	<div id="alertUpdt" onload="makeFade();" class="alert alert-success" role="alert">
		<span> <strong>Alerta:</strong> As mensagens foram atualizadas com sucesso</span>
	</div>

	<div id="container-master">
		<div id="container-menu">
			<h3>Menu</h3>
			<a href="inicioUser"><button id="logout-button">VOLTAR</button></a>
		</div>

		<form id="mensagens" action="">
			<div id="container-chat">
				<div class="col-sm-11" id="chat-box" >
					<div id="control-div" >
						<?php foreach($msgs as $key => $msg): ?>
							<div class="msg <?php echo $msg['tipo'] == 0 ? "cliente" : "consultor" ?>">
								<?php echo $msg['msg_txt'] ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<span class="col-xs-11">
					<div class="col-sm-9">
						<input id="msgAssId" class="form-control" type="hidden" name="assId" value="<?php echo  $_SESSION['userAssId']; ?>">
						<input id="textInput" class="form-control" type="text" name="sendText" autocomplete="off" onkeyup="countChar(this)">
					</div>
					<div class="btn-group col-sm-3" role="group" aria-label="...">
						<button id="submitTxtBtn" class="btn btn-primary col-sm-6" type="submit" name="submit" value="">Enviar</button>
						<button class="btn btn-basic col-sm-6" type="button" name="bt-updateTextBox" onclick="reloadDiv()">Atualizar</button>
					</div>
				</span>
			</div>
		</form>
	</div>


	<!-- glyphicon glyphicon-ok-circle -->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>
