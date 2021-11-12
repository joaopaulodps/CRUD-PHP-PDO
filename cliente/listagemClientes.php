<?php 

$paginaAtualCliente = filter_input(INPUT_GET, "pgcliente", FILTER_SANITIZE_NUMBER_INT);
$paginaCliente = (!empty($paginaAtualCliente)) ? $paginaAtualCliente : 1;

$limiteResultadoCliente = 20;

$inicioCliente = ($limiteResultadoCliente * $paginaCliente) - $limiteResultadoCliente;

if(isset($_GET['coluna'])){
  $coluna = $_GET['coluna'];
} else {
  $coluna = 'Id';
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

$sql = "SELECT * FROM clientes $selFiltro ORDER BY $coluna $ordem LIMIT $inicioCliente, $limiteResultadoCliente";
$statement = $connection->prepare($sql);
$statement->execute();
$clientes = $statement->fetchAll(PDO::FETCH_OBJ);

  $qtdRegistrosCliente = "SELECT COUNT(id) AS numResult FROM clientes";
  $resQtdRegistrosCliente = $connection->prepare($qtdRegistrosCliente);
  $resQtdRegistrosCliente->execute();
  $rowQtdRegistrosCliente = $resQtdRegistrosCliente->fetch(PDO::FETCH_ASSOC);
  
  $qtdPgCliente = ceil($rowQtdRegistrosCliente['numResult'] / $limiteResultadoCliente);

  $maxLinkCliente = 3;
  
  //listagem dos resultados da tabela CLIENTES, do banco de dados
$resultClientes = '';
foreach($clientes as $cliente){
  $resultClientes .= '<tr>
                    <td>'.$cliente->Id.'</td>
                    <td>'.$cliente->NomeCliente.'</td>
                    <td>'.$cliente->CPF.'</td>
                    <td>'.$cliente->Email.'</td>
                    <td>
                        <a href="./cliente/detalhesCliente.php?id='.$cliente->Id.'" target="_blank" class="btn btn-success">Detalhes</a>
                        <a href="./cliente/editarCliente.php?id='.$cliente->Id.'" class="btn btn-info">Editar</a>
                        <a href="./cliente/excluirCliente.php?id='.$cliente->Id.'" class="btn btn-danger">Excluir</a>
                    </td>
                  </tr>';
                  
                }

                echo '<div class="mt-3 d-flex inline">

                <form method="post">
                  <div class="row">
                    <div class="col">
                      <select class="form-select" aria-label="Default select example" name="status">
                        <option disabled>SELECIONE UM FILTRO</option>
                        <option value="Id" >ID</option>
                        <option value="NomeCliente" >Nome Cliente</option>
                        <option value="CPF" >CPF</option>
                        <option value="Email" >E-mail</option>
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
         
 
          echo "<table class='table bg-light text-center border-top border border-secondary'>
 
           <thead>
             <tr>
               <th><a href='?pgcliente=$paginaCliente&&coluna=Id&&ordem=DESC'><button class='btn btn-info btn-sm'>⮝ </button></a>
               <a href='?pgcliente=$paginaCliente&&coluna=Id&&ordem=ASC'><button class='btn btn-info btn-sm'>⮟</button></a><br>ID</a></th>
               <th><a href='?pgcliente=$paginaCliente&&coluna=NomeCliente&&ordem=DESC'><button class='btn btn-info btn-sm'>⮝ </button></a>
               <a href='?pgcliente=$paginaCliente&&coluna=NomeCliente&&ordem=ASC'><button class='btn btn-info btn-sm'>⮟</button></a><br>NOME CLIENTE</th>
               <th><a href='?pgcliente=$paginaCliente&&coluna=CPF&&ordem=DESC'><button class='btn btn-info btn-sm'>⮝ </button></a>
               <a href='?pgcliente=$paginaCliente&&coluna=CPF&&ordem=ASC'><button class='btn btn-info btn-sm'>⮟</button></a><br>CPF</th>
               <th><a href='?pgcliente=$paginaCliente&&coluna=Email&&ordem=DESC'><button class='btn btn-info btn-sm'>⮝ </button></a>
               <a href='?pgcliente=$paginaCliente&&coluna=Email&&ordem=ASC'><button class='btn btn-info btn-sm'>⮟</button></a><br>E-MAIL</th>
               <th>AÇÔES</th>
             </tr>
           </thead>
           ";
           echo "
           <tbody>        
           <?=$resultClientes?>
           </tbody>
           
           </table>
           ";
          ?> 
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php  
         
                echo "<li class='page-item'><a class='page-link' href='index.php?pgcliente=1&&coluna=$coluna&&ordem=$ordem'>Primeira</a></li> "; 
        
                for($paginaAnteriorCliente = $paginaCliente - $maxLinkCliente; $paginaAnteriorCliente <= $paginaCliente -1; $paginaAnteriorCliente++){
                if($paginaAnteriorCliente >=1){
                    echo "<li class='page-item'><a class='page-link' href='index.php?pgcliente=$paginaAnteriorCliente&&coluna=$coluna&&ordem=$ordem'>$paginaAnteriorCliente</a></li> ";
                }
                }
                
                echo "<li class='page-item' ><a class='page-link disabled bg-dark'>$paginaCliente</a></li>"; 
                
                for($proximaPaginaCliente = $paginaCliente + 1; $proximaPaginaCliente <= $paginaCliente + $maxLinkCliente; $proximaPaginaCliente++){
                if($proximaPaginaCliente <= $qtdPgCliente){
                    echo "<li class='page-item'><a class='page-link' href='index.php?pgcliente=$proximaPaginaCliente&&coluna=$coluna&&ordem=$ordem'>$proximaPaginaCliente</a></li> ";
                }
                }
            
                
                 echo "<li class='page-item'><a class='page-link' href='index.php?pgcliente=$qtdPgCliente&&coluna=$coluna&&ordem=$ordem'>Última</a></li> "; 
                 
            ?>
        </ul>
    </nav>