<?php
require 'db.php';

//mensagem de operação executada com sucesso
$mensagem = '';
if(isset($_GET['status'])){
    switch ($_GET['status']) {
        case 'sucesso':
            $mensagem = '<div class="alert alert-success">Operação executada com sucesso</div>';
    }
}

?>

<!-- barra de navegação para cadastro no banco de dados -->
<main>
    <?= $mensagem?>

    <nav class="navbar navbar-expand-lg navbar-dark border bg-dark">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="#">Home</a>
                <a class="nav-item nav-link" href="./cliente/cadastrarCliente.php">Novo Cliente</a>
                <a class="nav-item nav-link" href="./produto/cadastrarProduto.php">Novo Produto</a>
                <a class="nav-item nav-link" href="./pedido/cadastrarPedido.php">Novo Pedido</a>
            </div>
        </div>

    </nav>

    <!-- barra de navegação para a escolha da tabela a ser mostrada -->
    <section>
        <nav>
            <div class="nav nav-tabs mt-4" id="nav-tab" role="tablist">
                <button class="btn btn-outline-success btn btn-light" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><a href="index.php?pgpedido"><strong>PEDIDOS</strong></a></button>
                <button class="btn btn-outline-success btn btn-light" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><a href="index.php?pgcliente"><strong>CLIENTES</strong></a></button>
                <button class="btn btn-outline-success btn btn-light" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><a href="index.php?pgproduto"><strong>PRODUTOS</strong></a></button>
            </div>
        </nav>

    <section>

        <!-- seleção da tabela que vai ser mostrada na tela -->
        <?php 
        if(isset($_GET['pgpedido'])){
            require './pedido/listagemPedidos.php';
        }
        if(isset($_GET['pgcliente'])){
            include './cliente/listagemClientes.php';
        }
        if(isset($_GET['pgproduto'])){
            require './produto/listagemProdutos.php';
        }
        ?>

    </section>

</main>