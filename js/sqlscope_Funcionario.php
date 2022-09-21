<?php
include "repositorio.php";
include "girComum.php";

$funcao = $_POST["funcao"];

if ($funcao == 'gravaFuncionario') {
    call_user_func($funcao);
}

if ($funcao == 'recuperaFuncionario') {
    call_user_func($funcao);
}

if ($funcao == 'excluirFuncionario') {
    call_user_func($funcao);
}

if ($funcao == 'verificaCpf') {
    call_user_func($funcao);
}

if ($funcao == 'verificaCpfDependente') {
    call_user_func($funcao);
}

if ($funcao == 'verificaRg') {
    call_user_func($funcao);
}

return;

function gravaFuncionario()
{
    //Variáveis
    if ((empty($_POST['id'])) || (!isset($_POST['id'])) || (is_null($_POST['id']))) {
        $id = 0;
    } else {
        $id = (int) $_POST["id"];
    }
    $ativo = 1;
    session_start();

    $nome = "'" . $_POST['nome'] . "'";
    $cpf = "'" . $_POST['cpf'] . "'";
    $rg = "'" . $_POST['rg'] . "'";
    $dataNascimento = $_POST['dataNascimento'];
    $dataNascimento = explode("/", $dataNascimento);
    $dataNascimento = "'" . $dataNascimento[2] . "-" . $dataNascimento[1] . "-" . $dataNascimento[0] . "'";
    $primeiroEmprego = $_POST['primeiroEmprego'];
    $pispasep = "'" . $_POST['pispasep'] . "'";
    $cep = "'" . $_POST['cep'] . "'";
    $endereco = "'" . $_POST['endereco'] . "'";
    $numero = "'" . $_POST['numero'] . "'";
    $complemento = "'" . $_POST['complemento'] . "'";
    $cidade = "'" . $_POST['cidade'] . "'";
    $bairro = "'" . $_POST['bairro'] . "'";
    $uf = "'" . $_POST['uf'] . "'";
    $codigoGenero = $_POST['codigoGenero'];
    $estadoCivil = $_POST['estadoCivil'];

    $strArrayNumeroFuncionario = $_POST["jsonTelefone"];
    $strArrayNumeroFuncionario = $strArrayNumeroFuncionario;
    $xmlNumeroFuncionario = new \FluidXml\FluidXml('ArrayOfContato', ['encoding' => '']);
    foreach ($strArrayNumeroFuncionario as $item) {
        $xmlNumeroFuncionario->addChild('telefone', true) //nome da tabela
            ->add('telefone', $item['telefone']) //setando o campo e definindo o valor
            ->add('whatsapp', $item['whatsapp'])
            ->add('principal', $item['principal']);
    }
    $xmlNumeroFuncionario = "'" . $xmlNumeroFuncionario . "'";

    $strArrayEmailFuncionario = $_POST["jsonEmail"];
    $strArrayEmailFuncionario = $strArrayEmailFuncionario;
    $xmlEmailFuncionario = new \FluidXml\FluidXml('ArrayOfContato', ['encoding' => '']);
    foreach ($strArrayEmailFuncionario as $item) {
        $xmlEmailFuncionario->addChild('email', true) //nome da tabela
            ->add('email', $item['email'])
            ->add('principal', $item['emailPrincipal']);; //setando o campo e definindo o valor
    }
    $xmlEmailFuncionario = "'" . $xmlEmailFuncionario . "'";

    $strArrayDependente = $_POST["jsonDependente"];
    $strArrayDependente = $strArrayDependente;
    $xmlDependente = new \FluidXml\FluidXml('ArrayOfDependente', ['encoding' => '']);
    foreach ($strArrayDependente as $item) {

        $dataNascimentoDependente = $item['nascimentoDependente'];
        $dataNascimentoDependente = explode("/", $dataNascimentoDependente);
        $dataNascimentoDependente = $dataNascimentoDependente[2] . "-" . $dataNascimentoDependente[1] . "-" . $dataNascimentoDependente[0];

        $xmlDependente->addChild('dependente', true) //nome da tabela
            ->add('nomeDependente', $item['nomeDependente'])
            ->add('cpfDependente', $item['cpfDependente'])
            ->add('dataNascimentoDependente', $dataNascimentoDependente)
            ->add('tipoDependente', $item['tipoDependente']);
    }
    $xmlDependente = "'" . $xmlDependente . "'";

    $sql = "dbo.funcionario_att
            $id,
            $nome,
            $ativo,
            $cpf,       
            $rg,         
            $dataNascimento,
            $codigoGenero,                    
            $primeiroEmprego,
            $pispasep,          
            $cep,
            $endereco,
            $numero,
            $complemento,
            $cidade,
            $bairro,
            $uf,
            $estadoCivil, 
            $xmlNumeroFuncionario,
            $xmlEmailFuncionario,
            $xmlDependente

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

function recuperaFuncionario()
{
    $condicaoId = !((empty($_POST["id"])) || (!isset($_POST["id"])) || (is_null($_POST["id"])));
    $condicaoLogin = !((empty($_POST["loginPesquisa"])) || (!isset($_POST["loginPesquisa"])) || (is_null($_POST["loginPesquisa"])));


    if (($condicaoId === false) && ($condicaoLogin === false)) {
        $mensagem = "Nenhum parâmetro de pesquisa foi informado.";
        echo "failed#" . $mensagem . ' ';
        return;
    }

    if (($condicaoId === true) && ($condicaoLogin === true)) {
        $mensagem = "Somente 1 parâmetro de pesquisa deve ser informado.";
        echo "failed#" . $mensagem . ' ';
        return;
    }

    if ($condicaoId) {
        $codigoFuncionario = $_POST["id"];
    }

    if ($condicaoLogin) {
        $loginPesquisa = $_POST["loginPesquisa"];
    }
    $sql = "SELECT codigo, nome, ativo, cpf, rg, dataNascimento ,  FLOOR(DATEDIFF(DAY, dataNascimento, GETDATE()) / 365.25) as idade, 
        genero, cep,
        endereco, numero, complemento,
        bairro, cidade, uf, primeiroEmprego, pispasep, estadoCivil from dbo.funcionario WHERE (0 = 0) and codigo = $codigoFuncionario";

    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    $out = "";

    if ($row = $result[0]) {
        $id = +$row['codigo'];
        $nome = $row['nome'];
        $ativo = +$row['ativo'];
        $cpf =  $row['cpf'];
        $rg =  $row['rg'];
        $dataNascimento = $row['dataNascimento'];
        $dataNascimento = explode(" ", $dataNascimento);
        $dataNascimento = explode("-", $dataNascimento[0]);
        $dataNascimento =  $dataNascimento[2] . "/" . $dataNascimento[1] . "/" . $dataNascimento[0];
        $codigoGenero = $row['genero'];
        $primeiroEmprego = $row['primeiroEmprego'];

        $pispasep = $row['pispasep'];
        $cep = $row['cep'];
        $endereco = $row['endereco'];
        $numero = $row['numero'];
        $complemento = $row['complemento'];
        $bairro = $row['bairro'];
        $cidade = $row['cidade'];
        $uf = $row['uf'];
        $estadoCivil = $row['estadoCivil'];
        $idade = $row['idade'];

        $sql = "SELECT NT.telefone, NT.principal, NT.whatsapp  from dbo.numero_funcionario NT
        LEFT JOIN dbo.funcionario f ON f.codigo = NT.telefone
        WHERE NT.funcionario     = " . $id;
        $reposit = new reposit();
        $result = $reposit->RunQuery($sql);
        $contadorNumeroTelefone = 0;
        $arrayNumeroFuncionario = array();
        foreach ($result as $row) {

            $NumeroTelefone = $row['telefone'];
            $principal = $row['principal'];
            $whatsapp = $row['whatsapp'];


            if ($principal == 1) {
                $descricaoPrincipal = 'Sim';
            } else {
                $descricaoPrincipal = 'Não';
            }

            if ($whatsapp == 1) {
                $descricaoWhatsapp = 'Sim';
            } else {
                $descricaoWhatsapp = 'Não';
            }

            $contadorNumeroTelefone = $contadorNumeroTelefone + 1;
            $arrayNumeroFuncionario[] = array(
                "sequencialTelefone" => $contadorNumeroTelefone,
                "telefone" => $NumeroTelefone,
                "principal" => $principal,
                "principalDescricao" => $descricaoPrincipal,
                "whatsapp" => $whatsapp,
                "whatsappDescricao" => $descricaoWhatsapp,

            );
        }
        $strArrayNumeroFuncionario = json_encode($arrayNumeroFuncionario);



        $sql = "SELECT EF.email, EF.principal  from dbo.email_funcionario EF
        LEFT JOIN dbo.funcionario f ON f.codigo = EF.email
        WHERE EF.funcionario     = " . $id;
        $reposit = new reposit();
        $result = $reposit->RunQuery($sql);
        $contadorEmail = 0;
        $arrayEmailFuncionario = array();
        foreach ($result as $row) {

            $email = $row['email'];
            $emailPrincipal = $row['principal'];

            if ($emailPrincipal == 1) {
                $descricaoEmail = 'Sim';
            } else {
                $descricaoEmail = 'Não';
            }

            $contadorEmail = $contadorEmail + 1;
            $arrayEmailFuncionario[] = array(
                "sequencialEmail" => $contadorEmail,
                "email" => $email,
                "emailPrincipal" => $emailPrincipal,
                "principalDescricao" => $descricaoEmail,

            );
        }
        $strArrayEmailFuncionario = json_encode($arrayEmailFuncionario);



        $sql = "SELECT DF.nomeDependente, DF.cpfDependente, DF.dataNascimentoDependente, DF.tipoDependente  
        from dbo.dependentes_funcionario DF
        LEFT JOIN dbo.funcionario f ON f.codigo = DF.nomeDependente
        WHERE DF.funcionario = " . $id;
        $reposit = new reposit();
        $result = $reposit->RunQuery($sql);
        $contadorDependente = 0;
        $arrayDependenteFuncionario = array();
        foreach ($result as $row) {

            $nomeDependente = $row['nomeDependente'];
            $cpfDependente = $row['cpfDependente'];
            $dataNascimentoDependente = $row['dataNascimentoDependente'];
            $dataNascimentoDependente = explode(" ", $dataNascimentoDependente);
            $dataNascimentoDependente = explode("-", $dataNascimentoDependente[0]);
            $dataNascimentoDependente = $dataNascimentoDependente[2] . "/" . $dataNascimentoDependente[1] . "/" . $dataNascimentoDependente[0];

            $tipoDependente = (int)$row['tipoDependente'];

            $contadorDependente = $contadorDependente + 1;
            $arrayDependenteFuncionario[] = array(
                "sequencialDependente" => $contadorDependente,
                "nomeDependente" => $nomeDependente,
                "cpfDependente" => $cpfDependente,
                "nascimentoDependente" => $dataNascimentoDependente,
                "tipoDependente" => $tipoDependente
            );
        }
        $strArrayDependenteFuncionario = json_encode($arrayDependenteFuncionario);



        $out = $id . "^" . $nome . "^" . $ativo . "^" .   $cpf . "^" . $rg . "^" . $dataNascimento . "^" . $idade . "^" . $codigoGenero . "^" . $primeiroEmprego . "^" . $pispasep . "^" . $cep . "^" . $endereco . "^" . $numero . "^" . $complemento . "^" . $cidade . "^" . $bairro . "^" . $uf . "^" . $estadoCivil . "^";

        if ($out == "") {
            echo "failed#";
        }
        if ($out != '') {
            echo "sucess#" . $out . "#" . $strArrayNumeroFuncionario . "#" . $strArrayEmailFuncionario . "#" . $strArrayDependenteFuncionario;
        }
        return;
    }
}

function excluirFuncionario()
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

    $result = $reposit->update('dbo.funcionario' . '|' . 'ativo = 0' . '|' . 'codigo =' . $id);

    if ($result < 1) {
        echo ('failed#');
        return;
    }
    echo 'sucess#' . $result;
    return;
}

