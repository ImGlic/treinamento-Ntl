function gravaEstadoCivil(id, ativo, estadoCivil, callback) {
  $.ajax({
      url: 'js/sqlscope_estadoCivil.php',
      dataType: 'html', //tipo do retorno
      type: 'post', //metodo de envio
      data: { funcao: "gravaEstadoCivil", id: id, ativo: ativo, estadoCivil: estadoCivil}, //valores enviados ao script     
      success: function (data) {
          callback(data);
      }
  });
}

function recuperaEstadoCivil(id, callback) {
  $.ajax({
      url: 'js/sqlscope_estadoCivil.php', //caminho do arquivo a ser executado
      dataType: 'html', //tipo do retorno
      type: 'post', //metodo de envio
      data: { funcao: 'recuperaEstadoCivil', id: id }, //valores enviados ao script     
      success: function (data) {
          callback(data);
      }
  });
  return;
}

function excluirEstadoCivil(id, callback) {
  $.ajax({
      url: 'js/sqlscope_estadoCivil.php', //caminho do arquivo a ser executado
      dataType: 'html', //tipo do retorno
      type: 'post', //metodo de envio
      data: { funcao: 'excluirEstadoCivil', id: id }, //valores enviados ao script     
      success: function (data) {
          callback(data);
      }
  });
}

function verificaEstadoCivil(estadoCivil, callback) {
  $.ajax({
    url: "js/sqlscope_estadoCivil.php", //caminho do arquivo a ser executado
    dataType: "html", //tipo do retorno
    type: "post", //metodo de envio
    data: { funcao: "verificaEstadoCivil", estadoCivil: estadoCivil }, //valores enviados ao script
    success: function (data) {
      callback(data);
    },
  });
}


