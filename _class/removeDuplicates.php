<?php 
	$aditionalUrl = $_GET['addurl'];	

	if($aditionalUrl != null && $aditionalUrl != ""){
		header($aditionalUrl);
	}else{
		header("Location: index.php");
	}
?>
