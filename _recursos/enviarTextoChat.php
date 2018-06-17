<?php

// $temp = $_POST['Imgname'];
// echo $temp;

$tipo = $_GET['tipo'];
$ass_id = $_GET['ass_id'];
$txt = $_GET['texto'];

if($tipo == 0){
    include('../_class/conection.php');
    try{
        $var = $myPDO->prepare('INSERT INTO msg(ass_id, msg_txt, hms) VALUES (:caso , :mtxt , now())');

        $var->bindparam(":caso", $ass_id);
        $var->bindparam(":mtxt", $txt);

        $var->execute();
    }catch(Exception $e){
        echo $e->getMessage();
    }
}

        
?>