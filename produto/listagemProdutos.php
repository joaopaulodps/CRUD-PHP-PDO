<?php

$paginaAtualProduto = filter_input(INPUT_GET, "pgproduto", FILTER_SANITIZE_NUMBER_INT);
  $paginaProduto = (!empty($paginaAtualProduto)) ? $paginaAtualProduto : 1;
  
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

$sql = "SELECT * FROM produtos $selFiltro ORDER BY $coluna $ordem LIMIT $inicioProduto, $limiteResultadoProduto";
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
                        <a href="./produto/detalhesProduto.php?id='.$produto->IdProduto.'" target="_blank" class="btn btn-success">Detalhes</a>
                        <a href="./produto/editarProduto.php?id='.$produto->IdProduto.'" class="btn btn-info">Editar</a>
                        <a href="./produto/excluirProduto.php?id='.$produto->IdProduto.'" class="btn btn-danger">Excluir</a>
                    </td>
                  </tr>';
}

echo '<div class="mt-3 d-flex inline">

                <form method="post">
                  <div class="row">
                    <div class="col">
                      <select class="form-select" aria-label="Default select example" name="status">
                        <option disabled>SELECIONE UM FILTRO</option>
                        <option value="IdProduto" >ID</option>
                        <option value="CodBarras" >Código de Barras</option>
                        <option value="NomeProduto" >Nome Produto</option>
                        <option value="ValorUnitario" >Valor Unitário</option>
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
<!-- listagem dos dados da tabela clientes na tela -->
<table class='table bg-light text-center border-top border border-secondary'>

  <thead>
    <tr>
      <th><a href='?pgproduto=$paginaProduto&&coluna=IdProduto&&ordem=DESC'><button class='btn btn-info btn-sm'>⮝ </button></a>
      <a href='?pgproduto=$paginaProduto&&coluna=IdProduto&&ordem=ASC'><button class='btn btn-info btn-sm'>⮟</button></a><br>ID</a></th>
      <th><a href='?pgproduto=$paginaProduto&&coluna=CodBarras&&ordem=DESC'><button class='btn btn-info btn-sm'>⮝ </button></a>
      <a href='?pgproduto=$paginaProduto&&coluna=CodBarras&&ordem=ASC'><button class='btn btn-info btn-sm'>⮟</button></a><br>CODIGO DE BARRAS</a></th>
      <th><a href='?pgproduto=$paginaProduto&&coluna=NomeProduto&&ordem=DESC'><button class='btn btn-info btn-sm'>⮝ </button></a>
      <a href='?pgproduto=$paginaProduto&&coluna=NomeProduto&&ordem=ASC'><button class='btn btn-info btn-sm'>⮟</button></a><br>NOME PRODUTO</a></th>
      <th><a href='?pgproduto=$paginaProduto&&coluna=ValorUnitario&&ordem=DESC'><button class='btn btn-info btn-sm'>⮝ </button></a>
      <a href='?pgproduto=$paginaProduto&&coluna=ValorUnitario&&ordem=ASC'><button class='btn btn-info btn-sm'>⮟</button></a><br>VALOR UNITARIO</a></th>
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
