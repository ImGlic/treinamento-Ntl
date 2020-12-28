function gravaFerias(codigo, ativo, percentual ,callback) {
  $.ajax({
      url: 'js/sqlscope_tabelaBasicaFeriasTercoConstitucional.php',
      dataType: 'html', //tipo do retorno
      type: 'post', //metodo de envio
      data: {funcao: "grava", codigo:codigo, ativo:ativo, percentual:percentual}, //valores enviados ao script     
      success: function (data) {
          callback(data);
      }
  });
}

function recuperaFerias(id, callback) {
  $.ajax({
      url: 'js/sqlscope_tabelaBasicaFeriasTercoConstitucional.php', //caminho do arquivo a ser executado
      dataType: 'html', //tipo do retorno
      type: 'post', //metodo de envio
      data: {funcao: 'recupera', id: id}, //valores enviados ao script     
            
      success: function (data) {
          callback(data); 
      }
          
  });

  return;
}

function  excluirFerias(id, callback) {
  $.ajax({
      url: 'js/sqlscope_tabelaBasicaFeriasTercoConstitucional.php', //caminho do arquivo a ser executado
      dataType: 'html', //tipo do retorno
      type: 'post', //metodo de envio
      data: {funcao: 'excluir', id: id}, //valores enviados ao script     
    
      success: function (data) {
          callback(data); 
      }
      
  });
}