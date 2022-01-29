<?php

require_once 'lib/format.php';
require_once 'lib/database.php';
require_once 'lib/debug.php';
require_once 'repo/produtos.php';

$connection = getConnection();

$produtosEmOferta = getProdutosEmOferta($connection);

$sections = [
  'Ofertas' => $produtosEmOferta,
  // 'Mais Vendidos' => [
  //   ['name' => 'Título do Produto', 'rating' => 2, 'value' => 1702, 'discount' => 24, 'installments' => 10, 'image' => 'product.png'],
  //   ['name' => 'Título do Produto', 'rating' => 4, 'value' => 3555, 'discount' => 23, 'installments' => 10, 'image' => 'product.png'],
  //   ['name' => 'Título do Produto', 'rating' => 1, 'value' => 6681, 'discount' => 25, 'installments' => 10, 'image' => 'product.png'],
  //   ['name' => 'Título do Produto', 'rating' => 5, 'value' => 9395, 'discount' => 16, 'installments' => 10, 'image' => 'product.png'],
  //   ['name' => 'Título do Produto', 'rating' => 3, 'value' => 6145, 'discount' => 11, 'installments' => 10, 'image' => 'product.png'],
  //   ['name' => 'Título do Produto', 'rating' => 1, 'value' => 2947, 'discount' => 10, 'installments' => 10, 'image' => 'product.png'],
  // ],
  // 'Recomendados' => [
  //   ['name' => 'Título do Produto', 'rating' => 5, 'value' => 6875, 'discount' => 17, 'installments' => 10, 'image' => 'product.png'],
  //   ['name' => 'Título do Produto', 'rating' => 5, 'value' => 9439, 'discount' => 16, 'installments' => 10, 'image' => 'product.png'],
  //   ['name' => 'Título do Produto', 'rating' => 4, 'value' => 1043, 'discount' => 16, 'installments' => 10, 'image' => 'product.png'],
  //   ['name' => 'Título do Produto', 'rating' => 3, 'value' => 3143, 'discount' => 27, 'installments' => 10, 'image' => 'product.png'],
  //   ['name' => 'Título do Produto', 'rating' => 2, 'value' => 7172, 'discount' => 30, 'installments' => 10, 'image' => 'product.png'],
  //   ['name' => 'Título do Produto', 'rating' => 3, 'value' => 8479, 'discount' => 30, 'installments' => 10, 'image' => 'product.png'],
  // ],
  // 'Novidades' => [
  //   ['name' => 'Título do Produto', 'rating' => 5, 'value' => 2066, 'discount' => 29, 'installments' => 10, 'image' => 'product.png'],
  //   ['name' => 'Título do Produto', 'rating' => 2, 'value' => 3669, 'discount' => 23, 'installments' => 10, 'image' => 'product.png'],
  //   ['name' => 'Título do Produto', 'rating' => 3, 'value' => 1995, 'discount' => 23, 'installments' => 10, 'image' => 'product.png'],
  //   ['name' => 'Título do Produto', 'rating' => 1, 'value' => 7675, 'discount' => 15, 'installments' => 10, 'image' => 'product.png'],
  //   ['name' => 'Título do Produto', 'rating' => 4, 'value' => 4112, 'discount' => 25, 'installments' => 10, 'image' => 'product.png'],
  //   ['name' => 'Título do Produto', 'rating' => 4, 'value' => 3570, 'discount' => 25, 'installments' => 10, 'image' => 'product.png'],
  // ],
];

closeConnection($connection);

?>

<?php ob_start(); ?>

<img class="img-fluid" src="/images/banner.jpg" alt="banner" />

<main class="container">
  <?php foreach ($sections as $section => $produtos) : ?>
    <section>
      <h1 class="section-title"><?= $section ?></h1>
      <div class="row g-2">
        <?php foreach ($produtos as $produto) : ?>
          <div class="col-12 col-lg-4">
            <a href="produto.php">
              <div class="card p-3">
                <div class="row">
                  <div class="col-4">
                    <img class="card-img img-fluid rounded-start" src="<?= $produto['imagem'] ?>" alt="product" />
                  </div>
                  <div class="col-8 d-flex flex-column justify-content-center">
                    <h2 class="card-title"><?= $produto['nome'] ?></h2>
                    <p class="card-rating">
                      <?php for ($i = 0; $i < $produto['avaliacao']; $i++) : ?>
                        <i class="bi bi-star-fill"></i>
                      <?php endfor ?>
                      <?php for ($i = $produto['avaliacao']; $i < 5; $i++) : ?>
                        <i class="bi bi-star"></i>
                      <?php endfor ?>
                    </p>
                    <p class="card-original-value"><?= money($produto['preco']) ?></p>
                    <?php $discounted = $produto['preco'] - $produto['preco'] * $produto['desconto'] / 100 ?>
                    <p class="card-discounted-value"><?= money($discounted) ?></p>
                    <p class="card-installments">ou <?= $produto['quantidade_parcelas'] ?>x de <?= money($discounted / $produto['quantidade_parcelas']) ?> sem juros</p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        <?php endforeach ?>
      </div>
    </section>
  <?php endforeach ?>
</main>

<?php

$content = ob_get_clean();
$title = 'Página Inicial';
$style = 'index';
$script = 'index';

require_once 'base.php';
