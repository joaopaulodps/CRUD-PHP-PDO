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

$errDtPedido = '';
$errQtPedido = '';
$errIdProduto = '';
$errIdCliente = '';
$msg = '';

define('VALORDP',$pedido->DtPedido);
define('VALORQP',$pedido->Quantidade);
define('VALORIP',$pedido->idProduto);
define('VALORIC',$pedido->idCliente);

// Método responsável pelo update de produtos no banco de dados
if(isset($_POST['dtPedido'], $_POST['qtPedido'], $_POST['idProduto'], $_POST['idCliente'])){
    
    $dtPedido = $_POST['dtPedido'];
    $qtPedido = $_POST['qtPedido'];
    $idProduto = $_POST['idProduto'];
    $idCliente = $_POST['idCliente'];

    $sql = 'UPDATE pedidos SET dtPedido=:dtPedido, qtPedido=:qtPedido, idProduto=:idProduto, idCliente= :idCliente WHERE NumeroPedido=:numPedido';
    $statement = $connection->prepare($sql);
    if($statement->execute([':dtPedido'=> $dtPedido, ':qtPedido'=> $qtPedido, ':idProduto'=>$idProduto, ':idCliente'=>$idCliente, ':numPedido'=>$id])){
        header('location: ../index.php?status=sucesso');
    }

}


require '../header.php';
require 'formularioPedido.php';
require '../footer.php';
