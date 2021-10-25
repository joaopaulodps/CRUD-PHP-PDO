<?php

require 'db.php';

define('TITLE','EDITAR CLIENTE');
define('CONFIRMACAO','Concluir Edição');

$id = $_GET['id'];
$sql = 'SELECT * FROM clientes WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id'=>$id]);
$cliente = $statement->fetch(PDO::FETCH_OBJ);

define('VALORCLIENTE',$cliente->NomeCliente);
define('VALORCPF',$cliente->CPF);
define('VALOREMAIL',$cliente->Email);
$message = '';
/* echo "<pre>"; print_r($_POST); echo "</pre>"; exit; */
if(isset($_POST['nome'], $_POST['cpf'], $_POST['email'])){
    
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];

    $sql = 'UPDATE clientes SET NomeCliente=:nome, CPF=:cpf, Email=:email WHERE Id=:id';
    $statement = $connection->prepare($sql);
    if($statement->execute([':nome'=> $nome, ':cpf'=> $cpf, ':email'=>$email, ':id'=>$id])){
        $message = 'Cliente editado com sucesso!';
    }

}


require 'header.php';
require 'formularioCliente.php';
require 'footer.php';
