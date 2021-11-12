<?php

$paginaAtualPedido = filter_input(INPUT_GET, "pgpedido", FILTER_SANITIZE_NUMBER_INT);
  
  $limiteResultadoPedido = 20;
  $paginaPedido = (!empty($paginaAtualPedido)) ? $paginaAtualPedido : 1;
  
  $inicioPedido = ($limiteResultadoPedido * $paginaPedido) - $limiteResultadoPedido;


if(isset($_GET['coluna'])){
  $coluna = $_GET['coluna'];
} else {
  $coluna = 'NumeroPedido';
}

if(isset($_GET['ordem'])){
  $ordem = $_GET['ordem'];
} else {
  $ordem = 'ASC';
}

if(isset($_GET['opcoes'])){
  $opFiltro = $_GET['opcoes'];
}else{
  $opFiltro = '';
};

$opFiltro = $statusFiltro;

$textoFiltro = $busca;

$selFiltro = 'WHERE '.$opFiltro.' LIKE "%'.$textoFiltro.'%"';

if(empty($opFiltro) || empty($textoFiltro)){
  $selFiltro = '';
}

  $sql = "SELECT * FROM pedidos $selFiltro ORDER BY $coluna $ordem LIMIT $inicioPedido, $limiteResultadoPedido";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $pedidos = $statement->fetchAll(PDO::FETCH_OBJ);
  
  $qtdRegistrosPedido = "SELECT COUNT(NumeroPedido) AS numResultPedido FROM pedidos";
  $resQtdRegistrosPedido = $connection->prepare($qtdRegistrosPedido);
  $resQtdRegistrosPedido->execute();
  $rowQtdRegistrosPedido = $resQtdRegistrosPedido->fetch(PDO::FETCH_ASSOC);
  
  $qtdPgPedido = ceil($rowQtdRegistrosPedido['numResultPedido'] / $limiteResultadoPedido);
  
  $maxLinkPedido = 3;
  
  
  $resultPedidos = '';
  foreach($pedidos as $pedido){
    $resultPedidos .= '<tr>
    <td>'.$pedido->NumeroPedido.'</td>
    <td>'.date('d/m/Y à\s H:i:s',strtotime($pedido->DtPedido)).'</td>
    <td>'.$pedido->Quantidade.'</td>
    <td>'.$pedido->IdProduto.'</td>
    <td>'.$pedido->IdCliente.'</td>
    <td>'.$pedido->StatusPedido.'</td>
    <td>
    <a href="./pedido/detalhesPedido.php?id='.$pedido->NumeroPedido.'" target="_blank" class="btn btn-success">Detalhes</a>
    <a href="./pedido/editarPedido.php?id='.$pedido->NumeroPedido.'" class="btn btn-info">Editar</a>
    <a href="./pedido/excluirPedido.php?id='.$pedido->NumeroPedido.'" class="btn btn-danger">Excluir</a>
    </td>
    </tr>';
  }

  
  echo '<div class="mt-3 d-flex inline">

            <form method="post">
              <div class="row">
                <div class="col">
                  <select class="form-select" aria-label="Default select example" name="status">
                    <option disabled>SELECIONE UM FILTRO</option>
                    <option value="NumeroPedido" >Nº Pedido</option>
                    <option value="DtPedido" >Data Pedido</option>
                    <option value="Quantidade" >Quantidade</option>
                    <option value="IdProduto" >ID Produto</option>
                    <option value="IdCliente" >ID Cliente</option>
                    <option value="StatusPedido" >Status</option>
                  </select>
                </div>

                <div class="col">
                  <input type="text" name="busca" class="form-control" placeholder="Caixa de Busca" value='.$busca.'>
                </div>
                <div class="col d-flex align-items-end">

                  <button type="submit" name="pesquisa" class="btn btn-primary">Filtrar</button>
                </div>
              </div>
            </form>

            <form method="post" class="d-flex flex-row-reverse">
              <button value='.$selFiltro.' type="submit" class="btn btn-warning"> RESETAR FILTROS</button>
            </form>
        </div>';


  echo "
  <table class='table bg-light text-center border-top border border-secondary'>
  
  <thead>
  <tr>
  <th><a href='?pgpedido=$paginaPedido&&coluna=NumeroPedido&&ordem=DESC'><button class='btn btn-info btn-sm'>⮝ </button></a>
  <a href='?pgpedido=$paginaPedido&&coluna=NumeroPedido&&ordem=ASC'><button class='btn btn-info btn-sm'>⮟</button></a><br>N° PEDIDO</th>
  <th><a href='?pgpedido=$paginaPedido&&coluna=DtPedido&&ordem=DESC'><button class='btn btn-info btn-sm'>⮝ </button></a>
  <a href='?pgpedido=$paginaPedido&&coluna=DtPedido&&ordem=ASC'><button class='btn btn-info btn-sm'>⮟</button></a><br>DATA PEDIDO</th>
  <th><a href='?pgpedido=$paginaPedido&&coluna=Quantidade&&ordem=DESC'><button class='btn btn-info btn-sm'>⮝ </button></a>
  <a href='?pgpedido=$paginaPedido&&coluna=Quantidade&&ordem=ASC'><button class='btn btn-info btn-sm'>⮟</button></a><br>QUANTIDADE</th>
  <th><a href='?pgpedido=$paginaPedido&&coluna=IdProduto&&ordem=DESC'><button class='btn btn-info btn-sm'>⮝ </button></a>
  <a href='?pgpedido=$paginaPedido&&coluna=IdProduto&&ordem=ASC'><button class='btn btn-info btn-sm'>⮟</button></a><br>ID PRODUTO</th>
  <th><a href='?pgpedido=$paginaPedido&&coluna=IdCliente&&ordem=DESC'><button class='btn btn-info btn-sm'>⮝ </button></a>
  <a href='?pgpedido=$paginaPedido&&coluna=IdCliente&&ordem=ASC'><button class='btn btn-info btn-sm'>⮟</button></a><br>ID CLIENTE</th>
  <th><a href='?pgpedido=$paginaPedido&&coluna=StatusPedido&&ordem=DESC'><button class='btn btn-info btn-sm'>⮝ </button></a>
  <a href='?pgpedido=$paginaPedido&&coluna=StatusPedido&&ordem=ASC'><button class='btn btn-info btn-sm'>⮟</button></a><br>STATUS</th>
  <th>AÇÕES</th>
  </tr>
  </thead>
  <tbody>        
  <?=$resultPedidos?>
       </tbody>
       
       </table>
       "
       
       ?>
        <nav aria-label="Page navigation example">
          <ul class="pagination">
        <?php  

