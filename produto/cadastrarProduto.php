<?php

require '../db.php';

//definição do nome dos campos na tabela de cadastro
define('TITLE','CADASTRAR PRODUTO');
define('CONFIRMACAO','Cadastrar');
define('VALORCB','');
define('VALORNP','');
define('VALORVU','');

$errCodBarras = '';
$errNomProd = '';
$errValProd = '';
$msg = '';

// Método responsável pela criação de produtos no banco de dados
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

        //inserção dos dados na tabela produtos do banco de dados
        $sql = 'INSERT INTO produtos (CodBarras, NomeProduto, ValorUnitario) VALUES (:codBarras, :nomeProd, :valUni)';
        $statement = $connection->prepare($sql);
        if($statement->execute([':codBarras'=> $codBarras, ':nomeProd'=> $nomeProd, ':valUni'=>$valUni])){
            header('location: ../index.php?pgproduto&&status=sucesso');
        }  
    }

}

require '../header.php';
require 'formularioProduto.php';
require '../footer.php';

?>
