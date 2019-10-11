<?php
    require "autoload.php";
    use Ifnc\Tads\Gateway\ProdutoGateway;
    $conn = new \PDO("sqlite:".__DIR__."/database/tads.db");
    ProdutoGateway::setConnection($conn);
    $gw = new ProdutoGateway();
    $produtos = $gw->all();
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script type="text/javascript">
        function AttDados(id) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var retorno = JSON.parse(this.responseText);
                    console.log(retorno[0]);
                    document.getElementById('id').setAttribute('value', retorno[0].id);
                    document.getElementById('descricao').setAttribute('value', retorno[0].descricao);
                    document.getElementById('qtdEstoque').setAttribute('value', retorno[0].estoque);
                    document.getElementById('precoCusto').setAttribute('value', retorno[0].preco_custo);
                    document.getElementById('precoVenda').setAttribute('value', retorno[0].preco_venda);
                    document.getElementById('codigoBarra').setAttribute('value', retorno[0].codigo_barras);
                }
              };
              xhttp.open("GET", "getInfo.php?id=" + id, true);
              xhttp.send();
        }

        function limparForm() {
            document.getElementById('id').setAttribute('value', "");
            document.getElementById('descricao').setAttribute('value', "");
            document.getElementById('qtdEstoque').setAttribute('value', "");
            document.getElementById('precoCusto').setAttribute('value', "");
            document.getElementById('precoVenda').setAttribute('value', "");
            document.getElementById('codigoBarra').setAttribute('value', "");
        }

    </script>

    <title>Hello, world!</title>
</head>
<body>
<h1>Hello, world!</h1>
<div class="px-2 mb-1">
    <form method="post" action="add_update.php">
      <div class="row">
        <div class="col">
          <input type="text" class="form-control" placeholder="Descrição" name="descricao" id="descricao">
        </div>
        <div class="col">
          <input type="text" class="form-control" placeholder="Qtd Estoque" name="qtdEstoque" id="qtdEstoque">
        </div>
        <div class="col">
          <input type="text" class="form-control" placeholder="Preço custo" name="precoCusto" id="precoCusto">
        </div>
        <div class="col">
          <input type="text" class="form-control" placeholder="Preço venda" name="precoVenda" id="precoVenda">
        </div>
        <div class="col">
          <input type="text" class="form-control" placeholder="Codigo de barras" name="codigoBarra" id="codigoBarra">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-success" name="cadastrar" 
            data-toggle="tooltip" data-placement="top" title="Clique para cadastrar">Cadastrar</button>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-warning" name="atualizar"
            data-toggle="tooltip" data-placement="top" title="Clique para Atualizar">Atualizar</button>
        </div>
        <div class="col-auto">
            <button type="reset" class="btn btn btn-dark" 
                name="limpar" onclick="limparForm()" data-toggle="tooltip" data-placement="top" title="Clique para Limpar o formulário">Limpar</button>
        </div>
      </div>

      <input type="hidden" id="id" name="id" value="">
    </form>
</div>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Descrição</th>
        <th scope="col">Estoque</th>
        <th scope="col">Preço de Custo</th>
        <th scope="col">Preço de Venda</th>
        <th scope="col">Código de Barra</th>
        <th scope="col">Data Origem</th>
        <th scope="col">Data Cadastro</th>
        <th scope="col"></th>

    </tr>
    </thead>
    <tbody>
    <?php
        foreach($produtos as $produto){
    ?>
        <tr ondblclick="AttDados(<?=$produto->id?>)" 
            data-toggle="tooltip" data-placement="top" title="Clique duas vezes para Atualizar">

            <th scope="row"><?=$produto->id?></th>
            <td><?=$produto->descricao?></td>
            <td><?=$produto->estoque?></td>
            <td><?=$produto->preco_custo?></td>
            <td><?=$produto->preco_venda?></td>
            <td><?=$produto->codigo_barras?></td>
            <td><?=$produto->origem?></td>
            <td><?=$produto->data_cadastro?></td>
            <td>
                <a href="apagar.php?id=<?=$produto->id?>">
                    <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" 
                        title="Clique para apagar esse produto">
                        Apagar
                    </button>
                </a>
            </td>
        </tr>
    <?php }?>
    </tbody>
</table>
<div id="demo"></div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
