function gravaFuncionario(
  id,
  ativo,
  nome,
  cpf,
  rg,
  dataNascimento,
  codigoGenero,
  estadoCivil,
  primeiroEmprego,
  pispasep,
  cep,
  endereco,
  numero,
  complemento,
  cidade,
  bairro,
  uf,
  jsonTelefone,
  jsonEmail,
  jsonDependente,
  callback
) {
  $.ajax({
    url: "js/sqlscope_Funcionario.php",
    dataType: "html", //tipo do retorno
    type: "post", //metodo de envio
    data: {
      funcao: "gravaFuncionario",
      id: id,
      ativo: ativo,
      nome: nome,
      cpf: cpf,
      rg: rg,
      dataNascimento: dataNascimento,
      codigoGenero: codigoGenero,
      estadoCivil: estadoCivil,
      primeiroEmprego: primeiroEmprego,
      pispasep: pispasep,
      cep: cep,
      endereco: endereco,
      numero: numero,
      complemento: complemento,
      cidade: cidade,
      bairro: bairro,
      uf: uf,
      jsonTelefone: jsonTelefone,
      jsonEmail: jsonEmail,
      jsonDependente: jsonDependente
    }, //valores enviados ao script
    success: function (data) {
      callback(data);
    },
  });
}

function recuperaFuncionario(id, callback) {
  $.ajax({
    url: "js/sqlscope_Funcionario.php", //caminho do arquivo a ser executado
    dataType: "html", //tipo do retorno
    type: "post", //metodo de envio
    data: { funcao: "recuperaFuncionario", id: id }, //valores enviados ao script
    success: function (data) {
      callback(data);
    },
  });
}

function excluirFuncionario(id) {
  $.ajax({
    url: "js/sqlscope_Funcionario.php", //caminho do arquivo a ser executado
    dataType: "html", //tipo do retorno
    type: "post", //metodo de envio
    data: { funcao: "excluirFuncionario", id: id }, //valores enviados ao script
    success: function (data, textStatus) {
      if (textStatus === "success") {
        smartAlert("Sucesso", "Funcionário Excluido com Sucesso ", "error");
        voltar();
      } else {
        smartAlert(
          "Atenção",
          "Operação não realizada - entre em contato com a GIR!",
          "error"
        );
      }
    },
    error: function (xhr, er) {
      console.log(xhr, er);
    },
  });
}

function verificaCpf(cpf, id, callback) {
  $.ajax({
    url: "js/sqlscope_Funcionario.php", //caminho do arquivo a ser executado
    dataType: "html", //tipo do retorno
    type: "post", //metodo de envio
    data: { funcao: "verificaCpf", cpf: cpf, id: id}, //valores enviados ao script
    success: function (data) {
      callback(data);
    },
  });
}

function verificaCpfDepedente(CpfDependente, callback) {
  $.ajax({
    url: "js/sqlscope_Funcionario.php", //caminho do arquivo a ser executado
    dataType: "html", //tipo do retorno
    type: "post", //metodo de envio
    data: { funcao: "verificaCpfDependente", CpfDependente: CpfDependente }, //valores enviados ao script
    success: function (data) {
      callback(data);
    },
  });
}

function verificaRg(rg, id, callback) {
  $.ajax({
    url: "js/sqlscope_Funcionario.php", //caminho do arquivo a ser executado
    dataType: "html", //tipo do retorno
    type: "post", //metodo de envio
    data: { funcao: "verificaRg", rg: rg, id: id }, //valores enviados ao script
    success: function (data) {
      callback(data);
    },
  });
}