function verificaCpf()
{
    $id =  $_POST["id"];
    $cpf = $_POST["cpf"];

    // $sql = "SELECT COUNT (cpf) from dbo.funcionario  WHERE cpf = '$cpf' ";        
    // $reposit = new reposit();
    // $result = $reposit->RunQuery($sql);

    if ($id) {
        $sql = "SELECT (cpf) AS cont FROM dbo.funcionario WHERE (0=0) AND cpf = '$cpf' AND codigo != $id";
        $reposit = new reposit();
        $result = $reposit->RunQuery($sql);

        if (($result)) {
            echo 'failed#';
            return;
        } else {
            echo  'succes#';

            return;
        }
    } else {
        $sql = "SELECT  cpf from dbo.funcionario  WHERE cpf = '$cpf' ";
        $reposit = new reposit();
        $result = $reposit->RunQuery($sql);

        if ($cpf != "" && count($result) > 0) {
            echo 'failed#';
            return;
        } else {
            echo  'succes#';

            return;
        }
    }
}

function verificaCpfDependente()
{

    $cpfDependente =  $_POST["cpfDependente"];

    $sql = "SELECT DF.cpfDependente  
    from dbo.dependentes_funcionario DF
    LEFT JOIN dbo.funcionario f ON f.cpf = DF.cpfDependente
    WHERE f.cpf = '" . $cpfDependente . "'";
    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    if (count($result) > 0) {
        echo 'failed#';
        return;
    }
    echo  'succes#';

    return;
}

function verificaRg()
{
    $id =  $_POST["id"];
    $rg = $_POST["rg"];

    if ($id) {
        $sql = "SELECT (rg) AS cont FROM dbo.funcionario WHERE (0=0) AND rg = '$rg' AND codigo != $id";
        $reposit = new reposit();
        $result = $reposit->RunQuery($sql);

        if (($result)) {
            echo 'failed#';
            return;
        } else {
            echo  'succes#';
        }
    } else {
        $sql = "SELECT rg from dbo.funcionario  WHERE rg = '$rg' ";
        $reposit = new reposit();
        $result = $reposit->RunQuery($sql);

        if ($rg != "" && count($result) > 0) {
            echo 'failed#';
            return;
        } else {
            echo  'succes#';
        }
    }
}
