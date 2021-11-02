<?php


//Busca
$busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);

require 'header.php';
require 'listagem.php';
require 'footer.php';

?>