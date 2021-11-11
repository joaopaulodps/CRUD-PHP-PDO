<?php 

$paginaAtualCliente = filter_input(INPUT_GET, "pgcliente", FILTER_SANITIZE_NUMBER_INT);
$paginaCliente = (!empty($paginaAtualCliente)) ? $paginaAtualCliente : 1;
var_dump($paginaCliente);

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


$sql = "SELECT * FROM clientes ORDER BY $coluna $ordem LIMIT $inicioCliente, $limiteResultadoCliente";
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
                        <a href="./cliente/editarCliente.php?id='.$cliente->Id.'" class="btn btn-info">Editar</a>
                        <a href="./cliente/excluirCliente.php?id='.$cliente->Id.'" class="btn btn-danger">Excluir</a>
                    </td>
                  </tr>';
}

         
         $ordem == 'DESC' ? $ordem = 'ASC' : $ordem = 'DESC';
 
          echo "<table class='table bg-light text-center border-top border border-secondary'>
 
           <thead>
             <tr>
               <th><a href='?pgcliente=$paginaCliente&&coluna=Id&&ordem=$ordem'>ID</a></th>
               <th><a href='?pgcliente=$paginaCliente&&coluna=NomeCliente&&ordem=$ordem'>NOME CLIENTE</th>
               <th><a href='?pgcliente=$paginaCliente&&coluna=CPF&&ordem=$ordem'>CPF</th>
               <th><a href='?pgcliente=$paginaCliente&&coluna=Email&&ordem=$ordem'>E-MAIL</th>
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