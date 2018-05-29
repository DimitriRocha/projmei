<?php 

include '../_class/conection.php';

$consultorId = $_POST['con_id'];
$assinaturaId = $_POST['ass_id'];

try{
	$stmt = $myPDO->prepare('UPDATE caso SET ass_end = now(), status = 1 WHERE ass_id = :ass_id');
	$stmt->bindparam(":ass_id", $assinaturaId);
	$stmt->execute();
}catch(Exception $e){
	print_r($e);
}
 ?>
