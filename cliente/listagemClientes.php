<?php 

//método resposável pela paginação da tabela clientes

//método responsável por buscar a pagina atual
$paginaAtualCliente = filter_input(INPUT_GET, "pgcliente", FILTER_SANITIZE_NUMBER_INT);
$paginaCliente = (!empty($paginaAtualCliente)) ? $paginaAtualCliente : 1;

//limite de resultados listados por pagina
$limiteResultadoCliente = 20;

//variavel de busca da pagina na tabela
$inicioCliente = ($limiteResultadoCliente * $paginaCliente) - $limiteResultadoCliente;


//dados para o inicio padrão das ordenações de campos
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

//verifica se as variaveis de filtro estão vazias ou com dados
if(isset($_GET['opcoes'])){
    $opFiltro = $_GET['opcoes'];
}else{
    $opFiltro = '';
    };

$opFiltro = $statusFiltro;

$textoFiltro = $busca;

//variavel que adiciona ou não o WHERE na requisição do BD
$selFiltro = 'WHERE '.$opFiltro.' LIKE "%'.$textoFiltro.'%"';

if(empty($opFiltro) || empty($textoFiltro)){
    $selFiltro = '';
}

//método resposável por buscar os dados na tabela clientes
$sql = "SELECT * FROM clientes $selFiltro ORDER BY $coluna $ordem LIMIT $inicioCliente, $limiteResultadoCliente";
$statement = $connection->prepare($sql);
$statement->execute();
$clientes = $statement->fetchAll(PDO::FETCH_OBJ);

//método criado para determinar quais resultados devem ser exibidos nas páginas
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

/* campo de filtro da tabela clientes */
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

/* cabeçalho da tabela clientes e botões de ordenação de campos */
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
/* mostra os resultados da busca na tabela clientes */
echo "
        <tbody>        
            <?=$resultClientes?>
        </tbody>

    </table>
";
?> 

<!-- botões de paginação -->
<nav aria-label="Page navigation example">
<ul class="pagination">
<?php  
/* botão para a primeira página */
echo "<li class='page-item'><a class='page-link' href='index.php?pgcliente=1&&coluna=$coluna&&ordem=$ordem'>Primeira</a></li> "; 

for($paginaAnteriorCliente = $paginaCliente - $maxLinkCliente; $paginaAnteriorCliente <= $paginaCliente -1; $paginaAnteriorCliente++){
if($paginaAnteriorCliente >=1){
/* botão para a pagina anterior */
echo "<li class='page-item'><a class='page-link' href='index.php?pgcliente=$paginaAnteriorCliente&&coluna=$coluna&&ordem=$ordem'>$paginaAnteriorCliente</a></li> ";
}
}
/* pagina atual */
echo "<li class='page-item' ><a class='page-link disabled bg-dark'>$paginaCliente</a></li>"; 

for($proximaPaginaCliente = $paginaCliente + 1; $proximaPaginaCliente <= $paginaCliente + $maxLinkCliente; $proximaPaginaCliente++){
if($proximaPaginaCliente <= $qtdPgCliente){
/* proxima pagina */
echo "<li class='page-item'><a class='page-link' href='index.php?pgcliente=$proximaPaginaCliente&&coluna=$coluna&&ordem=$ordem'>$proximaPaginaCliente</a></li> ";
}
}
/* ultima pagina */
echo "<li class='page-item'><a class='page-link' href='index.php?pgcliente=$qtdPgCliente&&coluna=$coluna&&ordem=$ordem'>Última</a></li> "; 

?>
</ul>
</nav>