<!-- Método responsável pela exclusão de clientes no banco de dados -->
<?php
require '../db.php';
$id = $_GET['id'];
$sql = 'DELETE FROM clientes WHERE id=:id';
$statement = $connection->prepare($sql);
if ($statement->execute([':id' => $id])) {
  header("location: ../index.php?status=sucesso");
}