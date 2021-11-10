<?php

$paginaAtualProduto = filter_input(INPUT_GET, "pgproduto", FILTER_SANITIZE_NUMBER_INT);
  $paginaProduto = (!empty($paginaAtualProduto)) ? $paginaAtualProduto : 1;
  var_dump($paginaProduto);
  
  $limiteResultadoProduto = 20;
  
  $inicioProduto = ($limiteResultadoProduto * $paginaProduto) - $limiteResultadoProduto;  

  if(isset($_GET['coluna'])){
    $coluna = $_GET['coluna'];
  } else {
    $coluna = 'IdProduto';
  }
  
  if(isset($_GET['ordem'])){
    $ordem = $_GET['ordem'];
  } else {
    $ordem = 'ASC';
  }

$sql = "SELECT * FROM produtos ORDER BY $coluna $ordem LIMIT $inicioProduto, $limiteResultadoProduto";
$statement = $connection->prepare($sql);
$statement->execute();
$produtos = $statement->fetchAll(PDO::FETCH_OBJ);

$qtdRegistrosProduto = "SELECT COUNT(idProduto) AS numResultProd FROM produtos";
  $resQtdRegistrosProduto = $connection->prepare($qtdRegistrosProduto);
  $resQtdRegistrosProduto->execute();
  $rowQtdRegistrosProduto = $resQtdRegistrosProduto->fetch(PDO::FETCH_ASSOC);
  
  $qtdPgProduto = ceil($rowQtdRegistrosProduto['numResultProd'] / $limiteResultadoProduto);

  $maxLinkProduto = 3;

  //listagem dos resultados da tabela PRODUTOS, do banco de dados
$resultProdutos = '';
foreach($produtos as $produto){
  $resultProdutos .= '<tr>
                    <td>'.$produto->IdProduto.'</td>
                    <td>'.$produto->CodBarras.'</td>
                    <td>'.$produto->NomeProduto.'</td>
                    <td>'.number_format($produto->ValorUnitario, 2,',', ' ').'</td>
                    <td>
                        <a href="./produto/editarProduto.php?id='.$produto->IdProduto.'" class="btn btn-info">Editar</a>
                        <a href="./produto/excluirProduto.php?id='.$produto->IdProduto.'" class="btn btn-danger">Excluir</a>
                    </td>
                  </tr>';
}

$ordem == 'DESC' ? $ordem = 'ASC' : $ordem = 'DESC';
 
    echo "
<!-- listagem dos dados da tabela clientes na tela -->
<table class='table bg-light text-center border-top border border-secondary'>

  <thead>
    <tr>
      <th><a href='?pgproduto=$paginaProduto&&coluna=IdProduto&&ordem=$ordem'>ID</a></th>
      <th><a href='?pgcliente=$paginaCliente&&coluna=CodBarras&&ordem=$ordem'>CODIGO DE BARRAS</a></th>
      <th><a href='?pgcliente=$paginaCliente&&coluna=NomeProduto&&ordem=$ordem'>NOME PRODUTO</a></th>
      <th><a href='?pgcliente=$paginaCliente&&coluna=ValorUnitario&&ordem=$ordem'>VALOR UNITARIO</a></th>
      <th>AÇÔES</th>
    </tr>
  </thead>
  ";
  echo "
  <tbody>        
    <?=$resultProdutos?>
  </tbody>

</table>
";
?>
<nav aria-label="Page navigation example">
  <ul class="pagination">
<?php  

echo "<li class='page-item'><a class='page-link' href='index.php?pgproduto=1&&coluna=$coluna&&ordem=$ordem'>Primeira</a></li> "; 

for($paginaAnteriorProduto = $paginaProduto - $maxLinkProduto; $paginaAnteriorProduto <= $paginaProduto -1; $paginaAnteriorProduto++){
  if($paginaAnteriorProduto >=1){
    echo "<li class='page-item'><a class='page-link' href='index.php?pgproduto=$paginaAnteriorProduto&&coluna=$coluna&&ordem=$ordem'>$paginaAnteriorProduto</a></li> ";
  }
}

echo "<li class='page-item' ><a class='page-link disabled bg-dark'>$paginaProduto</a></li>"; 

for($proximaPaginaProduto = $paginaProduto + 1; $proximaPaginaProduto <= $paginaProduto + $maxLinkProduto; $proximaPaginaProduto++){
  if($proximaPaginaProduto <= $qtdPgProduto){
    echo "<li class='page-item'><a class='page-link' href='index.php?pgproduto=$proximaPaginaProduto&&coluna=$coluna&&ordem=$ordem'>$proximaPaginaProduto</a></li> ";
  }
}


echo "<li class='page-item'><a class='page-link' href='index.php?pgproduto=$qtdPgProduto&&coluna=$coluna&&ordem=$ordem'>Última</a></li> "; 
        
?>
</ul>
</nav>
