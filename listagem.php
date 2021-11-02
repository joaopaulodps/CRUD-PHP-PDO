<?php

//mensagem de operação executada com sucesso
$mensagem = '';
if(isset($_GET['status'])){
  switch ($_GET['status']) {
    case 'sucesso':
      $mensagem = '<div class="alert alert-success">Operação executada com sucesso</div>';
  }
}


//busca de dados na tabela cliente, do banco de dados
require 'db.php';
$sql = 'SELECT * FROM clientes';
$statement = $connection->prepare($sql);
$statement->execute();
$clientes = $statement->fetchAll(PDO::FETCH_OBJ);

$sql = 'SELECT * FROM produtos';
$statement = $connection->prepare($sql);
$statement->execute();
$produtos = $statement->fetchAll(PDO::FETCH_OBJ);

$sql = 'SELECT * FROM pedidos';
$statement = $connection->prepare($sql);
$statement->execute();
$pedidos = $statement->fetchAll(PDO::FETCH_OBJ);

//listagem dos resultados da tabela CLIENTES, do banco de dados
$resultClientes = '';
foreach($clientes as $cliente){
  $resultClientes .= '<tr>
                    <td>'.$cliente->Id.'</td>
                    <td>'.$cliente->NomeCliente.'</td>
                    <td>'.$cliente->CPF.'</td>
                    <td>'.$cliente->Email.'</td>
                    <td>
                        <a href="editarCliente.php?id='.$cliente->Id.'" class="btn btn-info">Editar</a>
                        <a href="excluirCliente.php?id='.$cliente->Id.'" class="btn btn-danger">Excluir</a>
                    </td>
                  </tr>';
}

//listagem dos resultados da tabela PRODUTOS, do banco de dados
$resultProdutos = '';
foreach($produtos as $produto){
  $resultProdutos .= '<tr>
                    <td>'.$produto->IdProduto.'</td>
                    <td>'.$produto->CodBarras.'</td>
                    <td>'.$produto->NomeProduto.'</td>
                    <td>'.$produto->ValorUnitario.'</td>
                    <td>
                        <a href="editarCliente.php?id='.$produto->IdProduto.'" class="btn btn-info">Editar</a>
                        <a href="excluirCliente.php?id='.$produto->IdProduto.'" class="btn btn-danger">Excluir</a>
                    </td>
                  </tr>';
}

//listagem dos resultados da tabela PEDIDOS, do banco de dados
$resultPedidos = '';
foreach($pedidos as $pedido){
  $resultPedidos .= '<tr>
                    <td>'.$pedido->NumeroPedido.'</td>
                    <td>'.$pedido->DtPedido.'</td>
                    <td>'.$pedido->Quantidade.'</td>
                    <td>'.$pedido->IdProduto.'</td>
                    <td>'.$pedido->IdCliente.'</td>
                    <td>
                        <a href="editarCliente.php?id='.$pedido->NumeroPedido.'" class="btn btn-info">Editar</a>
                        <a href="excluirCliente.php?id='.$pedido->NumeroPedido.'" class="btn btn-danger">Excluir</a>
                    </td>
                  </tr>';
}

?>

<main>
 <?= $mensagem?>

 <nav class="navbar navbar-expand-lg navbar-dark border bg-dark">
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="#">Home</a>
      <a class="nav-item nav-link" href="cadastrarCliente.php">Novo Cliente</a>
      <a class="nav-item nav-link" href="cadastrarProduto.php">Novo Produto</a>
      <a class="nav-item nav-link" href="cadastrarPedido.php">Novo Pedido</a>
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
        <button class="btn btn-outline-success btn btn-light" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><strong>PEDIDOS</strong></button>
        <button class="btn btn-outline-success btn btn-light" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><strong>CLIENTES</strong></button>
        <button class="btn btn-outline-success btn btn-light" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><strong>PRODUTOS</strong></button>
      </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <section>
        <!-- listagem dos dados da tabela clientes na tela -->
        <table class="table bg-light text-center border-top border border-secondary">

          <thead>
            <tr>
              <th>N° PEDIDO</th>
              <th>DATA PEDIDO</th>
              <th>QUANTIDADE</th>
              <th>ID PRODUTO</th>
              <th>ID CLIENTE</th>
              <th>AÇÕES</th>
            </tr>
          </thead>
          <tbody>        
            <?=$resultPedidos?>
          </tbody>

        </table>
    
      </section>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        <section>
        <!-- listagem dos dados da tabela clientes na tela -->
        <table class="table bg-light text-center border-top border border-secondary">

          <thead>
            <tr>
              <th>ID</th>
              <th>NOME CLIENTE</th>
              <th>CPF</th>
              <th>E-MAIL</th>
              <th>AÇÔES</th>
            </tr>
          </thead>
          <tbody>        
            <?=$resultClientes?>
          </tbody>

        </table>
    
      </section>
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"> 
          <section>
        <!-- listagem dos dados da tabela clientes na tela -->
        <table class="table bg-light text-center border-top border border-secondary">

          <thead>
            <tr>
              <th>ID</th>
              <th>CODIGO DE BARRAS</th>
              <th>NOME PRODUTO</th>
              <th>VALOR UNITARIO</th>
              <th>AÇÔES</th>
            </tr>
          </thead>
          <tbody>        
            <?=$resultProdutos?>
          </tbody>

        </table>
    
      </section>
    </div>
      </div>

  </section>
  
</main>