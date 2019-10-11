<?php
require "autoload.php";

use Ifnc\Tads\Gateway\ProdutoGateway;

	$conn = new \PDO("sqlite:".__DIR__."/database/tads.db");
	ProdutoGateway::setConnection($conn);
	$gw = new ProdutoGateway();

	if(isset($_GET['id'])){
		
		$r = json_encode($gw->find($_GET['id']));
		echo $r;

	}else{

		header("Location:index.php");

	}
	

?>