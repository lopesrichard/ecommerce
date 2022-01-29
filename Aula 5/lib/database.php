<?php

function getConnection() {
    return mysqli_connect('localhost', 'root', null, 'ecommerce');
}

function closeConnection($connection) {
    mysqli_close($connection);
}

function fetchMany($result) {
    $data = [];

    for ($i = 0; $i < $result->num_rows; $i++) {
        $data[] = $result->fetch_assoc();
    }

    return $data;
}
