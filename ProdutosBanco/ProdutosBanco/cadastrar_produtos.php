<?php
include_once("connection.php");

if (isset($_GET['descricao']) && isset($_GET['un_medida'])) {
    $descricao = $_GET['descricao'];
    $un_medida = $_GET['un_medida'];

    try {
        $conn = connection::getConnection();

        $qsql = "INSERT INTO produtos (descricao, un_medida) VALUES (:descricao, :un_medida)";
        $stm = $conn->prepare($qsql);
        $stm->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stm->bindParam(':un_medida', $un_medida, PDO::PARAM_STR);
        $stm->execute();
        
    } catch (PDOException $e) {
        die("Erro ao cadastrar o produto: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Produto</title>
</head>
<body>
    <h1>Cadastro de Produto</h1>
    <form method="get">
        <label for="descricao">Descrição:</label>
        <input type="text" name="descricao" required><br>
        
        <label for="unidade_medida">Unidade de Medida:</label>
        <input type="text" name="un_medida" required><br>

        <input type="submit" value="Cadastrar">
    </form>
    <a href="listar_produtos.php">Lista de Produtos</a>
</body>
</html>
