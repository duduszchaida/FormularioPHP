<?php
require_once("connection.php");

$conn = connection::getConnection();

    $sql = "SELECT * FROM produtos";
    $stm = $conn->prepare($sql);
    $stm->execute();
    $produtos = $stm->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Listagem de Produtos</title>
</head>
<body>
    <h1>Listagem de Produtos</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Descrição</th>
            <th>Unidade de Medida</th>
            <th>Ação</th>
        </tr>
        <?php foreach ($produtos as $produto): ?>
        <tr>
            <td><?= $produto['id'] ?></td>
            <td><?= $produto['descricao'] ?></td>
            <td><?= $produto['un_medida'] ?></td>
            <td><a href="excluir_produtos.php?id=<?= $produto['id'] ?>">Excluir</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br></br>
    <a href="cadastrar_produtos.php">Cadastrar Produto</a>
</body>
</html>
