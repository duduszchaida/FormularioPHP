
function validar() {
    var titulo = document.getElementById('titulo').value.trim();
    var genero = document.getElementById('genero').value;
    var duracao = document.getElementById('duracao').value;
    var artista = document.getElementById('artista').value.trim();

    var mensagemErro = "";

    if (titulo === '') {
        mensagemErro += 'Informe o título da música!\n';
    }

    if (genero === '') {
        mensagemErro += 'Selecione o gênero da música!\n';
    }

    if (duracao === '' || isNaN(duracao) || parseFloat(duracao) <= 0) {
        mensagemErro += 'Informe uma duração válida maior que zero!\n';
    }

    if (artista === '') {
        mensagemErro += 'Informe o nome do artista da música!\n';
    }

    if (mensagemErro !== '') {
        alert(mensagemErro);
        return false;
    }

    return true;
}
