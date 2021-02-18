function gravaInsumo(codigo, descricao, valor, callback) {
  $.ajax({
    url: 'js/sqlscope_tabelaBasicaInsumo.php',
    dataType: 'html', //tipo do retorno
    type: 'post', //metodo de envio
    data: {
      funcao: 'grava',
      codigo: codigo,
      descricao: descricao,
      valor: valor,
    }, //valores enviados ao script
    success: function (data) {
      callback(data)
    },
  })
}

function recuperaInsumo(id, callback) {
  $.ajax({
    url: 'js/sqlscope_tabelaBasicaInsumo.php', //caminho do arquivo a ser executado
    dataType: 'html', //tipo do retorno
    type: 'post', //metodo de envio
    data: { funcao: 'recupera', id: id }, //valores enviados ao script

    success: function (data) {
      callback(data)
    },
  })

  return
}

function excluirInsumo(id, callback) {
  $.ajax({
    url: 'js/sqlscope_tabelaBasicaInsumo.php', //caminho do arquivo a ser executado
    dataType: 'html', //tipo do retorno
    type: 'post', //metodo de envio
    data: { funcao: 'excluir', id: id }, //valores enviados ao script

    success: function (data) {
      callback(data)
    },
  })
}
