<?php 
	//require_once '_ref/header.php';
	require_once '_class/conexao.php';

	if($login->islogin()){
        header('location: chatIndex');
    }

    echo '<pre>';
    echo password_hash('123456', PASSWORD_DEFAULT);
    echo '</pre>';

	if(isset($_POST['btn-enviar'])){
    
		$uname= $_POST['name'];
		$upass= $_POST['pass'];
		$umail= $_POST['mail'];
		$ucnpj= $_POST['cnpj'];
		$uprof= $_POST['prof'];
		$uaddr= $_POST['addr'];

    if(strlen($upass) < 6){
      echo "É preciso de mais de 6 caracteres";
    }
    else if($login->validar_cnpj($ucnpj)) {
      echo "O cnpj está fora dos padrões";
    }
    else{
        $pdo = $DB_con->prepare("SELECT user_name,user_email,user_cnpj FROM users WHERE user_name=:uname OR user_email=:umail OR user_cnpj=:ucnpj");
        $pdo->execute(array(':uname'=>$uname, ':umail'=>$umail, ':ucnpj'=>$ucnpj ));
        $row=$pdo->fetch(PDO::FETCH_ASSOC);
      
        if($row['user_name']==$uname) {
          echo "ISH, JÁ TEMOS ESSE USUÁRIO";
        }
        else if($row['user_email']==$umail) {
          echo "PODE PARAR, EMAIL REPITIDO";
        }
        else if($row['user_cnpj']==$ucnpj) {
          echo "QUAL FOI? ESSA EMPRESA TA PINDURADA JÁ";
        }
        else if(isset($_POST['btn-enviar'])){
          $login->cadastro($uname, $upass, $umail, $ucnpj, $uprof, $uaddr);
        }
    }
  }
 ?>

<section class="col-xs-12" id="cadastro_container">
 <div class="" id="cadastro_master">
 	<h1>CADASTRAR-SE</h1>
 	<form method="post" action="">

 		<input required type="text" name="name" placeholder="Login"><br>

 		<input required type="password" name="pass" placeholder="Senha" ><br>
 		
 		<input required type="email" name="mail" placeholder="Email"><br>
 		
 		<input required type="text" name="cnpj" placeholder="Digite seu CNPJ"><br>
 		
 		<input required="Qual sua área de atuação?" type="text" name="prof" placeholder="Profissão"><br>
 		
 		<input required type="text" name="addr" placeholder="Enrereço"><br><br>

    <select name="uf">
    <option value="">Select...</option>
    <option value="AC">AC</option><option value="AM">Al</option><option value="AL">AP</option><option value="AP">AM</option>
    <option value="BA">BA</option>
    <option value="CE">CE</option>
    <option value="DF">DF</option>
    <option value="ES">ES</option>
    <option value="GO">GO</option>
    <option value="MA">MA</option><option value="MG">MT</option><option value="MT">MS</option><option value="MS">MG</option>
    <option value="PB">PR</option><option value="PE">PB</option><option value="PI">PA</option><option value="PR">PE</option><option value="PR">PI</option>
    <option value="RJ">RJ</option><option value="RL">RN</option><option value="RR">RS</option><option value="PR">RO</option><option value="PR">RR</option>
    <option value="SC">SC</option><option value="SE">SE</option><option value="PR">SP</option>
    <option value="TO">TO</option>
    </select><br>

 	<button type="submit" name="btn-enviar" >Enviar</button>

 	</form>
 </div>
</section>

<?php 
	require_once '_ref/footer.php';
?>
