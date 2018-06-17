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

		$stmt = $myPDO->prepare('SELECT * FROM caso WHERE user_id = :user_id ORDER BY ass_start DESC');
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
		
		foreach($casos as $caso){
			$assId = $caso['ass_id'];
			$stmt2 = $myPDO->prepare('SELECT * FROM msg WHERE ass_id = :ass_id ORDER BY hms DESC LIMIT 1');
			$stmt2->bindparam(":ass_id", $assId);
			$stmt2->execute();

			$msgs[$assId] = $stmt2->fetchAll(PDO::FETCH_ASSOC);
			$msgs[$assId] = $msgs[$assId][0];
		}

		// echo '<pre>';
		// print_r($msgs);
		// echo '</pre>';
		// die();
		return $msgs;
	}
}
