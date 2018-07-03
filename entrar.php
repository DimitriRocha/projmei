<?php include '_config/debug.php'; ?>
<?php 
	require_once '_class/conexao.php';
	if(isset($_POST['bt_enviar'])){
		$ulog  = $_POST['login'];
		$upass = $_POST['pass'];

		if($login->login($ulog, $upass)){ 
		?>
			<script>document.location.href='inicioUser.php'</script>
		<?php
		}

		else{
		?>
			<script type="text/javascript">alert('A senha ou usuário estão incorretos, tente novamente!');</script>
		<?php
		}
	}

	require_once '_ref/header.php';
 ?>

<section class="col-xs-12" id="entrar_container">
 <div class="col-xs-11 col-md-6" id="login_master">
 	<h1>ENTRAR</h1>
 	<form method="post" action="">

 		<input required="Ponha seu email" type="text" name="login" placeholder="Login"><br>

 		<input required="Ponha sua senha" type="password" name="pass" placeholder="Senha"><br>
 		
 		<a href="recover"><p>Esqueceu a senha</p></a>
 		 		
 		<button type="submit" name="bt_enviar">Enviar</button>

 		<a href="cadastro"><p>Não é cadastrado? CADASTRE-SE AQUI</p></a>
 		<a href="entrarConsultor"><p>É um consultor? Entre aqui</p></a>
 	</form>
 </div>
</section>

<?php 
	require_once '_ref/footer.php';
?>
