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
        <input type="text" class="form-control" name="codBarras" maxlength="20" pattern="[0-9]+$" value="<?=VALORCB?>">
    </div>

    <div class="form-group">
        <label>Nome do Produto <span class="text-danger font-weight-bold"><?=$errNomProd?></span></label>
        <input type="text" class="form-control" name="nomeProd" maxlength="100" value="<?=VALORNP?>">
    </div>

    <div class="form-group">
        <label>Valor Unitário</label>
        <input type="text" class="form-control" name="valUni" maxlength="14" pattern="[0-9]+(\.[0-9][0-9]?)?" value="<?=VALORVU?>">
    </div>

    <div class="form-group mt-3">
      <button type="submit" class="btn btn-success"><?=CONFIRMACAO?></button>
    </div>

  </form>  

</main>