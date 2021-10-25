<?php

require 'db.php';
$sql = 'SELECT * FROM clientes';
$statement = $connection->prepare($sql);
$statement->execute();
$clientes = $statement->fetchAll(PDO::FETCH_OBJ);

$resultados = '';
foreach($clientes as $cliente){
  $resultados .= '<tr>
                    <td>'.$cliente->Id.'</td>
                    <td>'.$cliente->NomeCliente.'</td>
                    <td>'.$cliente->CPF.'</td>
                    <td>'.$cliente->Email.'</td>
                    <td>
                        <a href="editarCliente.php?id='.$cliente->Id.'"><button class="btn btn-info">Editar</button></a>
                        <a href="excluirCliente.php?id='.$cliente->Id.'"><button class="btn btn-danger">Excluir</button></a>
                    </td>
                  </tr>';
}


?>

<main>

<section>
    <a href="cadastrarCliente.php">
      <button class="btn btn-success">Cadastrar</button>
    </a>
  </section>

  <section>
  
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