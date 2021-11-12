<?php

require '../db.php';

//definição do nome dos campos na tabela de cadastro de cliente 
define('TITLE','CADASTRAR CLIENTE');
define('CONFIRMACAO','Cadastrar');
define('VALORCLIENTE','');
define('VALORCPF','');
define('VALOREMAIL','');

$errNome = '';
$errCpf = '';
$msg = '';


// Método responsável pela criação de clientes no banco de dados

if(isset($_POST['nome'], $_POST['cpf'], $_POST['email'])){
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];

    //validação dos campos do formulário        
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

        //inserção dos dados na tabela clientes do banco de dados
        $sql = 'INSERT INTO clientes (NomeCliente, CPF, Email) VALUES (:nome, :cpf, :email)';
        $statement = $connection->prepare($sql);
        if($statement->execute([':nome'=> $nome, ':cpf'=> $cpf, ':email'=>$email])){
            header('location: ../index.php?pgcliente&&status=sucesso');
        } 
    }


}

require '../header.php';
require 'formularioCliente.php';
require '../footer.php';

?>
