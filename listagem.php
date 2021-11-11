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

  <div>

    <form method="get">
      <div class="row">
        <div class="col">
          <input type="text" name="busca" class="form-control" placeholder="Caixa de Busca" value="<?=$busca?>">
        </div>
        <div class="col d-flex align-items-end">
          <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
      </div>
    </form>
  </div>
</nav>

  <section>
      <nav>
      <div class="nav nav-tabs mt-4" id="nav-tab" role="tablist">
        <button class="btn btn-outline-success btn btn-light" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><a href="index.php?pgpedido=1&&coluna=NumeroPedido&&ordem=ASC"><strong>PEDIDOS</strong></a></button>
        <button class="btn btn-outline-success btn btn-light" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><a href="index.php?pgcliente"><strong>CLIENTES</strong></a></button>
        <button class="btn btn-outline-success btn btn-light" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><a href="index.php?pgproduto"><strong>PRODUTOS</strong></a></button>
      </div>
      </nav>
      
        <section>
        
         <!-- listagem dos dados da tabela clientes na tela -->
         <?php 
         if(isset($_GET['pgpedido'])){
           require './pedido/listagemPedidos.php';
         }
         if(isset($_GET['pgcliente'])){
           require './cliente/listagemClientes.php';
         }
         if(isset($_GET['pgproduto'])){
           require './produto/listagemProdutos.php';
         }
           ?>
         
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
      <section>
        <!-- listagem dos dados da tabela clientes na tela -->
        <?php require './cliente/listagemClientes.php';?>
      </section>

        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"> 
          <section>
       <?php require './produto/listagemProdutos.php';?>
      </section>

  </section>
  
</main>