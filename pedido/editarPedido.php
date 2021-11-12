<?php

require '../db.php';

define('TITLE','EDITAR PEDIDO');
define('CONFIRMACAO','Concluir Edição');

// Método responsável por buscar os dados dos clientes para o update
$id = $_GET['id'];
$sql = 'SELECT * FROM pedidos WHERE NumeroPedido=:numPedido';
$statement = $connection->prepare($sql);
$statement->execute([':numPedido'=>$id]);
$pedido = $statement->fetch(PDO::FETCH_OBJ);

$errQtPedido = '';
$errIdProduto = '';
$errIdCliente = '';
$msg = '';

define('VALORQP',$pedido->Quantidade);
define('VALORIP',$pedido->IdProduto);
define('VALORIC',$pedido->IdCliente);

// Método responsável pelo update de produtos no banco de dados
if(isset($_POST['qtPedido'], $_POST['idProduto'], $_POST['idCliente'], $_POST['statusPedido'])){

    $qtPedido = $_POST['qtPedido'];
    $idProduto = $_POST['idProduto'];
    $idCliente = $_POST['idCliente'];
    $statusPedido = $_POST['statusPedido'];

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
        //Update dos dados na tabela pedidos  
        $sql = 'UPDATE pedidos SET Quantidade=:qtPedido, IdProduto=:idProduto, IdCliente= :idCliente, StatusPedido= :statusPedido WHERE NumeroPedido=:numPedido';
        $statement = $connection->prepare($sql);
        if($statement->execute([':qtPedido'=> $qtPedido, ':idProduto'=>$idProduto, ':idCliente'=>$idCliente, ':statusPedido'=>$statusPedido, ':numPedido'=>$id])){
         header('location: ../index.php?pgpedido&&status=sucesso');
        }
    }
}


require '../header.php';
require 'formularioPedido.php';
require '../footer.php';
