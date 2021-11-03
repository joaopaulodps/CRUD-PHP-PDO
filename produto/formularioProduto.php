<main>
<!-- Formulário usado para a inserção e update na tabela de produtos -->
<section>
    <a href="../index.php">
      <button class="btn btn-success">Voltar</button>
    </a>
  </section>

  <h2 class="mt-4"><?=TITLE?></h2>
  <form method="POST">
  
    <div class="form-group">
        <label>Código de Barras <span class="text-danger font-weight-bold"><?=$errCodBarras?></span></label>
        <input type="text" class="form-control" name="codBarras" value="<?=VALORCB?>">
    </div>

    <div class="form-group">
        <label>Nome do Produto <span class="text-danger font-weight-bold"><?=$errNomProd?></span></label>
        <input type="text" class="form-control" name="nomeProd" value="<?=VALORNP?>">
    </div>

    <div class="form-group">
        <label>Valor Unitário</label>
        <input type="text" class="form-control" name="valUni" value="<?=VALORVU?>">
    </div>

    <div class="form-group mt-3">
      <button type="submit" class="btn btn-success"><?=CONFIRMACAO?></button>
    </div>

  </form>  

</main>