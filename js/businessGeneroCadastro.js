function gravaGeneroFuncionario(id, ativo, genero, callback) {
    $.ajax({
        url: 'js/sqlscope_GeneroFuncionario.php',
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: "gravaGenero", id: id, ativo: ativo, genero: genero}, //valores enviados ao script     
        success: function (data) {
            callback(data);
        }
    });
}

function recuperaGeneroFuncionario(id, callback) {
    $.ajax({
        url: 'js/sqlscope_GeneroFuncionario.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'recuperaGenero', id: id }, //valores enviados ao script     
        success: function (data) {
            callback(data);
        }
    });
    return;
}

function excluirGeneroFuncionario(id, callback) {
    $.ajax({
        url: 'js/sqlscope_GeneroFuncionario.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'excluirGenero', id: id }, //valores enviados ao script     
        success: function (data) {
            callback(data);
        }
    });
}

function verificaGenero(descricao, callback) {
    $.ajax({
      url: "js/sqlscope_GeneroFuncionario.php", //caminho do arquivo a ser executado
      dataType: "html", //tipo do retorno
      type: "post", //metodo de envio
      data: { funcao: "verificaGenero", descricao: descricao }, //valores enviados ao script
      success: function (data) {
        callback(data);
      },
    });
  }


