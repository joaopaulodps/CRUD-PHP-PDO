<?php

require 'db.php';

define('TITLE','CADASTRAR CLIENTE');
define('CONFIRMACAO','Cadastrar');
define('VALORCLIENTE','');
define('VALORCPF','');
define('VALOREMAIL','');

// Método responsável pela criação de clientes no banco de dados
    if(isset($_POST['nome'], $_POST['cpf'], $_POST['email'])){
        
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
    
        $sql = 'INSERT INTO clientes (NomeCliente, CPF, Email) VALUES (:nome, :cpf, :email)';
        $statement = $connection->prepare($sql);
        if($statement->execute([':nome'=> $nome, ':cpf'=> $cpf, ':email'=>$email])){
            header('location: index.php?status=sucesso');

        }
    
    }
    
require 'header.php';
require 'formularioCliente.php';
require 'footer.php';

?>
