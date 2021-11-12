<?php

require '../db.php';

//definição do nome dos campos na tabela de cadastro de pedidos
define('TITLE','CADASTRAR PEDIDO');
define('CONFIRMACAO','Cadastrar');
define('VALORQP','');
define('VALORIP','');
define('VALORIC','');

$errQtPedido = '';
$errIdProduto = '';
$errIdCliente = '';
$msg = '';
// Método responsável pela criação de pedidos no banco de dados

if(isset( $_POST['qtPedido'], $_POST['idProduto'], $_POST['idCliente'], $_POST['statusPedido'])){

    $qtPedido = $_POST['qtPedido'];
    $idProduto = $_POST['idProduto'];
    $idCliente = $_POST['idCliente'];
    $idStatusPedido = $_POST['statusPedido'];

    //validação dos campos do formulário 
    if(empty($qtPedido)){
        $errQtPedido = "Campo QUANTIDADE Obrigatório";
    }

    if(empty($idProduto)){
        $errIdProduto = "Campo ID Produto Obrigatório";
    }

    if(empty($idCliente)){
        $errIdCliente = "Campo ID Cliente Obrigatório";
    }

    if(!empty($qtPedido) && !empty($idProduto) && !empty($idCliente)){
        //inserção dos dados na tabela pedidos do banco de dados
        $sql = 'INSERT INTO pedidos (DtPedido, Quantidade, IdProduto, IdCliente, StatusPedido) VALUES (now(), :qtPedido, :idProduto, :idCliente, :statusPedido)';
        $statement = $connection->prepare($sql);
        if($statement->execute([':qtPedido'=> $qtPedido, ':idProduto'=>$idProduto, ':idCliente'=>$idCliente,':statusPedido'=>$idStatusPedido])){
            header('location: ../index.php?pgpedido&&status=sucesso');
        }  
    }

}

require '../header.php';
require 'formularioPedido.php';
require '../footer.php';

?>
