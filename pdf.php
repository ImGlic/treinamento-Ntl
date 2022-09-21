<?php
include "repositorio.php";
//initilize the page
require_once("inc/init.php");
require_once("inc/config.ui.php");
require('./fpdf/mc_table.php');

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

require_once('fpdf/fpdf.php');
$funcao = $_GET['function'];
$id = $_GET['id'];

class PDF extends FPDF
{
    var $col = 0;

    function Header()
    {
        global $codigo;
        $sqlLogo = "SELECT parametroLogoRelatorio 
        FROM Ntl.parametro ";
        $reposit = new reposit();
        $result = $reposit->RunQuery($sqlLogo);
        $rowLogo = $result[0];
        $logo = $rowLogo['parametroLogoRelatorio'];
        if ($logo != "") {
            $img = explode('/', $logo);
            $img = $img[1] . "/" . $img[2] . "/" . $img[3];
            $img = str_replace('"', "'", $img);


            list($x1, $y1) = getimagesize($img);
            $x2 = 15;
            $y2 = 10;
            if (($x1 / $x2) < ($y1 / $y2)) {
                $y2 = 5;
            } else {
                $x2 = 5;
            }
            $this->Cell(116, 1, "", 0, 1, 'C', $this->Image($img, $x2, $y2, 0, 15));
        }
        $sqlMarca = "SELECT parametroMarca 
        FROM Ntl.parametro ";
        $reposit = new reposit();
        $result = $reposit->RunQuery($sqlMarca);
        $rowMarca = $result[0];
        $logoMarca = $rowMarca['parametroMarca'];
        if ($logoMarca != "") {
            $img1 = explode('/', $logoMarca);
            $img1 = $img1[1] . "/" . $img1[2] . "/" . $img1[3];
            $img1 = str_replace('"', "'", $img1);
            list($x3, $y3) = getimagesize($img1);
            $x4 = 1;
            $y4 = 100;
            if (($x3 / $x4) < ($y3 / $y4)) {
                $y4 = 5;
            } else {
                $x4 = 50;
            }
            $this->Image($img1, $x4, $y4, 105, 105);
        }
        $this->SetXY(190, 1);
        $this->SetFont('Arial', 'B', 8); #Seta a Fonte
        $this->Cell(20, 5, 'Pagina ' . $this->pageno()); #Imprime o Número das Páginas
        $this->Image('C:\inetpub\wwwroot\Cadastro\img\Marcas NTL3.png', 85, 1, 50);
        $this->Image('C:\inetpub\wwwroot\Cadastro\img\ntl_logo-removebg-preview.png', 63, 110, 90,);
        $this->Ln(24); #Quebra de Linhas
    }
    function Footer()
    {
        $this->Image('C:\inetpub\wwwroot\Cadastro\img\footerPdf.png', 1, 279, 213);
    }
    static function dadosGerais()
    {
        $pdf = new PDF('P', 'mm', 'A4'); #Crio o PDF padrão RETRATO, Medida em Milímetro e papel A$
        $pdf->SetTitle('Relatório de Funcionários', 'UTF-8');
        $pdf->SetFillColor(238, 238, 238);
        $pdf->SetMargins(0, 0, 0); #Seta a Margin Esquerda com 20 milímetro, superrior com 20 milímetro e esquerda com 20 milímetros
        $pdf->SetDisplayMode('default', 'continuous'); #Digo que o PDF abrirá em tamanho PADRÃO e as páginas na exibição serão contínuas       
        $pdf->AddPage();

        $tamanhoFonte = 9;
        $tamanhoFonteMenor = 8;
        $tamanhoFonteNome = 6;
        $tipoDeFonte = 'Courier';
        $fontWeight = 'B';
        $marginTop = 18;

        $pdf->setY(20);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(10);
        $pdf->SetFillColor(112, 128, 144);
        $pdf->MultiCell(192, 6, iconv('UTF-8', 'windows-1252', 'RELATÓRIO DE FUNCIONÁRIOS'), 0, "C", 3); //Cell(20, -1, iconv('UTF-8', 'windows-1252', $nome), 0, 0, "L", 0);
        $pdf->SetFont($tipoDeFonte, '', 8);

        $pdf->setY(30);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(10);
        $pdf->MultiCell(60, 5, iconv('UTF-8', 'windows-1252', 'NOME'), 1, 0, "C", 0);
        $pdf->SetFont($tipoDeFonte, '', 8);

        $pdf->setY(30);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(70);
        $pdf->MultiCell(27, 5, iconv('UTF-8', 'windows-1252', 'NASCIMENTO'), 1 ,"C", 1,0); //Cell(20, -1, iconv('UTF-8', 'windows-1252', 'DATA DE NASCIMENTO'), 0, 0, "C", 0);
        $pdf->SetFont($tipoDeFonte, '', 8);

        $pdf->setY(30);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(97);
        $pdf->MultiCell(30, 5, iconv('UTF-8', 'windows-1252', 'CPF'), 1, "C", 1, 0);
        $pdf->SetFont($tipoDeFonte, '', 8);

        $pdf->setY(30);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(127);
        $pdf->MultiCell(13, 5, iconv('UTF-8', 'windows-1252', 'ATIVO'), 1, 0, "C", 0);
        $pdf->SetFont($tipoDeFonte, '', 8);

        $pdf->setY(30);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(140);
        $pdf->MultiCell(25, 5, iconv('UTF-8', 'windows-1252', 'GÊNERO'), 1, "C", 1, 0);
        $pdf->SetFont($tipoDeFonte, '', 8);

        $pdf->setY(30);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(165);
        $pdf->MultiCell(28, 5, iconv('UTF-8', 'windows-1252', 'EST.CIVIL'), 1, "C", 1, 0);
        $pdf->SetFont($tipoDeFonte, '', 8);

        $pdf->setY(30);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(193);
        $pdf->MultiCell(9, 5, iconv('UTF-8', 'windows-1252', 'MAT'), 1, "C", 1, 0);
        $pdf->SetFont($tipoDeFonte, '', 8);

        if ($_GET['genero'] != "") {
            $genero = $_GET['genero'];
            $where = " AND genero = '$genero'";
        }

        if ($_GET['estadoCivil'] != "") {
            $estadoCivil = $_GET['estadoCivil'];
            $where = " AND estadoCivil = '$estadoCivil'";
        }

        $sql = " SELECT f.codigo, f.nome, f.ativo, f.cpf, f.dataNascimento, f.genero, EC.descricao as descricaoEstadoCivil,    
        GF.descricao as descricaoGenero from dbo.funcionario f
        LEFT JOIN dbo.desc_genero GF on f.genero = GF.codigo
        LEFT JOIN dbo.estadoCivil EC ON EC.codigo= f.estadoCivil
        WHERE (0=0) ";


        $sql = $sql . $where;
        $reposit = new reposit();
        $resultQuery = $reposit->RunQuery($sql);

        $i = 30;
        $z = $pdf->GetY(276);

        foreach ($resultQuery as $row) {
            $nome = rtrim(ucfirst($row['nome']));
            // $nome = 'Adriana Giovanna Ester de Paula';
            $splitName = explode(" ", $nome);
            $quantidadeNome = count($splitName);
            $nome = $splitName[0];

            if ($quantidadeNome > 3) {
                if (count($splitName) > 1) {
                    for ($a = 1; (count($splitName) - 2) > $a; $a++) {
                        if (strlen($splitName[$a]) >= 3) {
                            $splitName[$a] = substr($splitName[$a], 0, 1) . ".";
                            $nome = implode(" ", $splitName);
                        } elseif (strlen($splitName[$a]) == 2) {
                            $splitName[$a] = substr($splitName[$a], 0, 2) ."";
                            $nome = implode(" ", $splitName);
                        }
                    }
                }
            } else {
                $nome = implode(" ", $splitName);
            }

            $id = $row['codigo'];
            $dataNascimento = $row['dataNascimento'];
            $dataNascimento = explode(" ", $dataNascimento);
            $dataNascimento = explode("-", $dataNascimento[0]);
            $dataNascimento =  $dataNascimento[2] . "/" . $dataNascimento[1] . "/" . $dataNascimento[0];
            $ativo = +$row['ativo'];
            if ($ativo == 1) {
                $ativo = 'Sim';
            } else {
                $ativo = 'Não';
            }

            $cpf = $row['cpf'];
            $genero = $row['descricaoGenero'];
            $estadoCivil = $row['descricaoEstadoCivil'];

            $i += 5;

            $pdf->setY($i);
            $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonteMenor);
            $pdf->setX(10);
            $pdf->MultiCell(60, 5, iconv('UTF-8', 'windows-1252', strtoupper($nome)), 1, "L", 0);
            $pdf->SetFont($tipoDeFonte, '', 8);

            $pdf->setY($i);
            $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonteMenor);
            $pdf->setX(70);
            $pdf->MultiCell(27, 5, $dataNascimento, 1, 'C', 0); //Cell(20, -1, iconv('UTF-8', 'windows-1252', $dataNascimento ), 0, 0, "C", 0);
            $pdf->SetFont($tipoDeFonte, '', 8);

