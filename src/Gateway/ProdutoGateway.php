<?php


namespace Ifnc\Tads\Gateway;

use PDO;

class ProdutoGateway
{
    private static $conn;

    public static function setConnection(PDO $conn){
        self::$conn = $conn;
    }

    public function all(){
        $sql = "SELECT * FROM produto";
        $result = self::$conn->query($sql);
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public function find($id)
    {
        $sql = "SELECT * FROM produto WHERE id = $id";
        $result = self::$conn->query($sql);
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM produto WHERE id = $id";
        return self::$conn->query($sql);
    }

    public function create($data)
    {
        $sql = <<<SQL
            INSERT INTO produto(
                descricao,
                estoque,
                preco_custo,
                preco_venda,
                codigo_barras,
                data_cadastro,
                origem) values(
                '{$data->descricao}',
                '{$data->estoque}',
                '{$data->preco_custo}',
                '{$data->preco_venda}',
                '{$data->codigo_barras}',
                '{$data->data_cadastro}',
                '{$data->origem}'
                )
        SQL;
        return self::$conn->exec($sql);
    }

    public function update($data)
    {
        $sql = <<<SQL
            UPDATE produto SET
                descricao ='{$data->descricao}',
                estoque = '{$data->estoque}',
                preco_custo = '{$data->preco_custo}',
                preco_venda = '{$data->preco_venda}',
                codigo_barras = '{$data->codigo_barras}',
                data_cadastro = '{$data->data_cadastro}',
                origem = '{$data->origem}'
                WHERE id = {$data->id}
        SQL;
        return self::$conn->exec($sql);
    }


}