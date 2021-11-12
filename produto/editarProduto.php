<?php

require '../db.php';

define('TITLE','EDITAR PRODUTO');
define('CONFIRMACAO','Concluir Edição');

// Método responsável por buscar os dados dos clientes para o update
$id = $_GET['id'];
$sql = 'SELECT * FROM produtos WHERE IdProduto=:idProd';
$statement = $connection->prepare($sql);
$statement->execute([':idProd'=>$id]);
$produto = $statement->fetch(PDO::FETCH_OBJ);

$errCodBarras = '';
$errNomProd = '';
$msg = '';

define('VALORCB',$produto->CodBarras);
define('VALORNP',$produto->NomeProduto);
define('VALORVU',$produto->ValorUnitario);

// Método responsável pelo update de produtos no banco de dados
if(isset($_POST['codBarras'], $_POST['nomeProd'], $_POST['valUni'])){

    $codBarras = $_POST['codBarras'];
    $nomeProd = $_POST['nomeProd'];
    $valUni = $_POST['valUni'];

    //validação dos campos do formulário              
    if(empty($codBarras)){
        $errCodBarras = "Campo CÓDIGO DE BARRAS Obrigatório";
    }

    if(empty($valUni)){
        $errNomProd = "Campo VALOR UNITÁRIO Obrigatório";
    }

    if(!empty($codBarras) && !empty($valUni)){

        $sql = 'UPDATE produtos SET CodBarras=:codBarras, NomeProduto=:nomeProd, ValorUnitario=:valUni WHERE IdProduto=:idProd';
        $statement = $connection->prepare($sql);
        if($statement->execute([':codBarras'=> $codBarras, ':nomeProd'=> $nomeProd, ':valUni'=>$valUni, ':idProd'=>$id])){
            header('location: ../index.php?status=sucesso');
        }
    }
}


require '../header.php';
require 'formularioProduto.php';
require '../footer.php';
