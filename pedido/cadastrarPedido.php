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

if(isset( $_POST['qtPedido'], $_POST['idProduto'], $_POST['idCliente'])){
        
    $qtPedido = $_POST['qtPedido'];
    $idProduto = $_POST['idProduto'];
    $idCliente = $_POST['idCliente'];
    

            $sql = 'INSERT INTO pedidos (DtPedido, Quantidade, IdProduto, IdCliente) VALUES (now(), :qtPedido, :idProduto, :idCliente)';
            $statement = $connection->prepare($sql);
            if($statement->execute([':qtPedido'=> $qtPedido, ':idProduto'=>$idProduto, ':idCliente'=>$idCliente])){
                header('location: ../index.php?status=sucesso');
            }  
    
    }
    
require '../header.php';
require 'formularioPedido.php';
require '../footer.php';

?>
