function gravaDependentes(id, ativo, dependente, callback) {
    $.ajax({
        url: 'js/sqlscope_DependentesFuncionario.php',
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: "gravaDependentes", id: id, ativos: ativo, dependente: dependente}, //valores enviados ao script     
        success: function (data) {
            callback(data);
        }
    });
}

function recuperaDependentes(id, callback) {
    $.ajax({
        url: 'js/sqlscope_DependentesFuncionario.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'recuperaDependentes', id: id }, //valores enviados ao script     
        success: function (data) {
            callback(data);
        }

    });

    return;
}

function excluirDependentes(codigo, callback) {
    $.ajax({
        url: 'js/sqlscope_DependentesFuncionario.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'excluirDependentes', codigo: codigo }, //valores enviados ao script     
        success: function (data) {
            callback(data);
        }
    });
}

function verificaDependentes(dependente, callback) {
    $.ajax({
      url: "js/sqlscope_DependentesFuncionario.php", //caminho do arquivo a ser executado
      dataType: "html", //tipo do retorno
      type: "post", //metodo de envio
      data: { funcao: "verificaDependentes", dependente: dependente }, //valores enviados ao script
      success: function (data) {
        callback(data);
      },
    });
  }

