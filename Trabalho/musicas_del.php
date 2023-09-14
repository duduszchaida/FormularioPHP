<?php

include_once("persistencia.php");


$id = "";
if (isset($_GET['id']))
    $id = $_GET['id'];

if (!$id) {
    echo "ID da música não informado!";
    echo "<br>";
    echo "<a href='musicas.php'>Voltar</a>";
    exit;
}


$musicas = buscarDados();


$index = -1;
foreach ($musicas as $i => $m) {
    if ($id == $m['id']) {
        $index = $i;
        break;
    }
}


if ($index < 0) {
    echo "ID da música não encontrado!";
    echo "<br>";
    echo "<a href='musicas.php'>Voltar</a>";
    exit;
}


array_splice($musicas, $index, 1);


salvarDados($musicas);


header("location: musicas.php");
