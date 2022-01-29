<?php

require_once 'lib/database.php';
require_once 'lib/debug.php';

function getProdutos($connection, $query) {
    $result = mysqli_query($connection, $query);
    $produtos = fetchMany($result);

    foreach ($produtos as $i => $produto) {
        $avaliacao = getAvaliacaoMedia($connection, $produto['id']);
        $produtos[$i]['avaliacao'] = $avaliacao;
    }

    return $produtos;
}

function getProdutosEmOferta($connection) {
    return getProdutos($connection, 'select * from produtos order by desconto desc limit 6');
}

function getProdutosMaisVendidos($connection) {
    return getProdutos($connection, '
        select p.*, sum(quantidade) as quantidade
        from pedidos_produtos as pp
        join produtos as p on p.id = pp.produto_id
        group by produto_id
        order by quantidade desc
        limit 6;
    ');
}

function getProdutosNovos($connection) {
    return getProdutos($connection, 'select * from produtos order by criado_em desc limit 6');
}

function getProdutosRecomendados($connection) {
    return getProdutos($connection, 'select * from produtos order by rand() desc limit 6');
}

function getAvaliacaoMedia($connection, $produtoId) {
    $result = mysqli_query($connection, 'select * from avaliacoes where produto_id = ' . $produtoId);
    $avaliacoes = fetchMany($result);

    if ($result->num_rows === 0) {
        return 0;
    }

    $total = 0;

    foreach ($avaliacoes as $avaliacao) {
        $total += $avaliacao['nota'];
    }

    return $total / $result->num_rows;
}
