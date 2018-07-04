<?php
	try {
   		//$myPDO = new PDO('mysql:host=localhost; dbname=dblogin', 'root', '');
   		$myPDO = new PDO('mysql:host=localhost; dbname=consu967_bdlogin', 'consu967_mei', 'Kp4v6CpaPu');
	    $dbh = null;
	} catch (PDOException $error) {
	    print "Error!: " . $error->getMessage() . "<br/>";
	    die();
	}
