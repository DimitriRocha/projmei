<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
class UserDashboard{
	private $id;

	const areas = [1 => 'Fiscal', 'Administrativo', 'Recursos Humanos', 'Jurídico', 'Marketing', 'Financeiro'];

	function __construct($id){
		$this->id = $id;
	}

	function getCasosAbertos(){
		include 'conection.php';

		$stmt = $myPDO->prepare('SELECT * FROM caso WHERE user_id = :user_id');
		$stmt->bindparam(":user_id", $this->id);
		$stmt->execute();
		$casos = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $casos;
	}

	function getLastMessage(){
		include 'conection.php';

		$stmt = $myPDO->prepare('SELECT ass_id FROM caso WHERE user_id = :user_id');
		$stmt->bindparam(":user_id", $this->id);
		$stmt->execute();

		$casos = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$stmt2 = $myPDO->prepare('SELECT * FROM caso WHERE user_id = :user_id');
		$stmt2->bindparam(":user_id", $this->id);
		$stmt2->execute();

		
		var_dump($casos);
		die();
	}
}
