<?php

require 'db.php';

define('TITLE','EDITAR CLIENTE');
define('CONFIRMACAO','Concluir Edição');

// Método responsável por buscar os dados dos clientes para o update
$id = $_GET['id'];
$sql = 'SELECT * FROM clientes WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id'=>$id]);
$cliente = $statement->fetch(PDO::FETCH_OBJ);

define('VALORCLIENTE',$cliente->NomeCliente);
define('VALORCPF',$cliente->CPF);
define('VALOREMAIL',$cliente->Email);

// Método responsável pelo update de clientes no banco de dados
if(isset($_POST['nome'], $_POST['cpf'], $_POST['email'])){
    
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];

    $sql = 'UPDATE clientes SET NomeCliente=:nome, CPF=:cpf, Email=:email WHERE Id=:id';
    $statement = $connection->prepare($sql);
    if($statement->execute([':nome'=> $nome, ':cpf'=> $cpf, ':email'=>$email, ':id'=>$id])){
        header('location: index.php?status=sucesso');
    }

}


require 'header.php';
require 'formularioCliente.php';
require 'footer.php';
