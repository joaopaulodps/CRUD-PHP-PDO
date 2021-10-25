<?php

require 'db.php';

$message = '';

/* echo "<pre>"; print_r($_POST); echo "</pre>"; exit; */
if(isset($_POST['nome'], $_POST['cpf'], $_POST['email'])){
    
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];

    $sql = 'INSERT INTO clientes (NomeCliente, CPF, Email) VALUES (:nome, :cpf, :email)';
    $statement = $connection->prepare($sql);
    if($statement->execute([':nome'=> $nome, ':cpf'=> $cpf, ':email'=>$email])){
        $message = 'Cliente cadastrado com sucesso!';
    }

}

require 'header.php';
require 'formularioCliente.php';
require 'footer.php';