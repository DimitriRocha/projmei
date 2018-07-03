<?php include '_config/debug.php'; ?>
<?php 
	require_once '_class/conexao.php';

	if(isset($_POST['bt_enviar'])){

		$ulog  = $_POST['login'];
		$upass = $_POST['pass'];

		if($login->logincon($ulog, $upass)){
			header('location: inicioConsultor');
		}
		else{
			echo("<script type='text/javascript'>alert('A senha ou usuário estão incorretos, tente novamente!')</script>");
		}
	}

	require_once '_ref/header.php';
 ?>

<section class="col-xs-12" id="entrar_container">
 <div class="col-xs-11 col-md-6" id="login_master">
 	<h1>CONSULTOR</h1>
 	<form method="post" action="">

 		<input required="Ponha seu email" type="text" name="login" placeholder="Login"><br>

 		<input required="Ponha sua senha" type="password" name="pass" placeholder="Senha"><br>
 		
 		<a href="recover"><p>Esqueceu a senha</p></a>
 		 		
 		<button type="submit" name="bt_enviar">Enviar</button>

 		<a href="cadas.con"><p>Não é cadastrado? CADASTRE-SE AQUI</p></a>
 	</form>
 </div>
</section>

<?php 
	require_once '_ref/footer.php';
?>
