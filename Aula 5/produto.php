<?php

require_once 'lib/format.php';
require_once 'lib/database.php';
require_once 'lib/redirect.php';
require_once 'repo/produtos.php';

if (!isset($_GET['ref'])) {
  redirectToHome();
}

$url = $_GET['ref'];

$connection = getConnection();

$product = getProdutoByUrl($connection, $url);

if ($product == null) {
  redirectToHome();
}

closeConnection($connection);

?>

<?php ob_start(); ?>

<main class="container my-5 bg-white p-5">
  <div class="row">
    <div class="col-12 col-lg-6 d-flex justify-content-center">
      <img class="product-image" src="<?= $product['imagem'] ?>" alt="product image" />
    </div>
    <div class="col-12 col-lg-6 text-center text-lg-start mt-5">
      <h2 class="card-title"><?= $product['nome'] ?></h2>
      <p class="card-rating">
        <?php for ($i = 0; $i < $product['avaliacao']; $i++) : ?>
          <i class="bi bi-star-fill"></i>
        <?php endfor ?>
        <?php for ($i = $product['avaliacao']; $i < 5; $i++) : ?>
          <i class="bi bi-star"></i>
        <?php endfor ?>
      </p>
      <p class="card-original-value"><?= money($product['preco']) ?></p>
      <?php $discounted = $product['preco'] - $product['preco'] * $product['desconto'] / 100 ?>
      <p class="card-discounted-value"><?= money($discounted) ?></p>
      <p class="card-installments">ou 10x de <?= money($discounted / $product['quantidade_parcelas']) ?> sem juros</p>
      <div class="col-12">
        <fieldset class="mt-4">
          <label for="quantidade">Quantidade: </label>
          <input id="quantidade" class="form-control btn-lg" type="number" value="1" min="1" />
        </fieldset>
        <a class="btn btn-primary btn-buy btn-lg mt-2 w-100" href="/carrinho.php">
          Comprar
        </a>
      </div>
    </div>
  </div>
</main>

<?php

$content = ob_get_clean();
$title = 'Produto';
$style = 'produto';
$script = 'produto';

require_once 'base.php';
