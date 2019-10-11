<?php
require "autoload.php";

use Ifnc\Tads\Gateway\ProdutoGateway;


    $conn = new \PDO("sqlite:".__DIR__."/database/tads.db");

    ProdutoGateway::setConnection($conn);
    $gw = new ProdutoGateway();
    $gw->delete($_GET['id']);

    header("Location:index.php");

?>