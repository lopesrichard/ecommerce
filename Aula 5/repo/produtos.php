<?php

require_once 'lib/database.php';
require_once 'lib/debug.php';

function getProdutosEmOferta($connection) {
    $result = mysqli_query($connection, 'select * from produtos order by desconto desc limit 6');
    $produtos = fetchMany($result);

    foreach ($produtos as $i => $produto) {
        $avaliacao = getAvaliacaoMedia($connection, $produto['id']);
        $produtos[$i]['avaliacao'] = $avaliacao;
    }

    return $produtos;
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
