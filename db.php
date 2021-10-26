<?php
//dados usados para a conexão com o banco de dados
$dsn = 'mysql:host=localhost;dbname=bd_pedidos';

$username = 'root';

$password = '1111';

$options = [];

try{
    $connection = new PDO($dsn, $username, $password, $options);
}catch(PDOException $e){
    die('ERROR: '.$e->getMessage());
}