            $pdf->setY($i);
            $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonteMenor);
            $pdf->setX(97);
            $pdf->MultiCell(30, 5, $cpf, 1, 'C', 0); // Cell(20, -1, iconv('UTF-8', 'windows-1252', $cpf), 0, 0, "C", 0);
            $pdf->SetFont($tipoDeFonte, '', 8);

            $pdf->setY($i);
            $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonteMenor);
            $pdf->setX(127);
            $pdf->MultiCell(13, 5, $ativo, 1, 'C', 0);
            $pdf->SetFont($tipoDeFonte, '', 8);

            $pdf->setY($i);
            $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonteMenor);
            $pdf->setX(140);
            $pdf->MultiCell(25, 5, iconv('UTF-8', 'windows-1252', $genero), 1, "C", 0);
            $pdf->SetFont($tipoDeFonte, '', 8);

            $pdf->setY($i);
            $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonteMenor);
            $pdf->setX(165);
            $pdf->MultiCell(28, 5, iconv('UTF-8', 'windows-1252', $estadoCivil), 1, "C", 0);
            $pdf->SetFont($tipoDeFonte, '', 8);

            $pdf->setY($i);
            $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonteMenor);
            $pdf->setX(193);
            $pdf->MultiCell(9, 5, $id, 1, 'C', 0);
            $pdf->SetFont($tipoDeFonte, '', 8);

            if ($i >= 270) {
                $pdf->SetAutoPageBreak(true, $marginTop);
                $pdf->AddPage();
                $i = 20;
                $pdf->SetY(30);
                $pdf->SetX(15);
            }
        }
        $pdf->Ln(8);
        $pdf->Output();
    }
    static function dadosFuncionario()
    {
        $id = $_GET['id'];
        $pdf = new PDF('P', 'mm', 'A4'); #Crio o PDF padrão RETRATO, Medida em Milímetro e papel A$

        $pdf->SetMargins(0, 0, 0); #Seta a Margin Esquerda com 20 milímetro, superrior com 20 milímetro e esquerda com 20 milímetros
        $pdf->SetDisplayMode('default', 'continuous'); #Digo que o PDF abrirá em tamanho PADRÃO e as páginas na exibição serão contínuas
        $pdf->SetAutoPageBreak(1, 30);
        $pdf->AddPage();

        $tamanhoFonte = 10;
        $tamanhoFonteMenor = 6;
        $tipoDeFonte = 'Arial';
        $arial = 'Arial';
        $fontWeight = '';
        $fontItalic = 'I';

        $pdf->setY(20);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(15);
        $pdf->SetFillColor(112, 128, 144);
        $pdf->MultiCell(180, 6, iconv('UTF-8', 'windows-1252', 'DADOS CADASTRAIS DO FUNCIONÁRIO'), 0, "C", 3); //Cell(20, -1, iconv('UTF-8', 'windows-1252', $nome), 0, 0, "L", 0);
        $pdf->SetFont($tipoDeFonte, '', 8);

        $pdf->setY(30);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(15);
        $pdf->MultiCell(60, 5, iconv('UTF-8', 'windows-1252', 'Matrícula:'), 0, "L");
        $pdf->SetFont($tipoDeFonte, '', 8);

        $pdf->setY(30);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(75);
        $pdf->MultiCell(120, 5, iconv('UTF-8', 'windows-1252', 'Nome:'), 0, "L", 0); //Cell(20, -1, iconv('UTF-8', 'windows-1252', 'DATA DE NASCIMENTO'), 0, 0, "C", 0);
        $pdf->SetFont($tipoDeFonte, '', 8);

        $pdf->setY(38);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(15);
        $pdf->MultiCell(60, 5, iconv('UTF-8', 'windows-1252', 'Data de Nasc:'), 0, "L", 0);
        $pdf->SetFont($tipoDeFonte, '', 8);

        $pdf->setY(38);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(75);
        $pdf->MultiCell(60, 5, iconv('UTF-8', 'windows-1252', 'Cpf:'), 0, "L", 0);
        $pdf->SetFont($tipoDeFonte, '', 8);

        $pdf->setY(38);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(135);
        $pdf->MultiCell(60, 5, iconv('UTF-8', 'windows-1252', 'Rg:'), 0, "L", 0);
        $pdf->SetFont($tipoDeFonte, '', 8);

        $pdf->setY(46);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(15);
        $pdf->MultiCell(60, 5, iconv('UTF-8', 'windows-1252', 'Estado Civil:'), 0, "L", 0);
        $pdf->SetFont($tipoDeFonte, '', 8);

        $pdf->setY(46);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(75);
        $pdf->MultiCell(60, 5, iconv('UTF-8', 'windows-1252', 'Gênero:'), 0, "L", 0);
        $pdf->SetFont($tipoDeFonte, '', 8);

        $pdf->setY(46);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(135);
        $pdf->MultiCell(60, 5, iconv('UTF-8', 'windows-1252', 'Ativo:'), 0, "L", 0);
        $pdf->SetFont($tipoDeFonte, '', 8);

        $pdf->setY(55);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(15);
        $pdf->MultiCell(60, 5, iconv('UTF-8', 'windows-1252', 'PisPasep:'), 0, "L", 0);
        $pdf->SetFont($tipoDeFonte, '', 8);

        $pdf->setY(103);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(15);
        $pdf->MultiCell(180, 6, iconv('UTF-8', 'windows-1252', 'ENDEREÇO '), 0, "C", 1);
        $pdf->SetFont($tipoDeFonte, '', 8);

        $pdf->setY(111);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(15);
        $pdf->MultiCell(60, 5, iconv('UTF-8', 'windows-1252', 'Logradouro:'), 0, "L");
        $pdf->SetFont($tipoDeFonte, '', 8);

        $pdf->setY(111);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(107);
        $pdf->MultiCell(16, 5, iconv('UTF-8', 'windows-1252', 'Número:'), 0, "L");
        $pdf->SetFont($tipoDeFonte, '', 8);

        $pdf->setY(111);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(140);
        $pdf->MultiCell(60, 5, iconv('UTF-8', 'windows-1252', 'Bairro:'), 0, "L");
        $pdf->SetFont($tipoDeFonte, '', 8);

        $pdf->setY(120);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(15);
        $pdf->MultiCell(15, 5, iconv('UTF-8', 'windows-1252', 'CEP:'), 0, "L");
        $pdf->SetFont($tipoDeFonte, '', 8);

        $pdf->setY(120);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(107);
        $pdf->MultiCell(15, 5, iconv('UTF-8', 'windows-1252', 'Cidade:'), 0, "L");
        $pdf->SetFont($tipoDeFonte, '', 8);

        $pdf->setY(70);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(15);
        $pdf->MultiCell(180, 6, iconv('UTF-8', 'windows-1252', 'CONTATOS '), 0, "C", 1);
        $pdf->SetFont($tipoDeFonte, '', 8);

        $sql = "SELECT codigo, nome, ativo, cpf, rg, dataNascimento ,  FLOOR(DATEDIFF(DAY, dataNascimento, GETDATE()) / 365.25) as idade, 
        genero, cep,
        endereco, numero, complemento,
        bairro, cidade, uf, primeiroEmprego, pispasep, estadoCivil from dbo.funcionario WHERE (0 = 0) and codigo = $id";
        $reposit = new reposit();
        $resultQuery = $reposit->RunQuery($sql);

        if ($row = $resultQuery[0]) {

            $id = +$row['codigo'];
            $nomeFuncionario = ucfirst($row['nome']);
            $ativo = +$row['ativo'];
            if ($ativo == 1) {
                $ativo = 'Sim';
            } else {
                $ativo = 'Não';
            }
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
            $complemento = ucfirst($row['complemento']);
            $bairro = $row['bairro'];
            $cidade = $row['cidade'];
            $uf = ucfirst($row['uf']);
            $estadoCivil = $row['estadoCivil'];
            $idade = $row['idade'];

            foreach ($resultQuery as $row) {

                $pdf->setY(32);
                $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                $pdf->setX(31);
                $pdf->MultiCell(10, 1, $id, 0,); //Cell(20, -1, iconv('U    TF-8', 'windows-1252', $nome), 0, 0, "L", 0);
                $pdf->SetFont($tipoDeFonte, '', 8);

                $pdf->SetTitle(" $nomeFuncionario.pdf", 'UTF-8');

                $pdf->setY(30);
                $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                $pdf->setX(86);
                $pdf->MultiCell(60, 5, $nomeFuncionario, 0,); //Cell(20, -1, iconv('UTF-8', 'windows-1252', $nome), 0, 0, "L", 0);
                $pdf->SetFont($tipoDeFonte, '', 8);

                $pdf->setY(38);
                $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                $pdf->setX(38);
                $pdf->MultiCell(25, 5, $dataNascimento, 0,); //Cell(20, -1, iconv('UTF-8', 'windows-1252', $nome), 0, 0, "L", 0);
                $pdf->SetFont($tipoDeFonte, '', 8);

                $pdf->setY(38);
                $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                $pdf->setX(82);
                $pdf->MultiCell(35, 5, $cpf, 0, "L", 0); //Cell(20, -1, iconv('UTF-8', 'windows-1252', $nome), 0, 0, "L", 0);
                $pdf->SetFont($tipoDeFonte, '', 8);

                $pdf->setY(38);
                $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                $pdf->setX(142);
                $pdf->MultiCell(35, 5, $rg, 0,); //Cell(20, -1, iconv('UTF-8', 'windows-1252', $nome), 0, 0, "L", 0);
                $pdf->SetFont($tipoDeFonte, '', 8);

                $pdf->setY(46);
                $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                $pdf->setX(145);
                $pdf->MultiCell(35, 5, $ativo, 0,); //Cell(20, -1, iconv('UTF-8', 'windows-1252', $nome), 0, 0, "L", 0);
                $pdf->SetFont($tipoDeFonte, '', 8);

                $pdf->setY(55);
                $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                $pdf->setX(32);
                $pdf->MultiCell(50, 5, $pispasep, 0,); //Cell(20, -1, iconv('UTF-8', 'windows-1252', $nome), 0, 0, "L", 0);
                $pdf->SetFont($tipoDeFonte, '', 8);

                $pdf->setY(111);
                $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                $pdf->setX(35);
                $pdf->MultiCell(70, 5, iconv('UTF-8', 'windows-1252', "$endereco"), 0, "L", 0);
                $pdf->SetFont($tipoDeFonte, '', 8);

                $pdf->setY(111);
                $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                $pdf->setX(121);
                $pdf->MultiCell(10, 5, iconv('UTF-8', 'windows-1252', "$numero"), 0, "L", 0);
                $pdf->SetFont($tipoDeFonte, '', 8);

                $pdf->setY(111);
                $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                $pdf->setX(151);
                $pdf->MultiCell(30, 5, iconv('UTF-8', 'windows-1252', "$bairro"), 0, "L", 0);
                $pdf->SetFont($tipoDeFonte, '', 8);

                $pdf->setY(120);
                $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                $pdf->setX(24);
                $pdf->MultiCell(30, 5, iconv('UTF-8', 'windows-1252', "$cep"), 0, "L", 0);
                $pdf->SetFont($tipoDeFonte, '', 8);

                $pdf->setY(120);
                $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                $pdf->setX(120);
                $pdf->MultiCell(50, 5, iconv('UTF-8', 'windows-1252', "$cidade - $uf"), 0, "L", 0);
                $pdf->SetFont($tipoDeFonte, '', 8);
                if ($complemento != "") {

                    $pdf->setY(129);
                    $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                    $pdf->setX(15);
                    $pdf->MultiCell(30, 5, iconv('UTF-8', 'windows-1252', 'Complemento:'), 0, "L");
                    $pdf->SetFont($tipoDeFonte, '', 8);

                    $pdf->setY(129);
                    $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                    $pdf->setX(39);
                    $pdf->MultiCell(30, 5, iconv('UTF-8', 'windows-1252', "$complemento"), 0, "L", 0);
                    $pdf->SetFont($tipoDeFonte, '', 8);
                }
            }

            $sql = " SELECT f.codigo, f.nome, f.ativo, f.cpf, f.dataNascimento, f.genero,    
            GF.descricao from dbo.funcionario f
            LEFT JOIN dbo.desc_genero GF on f.genero = GF.codigo
            WHERE (0=0) AND GF.codigo =  " . $codigoGenero;
            $reposit = new reposit();
            $resultQuery = $reposit->RunQuery($sql);
            foreach ($resultQuery as $row) {
                $genero = $row['descricao'];
            }

            $sql = "SELECT NT.telefone, NT.principal, NT.whatsapp  from dbo.numero_funcionario NT
            LEFT JOIN dbo.funcionario f ON f.codigo = NT.telefone
            WHERE NT.funcionario     = " . $id . "
             ORDER BY NT.principal DESC
             OFFSET 0 ROWS
             FETCH NEXT 3 ROWS ONLY ";

            $reposit = new reposit();
            $result = $reposit->RunQuery($sql);
            $contadorNumeroTelefone = 0;
            $arrayNumeroFuncionario = array();
            $i = 80;
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

                $pdf->setY(78);
                $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                $pdf->setX(15);
                $pdf->MultiCell(30, 5, iconv('UTF-8', 'windows-1252', 'Telefone '), 0, "L", 0);
                $pdf->SetFont($tipoDeFonte, '', 8);

                $pdf->setY(78);
                $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                $pdf->setX(50);
                $pdf->MultiCell(30, 5, iconv('UTF-8', 'windows-1252', 'WhatsApp '), 0, "L", 0);
                $pdf->SetFont($tipoDeFonte, '', 8);

                $pdf->setY(78);
                $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                $pdf->setX(80);
                $pdf->MultiCell(20, 5, iconv('UTF-8', 'windows-1252', 'Principal '), 0, "L", 0);
                $pdf->SetFont($tipoDeFonte, '', 8);


                $pdf->setY($i = $i + 5);
                $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                $pdf->setX(15);
                $pdf->MultiCell(30, 5, "$NumeroTelefone", 0, "L", 0); //Cell(20, -1, iconv('UTF-8', 'windows-1252', $nome), 0, 0, "L", 0);
                $pdf->SetFont($tipoDeFonte, '', 8);

                $pdf->setY($i);
                $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                $pdf->setX(50);
                $pdf->MultiCell(10, 5, iconv('UTF-8', 'windows-1252', $descricaoWhatsapp), 0, "L", 0); //Cell(20, -1, iconv('UTF-8', 'windows-1252', $nome), 0, 0, "L", 0);
                $pdf->SetFont($tipoDeFonte, '', 8);

                $pdf->setY($i);
                $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                $pdf->setX(80);
                $pdf->MultiCell(10, 5, iconv('UTF-8', 'windows-1252', $descricaoPrincipal), 0, "L", 0); //Cell(20, -1, iconv('UTF-8', 'windows-1252', $nome), 0, 0, "L", 0);
                $pdf->SetFont($tipoDeFonte, '', 8);
            }

            $sql = "SELECT  EF.email, EF.principal  from dbo.email_funcionario EF
            LEFT JOIN dbo.funcionario f ON f.codigo = EF.email 
            
            WHERE EF.funcionario    = " . $id . "
            ORDER BY EF.email
			OFFSET 0 ROWS
			FETCH NEXT 2 ROWS ONLY ";

            $reposit = new reposit();
            $result = $reposit->RunQuery($sql);
            $contadorEmail = 0;
            $arrayEmailFuncionario = array();
            $i = 80;
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

                $pdf->setY(78);
                $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                $pdf->setX(105);
                $pdf->MultiCell(60, 5, iconv('UTF-8', 'windows-1252', 'Email '), 0, "L", 0);
                $pdf->SetFont($tipoDeFonte, '', 8);

                $pdf->setY(78);
                $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                $pdf->setX(165);
                $pdf->MultiCell(25, 5, iconv('UTF-8', 'windows-1252', 'Principal '), 0, "L", 0);
                $pdf->SetFont($tipoDeFonte, '', 8);

                $pdf->setY($i = $i + 5);
                $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                $pdf->setX(105);
                $pdf->MultiCell(60, 5, "$email", 0, "L", 0); //Cell(20, -1, iconv('UTF-8', 'windows-1252', $nome), 0, 0, "L", 0);
                $pdf->SetFont($tipoDeFonte, '', 8);

                $pdf->setY($i);
                $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                $pdf->setX(165);
                $pdf->MultiCell(10, 5, iconv('UTF-8', 'windows-1252', $descricaoEmail), 0, "L", 0); //Cell(20, -1, iconv('UTF-8', 'windows-1252', $nome), 0, 0, "L", 0);
                $pdf->SetFont($tipoDeFonte, '', 8);
            }

            $sql = "SELECT DF.nomeDependente, DF.cpfDependente, DF.dataNascimentoDependente, FLOOR(DATEDIFF(DAY, dataNascimentoDependente, GETDATE()) / 365.25) as idade, DF.tipoDependente  
            from dbo.dependentes_funcionario DF
            LEFT JOIN dbo.funcionario f ON f.codigo = DF.nomeDependente
            WHERE DF.funcionario = " . $id;
            $reposit = new reposit();
            $result = $reposit->RunQuery($sql);
            $contadorDependente = 0;
            $arrayDependenteFuncionario = array();

            $i = 152;
            foreach ($result as $row) {

                $nomeDependente = ucfirst($row['nomeDependente']);
                $cpfDependente = $row['cpfDependente'];
                $dataNascimentoDependente = $row['dataNascimentoDependente'];
                $dataNascimentoDependente = explode(" ", $dataNascimentoDependente);
                $dataNascimentoDependente = explode("-", $dataNascimentoDependente[0]);
                $dataNascimentoDependente = $dataNascimentoDependente[2] . "/" . $dataNascimentoDependente[1] . "/" . $dataNascimentoDependente[0];
                $tipoDependente = (int)$row['tipoDependente'];
                $idadeDependente = $row['idade'];

                $contadorDependente = $contadorDependente + 1;
                $arrayDependenteFuncionario[] = array(
                    "sequencialDependente" => $contadorDependente,
                    "nomeDependente" => $nomeDependente,
                    "cpfDependente" => $cpfDependente,
                    "nascimentoDependente" => $dataNascimentoDependente,
                    "tipoDependente" => $tipoDependente
                );

                $sql = "SELECT DD.codigo, DD.descricao  
                from dbo.desc_dependentes DD
                LEFT JOIN dbo.dependentes_funcionario f ON f.tipoDependente = DD.codigo
                WHERE f.tipoDependente = " . $tipoDependente;
                $reposit = new reposit();
                $result = $reposit->RunQuery($sql);

                foreach ($result as $row) {
                    $tipoDependente = $row['descricao'];
                }


                if ($arrayDependenteFuncionario != "") {

                    $pdf->setY(145);
                    $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                    $pdf->setX(15);
                    $pdf->MultiCell(180, 6, iconv('UTF-8', 'windows-1252', 'DEPENDENTES '), 0, "C", 1);
                    $pdf->SetFont($tipoDeFonte, '', 8);

                    $pdf->setY(151);
                    $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                    $pdf->setX(15);
                    $pdf->MultiCell(75, 6, iconv('UTF-8', 'windows-1252', 'NOME '), 1, "C", 1);
                    $pdf->SetFont($tipoDeFonte, '', 8);

                    $pdf->setY(151);
                    $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                    $pdf->setX(90);
                    $pdf->MultiCell(45, 6, iconv('UTF-8', 'windows-1252', 'DATA DE NASCIMENTO '), 1, "C", 1);
                    $pdf->SetFont($tipoDeFonte, '', 8);

                    $pdf->setY(151);
                    $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                    $pdf->setX(135);
                    $pdf->MultiCell(30, 6, iconv('UTF-8', 'windows-1252', 'CPF '), 1, "C", 1);
                    $pdf->SetFont($tipoDeFonte, '', 8);

                    $pdf->setY(151);
                    $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                    $pdf->setX(165);
                    $pdf->MultiCell(15, 6, iconv('UTF-8', 'windows-1252', 'TIPO'), 1, "C", 1);
                    $pdf->SetFont($tipoDeFonte, '', 8);

                    $pdf->setY(151);
                    $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                    $pdf->setX(180);
                    $pdf->MultiCell(15, 6, iconv('UTF-8', 'windows-1252', 'IDADE'), 1, "C", 1);
                    $pdf->SetFont($tipoDeFonte, '', 8);


                    foreach ($result as $row) {

                        $pdf->setY($i = $i + 5);
                        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                        $pdf->setX(15);
                        $pdf->MultiCell(75, 5, $nomeDependente, 1, "L", 0); //Cell(20, -1, iconv('UTF-8', 'windows-1252', $nome), 0, 0, "L", 0);
                        $pdf->SetFont($tipoDeFonte, '', 8);

                        $pdf->setY($i);
                        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                        $pdf->setX(90);
                        $pdf->MultiCell(45, 5, $dataNascimentoDependente, 1, "C", 0); //Cell(20, -1, iconv('UTF-8', 'windows-1252', $nome), 0, 0, "L", 0);
                        $pdf->SetFont($tipoDeFonte, '', 8);

                        $pdf->setY($i);
                        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                        $pdf->setX(135);
                        $pdf->MultiCell(30, 5, $cpfDependente, 1, "C", 0); //Cell(20, -1, iconv('UTF-8', 'windows-1252', $nome), 0, 0, "L", 0);
                        $pdf->SetFont($tipoDeFonte, '', 8);

                        $pdf->setY($i);
                        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                        $pdf->setX(165);
                        $pdf->MultiCell(15, 5, iconv('UTF-8', 'windows-1252', $tipoDependente), 1, "C", 0); //Cell(20, -1, iconv('UTF-8', 'windows-1252', $nome), 0, 0, "L", 0);
                        $pdf->SetFont($tipoDeFonte, '', 8);

                        $pdf->setY($i);
                        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                        $pdf->setX(180);
                        $pdf->MultiCell(15, 5, $idadeDependente, 1, "C", 0);  //Cell(20, -1, iconv('UTF-8', 'windows-1252', $nome), 0, 0, "L", 0);
                        $pdf->SetFont($tipoDeFonte, '', 8);
                    }
                }
            }

            $sql = "SELECT EF.codigo, EF.descricao  
                from dbo.estadoCivil EF
                LEFT JOIN dbo.funcionario f ON f.estadoCivil= EF.codigo
                WHERE EF.codigo = " . $estadoCivil;
            $reposit = new reposit();
            $result = $reposit->RunQuery($sql);

            foreach ($result as $row) {
                $estadoCivil = $row['descricao'];

                $pdf->setY(46);
                $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
                $pdf->setX(35);
                $pdf->MultiCell(35, 5, iconv('UTF-8', 'windows-1252', $estadoCivil), 0, "L", 0);
                $pdf->SetFont($tipoDeFonte, 'I', 8);
            }

            $pdf->setY(46);
            $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
            $pdf->setX(89);
            $pdf->MultiCell(35, 5, iconv('UTF-8', 'windows-1252', $genero), 0, "L", 0);
            $pdf->SetFont($tipoDeFonte, '', 8);
        }
        $pdf->Ln(8);
        $pdf->Output();
    }
}

if ($funcao == 'dadosGerais') {
    return PDF::dadosGerais();
}

if ($funcao == 'dadosFuncionario') {
    return PDF::dadosFuncionario();
}
