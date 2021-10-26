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


//listagem dos resultados da tabela cliente, do banco de dados
$resultados = '';
foreach($clientes as $cliente){
  $resultados .= '<tr>
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


?>

<main>
 <?= $mensagem?>
<section>
    <a href="cadastrarCliente.php">
      <button class="btn btn-success">Cadastrar</button>
    </a>
  </section>

  <section>
  <!-- listagem dos dados da tabela clientes na tela -->
    <table class="table bg-light mt-3 text-center">

        <thead>
          <tr>
            <th>ID</th>
            <th>NOME</th>
            <th>CPF</th>
            <th>E-MAIL</th>
            <th>AÇÔES</th>
          </tr>
        </thead>
        <tbody>        
        <?=$resultados?>
        </tbody>

    </table>
  
  </section>

</main>