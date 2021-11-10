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

$paginaAtualCliente = filter_input(INPUT_GET, "pgcliente", FILTER_SANITIZE_NUMBER_INT);
$paginaCliente = (!empty($paginaAtualCliente)) ? $paginaAtualCliente : 1;
var_dump($paginaCliente);

$limiteResultadoCliente = 20;

$inicioCliente = ($limiteResultadoCliente * $paginaCliente) - $limiteResultadoCliente;

$sql = "SELECT * FROM clientes LIMIT $inicioCliente, $limiteResultadoCliente";
$statement = $connection->prepare($sql);
$statement->execute();
$clientes = $statement->fetchAll(PDO::FETCH_OBJ);

  $qtdRegistrosCliente = "SELECT COUNT(id) AS numResult FROM clientes";
  $resQtdRegistrosCliente = $connection->prepare($qtdRegistrosCliente);
  $resQtdRegistrosCliente->execute();
  $rowQtdRegistrosCliente = $resQtdRegistrosCliente->fetch(PDO::FETCH_ASSOC);
  
  $qtdPgCliente = ceil($rowQtdRegistrosCliente['numResult'] / $limiteResultadoCliente);

  $maxLinkCliente = 3;
  

  $paginaAtualProduto = filter_input(INPUT_GET, "pgproduto", FILTER_SANITIZE_NUMBER_INT);
  $paginaProduto = (!empty($paginaAtualProduto)) ? $paginaAtualProduto : 1;
  var_dump($paginaProduto);
  
  $limiteResultadoProduto = 20;
  
  $inicioProduto = ($limiteResultadoProduto * $paginaProduto) - $limiteResultadoProduto;  

$sql = "SELECT * FROM produtos LIMIT $inicioProduto, $limiteResultadoProduto";
$statement = $connection->prepare($sql);
$statement->execute();
$produtos = $statement->fetchAll(PDO::FETCH_OBJ);

$qtdRegistrosProduto = "SELECT COUNT(idProduto) AS numResultProd FROM produtos";
  $resQtdRegistrosProduto = $connection->prepare($qtdRegistrosProduto);
  $resQtdRegistrosProduto->execute();
  $rowQtdRegistrosProduto = $resQtdRegistrosProduto->fetch(PDO::FETCH_ASSOC);
  
  $qtdPgProduto = ceil($rowQtdRegistrosProduto['numResultProd'] / $limiteResultadoProduto);

  $maxLinkProduto = 3;


  $paginaAtualPedido = filter_input(INPUT_GET, "pgpedido", FILTER_SANITIZE_NUMBER_INT);
  
  $limiteResultadoPedido = 20;
  $paginaPedido = (!empty($paginaAtualPedido)) ? $paginaAtualPedido : 1;
  var_dump($paginaPedido);
  
  $inicioPedido = ($limiteResultadoPedido * $paginaPedido) - $limiteResultadoPedido;

$sql = "SELECT * FROM pedidos LIMIT $inicioPedido, $limiteResultadoPedido";
$statement = $connection->prepare($sql);
$statement->execute();
$pedidos = $statement->fetchAll(PDO::FETCH_OBJ);

$qtdRegistrosPedido = "SELECT COUNT(NumeroPedido) AS numResultPedido FROM pedidos";
  $resQtdRegistrosPedido = $connection->prepare($qtdRegistrosPedido);
  $resQtdRegistrosPedido->execute();
  $rowQtdRegistrosPedido = $resQtdRegistrosPedido->fetch(PDO::FETCH_ASSOC);
  
  $qtdPgPedido = ceil($rowQtdRegistrosPedido['numResultPedido'] / $limiteResultadoPedido);

  $maxLinkPedido = 3;

