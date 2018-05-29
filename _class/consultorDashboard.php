<?php

class ConsultorDashboard{
	private $id;

	function __construct($id){
		$this->id = $id;
	}

	function casosAbertos(){
		include 'conection.php';

		$stmt = $myPDO->prepare('SELECT * FROM caso WHERE con_id IS NULL AND status = 0');
		$stmt->execute();
		$casos = $stmt->fetchAll(PDO::FETCH_ASSOC);

		//Busca o nome do usuário em cada caso que o consultor tenha
		foreach ($casos as $key => $caso) {
			$stmt2 = $myPDO->prepare('SELECT user_name FROM users WHERE user_id = :user_id');
			$stmt2->bindparam(":user_id", $caso['user_id']);
			$stmt2->execute();
			$casos[$key] = array_merge($caso, $stmt2->fetch(PDO::FETCH_ASSOC));
		}

		foreach ($casos as $key => $caso) {
			$stmt3 = $myPDO->prepare('SELECT ed_nome FROM area WHERE ed_id = :ed_id');
			$stmt3->bindparam(":ed_id", $caso['ed_id']);
			$stmt3->execute();
			$casos[$key] = array_merge($caso, $stmt3->fetch(PDO::FETCH_ASSOC));
		}

		foreach ($casos as $key => $caso) {
			$stmt4 = $myPDO->prepare('SELECT nome_status FROM caso_status WHERE id = :status_id');
			$stmt4->bindparam(":status_id", $caso['status']);
			$stmt4->execute();
			$casos[$key] = array_merge($caso, $stmt4->fetch(PDO::FETCH_ASSOC));
		}

		return $casos;
	}

	function meusCasos(){
		include 'conection.php';

		$stmt = $myPDO->prepare('SELECT * FROM caso WHERE con_id = :id ORDER BY status ASC');
		$stmt->bindparam(":id", $this->id);
		$stmt->execute();
		$casos = $stmt->fetchAll(PDO::FETCH_ASSOC);

		//Busca o nome do usuário em cada caso que o consultor tenha
		foreach ($casos as $key => $caso) {
			$stmt2 = $myPDO->prepare('SELECT user_name FROM users WHERE user_id = :user_id');
			$stmt2->bindparam(":user_id", $caso['user_id']);
			$stmt2->execute();
			$casos[$key] = array_merge($caso, $stmt2->fetch(PDO::FETCH_ASSOC));
		}

		foreach ($casos as $key => $caso) {
			$stmt3 = $myPDO->prepare('SELECT ed_nome FROM area WHERE ed_id = :ed_id');
			$stmt3->bindparam(":ed_id", $caso['ed_id']);
			$stmt3->execute();
			$casos[$key] = array_merge($caso, $stmt3->fetch(PDO::FETCH_ASSOC));
		}


		foreach ($casos as $key => $caso) {
			$stmt4 = $myPDO->prepare('SELECT nome_status FROM caso_status WHERE id = :status_id');
			$stmt4->bindparam(":status_id", $caso['status']);
			$stmt4->execute();
			$casos[$key] = array_merge($caso, $stmt4->fetch(PDO::FETCH_ASSOC));
		}

		return $casos;
	}

	public function mensagemConsultor(){
		include 'conection.php';
		try{
			$stmt = $myPDO->prepare('SELECT msg FROM mensagem_consultor WHERE con_id = :id');
			$stmt->bindparam(":id", $this->id);
			$stmt->execute();
			$msg = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if($msg[0]['msg'] != "" && $msg[0]['msg'] != NULL){
				return $msg[0]['msg'];
			}else{
				return 'Ainda não há mensagens para você';
			}
		}catch(Exception $e){
			print_r($e);
		}

	}
}
