<?php

require '../db.php';

define('TITLE','EDITAR CLIENTE');
define('CONFIRMACAO','Concluir Edição');

// Método responsável por buscar os dados dos clientes para o update
$id = $_GET['id'];
$sql = 'SELECT * FROM clientes WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id'=>$id]);
$cliente = $statement->fetch(PDO::FETCH_OBJ);

$errNome = '';
$errCpf = '';
$msg = '';

define('VALORCLIENTE',$cliente->NomeCliente);
define('VALORCPF',$cliente->CPF);
define('VALOREMAIL',$cliente->Email);

// Método responsável pelo update de clientes no banco de dados
if(isset($_POST['nome'], $_POST['cpf'], $_POST['email'])){
    
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];

    if(empty($nome)) {
        $errNome = "Campo NOME obrigatório!";
    }
    if(empty($cpf)) {
        $errCpf = "Campo CPF obrigatório!";
    }
       
    if(strlen($nome) > 100){
        $errNome = "Campo NOME deve possuir até 100 caracteres";
    };
    
    if(!empty($nome) && !empty($cpf)){

        
        $sql = 'UPDATE clientes SET NomeCliente=:nome, CPF=:cpf, Email=:email WHERE Id=:id';
        $statement = $connection->prepare($sql);
        if($statement->execute([':nome'=> $nome, ':cpf'=> $cpf, ':email'=>$email, ':id'=>$id])){
            header('location: ../index.php?status=sucesso');
        }
    }

}


require '../header.php';
require 'formularioCliente.php';
require '../footer.php';
