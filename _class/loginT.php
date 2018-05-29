<?php

 class LoginT{

 	private $db;
	function __construct($DB_con)
	{
  		$this->db = $DB_con;
	}


/*           **********************************************************************************
*                               CÓDIGOS            DOS           CLIENTES
*            **********************************************************************************
*/

/**
 * LOGAR O USUÁRIO
 */
  public function login($ulog,$upass)
  {
    try
    {
      $stmt = $this->db->prepare("SELECT * FROM users WHERE user_name=:uname OR user_email=:umail LIMIT 1");
      $stmt->execute(array(':uname'=>$ulog, ':umail'=>$ulog));
      $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

      if($stmt->rowCount() > 0)
      {
        if(password_verify($upass, $userRow['user_pass']))
        {
          $_SESSION['user'] = $userRow['user_id'];
          $_SESSION['userName'] = $userRow['user_name'];
          return true;
        }
        else{
          return false;
        }
      }
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
  }

/*
* VERIFICAR SE O USUÁRIO ESTÁ LOGADO
*/
public function islogin(){
	if(isset($_SESSION['user']) != ""){
		return true;
	}
	else{
		return false;
	}
}

/*
* FAZER LOGOUT
*/
	public function logout(){

    session_register_shutdown();
    session_unset();
    unset($_SESSION['user']);
    unset($_SESSION['case']);
    header('location: entrar.php');
  }

/*
* CADASTRAR USUÁRIOS
*/
  public function cadastro($uname,$upass,$umail,$ucnpj,$uprof,$uaddr){
    try{
      $new_password = password_hash($upass, PASSWORD_DEFAULT);

      $pdo = $this->db->prepare("INSERT INTO users(user_date,user_name,user_cnpj,user_profissao,user_endereco,user_email,user_pass)VALUES(:udate,:uname, :ucnpj, :uprof, :uaddr, :umail, :upass)");

      $pdo->bindparam(":udate", date('y-m-d'));
      $pdo->bindparam(":uname", $uname);
      $pdo->bindparam(":ucnpj", $ucnpj);
      $pdo->bindparam(":uprof", $uprof);
      $pdo->bindparam(":uaddr", $uaddr);
      $pdo->bindparam(":umail", $umail);
      $pdo->bindparam(":upass", $new_password);            
      $pdo->execute();

      header('location:valores.contratar.php');
    }
    catch(PDOException $e){
      echo $e->getMessage();
    }
  }


/*
* TESTAR O CNPJ
*/
  public function validar_cnpj($cnpj)
  {
    $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
    // Lista de CNPJs inválidos
    $invalidos = [
      '00000000000000',
      '11111111111111',
      '22222222222222',
      '33333333333333',
      '44444444444444',
      '55555555555555',
      '66666666666666',
      '77777777777777',
      '88888888888888',
      '99999999999999'
    ];

    // Verifica se o CNPJ está na lista de inválidos
    if (in_array($cnpj, $invalidos)) {  
      return false;
    }
    // Valida tamanho
    if (strlen($cnpj) != 14){
      return false;
    }
  }

/*
*   INFO USUÁRIOS
*/
  public function user(){

    $stmt= $this->db->prepare("SELECT * FROM users WHERE user_id=:uid LIMIT 1");
    $stmt->execute(array(':uid'=>$_SESSION['user']));
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

    return $userRow['user_name'];
  }

public function userCnpj(){

    $stmt= $this->db->prepare("SELECT * FROM users WHERE user_id=:uid LIMIT 1");
    $stmt->execute(array(':uid'=>$_SESSION['user']));
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

    return $userRow['user_cnpj'];
}


/*
*   MUDAR A SENHA
*/
  public function newpass($npass){

    try{
      $stmt= $this->db->preapre("UPDATE users SET user_pass=:npass WHERE user_id=:uid LIMIT 1");
      $stmt->execute(array(':uid'=>$_SESSION['user']));

      $pdo->bindparam(":npass", $npass);            
      $pdo->execute(); 

    }
    catch(PDOException $e){
      echo $e->getMessage();
    }
  }


/**
 * ALTERAR ÁREAS DE CONTRATO
 */



/*           **********************************************************************************
*                               CÓDIGOS            DOS           CONSULTORES
*            **********************************************************************************
*/

/**
 * LOGAR
 */
  public function logincon($clog,$cpass){
    try
    {
      $stmt = $this->db->prepare("SELECT * FROM consultor WHERE con_name=:cname OR con_mail=:cmail LIMIT 1");
      $stmt->execute(array(':cname'=>$clog, ':cmail'=>$clog));
      $conRow=$stmt->fetch(PDO::FETCH_ASSOC);

      if($stmt->rowCount() > 0){

        if(password_verify($cpass, $conRow['con_pass'])){
          $_SESSION['consultor'] = $conRow['con_id'];
          $_SESSION['consultorNome'] = $conRow['con_name'];
          return true;
        }
        else{
          return false;
        }
      }
    }
    catch(PDOException $e){
      echo $e->getMessage();
    }
  }

/*
* CADASTRAR
*/
  public function cadastrocon($cname,$cpass,$cmail,$carea,$caddr,$cvall){
    try{
      $new_password = password_hash($cpass, PASSWORD_DEFAULT);

      $pdo = $this->db->prepare("INSERT INTO consultor(con_name, con_mail, con_pass, con_addr, con_atua, con_vm)VALUES(:cname, :cmail, :cpass, :caddr, :carea, :cvall)");

      $pdo->bindparam(":cname", $cname);
      $pdo->bindparam(":carea", $carea);
      $pdo->bindparam(":caddr", $caddr);
      $pdo->bindparam(":cvall", $cvall);
      $pdo->bindparam(":cmail", $cmail);
      $pdo->bindparam(":cpass", $new_password);            
      $pdo->execute();

      echo 'CONSULTOR FOI CADASTRADO';
      header('adm.php');
    }
    catch(PDOException $e){
      echo $e->getMessage();
    }
  }

/*
* FAZER LOGOUT
*/
  public function logoutcon(){

    session_register_shutdown();
    session_unset();
    unset($_SESSION['consultor']);
    unset($_SESSION['ccase']);
    header('location: adm.log.php');
  }

/*
* VERIFICAR SE ESTÁ LOGADO
*/
  public function islogincon(){
    
    if(isset($_SESSION['consultor']) != ""){
      return true;
    }
    else{
      return false;
    }
  }

/*
*   INFO
*/
  public function consul(){

    $stmt= $this->db->prepare("SELECT * FROM consultor WHERE con_id=:cid LIMIT 1");
    $stmt->execute(array(':cid'=>$_SESSION['consultor']));
    $conRow=$stmt->fetch(PDO::FETCH_ASSOC);

    return $conRow;
  }

/*
*   INFO
*/
  public function area($area){

    $stmt= $this->db->prepare("SELECT * FROM area WHERE ed_id=:aid LIMIT 1");
    $stmt->execute(array(':aid'=>$area));
    $areaRow=$stmt->fetch(PDO::FETCH_ASSOC);
    return $areaRow['ed_nome'];
  }
 


/*           **********************************************************************************
*                               CÓDIGOS            DOS           ADMINISTRADORES
*            **********************************************************************************
*/

   public function loginadm($alog,$apass){
    try
    {
      $stmt = $this->db->prepare("SELECT * FROM adm WHERE adm_name=:aname OR adm_mail=:amail LIMIT 1");
      $stmt->execute(array(':aname'=>$alog, ':amail'=>$alog));
      $admRown=$stmt->fetch(PDO::FETCH_ASSOC);

      if($stmt->rowCount() > 0){

        if(password_verify($apass, $admRown['adm_pass'])){
          $_SESSION['adm'] = $admRown['adm_id'];
          return true;
        }
        else{
          return false;
        }
      }
    }
    catch(PDOException $e){
      echo $e->getMessage();
    }
  }

  public function isloginadm(){
    
    if(isset($_SESSION['adm']) != ""){
      return true;
    }
    else{
      return false;
    }
  }

  public function logoutadm(){

    session_register_shutdown();
    session_unset();
    unset($_SESSION['adm']);
    header('location: adm.log.php');
  }

}
?>