<?php

require_once("connection.php");


$id = 0;

if (isset($_GET['id'])) 
    $id = $_GET['id'];
    if(! $id) {
        echo "ID inválido!<br>";
        echo "<a href='time_listar.php'>Voltar</a>";
        exit;
    }
    

    $conn = connection::getConnection();
    
    $sql = "DELETE FROM produtos WHERE id = :id";
    $stm = $conn->prepare($sql);
    $stm->execute([$id]);
    
    header("location: listar_produtos.php");
?>
