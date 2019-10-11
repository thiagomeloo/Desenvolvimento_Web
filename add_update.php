<?php
require "autoload.php";

use Ifnc\Tads\Gateway\ProdutoGateway;


    $conn = new \PDO("sqlite:".__DIR__."/database/tads.db");
    ProdutoGateway::setConnection($conn);
    $gw = new ProdutoGateway();

 
    $data = (object) [
    'id' => $_POST['id'],
    'descricao' => $_POST['descricao'],
    'estoque' => $_POST['qtdEstoque'],
    "preco_custo" => $_POST['precoCusto'],
    "preco_venda" => $_POST['precoVenda'],
    "codigo_barras" => $_POST['codigoBarra'],
    "data_cadastro" => date("Y/m/d") ,
    "origem" => date("Y/m/d"),
    ];


    
    if(isset($_POST['cadastrar'])){
        $gw->create($data);
    }else if(isset($_POST['atualizar'])){
        $gw->update($data);
    }

    header("Location:index.php");

?>