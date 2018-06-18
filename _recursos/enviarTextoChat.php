<?php
include('../_class/conection.php');

$tipo = $_GET['tipo'];
$ass_id = $_GET['ass_id'];
$txt = $_GET['texto'];

if($tipo == 0){
    try{
        $var = $myPDO->prepare('INSERT INTO msg(ass_id, msg_txt, hms) VALUES (:caso , :mtxt , now())');

        $var->bindparam(":caso", $ass_id);
        $var->bindparam(":mtxt", $txt);

        $var->execute();
    }catch(Exception $e){
        echo $e->getMessage();
    }
}else if($tipo = 1){
    try{
        $var = $myPDO->prepare('INSERT INTO resposta(ass_id, res_txt, hms) VALUES (:caso,:rtxt,now())');

        $var->bindparam(":caso", $ass_id);
        $var->bindparam(":rtxt", $txt);

        $var->execute();
    }catch(Exception $e){
        echo $e->getMessage();
    }
    
}

        
?>