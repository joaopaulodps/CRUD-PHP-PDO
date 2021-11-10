<main>
<!-- Formulário usado para a inserção e update na tabela de pedidos -->
<section>
    <a href="../index.php">
      <button class="btn btn-success">Voltar</button>
    </a>
  </section>

  <h2 class="mt-4"><?=TITLE?></h2>
  <form method="POST">

    <div class="form-group">
        <label>Id Produto <span class="text-danger font-weight-bold"><?=$errIdProduto?></span></label>
        <input type="text" class="form-control" name="idProduto" value="<?=VALORIP?>">
    </div>

    <div class="form-group">
        <label>Id Cliente <span class="text-danger font-weight-bold"><?=$errIdCliente?></span></label>
        <input type="text" class="form-control" name="idCliente" value="<?=VALORIC?>">
    </div>

    <div class="form-group">
        <label>Quantidade <span class="text-danger font-weight-bold"><?=$errQtPedido?></span></label>
        <input type="text" class="form-control" name="qtPedido" value="<?=VALORQP?>">
    </div>

    <div class="form-group mt-3">
      <button type="submit" class="btn btn-success"><?=CONFIRMACAO?></button>
    </div>

  </form>  

</main>