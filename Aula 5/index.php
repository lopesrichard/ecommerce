<?php

require_once 'lib/format.php';
require_once 'lib/database.php';
require_once 'lib/debug.php';
require_once 'repo/produtos.php';

$connection = getConnection();

$produtosEmOferta = getProdutosEmOferta($connection);
$produtosMaisVendidos = getProdutosMaisVendidos($connection);
$produtosNovos = getProdutosNovos($connection);
$produtosRecomendados = getProdutosRecomendados($connection);

$sections = [
  'Ofertas' => $produtosEmOferta,
  'Mais Vendidos' => $produtosMaisVendidos,
  'Recomendados' => $produtosRecomendados,
  'Novidades' => $produtosNovos,
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
            <a href="produto.php?ref=<?= $produto['url'] ?>">
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
