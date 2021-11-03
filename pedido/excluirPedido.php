<!-- Método responsável pela exclusão de produtos no banco de dados -->
<?php
require '../db.php';
$id = $_GET['id'];
$sql = 'DELETE FROM pedidos WHERE NumeroPedido=:numPedido';
$statement = $connection->prepare($sql);
if ($statement->execute([':numPedido' => $id])) {
  header("location: ../index.php?status=sucesso");
}