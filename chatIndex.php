<?php
	include('_class/conexao.php');
	include('_class/chatClasses.php');

	$chatClasse = new ChatClass;

	if (!$login->islogin()) { //Caso o usuário não esteja logado
	 	header('Location: entrar.php'); //Redireciona ele para a pagina de login
	}

	if(!isset($_SESSION['casoCheck'])){
		$_SESSION['casoCheck'] = '';
	}else if(isset($_POST['check'])){
		$_SESSION['casoCheck'] = $_POST['check'];

	}
	$_SESSION['userAssId'] = null;
	$_SESSION['hasOpenCase'] = false;

	$fiscal = "";
	$adm = "";
	$rh = "";
	$juridico = "";
	$marketing = "";
	$financeiro = "";

	switch ($_SESSION['casoCheck']) {
		case '1':
			$fiscal = 'checked';
			$adm = '';
			$rh = '';
			$juridico = '';
			$marketing = '';
			$financeiro = '';
			break;

		case '2':
			$fiscal = '';
			$adm = 'checked';
			$rh = '';
			$juridico = '';
			$marketing = '';
			$financeiro = '';
			break;

		case '3':
			$fiscal = '';
			$adm = '';
			$rh = 'checked';
			$juridico = '';
			$marketing = '';
			$financeiro = '';
			break;

		case '4':
			$fiscal = '';
			$adm = '';
			$rh = '';
			$juridico = 'checked';
			$marketing = '';
			$financeiro = '';
			break;

		case '5':
			$fiscal = '';
			$adm = '';
			$rh = '';
			$juridico = '';
			$marketing = 'checked';
			$financeiro = '';
			break;

		case '6':
			$fiscal = '';
			$adm = '';
			$rh = '';
			$juridico = '';
			$marketing = '';
			$financeiro = 'checked';
			break;

		default:
			// code...
			break;
	}
	$_SESSION['userAssId'] = $chatClasse->buscarAssId($_SESSION['user'] , $_SESSION['casoCheck']);
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
</head>
<body onload="updateScroll()">
	<div id="alertUpdt" onload="makeFade();" class="alert alert-success" role="alert">
		<span> <strong>Alerta:</strong> As mensagens foram atualizadas com sucesso</span>
	</div>

	<div id="container-master">
		<div id="container-menu">
			<h3>Menu</h3>
			<form method="post">
				<div class="radio">
					<label><input <?php echo($fiscal) ?> type="radio" name="check" value="1" selected="<?php $selectFiscal ?>">Fiscal</label>
				</div>
				<div class="radio">
					<label><input <?php echo($adm) ?> type="radio" name="check" value="2" selected="<?php $selectAdm ?>">ADM</label>
				</div>
				<div class="radio">
					<label><input <?php echo($rh) ?> type="radio" name="check" value="3" selected="<?php $selectRh ?>">RH</label>
				</div>
				<div class="radio">
					<label><input <?php echo($juridico) ?> type="radio" name="check" value="4" selected="<?php $selectJur ?>">Juridico</label>
				</div>
				<div class="radio">
					<label><input <?php echo($marketing) ?> type="radio" name="check" value="5" selected="<?php $selectMark ?>">Marketing</label>
				</div>
				<div class="radio disabled">
					<label><input <?php echo($financeiro) ?> type="radio" name="check" value="6" disabled>Financeiro</label>
				</div>
				<button class="btn btn-primary" type="submit" name="bt-abrir" onclick="">Abrir Um Caso</button><br><br>
				<a href="perfil.php" class="btn btn-primary">Perfil</a>
			</form>

			<?php

				if(isset($_POST['bt-abrir']) && isset($_POST['check'])) {
					$_SESSION['casoCheck'] = $_POST['check'];
					//Busca o id da assinatura que será usado pra o resto
					$_SESSION['userAssId'] = $chatClasse->buscarAssId($_SESSION['user'] , $_SESSION['casoCheck']);

					if(!isset($_SESSION['userAssId'])){
						$chatClasse->abrirCaso($_SESSION['casoCheck']);
					}

				}
			?>

			<a href="logout.php"><button id="logout-button">SAIR</button></a>
		</div>

		<div id="container-chat">
			<div class="col-sm-11" id="chat-box" >
				<div id="control-div" >
					<?php
						//Chama a função showTextOnScreen() para que o texto possa ser enviado e encapsulado em divs
						if(isset($_SESSION['userAssId'])&& $_SESSION['userAssId'] != null){
							$chatClasse->showTextOnScreen($_SESSION['user'], $_SESSION['userAssId']);
						}else if(isset($_SESSION['casoCheck']) && $_SESSION['casoCheck'] != NULL){
							echo "<h2>O caso foi aberto<h2><br>";
							echo "<h4>Clique em atualizar para que as mensagens fiquem disponiveis</h4>";
							if($chatClasse->buscarAssId($_SESSION['user'] , $_SESSION['casoCheck']) == null && $_SESSION['casoCheck'] != NULL){
								$chatClasse->criarAssId($_SESSION['user'] , $_SESSION['casoCheck']);
							}
						}else{
							echo "<h2>Abra um caso para continuar<h2>";
						}
	    			?>
	    		</div>
			</div>
			<span class="col-xs-11">
				<form class="" class="" method="post" action="">
					<div class="col-sm-9">
						<input class="form-control" id="chat-send" type="hidden" name="assId" value="<?php echo  $_SESSION['userAssId']; ?>">
						<input class="form-control" id="chat-send" type="text" name="sendText" onkeyup="countChar(this)">
					</div>
					<div class="btn-group col-sm-3" role="group" aria-label="...">
						<button class="btn btn-primary col-sm-6" type="submit" name="submit" value="send" onclick="">Enviar</button>
						<button class="btn btn-basic col-sm-6" type="button" name="bt-updateTextBox" onclick="reloadDiv()">Atualizar</button>
					</div>
				</form>
				<?php
					//echo $_SESSION['userAssId'];
					//Verifica se o botão foi clicado e envia oque está na caixa para a função insertText() que está em chatClasses.php
					$userAssId = $_SESSION['userAssId'];
					if(isset($_POST['submit']) && isset($_POST['sendText'])) {
						$txt = $_POST['sendText'];
						$chatClasse->insertText($txt, $_POST['assId']);
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
