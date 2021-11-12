<?php

$busca = filter_input(INPUT_POST, 'busca', FILTER_SANITIZE_STRING);
$statusFiltro = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);


require 'header.php';
require 'listagem.php';
require 'footer.php';

?>