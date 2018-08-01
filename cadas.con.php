<?php include '_config/debug.php'; ?>
<?php
  require_once '_class/conexao.php';
  require_once '_ref/header.php';

  if($login->isloginadm()){
  }else{ header('adm.log.php');
  }

	if(isset($_POST['btn-enviar'])){

		$cname= $_POST['name'];
		$cpass= $_POST['pass'];
		$cmail= $_POST['mail'];
		$cvall= $_POST['vall'];
		$carea= $_POST['atua'];
		$caddr= $_POST['addr'];

    if(strlen($cmail) < 6){
      echo "É PRECISO MAIS DE 6 CARACTERES";
    }
    else{

      $pdo = $DB_con->prepare("SELECT con_name, con_mail FROM consultor WHERE con_name=:cname OR con_mail=:cmail");
      $pdo->execute(array(':cname'=>$cname, ':cmail'=>$cmail));
      $row=$pdo->fetch(PDO::FETCH_ASSOC);

      if($row['con_name']==$cname){
        echo "JÁ TEMOS ESSE CONSULTOR";
      }
      else if($row['con_mail']==$cmail){
        echo "EMAIL Já ULTILIZADO";
      }
      else if(isset($_POST['btn-enviar'])){
        $login->cadastrocon($cname,$cpass,$cmail,$carea,$caddr,$cvall);
      }
    }
  }
?>

<section id="cadastro_container">
 <div id="cadastro_master">
 	<h1>CADASTRE O CONSULTOR</h1>
 	<form method="post">

 		<input required type="text" name="name" placeholder="Login"><br>

    <input required type="email" name="mail" placeholder="Email"><br>

 		<input required type="password" name="pass" placeholder="Senha" ><br>

 		<input required type="number" name="vall" placeholder="Valor por msg"><br>

 		<input required="Qual sua área de atuação?" type="text" name="atua" placeholder="Área de atuação"><br>

 		<input required type="text" name="addr" placeholder="Enrereço"><br>

 		<button type="submit" name="btn-enviar" >Enviar</button>

 	</form>

 </div>
</section>

<?php
	require_once '_ref/footer.php';
?>
