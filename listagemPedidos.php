<?php

$paginaAtualPedido = filter_input(INPUT_GET, "pgpedido", FILTER_SANITIZE_NUMBER_INT);
  
  $limiteResultadoPedido = 20;
  $paginaPedido = (!empty($paginaAtualPedido)) ? $paginaAtualPedido : 1;
  var_dump($paginaPedido);
  
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

$sql = "SELECT * FROM pedidos ORDER BY $coluna $ordem LIMIT $inicioPedido, $limiteResultadoPedido";
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
                    <td>'.$pedido->DtPedido.'</td>
                    <td>'.$pedido->Quantidade.'</td>
                    <td>'.$pedido->IdProduto.'</td>
                    <td>'.$pedido->IdCliente.'</td>
                    <td>'.$pedido->IdCliente.'</td>
                    <td>
                        <a href="./pedido/detalhesPedido.php?id='.$pedido->NumeroPedido.'" class="btn btn-success">Detalhes</a>
                        <a href="./pedido/editarPedido.php?id='.$pedido->NumeroPedido.'" class="btn btn-info">Editar</a>
                        <a href="./pedido/excluirPedido.php?id='.$pedido->NumeroPedido.'" class="btn btn-danger">Excluir</a>
                    </td>
                  </tr>';
}
?>
<?php 
         
        $ordem == 'DESC' ? $ordem = 'ASC' : $ordem = 'DESC';

         echo "
         <table class='table bg-light text-center border-top border border-secondary'>

          <thead>
            <tr>
              <th><a href='?pgpedido=$paginaPedido&&coluna=NumeroPedido&&ordem=$ordem'>N° PEDIDO</a></th>
              <th><a href='?pgpedido=$paginaPedido&&coluna=DtPedido&&ordem=$ordem'>DATA PEDIDO</a></th>
              <th><a href='?pgpedido=$paginaPedido&&coluna=Quantidade&&ordem=$ordem'>QUANTIDADE</a></th>
              <th><a href='?pgpedido=$paginaPedido&&coluna=IdProduto&&ordem=$ordem'>ID PRODUTO</a></th>
              <th><a href='?pgpedido=$paginaPedido&&coluna=IdCliente&&ordem=$ordem'>ID CLIENTE</a></th>
              <th><a href='?pgpedido=$paginaPedido&&coluna=$coluna&&ordem=$ordem'>STATUS</a></th>
              <th>AÇÕES</th>
            </tr>
          </thead>
         ";
         echo "
         <tbody>        
         <?=$resultPedidos?>
       </tbody>
       
       </table>
       "
       ?>
        
    
        <nav aria-label="Page navigation example">
          <ul class="pagination">
        <?php  
        
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