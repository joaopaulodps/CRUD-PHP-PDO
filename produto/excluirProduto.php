<!-- Método responsável pela exclusão de produtos no banco de dados -->
<?php
require '../db.php';
$id = $_GET['id'];
$sql = 'DELETE FROM produtos WHERE IdProduto=:idProd';
$statement = $connection->prepare($sql);
if ($statement->execute([':idProd' => $id])) {
  header("location: ../index.php?status=sucesso");
}