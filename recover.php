<?php include '_config/debug.php'; ?>
<?php
  require_once '_class/conexao.php';
  require_once '_ref/header.php';

if(isset($_POST['btn-enviar'])){
  //1 – Definimos Para quem vai ser enviado o email
  $para = $_POST['mail'];
  //2 - resgatar o nome digitado no formulário e  grava na variavel $nome
  $nome = $_POST['name'];
  // 3 - resgatar o assunto digitado no formulário e  grava na variavel //$assunto
  $assunto = "Recuperando a senha";
   //4 – Agora definimos a  mensagem que vai ser enviado no e-mail
  $mensagem = "<strong>Nome: </strong>".$nome;
  $mensagem .= "<br>  <strong>Mensagem: </strong>".$_POST['mensagem'];
  //5 – agora inserimos as codificações corretas e  tudo mais.

  $headers =  "Content-Type:text/html; charset=UTF-8\n";
  $headers .= "From:  localhost <no-replay@mei.com.br>\n";
  //Vai ser mostrado que  o email partiu deste email e seguido do nom
  $headers .= "localhost-Sender: <no-replay@mei.com.br>\n"; //email do servidor //que enviou
  $headers .= "X-Mailer: PHP  v".phpversion()."\n";
  $headers .= "X-IP:  ".$_SERVER['REMOTE_ADDR']."\n";
  $headers .= "Return-Path: <gustavo.santos@praxisjr.com.br>\n"; //caso a msg //seja respondida vai para  este email.
  $headers .= "MIME-Version: 1.0\n";

  mail($para, $assunto, $mensagem, $headers);  //função que faz envio ao email
}
?>

<section id="cadastro_container">
 <div id="cadastro_master">
  <h1>Teste email</h1>

  <form method="post" action="">

    <input required type="text" name="name" placeholder="nome"><br>
    
    <input required type="email" name="mail" placeholder="Email"><br>

    <input type="text" name="mensagem" placeholder="Mensagem de teste"><br>

    <button type="submit" name="btn-enviar" >Enviar</button>
  </form>
 </div>
</section>

<?php 
  require_once '_ref/footer.php';
?>