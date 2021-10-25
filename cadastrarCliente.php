<?php

require 'db.php';

define('TITLE','CADASTRAR CLIENTE');
define('CONFIRMACAO','Cadastrar');
define('VALORCLIENTE','');
define('VALORCPF','');
define('VALOREMAIL','');


$message = '';
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
    


/* echo "<pre>"; print_r($_POST); echo "</pre>"; exit; */

require 'header.php';
require 'formularioCliente.php';
require 'footer.php';

?>
