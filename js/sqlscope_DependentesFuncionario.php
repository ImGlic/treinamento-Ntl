<?php

include "repositorio.php";
include "girComum.php";

$funcao = $_POST["funcao"];

if ($funcao == 'gravaDependentes') {
    call_user_func($funcao);
}

if ($funcao == 'recuperaDependentes') {
    call_user_func($funcao);
}

if ($funcao == 'excluirDependentes') {
    call_user_func($funcao);
}

if ($funcao == 'verificaDependentes') {
    call_user_func($funcao);
}


function gravaDependentes(){
    //Variáveis
    if ((empty($_POST['id'])) || (!isset($_POST['id'])) || (is_null($_POST['id']))) {
        $codigo = 0;
    } else {
        $codigo = (int) $_POST["id"];
    }
    $ativo = 1;
    session_start();


    $dependente = "'" . $_POST['dependente'] . "'";

    $sql = "dbo.desc_dependentesatt
            $codigo,
            $dependente,
            $ativo
            ";

    $reposit = new reposit();
    $result = $reposit->Execprocedure($sql);

    $ret = 'sucess#';
    if ($result < 1) {
        $ret = 'failed#';
    }
    echo $ret;
    return;
}

function recuperaDependentes(){
    $condicaoId = !((empty($_POST["id"])) || (!isset($_POST["id"])) || (is_null($_POST["id"])));
    // $condicaoLogin = !((empty($_POST["loginPesquisa"])) || (!isset($_POST["loginPesquisa"])) || (is_null($_POST["loginPesquisa"])));


    // if (($condicaoId === false) && ($condicaoLogin === false)) {
    //     $mensagem = "Nenhum parâmetro de pesquisa foi informado.";
    //     echo "failed#" . $mensagem . ' ';
    //     return;
    // }

    // if (($condicaoId === true) && ($condicaoLogin === true)) {
    //     $mensagem = "Somente 1 parâmetro de pesquisa deve ser informado.";
    //     echo "failed#" . $mensagem . ' ';
    //     return;
    // }

    if ($condicaoId) {
        $codigo = $_POST["id"];
    }

    // if ($condicaoLogin) {
    //     $loginPesquisa = $_POST["loginPesquisa"];
    // }

    $sql = "SELECT codigo, descricao from dbo.desc_dependentes where (0=0) and codigo = $codigo";


    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    $out = "";

    if ($row = $result[0]) {
        $id = $row['codigo'];
        $dependente = $row['descricao'];


        $out = $id . "^" . $dependente;

        if ($out == "") {
            echo "failed#";
        }
        if ($out != '') {
            echo "sucess#" . $out . " ";
        }
        return;
    }
}

function excluirDependentes(){

    $reposit = new reposit();
    // $possuiPermissao = $reposit->PossuiPermissao("CARGO_ACESSAR|CARGO_EXCLUIR");
    // if ($possuiPermissao === 0) {
    //     $mensagem = "O usuário não tem permissão para excluir!";
    //     echo "failed#" . $mensagem . ' ';
    //     return;
    // }
    $id = $_POST["id"];
    if ((empty($_POST['id']) || (!isset($_POST['id'])) || (is_null($_POST['id'])))) {
        $mensagem = "Selecione um cargo para ser excluído";
        echo "failed#" . $mensagem . ' ';
        return;
    }

    $reposit = new reposit();

    $result = $reposit->update('dbo.desc_dependentes' . '|' . 'ativo = 0' . '|' . 'codigo =' . $id);

    if ($result < 1) {
        echo ('failed#');
        return;
    }
    echo 'sucess#' . $result;
    return;
}

function verificaDependentes(){
    $id =  $_POST["id"];
    $dependente = strtoupper( $_POST["dependente"]);
   
    if ($id) {
        $sql = "SELECT UPPER(descricao) AS cont FROM dbo.desc_dependentes WHERE (0=0) AND descricao = '$dependente' AND codigo != $id";
        $reposit = new reposit();
        $result = $reposit->RunQuery($sql);

        if (($result)) {
            echo 'failed#';
            return;
        } else {
            echo  'succes#';
        }
    } else {
        $sql = "SELECT descricao from dbo.desc_dependentes   WHERE descricao = '$dependente' ";
        $reposit = new reposit();
        $result = $reposit->RunQuery($sql);

        if ($dependente != "" && count($result) > 0) {
            echo 'failed#';
            return;
        } else {
            echo  'succes#';
        }
    }
}
