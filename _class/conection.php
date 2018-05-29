<?php
	try {
   		$myPDO = new PDO('mysql:host=localhost; dbname=dblogin', 'root', '');
	    $dbh = null;
	} catch (PDOException $error) {
	    print "Error!: " . $error->getMessage() . "<br/>";
	    die();
	}

/*
	-Usado para ler toda uma tabela
		foreach($myPDO->query('SELECT * from FOO') as $row) {
	        print_r($row);
	    }
*/