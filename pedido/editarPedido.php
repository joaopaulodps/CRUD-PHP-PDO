<?php

require '../db.php';

define('TITLE','EDITAR PRODUTO');
define('CONFIRMACAO','Concluir Edição');

// Método responsável por buscar os dados dos clientes para o update
$id = $_GET['id'];
$sql = 'SELECT * FROM produtos WHERE id=:idProd';
$statement = $connection->prepare($sql);
$statement->execute([':idProd'=>$id]);
$produto = $statement->fetch(PDO::FETCH_OBJ);

$errNome = '';
$errCpf = '';
$msg = '';

define('VALORCB',$produto->CodBarras);
define('VALORNP',$produto->NomeProduto);
define('VALORVU',$produto->ValorUnitario);

// Método responsável pelo update de clientes no banco de dados
if(isset($_POST['codBarras'], $_POST['nomeProd'], $_POST['valUni'])){
    
    $nome = $_POST['codBarras'];
    $cpf = $_POST['nomeProd'];
    $email = $_POST['valUni'];

    $sql = 'UPDATE produtos SET CodBarras=:codBarras, NomeProduto=:nomeProd, ValorUnitario=:valUni WHERE IdProduto=:idProd';
    $statement = $connection->prepare($sql);
    if($statement->execute([':codBarras'=> $codBarras, ':nomeProd'=> $nomeProd, ':valUni'=>$valUni, ':idProd'=>$id])){
        header('location: ../index.php?status=sucesso');
    }

}


require '../header.php';
require 'formularioCliente.php';
require '../footer.php';
