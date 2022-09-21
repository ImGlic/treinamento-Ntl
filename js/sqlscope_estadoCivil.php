<?php

include "repositorio.php";
include "girComum.php";

$funcao = $_POST["funcao"];

if ($funcao == 'gravaEstadoCivil') {
    call_user_func($funcao);
}

if ($funcao == 'recuperaEstadoCivil') {
    call_user_func($funcao);
}

if ($funcao == 'excluirEstadoCivil') {
    call_user_func($funcao);
}

if ($funcao == 'verificaEstadoCivil') {
    call_user_func($funcao);
}

function gravaEstadoCivil()
{
    //Variáveis
    if ((empty($_POST['id'])) || (!isset($_POST['id'])) || (is_null($_POST['id']))) {
        $codigo = 0;
    } else {
        $codigo = (int) $_POST["id"];
    }
    $ativo = 1;
    session_start();

    $descricao = "'" . $_POST['estadoCivil'] . "'";

    $sql = "dbo.estadoCivilatt
            $codigo,
            $descricao,
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

function recuperaEstadoCivil()
{
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
        $id = $_POST["id"];
    }

    // if ($condicaoLogin) {
    //     $loginPesquisa = $_POST["loginPesquisa"];
    // }
    $sql = "SELECT codigo, descricao from dbo.estadoCivil where codigo = $id";

    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    $out = "";

    if ($row = $result[0]) {
        $id = $row['codigo'];
        $estadoCivil = $row['descricao'];

        $out = $id . "^" . $estadoCivil;

        if ($out == "") {
            echo "failed#";
        }
        if ($out != '') {
            echo "sucess#" . $out . " ";
        }
        return;
    }
}

function excluirEstadoCivil()
{

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

    $result = $reposit->update('dbo.estadoCivil' . '|' . 'ativo = 0' . '|' . 'codigo =' . $id);

    if ($result < 1) {
        echo ('failed#');
        return;
    }
    echo 'sucess#' . $result;
    return;
}

function verificaEstadoCivil()
{
    $id =  $_POST["id"];
    $estadoCivil = strtoupper($_POST['estadoCivil']);
   



    if ($id) {
        $sql = "SELECT UPPER(descricao) AS cont FROM dbo.estadoCivil WHERE (0=0) AND descricao = '$estadoCivil' AND codigo != $id";
        $reposit = new reposit();
        $result = $reposit->RunQuery($sql);

        if (($result)) {
            echo 'failed#';
            return;
        } else {
            echo  'succes#';
        }
    } else {
        $sql = "SELECT descricao from dbo.estadoCivil  WHERE descricao = '$estadoCivil' ";
        $reposit = new reposit();
        $result = $reposit->RunQuery($sql);

        if ($estadoCivil != "" && count($result) > 0) {
            echo 'failed#';
            return;
        } else {
            echo  'succes#';
        }
    }
}