if(isset($_GET['ordem=']) == "DESC"){
  $ordem = "DESC";
}

echo "<li class='page-item'><a class='page-link' href='index.php?pgpedido=1&&coluna=$coluna&&ordem=$ordem'>Primeira</a></li> "; 

for($paginaAnteriorPedido = $paginaPedido - $maxLinkPedido; $paginaAnteriorPedido <= $paginaPedido -1; $paginaAnteriorPedido++){
  if($paginaAnteriorPedido >=1){
    echo "<li class='page-item'><a class='page-link' href='index.php?pgpedido=$paginaAnteriorPedido&&coluna=$coluna&&ordem=$ordem'>$paginaAnteriorPedido</a></li> ";
  }
}

echo "<li class='page-item' ><a class='page-link disabled bg-dark'>$paginaPedido</a></li>"; 

for($proximaPaginaPedido = $paginaPedido + 1; $proximaPaginaPedido <= $paginaPedido + $maxLinkPedido; $proximaPaginaPedido++){
  if($proximaPaginaPedido <= $qtdPgPedido){
    echo "<li class='page-item'><a class='page-link' href='index.php?pgpedido=$proximaPaginaPedido&&coluna=$coluna&&ordem=$ordem'>$proximaPaginaPedido</a></li> ";
  }
}


echo "<li class='page-item'><a class='page-link' href='index.php?pgpedido=$qtdPgPedido&&coluna=$coluna&&ordem=$ordem'>Última</a></li> "; 

?>
        </ul>
        </nav>

      </section>
        </div>