//listagem dos resultados da tabela CLIENTES, do banco de dados
$resultClientes = '';
foreach($clientes as $cliente){
  $resultClientes .= '<tr>
                    <td>'.$cliente->Id.'</td>
                    <td>'.$cliente->NomeCliente.'</td>
                    <td>'.$cliente->CPF.'</td>
                    <td>'.$cliente->Email.'</td>
                    <td>
                        <a href="./cliente/editarCliente.php?id='.$cliente->Id.'" class="btn btn-info">Editar</a>
                        <a href="./cliente/excluirCliente.php?id='.$cliente->Id.'" class="btn btn-danger">Excluir</a>
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
                        <a href="./produto/editarProduto.php?id='.$produto->IdProduto.'" class="btn btn-info">Editar</a>
                        <a href="./produto/excluirProduto.php?id='.$produto->IdProduto.'" class="btn btn-danger">Excluir</a>
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
                        <a href="./pedido/editarPedido.php?id='.$pedido->NumeroPedido.'" class="btn btn-info">Editar</a>
                        <a href="./pedido/excluirPedido.php?id='.$pedido->NumeroPedido.'" class="btn btn-danger">Excluir</a>
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
    
        <nav aria-label="Page navigation example">
          <ul class="pagination">
        <?php  
        
        echo "<li class='page-item'><a class='page-link' href='index.php?pgpedido=1'>Primeira</a></li> "; 
  
        for($paginaAnteriorPedido = $paginaPedido - $maxLinkPedido; $paginaAnteriorPedido <= $paginaPedido -1; $paginaAnteriorPedido++){
          if($paginaAnteriorPedido >=1){
            echo "<li class='page-item'><a class='page-link' href='index.php?pgpedido=$paginaAnteriorPedido'>$paginaAnteriorPedido</a></li> ";
          }
        }
        
        echo "<li class='page-item' ><a class='page-link disabled bg-dark'>$paginaPedido</a></li>"; 
        
        for($proximaPaginaPedido = $paginaPedido + 1; $proximaPaginaPedido <= $paginaPedido + $maxLinkPedido; $proximaPaginaPedido++){
          if($proximaPaginaPedido <= $qtdPgPedido){
            echo "<li class='page-item'><a class='page-link' href='index.php?pgpedido=$proximaPaginaPedido'>$proximaPaginaPedido</a></li> ";
          }
        }
      
        
      echo "<li class='page-item'><a class='page-link' href='index.php?pgpedido=$qtdPgPedido'>Última</a></li> "; 
                
        ?>
        </ul>
        </nav>

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

        <nav aria-label="Page navigation example">
          <ul class="pagination">
        <?php  
        
        echo "<li class='page-item'><a class='page-link' href='index.php?pgcliente=1'>Primeira</a></li> "; 
  
        for($paginaAnteriorCliente = $paginaCliente - $maxLinkCliente; $paginaAnteriorCliente <= $paginaCliente -1; $paginaAnteriorCliente++){
          if($paginaAnteriorCliente >=1){
            echo "<li class='page-item'><a class='page-link' href='index.php?pgcliente=$paginaAnteriorCliente'>$paginaAnteriorCliente</a></li> ";
          }
        }
        
        echo "<li class='page-item' ><a class='page-link disabled bg-dark'>$paginaCliente</a></li>"; 
        
        for($proximaPaginaCliente = $paginaCliente + 1; $proximaPaginaCliente <= $paginaCliente + $maxLinkCliente; $proximaPaginaCliente++){
          if($proximaPaginaCliente <= $qtdPgCliente){
            echo "<li class='page-item'><a class='page-link' href='index.php?pgcliente=$proximaPaginaCliente'>$proximaPaginaCliente</a></li> ";
          }
        }
      
        
      echo "<li class='page-item'><a class='page-link' href='index.php?pgcliente=$qtdPgCliente'>Última</a></li> "; 
                
        ?>
        </ul>
        </nav>
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
    
        <nav aria-label="Page navigation example">
          <ul class="pagination">
        <?php  
        
        echo "<li class='page-item'><a class='page-link' href='index.php?pgproduto=1'>Primeira</a></li> "; 
  
        for($paginaAnteriorProduto = $paginaProduto - $maxLinkProduto; $paginaAnteriorProduto <= $paginaProduto -1; $paginaAnteriorProduto++){
          if($paginaAnteriorProduto >=1){
            echo "<li class='page-item'><a class='page-link' href='index.php?pgproduto=$paginaAnteriorProduto'>$paginaAnteriorProduto</a></li> ";
          }
        }
        
        echo "<li class='page-item' ><a class='page-link disabled bg-dark'>$paginaProduto</a></li>"; 
        
        for($proximaPaginaProduto = $paginaProduto + 1; $proximaPaginaProduto <= $paginaProduto + $maxLinkProduto; $proximaPaginaProduto++){
          if($proximaPaginaProduto <= $qtdPgProduto){
            echo "<li class='page-item'><a class='page-link' href='index.php?pgproduto=$proximaPaginaProduto'>$proximaPaginaProduto</a></li> ";
          }
        }
      
        
      echo "<li class='page-item'><a class='page-link' href='index.php?pgproduto=$qtdPgProduto'>Última</a></li> "; 
                
        ?>
        </ul>
        </nav>

      </section>
    </div>
      </div>

  </section>
  
</main>