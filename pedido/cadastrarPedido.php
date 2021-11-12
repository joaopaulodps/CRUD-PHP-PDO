<?php

require '../db.php';

define('TITLE','CADASTRAR PEDIDO');
define('CONFIRMACAO','Cadastrar');
define('VALORQP','');
define('VALORIP','');
define('VALORIC','');

$errQtPedido = '';
$errIdProduto = '';
$errIdCliente = '';
$msg = '';
// Método responsável pela criação de produtos no banco de dados

if(isset( $_POST['qtPedido'], $_POST['idProduto'], $_POST['idCliente'], $_POST['statusPedido'])){
        
    $qtPedido = $_POST['qtPedido'];
    $idProduto = $_POST['idProduto'];
    $idCliente = $_POST['idCliente'];
    $idStatusPedido = $_POST['statusPedido'];

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
