<?php

require '../db.php';

define('TITLE','CADASTRAR PRODUTO');
define('CONFIRMACAO','Cadastrar');
define('VALORCB','');
define('VALORNP','');
define('VALORVU','');

$errCodBarras = '';
$errNomProd = '';
$msg = '';
// Método responsável pela criação de produtos no banco de dados

if(isset($_POST['codBarras'], $_POST['nomeProd'], $_POST['valUni'])){
        $codBarras = $_POST['codBarras'];
        $nomeProd = $_POST['nomeProd'];
        $valUni = $_POST['valUni'];

        if(empty($codBarras)){
            $errCodBarras = "Campo CÓDIGO DE BARRAS Obrigatório";
        }

        if(empty($valUni)){
            $errNomProd = "Campo VALOR UNITÁRIO Obrigatório";
        }

        if(!empty($codBarras) && !empty($valUni)){

            $sql = 'INSERT INTO produtos (CodBarras, NomeProduto, ValorUnitario) VALUES (:codBarras, :nomeProd, :valUni)';
            $statement = $connection->prepare($sql);
            if($statement->execute([':codBarras'=> $codBarras, ':nomeProd'=> $nomeProd, ':valUni'=>$valUni])){
                header('location: ../index.php?status=sucesso');
            }  
        }
    
    }
    
require '../header.php';
require 'formularioProduto.php';
require '../footer.php';

?>
