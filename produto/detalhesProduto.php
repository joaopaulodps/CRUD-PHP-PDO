<?php
require '../db.php';

require '../header.php';

//método resposável por buscar os dados do BD na tabela produtos
$id = $_GET['id'];
$sql = 'SELECT * FROM produtos WHERE IdProduto=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id'=>$id]);
$produto = $statement->fetch(PDO::FETCH_OBJ);

define('idProduto', $produto->IdProduto);
define('codBarras', $produto->CodBarras);
define('nomeProduto', $produto->NomeProduto);
define('valorUnitario', $produto->ValorUnitario);

//método resposável por buscar os dados do BD na tabela pedidos
$idPedido = $id;
$sql = "SELECT * FROM pedidos WHERE IdProduto = $idPedido";
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
  <a href="../index.php?pgproduto">
    <button class="btn btn-success">Voltar</button>
  </a>
</section>
<!-- listagem dos detalhes do produto-->
<h1>DETALHES DO PRODUTO Nº <?= idProduto ?></h1>

  <h2>DETALHES DO PRODUTO</h2>
    <table class='table bg-light text-center border-top border border-secondary'>
      <thead>
        <th>ID PRODUTO</th>
        <th>NOME DO PRODUTO</th>
        <th>CÓDIGO DE BARRAS</th>
        <th>VALOR UNITÁRIO</th>
      </thead>
      <tbody>
        <tr>
          <td><?= idProduto ?></td>
          <td><?= nomeProduto ?></td>
          <td><?= codBarras ?></td>
          <td><?= valorUnitario ?></td>
        </tr>
      </tbody>
    </table>
<!-- listagem do historico de pedidos -->
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