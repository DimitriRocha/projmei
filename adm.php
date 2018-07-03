<?php include '_config/debug.php'; ?>
<?php 
	require_once '_class/conexao.php';

	include '_class/consultas.php';

	$cons = new Consultas($DB_con);

	// TESTEANDO A EXISTENCIA - LOGOUT
	if($login->isloginadm()){
	}else{ header('location: adm.log.php');}

	if(isset($_POST['bt-logout'])){
		$login->logoutadm();
		header('location: adm.log.php');
	}

	if(isset($_POST['check'])){
		echo $_POST['check'];
	}

	if(isset($_POST['bt-cadas'])){
		header('location: cadas.con.php');
	}
?>

	<h3><?php echo 'BEM-VINDO AO SISTEMA'; ?></h3>


	<form method="post">
		<button type="submit" name="bt-cadas">CADASTRAR CONSULTOR</button><br>
		<button type="submit" name="bt-logout">LOGOUT</button><br>
		<a href="adm.con.php">Rendimento dos Consultores</a>
	</form>


	<h3>FISCAL</h3>
	<h4>TEMOS <?php  ?>CONSULTORES NESSA ÁREA E <?php  ?>CLIENTES</h4><br>

	<h3>ADM</h3>
	<h4>TEMOS <?php  ?>CONSULTORES NESSA ÁREA E <?php  ?>CLIENTES</h4><br>

	<h3>RH</h3>
	<h4>TEMOS <?php  ?>CONSULTORES NESSA ÁREA E <?php  ?>CLIENTES</h4><br>

	<h3>JURIDICO</h3>
	<h4>TEMOS <?php  ?>CONSULTORES NESSA ÁREA E <?php  ?>CLIENTES</h4><br>

	<h3>MARKETING</h3>
	<h4>TEMOS <?php  ?>CONSULTORES NESSA ÁREA E <?php  ?>CLIENTES</h4><br>

	<h3>FINCANCEIRO</h3>
	<h4>TEMOS <?php  ?>CONSULTORES NESSA ÁREA E <?php  ?>CLIENTES</h4><br>

	<h3>Número de consultores cadastrados no sistema</h3>
	<h4><?php echo $cons->qtdConsultants() ?></h4><br>

	<h3>Número de clientes cadastrados no sistema</h3>
	<h4><?php echo $cons->qtdClientes() ?></h4><br>

	<h3>Número de Mensagens já enviadas</h3>
	<h4><?php echo $cons->qtdMensagensT() ?></h4><br>

	<h3>Número de Respostas já enviadas</h3>
	<h4><?php echo $cons->qtdRespostasT() ?></h4><br>

	<h3>Número de casos abertos</h3>
	<h4><?php echo $cons->qtdCases() ?></h4><br>

	<h3>Número de casos fechados</h3>
	<h4><?php echo $cons->qtdClosedCases() ?></h4><br>

<?php 
	require_once '_ref/footer.php';
?>