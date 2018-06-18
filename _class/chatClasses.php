<?php

	class ChatClass
	{


		function __construct()
		{

		}

		function getMessages($user , $assId)
		{
			include('conection.php');

			$sth = 	$myPDO->prepare("SELECT * FROM
										(SELECT msg_txt,tipo,hms FROM msg WHERE ass_id = (:assId) ORDER BY hms DESC) AS a
									UNION
									SELECT * FROM
										(SELECT res_txt,tipo,hms FROM resposta WHERE ass_id = (:assId) ORDER BY hms DESC) AS b
								    ORDER BY hms
									");
			$sth->bindparam(":assId", $assId);

			$sth->execute();

			$result = $sth->fetchAll(PDO::FETCH_ASSOC);

			return $result;
		}

		function insertText($txt, $case)
		{
			include('conection.php');
			try{
				$var = $myPDO->prepare('INSERT INTO msg(ass_id, msg_txt, hms) VALUES (:caso , :mtxt , now())');

				$var->bindparam(":caso", $case);
	    		$var->bindparam(":mtxt", $txt);

				$var->execute();
				echo '<script>document.location.href="chatIndex.php"</script>';
			}catch(Exception $e){
				echo $e->getMessage();
			}
		}

		function abrirCaso($area)
		{
			include('conection.php');

			try{
				$stmt= $myPDO->prepare('INSERT INTO caso(user_id, ed_id, ass_start) VALUES (:uid, :area,:start)');

				$date=date('y-m-d');
				$stmt->bindparam(":uid", $_SESSION['user']);
				$stmt->bindparam(":area", $area);
				$stmt->bindparam(":start", $date);
	      		$stmt->execute();


			}
			catch(PDOException $e){
	      		echo $e->getMessage();
	      		echo 'CONSULTE A ASSISTÊNCIA';
	    	}
		}

		function insertConsultorText($txt, $case)
		{
			include('conection.php');

			$var = $myPDO->prepare('INSERT INTO resposta(ass_id, res_txt, hms) VALUES (:caso,:rtxt,now())');

			$var->bindparam(":caso", $case);
      		$var->bindparam(":rtxt", $txt);

			$var->execute();

			$locationString = "Location: ../chatConsultor.php"."?id=".$case;
			//header($locationString); ?addurl='.$locationString.'
			echo '<script>window.location.href="_class/removeDuplicates.php?addurl='.$locationString.'"</script>';
		}

		function fecharCaso($case)
		{
			include('conection.php');

			$stmt = $myPDO->prepare('UPDATE caso SET ass_end = now(), status = 1 WHERE ass_id = :ass_id');
			$stmt->bindparam(":ass_id", $case);
			$var->execute();
		}

		public function buscarAssId($userId , $area){
			include('conection.php');

			$stmt = $myPDO->prepare('SELECT * FROM `caso` WHERE user_id = (:user_id) AND ed_id = (:ed_id)');
			$stmt->bindparam(":user_id", $userId);
			$stmt->bindparam(":ed_id", $area);
			$stmt->execute();

			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result['ass_id'];
		}

		public function criarAssId($userId , $area){
			try{
				include('conection.php');
				$stmt = $myPDO->prepare('INSERT INTO caso (user_id, ed_id, ass_start) VALUES (:user_id, :ed_id, now())');
				$stmt->bindparam(":user_id", $userId);
				$stmt->bindparam(":ed_id", $area);
				$stmt->execute();

			}catch(Exception $err){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		}

		public function casoAberto($caso){
				include('conection.php');
				$stmt = $myPDO->prepare('SELECT status FROM caso WHERE ass_id = :ass_id');
				$stmt->bindparam(":ass_id", $caso);
				$stmt->execute();

				$casoStatus = $stmt->fetch(PDO::FETCH_ASSOC);
				if($casoStatus['status'] == 0){
					return true;
				}else {
					return false;
				}
		}

		public function validateUserByAssId($user, $assId){
			include('conection.php');
			$stmt = $myPDO->prepare('SELECT * FROM caso WHERE ass_id = :assId');
			$stmt->bindparam('assId', $assId);
			$stmt->execute();

			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			if($result['user_id'] == $user){
				return true;
			}else {
				return false;
			}
		}

	}




 ?>
