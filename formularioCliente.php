<?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>

<main>

<section>
    <a href="index.php">
      <button class="btn btn-success">Voltar</button>
    </a>
  </section>

  <h2 class="mt-4"><?=TITLE?></h2>

  <form method="POST">
  
    <div class="form-group">
        <label>Nome</label>
        <input type="text" class="form-control" name="nome" value="<?=VALORCLIENTE?>">
    </div>

    <div class="form-group">
        <label>CPF</label>
        <input type="text" class="form-control" name="cpf" value="<?=VALORCPF?>">
    </div>

    <div class="form-group">
        <label>E-mail</label>
        <input type="text" class="form-control" name="email" value="<?=VALOREMAIL?>">
    </div>

    <div class="form-group mt-3">
      <button type="submit" class="btn btn-success"><?=CONFIRMACAO?></button>
    </div>

  </form>  

</main>