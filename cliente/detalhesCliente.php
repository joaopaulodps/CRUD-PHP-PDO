<?php
require '../db.php';

require '../header.php';

$id = $_GET['id'];
$sql = 'SELECT * FROM clientes WHERE Id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id'=>$id]);
$cliente = $statement->fetch(PDO::FETCH_OBJ);

define('idCliente', $cliente->Id);
define('nomeCliente', $cliente->NomeCliente);
define('cpf', $cliente->CPF);
define('email', $cliente->Email);

$idPedido = $id;
$sql = "SELECT * FROM pedidos WHERE IdCliente = $idPedido";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $pedidos = $statement->fetchAll(PDO::FETCH_OBJ);

  $resultPedidos = '';
  foreach($pedidos as $pedido){
    $resultPedidos .= '<tr>
    <td>'.$pedido->NumeroPedido.'</td>
    <td>'.date('d/m/Y à\s H:i:s',strtotime($pedido->DtPedido)).'</td>
    </tr>';
  }
?>
<section>
    <a href="../index.php?pgcliente">
      <button class="btn btn-success">Voltar</button>
    </a>
  </section>

<h1>DETALHES DO CLIENTE Nº <?= idCliente ?></h1>

<h2>DETALHES DO CLIENTE</h2>
<table class='table bg-light text-center border-top border border-secondary'>
        <thead>
            <th>ID CLIENTE</th>
            <th>NOME DO CLIENTE</th>
            <th>CPF</th>
            <th>E-MAIL</th>
        </thead>
        <tbody>
            <tr>
                <td><?= idCliente ?></td>
                <td><?= nomeCliente ?></td>
                <td><?= cpf ?></td>
                <td><?= email ?></td>
            </tr>
        </tbody>
    </table>
<h2>HISTÓRICO DE PEDIDOS</h2>
    
   <table class='table bg-light text-center border-top border border-secondary'>
    <thead>
        <th>NÚMERO DO PEDIDO</th>
        <th>DATA DO PEDIDO</th>
    </thead>
    <tbody>
        <?= $resultPedidos ?>
    </tbody>
   </table> 

<?php 
require '../footer.php';
?>