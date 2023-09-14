<?php
function segundosParaMinutos($segundos) {
    $minutos = floor($segundos / 60);
    $segundosRestantes = $segundos % 60;
    return sprintf("%02d:%02d", $minutos, $segundosRestantes);
}


ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once("persistencia.php");

$musicas = buscarDados();

$msgErro = "";

$titulo = "";
$genero = "";
$duracao = "";
$artista = "";

if (isset($_POST['submetido'])) {
    $titulo = $_POST['titulo'];
    $genero = $_POST['genero'];
    $duracao = $_POST['duracao'];
    $artista = $_POST['artista'];

    $erros = array();

    
    if (!trim($titulo))
        array_push($erros, "Informe o título!");

    if (!trim($genero))
        array_push($erros, "Informe o gênero!");

    if (!$duracao)
        array_push($erros, "Informe a duração!");

    if (!trim($artista))
        array_push($erros, "Informe o artista!");

    if (!$erros) { 
       
        if ($duracao <= 0)
            array_push($erros, "A duração deve ser maior que zero!");

        
        if (strlen($titulo) < 3 || strlen($titulo) > 50)
            array_push($erros, "O título deve ter entre 3 e 50 caracteres!");

        
        $tituloExiste = false;
        foreach ($musicas as $m) {
            if ($titulo == $m['titulo']) {
                $tituloExiste = true;
                break;
            }
        }
        if ($tituloExiste)
            array_push($erros, "O título desta música já foi cadastrado!");
    }

    if (!$erros) { // Apenas se passou por todas as validações
        $id = vsprintf('%s%s-%s-%s-%s-%s%s%s',
            str_split(bin2hex(random_bytes(16)), 4));

        $musica = array('id' => $id,
            'titulo' => $titulo,
            'genero' => $genero,
            'duracao' => $duracao,
            'artista' => $artista);
        array_push($musicas, $musica);

       
        salvarDados($musicas);

        
        header("location: musicas.php");
    } else
        
        $msgErro = implode("<br>", $erros);
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Músicas</title>
</head>

<body>

    <h1>Cadastro de Músicas</h1>

    <h3>Formulário de Músicas</h3>
    <form action="" method="POST" onsubmit="return validar()">
        <input type="text" name="titulo"
            placeholder="Informe o título"
            value="<?= $titulo ?>" />

        <br><br>

        <select name="genero">
            <option value="">---Selecione o gênero---</option>
            <option value="Sertanejo" <?php if ($genero == 'Sertanejo') echo 'selected'; ?>>Sertanejo</option>
            <option value="Pagode" <?php if ($genero == 'Pagode') echo 'selected'; ?>>Pagode</option>
            <option value="Samba" <?php if ($genero == 'Samba') echo 'selected'; ?>>Samba</option>
            <option value="Fanqui" <?php if ($genero == 'Fanqui') echo 'selected'; ?>>Fanqui</option>
        </select>

        <br><br>

        <input type="number" name="duracao"
            placeholder="Informe a duração (em segundos)"
            value="<?= $duracao ?>" />

        <br><br>

        <input type="text" name="artista"
            placeholder="Informe o nome do artista"
            value="<?= $artista ?>" />

        <br><br>

        <input type="hidden" name="submetido" value="1" />

        <button type="submit">Gravar</button>
        <button type="reset">Limpar</button>
    </form>

    <div style="color: red;">
        <?= $msgErro ?>
    </div>

    <h3>Listagem de Músicas</h3>
<table border="1">
    <tr>
        <td>Título</td>
        <td>Gênero</td>
        <td>Duração</td>
        <td>Artista</td>
        <td></td>
    </tr>

    <?php foreach ($musicas as $m) : ?>
        <tr>
            <td><?= $m['titulo'] ?></td>
            <td><?= $m['genero'] ?></td>
            <td><?= segundosParaMinutos($m['duracao']) ?></td>
            <td><?= $m['artista'] ?></td>
            <td><a href="musicas_del.php?id=<?= $m['id'] ?>"
                    onclick="return confirm('Confirma a exclusão?');">
                    Excluir</a></td>
        </tr>
    <?php endforeach; ?>

</table>

    <script src="validacao.js"></script>
</body>

</html>
