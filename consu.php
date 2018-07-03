<?php include '_config/debug.php'; ?>
<?php 
	require_once '_class/conexao.php';
	//require_once '_ref/header.php';
	
	include ('_class/ps.php');

	$ps = new Posave($DB_con);

	// TESTEANDO A EXISTENCIA - LOGOUT
	if($login->islogincon()){
	}else{ header('location: adm.log.php');}

	if(isset($_POST['bt-logout'])){
		$login->logoutcon();
		header('location: adm.log.php');
	}
	$conRow= $login->consul();
	$area=$login->area($conRow['con_atua']);
	echo $area,"<br>"; 

	if(isset($_POST['check'])){
		echo $_POST['check'];
	}

	if(isset($_POST['bt-sol'])){
		$ps->pegarcaso($conRow['con_atua']);
	}

	if(isset($_POST['bt-enviar']) && isset($_SESSION['ccaso'])){
		$rtxt= $_POST['resp'];
 		if(strlen($rtxt) < 144){
 			$ps->cinserir($rtxt);
 		}else{
 			echo 'Texto muito grande';
 		}
	}

	echo $casoRow['ass_id'];

	if(isset($_POST['bt-close'])){
		$ps->fecharcaso($casoRow);
	}
?>
	<h3><?php echo 'BEM-VINDO AO SISTEMA ',$conRow['con_name']; ?></h3>

	<form method="post">
		<?php if(!$ps->ccasoha()){?>
		<br><button type="submit" name="bt-sol">solicitar novo</button><?php }else{?>
		<br><button type="submit" name="bt-abrir">ABRA UM CASO</button><?php } ?>
		<br><button type="submit" name="bt-close">FECHAR CASO</button> 
	</form>

	<div ><?php
		if(isset($_SESSION['ccaso'])){

			$stmt= $DB_con->prepare("SELECT msg_txt FROM msg WHERE ass_id=:caso");
			$stmt->execute(array(':caso'=>$_SESSION['ccaso']));

			$pdo= $DB_con->prepare("SELECT res_txt FROM resposta WHERE ass_id=:caso");
			$pdo->execute(array(':caso'=>$_SESSION['ccaso']));

			foreach ($stmt as $row){
				print $row['msg_txt'] ."<br>";
			}
			foreach ($pdo as $rowc){
				print $rowc['res_txt'] ."<br>";
			}
		}
	?></div>

	<form method="post" action="">
		<input required type="text" name="resp" placeholder="Envie sua mensagem"><br>
		
		<button type="submit" name="bt-enviar">ENVIAR</button>
 	</form>

	<form method="post">
		<button type="submit" name="bt-logout">LOGOUT</button>
	</form>

	<a href="index.php"><p>QUER VOLTAR PARA O SITE?</p></a>

<?php 
	require_once '_ref/footer.php';
?>