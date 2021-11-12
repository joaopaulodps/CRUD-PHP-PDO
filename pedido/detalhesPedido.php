<?php
require '../db.php';

require '../header.php';

//método resposável por buscar os dados do BD na tabela pedidos
$id = $_GET['id'];
$sql = 'SELECT * FROM pedidos WHERE NumeroPedido=:numPedido';
$statement = $connection->prepare($sql);
$statement->execute([':numPedido'=>$id]);
$pedido = $statement->fetch(PDO::FETCH_OBJ);

$errQtPedido = '';
$errIdProduto = '';
$errIdCliente = '';
$msg = '';

$idCliente = $pedido->IdCliente;
$idProduto = $pedido->IdProduto;

define('numeroPedido',$pedido->NumeroPedido);
define('dataPedido',$pedido->DtPedido);
define('VALORQP',$pedido->Quantidade);
define('VALORIP',$pedido->IdProduto);
define('VALORIC',$pedido->IdCliente);
define('StatusPedido',$pedido->StatusPedido);

//método resposável por buscar os dados do BD na tabela pedidos
$idClt = $idCliente;
$sql = 'SELECT * FROM clientes WHERE Id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id'=>$idClt]);
$cliente = $statement->fetch(PDO::FETCH_OBJ);

define('nomeCliente', $cliente->NomeCliente);
define('cpfCliente', $cliente->CPF);
define('emailCliente', $cliente->Email);

//método resposável por buscar os dados do BD na tabela produtos
$idPdt = $idProduto;
$sql = 'SELECT * FROM produtos WHERE IdProduto=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id'=>$idPdt]);
$produto = $statement->fetch(PDO::FETCH_OBJ);

define('codBarras', $produto->CodBarras);
define('nomeProduto', $produto->NomeProduto);
define('valorUnitario', $produto->ValorUnitario);
?>

<!-- listagem dos detalhes do pedido -->
<section>
    <a href="../index.php?pgpedido">
        <button class="btn btn-success">Voltar</button>
    </a>
</section>

<h1>DETALHES DO PEDIDO Nº <?= numeroPedido ?></h1>
    <h2>DETALHES DO PEDIDO</h2>
        <table class='table bg-light text-center border-top border border-secondary'>
            <thead>
                <th>DATA DO PEDIDO</th>
                <th>QUANTIDADE DE PRODUTOS</th>
                <th>STATUS DO PEDIDO</th>
            </thead>
            <tbody>
                <tr>
                    <td><?= dataPedido ?></td>
                    <td><?= VALORQP ?></td>
                    <td><?= StatusPedido ?></td>
                </tr>
            </tbody>
        </table>

<!-- listagem dos detalhes do produto -->    
<h2>DETALHES DO PRODUTO</h2>
    <table class='table bg-light text-center border-top border border-secondary'>
        <thead>
            <th>ID PRODUTO</th>
            <th>NOME DO PRODUTO</th>
            <th>CÓDIGO DE BARRAS</th>
            <th>VALOR UNITÁRIO</th>
        </thead>
        <tbody>
            <tr>
                <td><?= VALORIP ?></td>
                <td><?= nomeProduto ?></td>
                <td><?= codBarras ?></td>
                <td><?= valorUnitario ?></td>
            </tr>
        </tbody>
    </table>

<!-- listagem dos detalhes do cliente -->
<h2>DETALHES DO CLIENTE</h2>
    <table class='table bg-light text-center border-top border border-secondary'>
        <thead>
            <th>ID CLIENTE</th>
            <th>NOME DO CLIENTE</th>
            <th>CPF</th>
            <th>E-MAIL</th>
        </thead>
        <tbody>
            <tr>
                <td><?= VALORIC ?></td>
                <td><?= nomeCliente ?></td>
                <td><?= cpfCliente ?></td>
                <td><?= emailCliente ?></td>
            </tr>
        </tbody>
    </table>

<?php 
require '../footer.php';
?>