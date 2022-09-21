<?php
//initilize the page
require_once "inc/init.php";

//require UI configuration (nav, ribbon, etc.)
require_once "inc/config.ui.php";

//colocar o tratamento de permissão sempre abaixo de require_once("inc/config.ui.php");
// $condicaoAcessarOK = true;
// $condicaoGravarOK =  true;

// if ($condicaoAcessarOK == false) {
//     unset($_SESSION['login']);
//     header("Location:login.php");
// }

// $esconderBtnGravar = "";
// if ($condicaoGravarOK === false) {
//     $esconderBtnGravar = "none";
// }

/* ---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Funcionário";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include "inc/header.php";

//include left panel (navigation);
//follow the tree in inc/config.ui.php
$page_nav["cadastro"]["sub"]["cadastro"]["active"] = true;

include "inc/nav.php";
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
    <?php
    //configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
    //$breadcrumbs["New Crumb"] => "http://url.com"
    $breadcrumbs["Cadastro"] = "";
    include "inc/ribbon.php";
    ?>

    <!-- MAIN CONTENT -->
    <div id="content">

        <!-- widget grid -->
        <section id="widget-grid" class="">
            <div class="row">
                <article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable centerBox">
                    <div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
                        <header>
                            <span class="widget-icon"><i class="fa fa-cog"></i></span>
                            <h2>Funcionário </h2>
                        </header>
                        <div>
                            <div class="widget-body no-padding">
                                <form class="smart-form client-form" id="formFuncionario">
                                    <div class="panel-group smart-accordion-default" id="accordion">
                                        <div class="panel panel-default">

                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseCadastro" class="" id="accordionFuncionario">
                                                        <i class="fa fa-lg fa-angle-down pull-right"></i>
                                                        <i class="fa fa-lg fa-angle-up pull-right"></i>
                                                        Dados
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseCadastro" class="panel-collapse collapse in">
                                                <div class="panel-body no-padding">
                                                    <fieldset>
                                                        <div class="row">
                                                            <section class="col col-1">
                                                                <label class="hidden">
                                                                    <input id="codigo" name="codigo" type="text" class="readonly" readonly>
                                                                </label>
                                                            </section>

                                                            <section class="col col-1">
                                                                <label class="select">
                                                                    <select id="ativo" class="hidden">
                                                                        <option value="1">Sim</option>
                                                                        <option value="0">Não</option>
                                                                    </select>
                                                                </label>
                                                            </section>

                                                        </div>
                                                        <div class="row">
                                                        </div>
                                                        <div class="row">
                                                            <section class="col col-3">
                                                                <label class="label">Nome Funcionário</label>
                                                                <label class="input"><i class="icon-prepend fa fa-user"></i>
                                                                    <input id="nomeFuncionario" maxlength="255" name="nomeFuncionario" class="required" type="text" value="" required>
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label class="label">CPF</label>
                                                                <label class="input"><i class="icon-prepend fa fa-address-card"></i>
                                                                    <input type="text" maxlength="14" id="cpf" name="cpf" class="required">

                                                                </label>
                                                            </section>

                                                            <section class="col col-2">
                                                                <label class="label">RG</label>
                                                                <label class="input">
                                                                    <input type="text" maxlength="11" id="rg" name="rg" class="required">
                                                                </label>
                                                            </section>
                                                            <section class="col col-2 col-auto">
                                                                <label class="label">Data de Nascimento</label>
                                                                <label class="input">
                                                                    <i class="icon-append fa fa-calendar"></i>
                                                                    <input id="dataNascimento" name="dataNascimento" autocomplete="off" data-mask="99/99/9999" data-mask-placeholder="--/--/----" data-dateformat="dd/mm/yy" placeholder="--/--/----" type="text" class="datepicker required" style="text-align:center;">

                                                            </section>
                                                            <section class="col col-1">
                                                                <label class="label">Idade</label>
                                                                <label class="input">
                                                                    <input id="idade" name="idade" type="text" class="readonly" readonly>
                                                                </label>

                                                            </section>
                                                            <section class="col col-2 col-auto">
                                                                <label class="label">Gênero</label>
                                                                <label class="select">
                                                                    <select id="descricao" name="descricao">
                                                                        <option ></option>
                                                                        <?php
                                                                        $reposit = new reposit();
                                                                        $sql = "SELECT codigo,descricao
                                                                        FROM dbo.desc_genero ORDER BY codigo";
                                                                        $result = $reposit->RunQuery($sql);
                                                                        foreach ($result as $row) {
                                                                            $codigo = $row['codigo'];
                                                                            $descricao = $row['descricao'];
                                                                            echo '<option value=' . $codigo . '>' . $descricao . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select><i></i>
                                                                </label>
                                                            </section>
                                                            <section class="col col-2 col-auto">
                                                                <label class="label" " >Estado Civil</label>
                                                                <label class=" select">

                                                                    <select id="descricaoEstadoCivil" name="descricaoEstadoCivil">
                                                                        <option></option>
                                                                        <?php
                                                                        $reposit = new reposit();
                                                                        $sql = "SELECT codigo,descricao
                                                                        FROM dbo.estadoCivil ORDER BY codigo";
                                                                        $result = $reposit->RunQuery($sql);
                                                                        foreach ($result as $row) {
                                                                            $codigo = $row['codigo'];
                                                                            $descricao = $row['descricao'];
                                                                            echo '<option value=' . $codigo . '>' . $descricao . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select><i></i>
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label for="" class="label">Primeiro Emprego ?</label>
                                                                <label for="" class="select">
                                                                    <select id="primeiroEmprego" name="primeiroEmprego" class="required" value="1"=>
                                                                        <option value=""></option>
                                                                        <option value="1">Sim</option>
                                                                        <option value="0">Não</option>
                                                                    </select><i></i>
                                                                </label>
                                                            </section>

                                                            <section class="col col-2">
                                                                <label class="label" id="pisPasepT">PIS/PASEP</label>
                                                                <label class="input"><i class=""></i>
                                                                    <input id="pisPasep" maxlength="255" name="pisPasep" class="" type="text" value="">
                                                                </label>
                                                            </section>

                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>

                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseContatos" class="collapsed" id="accordionContato">
                                                        <i class="fa fa-lg fa-angle-down pull-right"></i>
                                                        <i class="fa fa-lg fa-angle-up pull-right"></i>
                                                        Contatos
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseContatos" class="panel-collapse collapse">
                                                <div class="panel-body no-padding">
                                                    <fieldset>
                                                        <input id="jsonTelefone" name="jsonTelefone" type="hidden" value="[]">
                                                        <div id="formTelefone" class="col-sm-6">
                                                            <input id="sequencialTelefone" name="sequencialTelefone" type="hidden" value="">
                                                            <input id="telefoneId" name="telefoneId" type="hidden" value="">
                                                            <div class="row">

                                                                <section class="col col-4 col-auto">
                                                                    <label class="label">Número de Telefone</label>
                                                                    <label class="input"><i class="icon-prepend fa fa-phone"></i>
                                                                        <input id="telefone" name="telefone" autocomplete="off" type="text" placeholder="(21) 99999-9999" value="">

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="label">&nbsp;</label>
                                                                    <label class="checkbox ">
                                                                        <input id="principal" name="principal" type="checkbox"><i></i>
                                                                        Principal
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="label">&nbsp;</label>
                                                                    <label class="checkbox ">
                                                                        <input id="whatsapp" name="whatsapp" type="checkbox"><i></i>
                                                                        WhatsApp
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="label">&nbsp;</label>
                                                                    <button id="btnInserirNumero" type="button" class="btn btn-primary">
                                                                        <i class="fa fa-plus"></i>
                                                                    </button>
                                                                    <button id="btnExcluirNumero" type="button" class="btn btn-danger">
                                                                        <i class="fa fa-minus"></i>
                                                                    </button>
                                                                </section>

                                                            </div>
                                                            <div class="table-responsive" style="min-height: 115px; width:90%; border: 1px solid #ddd; margin-bottom: 13px; overflow-x: auto;">
                                                                <table id="tableTelefone" class="table table-bordered table-striped table-condensed table-hover dataTable">
                                                                    <thead>
                                                                        <tr role="row">
                                                                            <th style="width: 2px"></th>
                                                                            <th class="text-center" style="min-width: 20px;">Telefone</th>
                                                                            <th class="text-center" style="min-width: 20px;">Principal</th>
                                                                            <th class="text-center" style="min-width: 20px;">WhatsApp</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                        <input id="jsonEmail" name="jsonEmail" type="hidden" value="[]">
                                                        <div id="formEmail" class="col-sm-6">
                                                            <input id="sequencialEmail" name="sequencialEmail" type="hidden" value="">
                                                            <input id="emailId" name="emailId" type="hidden" value="">
                                                            <div class="row">

                                                                <section class="col col-6 col-auto">
                                                                    <label class="label">Email</label>
                                                                    <label class="input"><i class="icon-prepend fa fa-envelope"></i>
                                                                        <input id="email" name="email" autocomplete="off" type="text" placeholder="ex:Joaquim@outlook.com" value="">

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="label">&nbsp;</label>
                                                                    <label class="checkbox ">
                                                                        <input id="emailPrincipal" name="emailPrincipal" type="checkbox" value="" checked="checked"><i></i>
                                                                        Principal
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="label">&nbsp;</label>
                                                                    <button id="btnInserirEmail" type="button" class="btn btn-primary">
                                                                        <i class="fa fa-plus"></i>
                                                                    </button>
                                                                    <button id="btnExcluirEmail" type="button" class="btn btn-danger">
                                                                        <i class="fa fa-minus"></i>
                                                                    </button>
                                                                </section>

                                                            </div>
                                                            <div class="table-responsive" style="min-height: 115px; width:90%; border: 1px solid #ddd; margin-bottom: 13px; overflow-x: auto;">
                                                                <table id="tableEmail" class="table table-bordered table-striped table-condensed table-hover dataTable">
                                                                    <thead>
                                                                        <tr role="row">
                                                                            <th style="width: 2px"></th>
                                                                            <th class="text-left" style="min-width: 40px;">Email</th>
                                                                            <th class="text-lefts" style="min-width: 10px;">Principal</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>


                                                    </fieldset>
                                                </div>
                                            </div>

                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseEndereco" class="collapsed" id="accordionEndereco">
                                                        <i class="fa fa-lg fa-angle-down pull-right"></i>
                                                        <i class="fa fa-lg fa-angle-up pull-right"></i>
                                                        Endereço
                                                    </a>
                                                </h4>
                                            </div>

                                            <div id="collapseEndereco" class="panel-collapse collapse">
                                                <div class="panel-body no-padding">
                                                    <fieldset>
                                                        <div>
                                                            <section class="col col-2 col-auto">
                                                                <label class="label">CEP</label>
                                                                <label class="input"><i class="icon-prepend fa fa-map-marker"></i>
                                                                    <input id="cep" name="cep" autocomplete="off" type="text" placeholder="XXXXX-XXX" value="">

                                                                </label>
                                                            </section>
                                                        </div>
                                                        <div class="row">
                                                        </div>
                                                        <div>
                                                            <section class="col col-4 col-auto">
                                                                <label class="label">Logradouro</label>
                                                                <label class="input"><i class="icon-prepend fa fa-home  "></i>
                                                                    <input id="endereco" name="endereco" autocomplete="off" type="text" placeholder="" value="">

                                                                </label>
                                                            </section>

                                                            <section class="col col-1 col-auto">
                                                                <label class="label">Número</label>
                                                                <label class="input"><i class=""></i>
                                                                    <input id="numero" name="numero" autocomplete="off" type="text" placeholder="" value="">

                                                                </label>
                                                            </section>

                                                            <section class="col col-3    col-auto">
                                                                <label class="label">Complemento</label>
                                                                <label class="input"><i class=""></i>
                                                                    <input id="complemento" name="complemento" autocomplete="off" type="text" placeholder="" value="">

                                                                </label>
                                                            </section>

                                                            <section class="col col-2    col-auto">
                                                                <label class="label">Bairro</label>
                                                                <label class="input"><i class=""></i>
                                                                    <input id="bairro" name="bairro" autocomplete="off" type="text" placeholder="" value="">

                                                                </label>
                                                            </section>

                                                            <section class="col col-3    col-auto">
                                                                <label class="label">Cidade</label>
                                                                <label class="input"><i class=""></i>
                                                                    <input id="cidade" name="cidade" autocomplete="off" type="text" placeholder="" value="">

                                                                </label>
                                                            </section>


                                                            <section class="col col-1">
                                                                <label for="" class="label">UF</label>
                                                                <label for="" class="select">
                                                                    <select id="uf" name="uf" class="required">
                                                                        <option></option>
                                                                        <option value="AC">AC</option>
                                                                        <option value="AL">AL</option>
                                                                        <option value="AP">AP</option>
                                                                        <option value="AM">AM</option>
                                                                        <option value="BA">BA</option>
                                                                        <option value="CE">CE</option>
                                                                        <option value="DF">DF</option>
                                                                        <option value="ES">ES</option>
                                                                        <option value="GO">GO</option>
                                                                        <option value="MA">MA</option>
                                                                        <option value="MT">MT</option>
                                                                        <option value="MS">MS</option>
                                                                        <option value="MG">MG</option>
                                                                        <option value="PA">PA</option>
                                                                        <option value="PB">PB</option>
                                                                        <option value="PR">PR</option>
                                                                        <option value="PE">PE</option>
                                                                        <option value="PI">PI</option>
                                                                        <option value="RJ">RJ</option>
                                                                        <option value="RN">RN</option>
                                                                        <option value="RS">RS</option>
                                                                        <option value="RO">RO</option>
                                                                        <option value="RR">RR</option>
                                                                        <option value="SC">SC</option>
                                                                        <option value="SP">SP</option>
                                                                        <option value="SE">SE</option>
                                                                        <option value="TO">TO</option>                                                                        
                                                                    </select><i class="fa fa-sort-desc"></i>
                                                                </label>

                                                            </section>

                                                        </div>

                                                    </fieldset>
                                                </div>
                                            </div>


                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseDependente" class="collapsed" id="accordionEndereco">
                                                        <i class="fa fa-lg fa-angle-down pull-right"></i>
                                                        <i class="fa fa-lg fa-angle-up pull-right"></i>
                                                        Dependentes
                                                    </a>
                                                </h4>
                                            </div>

                                            <div id="collapseDependente" class="panel-collapse collapse">
                                                <div class="panel-body no-padding">
                                                    <fieldset>

                                                        <input id="jsonDependente" name="jsonDependente" type="hidden" value="[]">
                                                        <div id="formDependente" class="col-sm-12">
                                                            <input id="sequencialDependente" name="sequencialDependente" type="hidden" value="">
                                                            <input id="dependenteId" name="dependenteId" type="hidden" value="">
                                                            <div class="row margin-left:10px;">

                                                                <section class="col col-3">
                                                                    <label class="label">Nome do Dependente</label>
                                                                    <label class="input"><i class="icon-prepend fa fa-user"></i>
                                                                        <input id="nomeDependente" maxlength="255" name="nomeDependente" class="" type="text" value="">
                                                                    </label>
                                                                </section>
                                                                <section class="col col-2">
                                                                    <label class="label">CPF do Dependente</label>
                                                                    <label class="input"><i class="icon-prepend fa fa-address-card"></i>
                                                                        <input type="text" maxlength="14" id="cpfDependente" name="cpfDependente" class="">

                                                                    </label>
                                                                </section>

                                                                <section class="col col-2 col-auto">
                                                                    <label class="label">Data de Nascimento</label>
                                                                    <label class="input">
                                                                        <i class="icon-append fa fa-calendar"></i>
                                                                        <input id="nascimentoDependente" name="nascimentoDependente" autocomplete="off" data-mask="99/99/9999" data-mask-placeholder="--/--/----" data-dateformat="dd/mm/yy" placeholder="--/--/----" type="text" class="" style="text-align:center;">

                                                                </section>

                                                                <section class="col col- col-auto">
                                                                    <label class="label">Tipo de Dependente</label>
                                                                    <label class="select">
                                                                        <select id="tipoDependente" name="tipoDependente">
                                                                            <?php
                                                                            $reposit = new reposit();
                                                                            $sql = "SELECT codigo,descricao
                                                                            FROM dbo.desc_dependentes ORDER BY codigo";
                                                                            $result = $reposit->RunQuery($sql);
                                                                            foreach ($result as $row) {
                                                                                $codigo = $row['codigo'];
                                                                                $descricao = $row['descricao'];
                                                                                echo '<option value=' . $codigo . '>' . $descricao . '</option>';
                                                                            }
                                                                            ?>
                                                                        </select><i></i>
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="label">&nbsp;</label>
                                                                    <button id="btnInserirDependente" type="button" class="btn btn-primary">
                                                                        <i class="fa fa-plus"></i>
                                                                    </button>
                                                                    <button id="btnExcluirDependente" type="button" class="btn btn-danger">
                                                                        <i class="fa fa-minus"></i>
                                                                    </button>
                                                                </section>

                                                            </div>


                                                            <div class="table-responsive" style="min-height: 115px; width:100%; border: 1px solid #ddd; margin-bottom: 13px; overflow-x: auto; ">
                                                                <table id="tableDependente" class="table table-bordered table-striped table-condensed table-hover dataTable ">
                                                                    <thead>
                                                                        <tr role="row">
                                                                            <th style="width: 2px"></th>
                                                                            <th class="text-center" style="min-width: 40px;">Nome do Dependente</th>
                                                                            <th class="text-center" style="min-width: 10px;">CPF</th>
                                                                            <th class="text-center" style="min-width: 10px;">Data de Nascimento</th>
                                                                            <th class="text-center" style="min-width: 10px;">Tipo de Dependente</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>

                                        <footer>
                                            <button type="button" id="btnExcluir" class="btn btn-danger" aria-hidden="true" title="Excluir">
                                                <span class="fa fa-trash"></span>
                                            </button>
                                            <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-front ui-dialog-buttons ui-draggable" tabindex="-1" role="dialog" aria-describedby="dlgSimpleExcluir" aria-labelledby="ui-id-1" style="height: auto; width: 600px; top: 220px; left: 262px; display: none;">
                                                <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
                                                    <span id="ui-id-2" class="ui-dialog-title">
                                                    </span>
                                                </div>
                                                <div id="dlgSimpleExcluir" class="ui-dialog-content ui-widget-content" style="width: auto; min-height: 0px; max-height: none; height: auto;">
                                                    <p>CONFIRMA A EXCLUSÃO ? </p>
                                                </div>
                                                <div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
                                                    <div class="ui-dialog-buttonset">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" id="btnGravar" class="btn btn-success" aria-hidden="true" title="Gravar">
                                                <span class="fa fa-floppy-o"></span>
                                            </button>
                                            <button type="button" id="btnNovo" class="btn btn-primary" aria-hidden="true" title="Novo">
                                                <span class="fa fa-file-o"></span>
                                            </button>
                                            <button type="button" id="btnVoltar" class="btn btn-default" aria-hidden="true" title="Voltar">
                                                <span class="fa fa-backward "></span>
                                            </button>
                                            <!-- <button type="button" style=<  id="btnPdf" class="btn btn-danger" aria-hidden="true" title="Abrir Pdf de Funcionários">
                                                <span class="fa fa-file-pdf-o  "></span>
                                            </button> -->

                                        </footer>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>

    </div>

    <!-- END MAIN CONTENT -->


</div>
<!-- END MAIN PANEL -->

<!-- ==========================CONTENT ENDS HERE ========================== -->

<!-- PAGE FOOTER -->
<?php
include "inc/footer.php";
?>
<!-- END PAGE FOOTER -->

<?php
//include required scripts
include "inc/scripts.php";
?>

<!-- PAGE RELATED PLUGIN(S)
<script src="..."></script>-->
<!-- validador CPF -->
<script src="js/plugin/cpfcnpj/jquery.cpfcnpj.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<script src="<?php echo ASSETS_URL; ?>/js/businessFuncionario.js" type="text/javascript"></script>


<!-- <script src="..."></script>--> -->
<!-- Flot Chart Plugin: Flot Engine, Flot Resizer, Flot Tooltip -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.cust.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.resize.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.time.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.tooltip.min.js"></script>

<!-- Vector Maps Plugin: Vectormap engine, Vectormap language -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- Full Calendar -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/moment/moment.min.js"></script>

<!--<script src="/js/plugin/fullcalendar/jquery.fullcalendar.min.js"></script>-->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/fullcalendar/fullcalendar.js"></script>

<!--<script src="<?php echo ASSETS_URL; ?>/js/plugin/fullcalendar/locale-all.js"></script>-->

<!-- Validador de CPF -->
<script src="js/plugin/cpfcnpj/jquery.cpfcnpj.js"></script>

<!-- Form to json -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/form-to-json/form2js.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/form-to-json/jquery.toObject.js"></script>




<script language="JavaScript" type="text/javascript">
    $(document).ready(function($) {
        jsonTelefoneArray = JSON.parse($("#jsonTelefone").val())
        jsonEmailArray = JSON.parse($("#jsonEmail").val())
        jsonDependenteArray = JSON.parse($("#jsonDependente").val())
        var cpf = $("#cpf").val();
        var cpfDependente = $("#cpfDependente").val();
        var primeiroEmprego = $("#primeiroEmprego").val();
        $('#cpf').mask('999.999.999-99');
        $('#rg').mask('99.999.999-9');
        $('#telefone').mask('(99) 99999-9999');
        $('#cep').mask('99999-999');
        $('#cpfDependente').mask('999.999.999-99');
        $('#pisPasep').mask('999.999999.99.9');

        $('#dlgSimpleExcluir').dialog({
            autoOpen: false,
            width: 400,
            resizable: false,
            modal: true,
            title: "Atenção",
            buttons: [{
                html: "Excluir registro",
                "class": "btn btn-success",
                click: function() {
                    $(this).dialog("close");
                    excluir();
                }
            }, {
                html: "<i class='fa fa-times'></i>&nbsp; Cancelar",
                "class": "btn btn-default",
                click: function() {
                    $(this).dialog("close");
                }
            }]
        });

        $("#cpf").on("change", function() {
            var cpf = $("#cpf").val()
            var id = $('#codigo').val();

            if (validarCPF() == false) {
                smartAlert("Atenção", "CPF inválido, não será possivel cadastrar", "error");
                $("#cpf").val('');
            }
        });

        $("#rg").on("change", function() {
            var rg = $("#rg").val()

            if (validarRg() == false) {
                smartAlert("Atenção", "RG inválido, Não será possivel Cadastrar!", "error");
                $("#rg").val('');
            } else {


            }
        });

        $("#dataNascimento").on("change", function() {
            var dateString = $("#dataNascimento").val()
            if (isValidDate(dateString) == false) {
                smartAlert("Atenção", "Data Inválida!", "error");
                $("#idade").val("");
                $("dataNascimento").val("");
            } else {
                validardata(dateString);
            }

        });

        $('#primeiroEmprego').on("click", function() {
            var primeiroEmprego = $('#primeiroEmprego').val();

            if (primeiroEmprego == 1) {
                $("#pisPasep").prop('disabled', true);
                $("#pisPasep").addClass('readonly', true);
                $("#pisPasep").removeClass('required', true);
                $("#pisPasep").val("");

            } else if (primeiroEmprego == 0) {
                $("#pisPasep").prop('disabled', false);
                $("#pisPasep").removeClass('readonly', true);
                $("#pisPasep").addClass('required', true);

            }

        })

        $("#nascimentoDependente").on("change", function() {

            var dateString = $("#nascimentoDependente").val()
            if (isValidDateDependente(dateString) != "" && false) {
                smartAlert("Atenção", "Data Inválida!", "error");

                $("nascimentoDependente").val("");
            }
        });

        $("#cpfDependente").on("change", function() {
            var cpfDependente = $("#cpfDependente").val();

            if (cpfDependente == "") {
                smartAlert("Atenção", "Por favor, infor o CPf do Dependente!", "error")
            } 

            if  ( validarCPF() == false){                
                smartAlert("Atenção", "CPF inválido, não será possivel cadastrar", "error");
                $("#cpfDependente").val('');                 
            }else    if ((cpf && cpfDependente != "") && (cpf == cpfDependente)) {
                smartAlert("Atenção", "CPF Titular igual o CPF do Dependente, Não será Possível Gravar", "error")
                $("#cpfDependente").val('');
            }else{
                verificarCpfDependente(cpfDependente);
            }                     

        });

        $("#cep").blur(function() {

            var cep = this.value.replace(/[^0-9]/, "");

            if (cep.length != 8) {
                return false;
            }

            var url = "https://viacep.com.br/ws/" + cep + "/json/";

            $.getJSON(url, function(dadosRetorno) {
                try {
                    // Preenche os campos de acordo com o retorno da pesquisa
                    $("#endereco").val(dadosRetorno.logradouro);
                    $("#bairro").val(dadosRetorno.bairro);
                    $("#cidade").val(dadosRetorno.localidade);
                    $("#uf").val(dadosRetorno.uf);
                } catch (ex) {}
            });
        });

        $("#btnInserirNumero").on("click", function() {
            validaTelefone();
        })

        $("#btnExcluirNumero").on("click", function() {
            excluiTelefoneTabela();
        })

        $("#btnInserirEmail").on("click", function() {
            validaEmail();
        })

        $("#btnExcluirEmail").on("click", function() {
            excluiEmailTabela();
        })

        $("#btnInserirDependente").on("click", function() {

            validaDependente();
        })

        $("#btnExcluirDependente").on("click", function() {
            excluiDependenteTabela();
        })

        $("#btnExcluir").on("click", function() {
            excluir();
        });

        $("#btnNovo").on("click", function() {
            novo();
        });

        $("#btnGravar").on("click", function() {
            verificarCpf();
        });

        $("#btnVoltar").on("click", function() {
            voltar();
        });

        carregaPagina();
    })

    function enableButton() {
        // Select the element with id "theButton" and disable it
        document.getElementById("btnGravar").disabled = false;
    }

    function disableButton() {
        // Select the element with id "theButton" and disable it
        document.getElementById("btnGravar").disabled = true;
    }

    function disableButtonInserir() {
        document.getElementById("btnInserirNumero").disabled = true;
    }

    function validardata(data) {
        data = data.replace(/\//g, "-"); // substitui eventuais barras (ex. IE) "/" por hífen "-"
        var data_array = data.split("-"); // quebra a data em array

        // para o IE onde será inserido no formato dd/MM/yyyy
        if (data_array[0].length != 4) {
            data = data_array[2] + "-" + data_array[1] + "-" + data_array[0]; // remonto a data no formato yyyy/MM/dd
        }

        // comparo as datas e calculo a idade
        var hoje = new Date();
        var nasc = new Date(data);
        var idade = hoje.getFullYear() - nasc.getFullYear();
        var m = hoje.getMonth() - nasc.getMonth();

        // if ((m === 0 && hoje.getDate() < nasc.getDate())) {
        //     smartAlert("Atenção", "Data Inválida!", "error");
        //     $("#idade").val("");
        //     $("#dataNascimento").val("");
        // } else {
        // }

        $("#idade").val(idade);

        if (idade < 14) {
            smartAlert("Atenção", "Pessoas menores de 14 não podem se cadastrar!", "error");
            return false;
        }

        if (idade >= 14 && idade <= 60) {
            // alert("Maior de 14, pode se cadastrar.");
            return true;
        }

        // se for maior que 60 não vai acontecer nada!
        // return false;
    }

    function isValidDateDependente(dateString) {
        // First check for the pattern
        if (!/^\d{1,2}\/\d{1,2}\/\d{4}$/.test(dateString))
            return false;
        // Parse the date parts to integers
        var parts = dateString.split("/");
        var day = parseInt(parts[0], 10);
        var month = parseInt(parts[1], 10);
        var year = parseInt(parts[2], 10);

        // Check the ranges of month and year
        if (year < 1930 || year > 2022 || month == 0 || month > 12)
            return false;

        var monthLength = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

        // Adjust for leap years
        if (year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
            monthLength[1] = 29;

        // //     // Check the range of the day
        return day > 0 && day <= monthLength[month - 1];
    }

    function isValidDate(dateString) {
        // First check for the pattern
        if (!/^\d{1,2}\/\d{1,2}\/\d{4}$/.test(dateString))
            return false;
        // Parse the date parts to integers
        var parts = dateString.split("/");
        var day = parseInt(parts[0], 10);
        var month = parseInt(parts[1], 10);
        var year = parseInt(parts[2], 10);

        // Check the ranges of month and year
        if (year < 1930 || year > 2022 || month == 0 || month > 12)
            return false;

        var monthLength = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

        // Adjust for leap years
        if (year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
            monthLength[1] = 29;

        // //     // Check the range of the day
        return day > 0 && day <= monthLength[month - 1];
    }

    function validarCPF() {
        let cpf = $("#cpf").val().replace(/[^\d]+/g, '');

        if (cpf == '') return false;
        // Elimina CPFs invalidos conhecidos
        if (cpf.length != 11 ||
            cpf == "00000000000" ||
            cpf == "11111111111" ||
            cpf == "22222222222" ||
            cpf == "33333333333" ||
            cpf == "44444444444" ||
            cpf == "55555555555" ||
            cpf == "66666666666" ||
            cpf == "77777777777" ||
            cpf == "88888888888" ||
            cpf == "99999999999")
            return false;
        // Valida 1o digito
        add = 0;
        for (i = 0; i < 9; i++)
            add += parseInt(cpf.charAt(i)) * (10 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(9)))
            return false;
        // Valida 2o digito
        add = 0;
        for (i = 0; i < 10; i++)
            add += parseInt(cpf.charAt(i)) * (11 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(10)))
            return false;
        return true;
    }

    function verificarCpf() {
        var cpf = $("#cpf").val();
        var id = $('#codigo').val();

        $.ajax({
            url: 'js/sqlscope_Funcionario.php', //caminho do arquivo a ser executado
            dataType: 'html', //tipo do retorno
            type: 'post', //metodo de envio
            data: {
                funcao: 'verificaCpf',
                cpf: cpf,
                id: id
            }, //valores enviados ao script
            success: function(data) {
                if (data == 'failed#') {
                    smartAlert("Atenção", "CPF já Cadastrado!", "error");
                    // $("#btnGravar").prop('disabled', true);
                } else {
                    verificarRg();
                }

            }

        });
    }

    function verificarCpfDependente() {

        var cpfDependente = $("#cpfDependente").val();

        $.ajax({
            url: 'js/sqlscope_Funcionario.php', //caminho do arquivo a ser executado
            dataType: 'html', //tipo do retorno
            type: 'post', //metodo de envio
            data: {
                funcao: 'verificaCpfDependente',
                cpfDependente: cpfDependente
            }, //valores enviados ao script
            success: function(data) {
                if (data == 'failed#') {
                    smartAlert("Atenção", "CPF já Cadastrado!", "error");
                    $("#btnGravar").prop('disabled', true);
                } else {
                    $("#btnGravar").prop('disabled', false);

                }

            }
        });
    }

    function validarRg() {
        let rg = $("#rg").val().replace(/[^\d]+/g, '');

        if (rg == '') return false;
        // Elimina rgs invalidos conhecidos
        if (rg.length != 9 ||
            rg == "000000000" ||
            rg == "111111111" ||
            rg == "222222222" ||
            rg == "333333333" ||
            rg == "444444444" ||
            rg == "555555555" ||
            rg == "666666666" ||
            rg == "777777777" ||
            rg == "888888888" ||
            rg == "999999999")
            return false;

    }

    function verificarRg() {
        var rg = $("#rg").val();
        var id = $('#codigo').val();

        $.ajax({
            url: 'js/sqlscope_Funcionario.php', //caminho do arquivo a ser executado
            dataType: 'html', //tipo do retorno
            type: 'post', //metodo de envio
            data: {
                funcao: 'verificaRg',
                rg: rg,
                id: id
            }, //valores enviados ao script
            success: function(data) {
                if (data == 'failed#') {
                    smartAlert("Atenção", "RG já Cadastrado!", "error");
                    $("#btnGravar").prop('disabled', true);
                } else {

                    gravar();
                }

            }

        });


    }

    function validaTelefone() {
        var achouTelefone = false;
        var achouPrincipal = false;
        var numeroFuncionario = $('#telefone').val();
        var telefoneId = $('#telefoneId').val();
        var sequencial = $('#sequencialTelefone').val();
        if ($("#principal").is(':checked')) {
            var principal = 1
        } else {
            var principal = 0
        }

        if ($("#whatsapp").is(':checked')) {
            var whatsapp = 1
        } else {
            var whatsapp = 0
        }

        if (!numeroFuncionario) {
            smartAlert("Atenção", "Preencha ao menos um meio de Contato", "error");
            return;
        }

        for (i = jsonTelefoneArray.length - 1; i >= 0; i--) {
            if (numeroFuncionario !== "") {
                if ((jsonTelefoneArray[i].telefone == numeroFuncionario) && (jsonTelefoneArray[i].sequencialTelefone != sequencial) ) {
                    achouTelefone = true;
                }
            }
        }

        for (i = jsonTelefoneArray.length - 1; i >= 0; i--) {
            if (principal !== "") {
                if ((jsonTelefoneArray[i].principal === principal) && (jsonTelefoneArray[i].sequencialTelefone != sequencial) && (principal == 1)) {
                    achouPrincipal = true;
                }
            }
        }

        if (achouTelefone || achouPrincipal === true) {
            smartAlert("Atenção", "Já existe esse Telefone ou Telefone Principal na lista.", "error");
            return false;
        }

        if (achouTelefone === false) {
            addTelefone();
        }


    }

    function addTelefone() {
        var item = $("#formTelefone").toObject({
            mode: 'combine',
            skipEmpty: false
        });

        if (item["sequencialTelefone"] === '') {
            if (jsonTelefoneArray.length === 0) {
                item["sequencialTelefone"] = 1;
            } else {
                item["sequencialTelefone"] = Math.max.apply(Math, jsonTelefoneArray.map(function(o) {
                    return o.sequencialTelefone;
                })) + 1;
            }
            item["telefoneId"] = 0;
        } else {
            item["sequencialTelefone"] = +item["sequencialTelefone"];
        }

        if ($("#principal").is(':checked')) {
            item['principalDescricao'] = "Sim"
            item['principal'] = 1

        } else {
            item['principalDescricao'] = "Não"
            item.principal = 0
        }

        if ($("#whatsapp").is(':checked')) {
            item['whatsappDescricao'] = "Sim"
            item.whatsapp = 1

        } else {
            item['whatsappDescricao'] = "Não"
            item.whatsapp = 0
        }



        var index = -1;
        $.each(jsonTelefoneArray, function(i, obj) {
            if (+$('#sequencialTelefone').val() === obj.sequencialTelefone) {
                index = i;
                return false;
            }
        });

        if (index >= 0)
            jsonTelefoneArray.splice(index, 1, item);
        else
            jsonTelefoneArray.push(item);

        $("#jsonTelefone").val(JSON.stringify(jsonTelefoneArray));

        fillTableTelefone();
        clearFormTelefone();
    }

    function fillTableTelefone() {
        $("#tableTelefone tbody").empty();
        for (var i = 0; i < jsonTelefoneArray.length; i++) {
            var row = $('<tr />');
            // var telefone = $("#telefone option[value = '" + jsonTelefoneArray[i].telefone + "']").text();

            $("#tableTelefone tbody").append(row);
            row.append($('<td><label class="checkbox"><input type="checkbox" name="checkbox" value="' + jsonTelefoneArray[i].sequencialTelefone + '"><i></i></label></td>'));

            row.append($('<td class="text-center" onclick="carregaTelefone(' + jsonTelefoneArray[i].sequencialTelefone + ');">' + jsonTelefoneArray[i].telefone + '</td>'));

            row.append($('<td class="text-center" >' + jsonTelefoneArray[i].principalDescricao + '</td>'));

            row.append($('<td class="text-center" >' + jsonTelefoneArray[i].whatsappDescricao + '</td>'));

        }
    }

    function carregaTelefone(sequencial) {
        var arr = jQuery.grep(jsonTelefoneArray, function(item, i) {
            return (item.sequencialTelefone === sequencial);
        });

        clearFormTelefone();

        if (arr.length > 0) {
            var item = arr[0];
            $("#telefoneId").val(item.telefoneId);
            $("#telefone").val(item.telefone);
            $("#sequencialTelefone").val(item.sequencialTelefone);
            $("#principal").val(item.principalDescricao);
            $("#whatsapp").val(item.whatsappDescricao);

            if (item.principal == 1) {
                $('#principal').prop('checked', true);
                $('#principal').val("Sim");
            } else {
                $('#principal').prop('checked', false);
                $('#principal').val("Não");
            }

            if (item.whatsapp == 1) {
                $('#whatsapp').prop('checked', true);
                $('#whatsapp').val("Sim");
            } else {
                $('#whatsapp').prop('checked', false);
                $('#whatsapp').val("Não");
            }
        }

    }

    function clearFormTelefone() {
        $("#telefone").val('');
        $("#telefoneId").val('');
        $("#sequencialTelefone").val('');
        $("#principal").prop('checked', false);
        $("#whatsapp").prop('checked', false);
    }

    function excluiTelefoneTabela() {
        var arrSequencial = [];
        $('#tableTelefone input[type=checkbox]:checked').each(function() {
            arrSequencial.push(parseInt($(this).val()));
        });
        if (arrSequencial.length > 0) {
            for (i = jsonTelefoneArray.length - 1; i >= 0; i--) {
                var obj = jsonTelefoneArray[i];
                if (jQuery.inArray(obj.sequencialTelefone, arrSequencial) > -1) {
                    jsonTelefoneArray.splice(i, 1);
                }
            }
            $("#jsonTelefone").val(JSON.stringify(jsonTelefoneArray));
            fillTableTelefone();
        } else
            alert("Selecione pelo menos um Número para excluir.");
    }

    function validaEmail() {
        var achouPrincipal = false;
        var achouEmail = false;
        var emailFuncionario = $('#email').val();
        var emailId = $('#emailId').val()
        var sequencial = $('#sequencialEmail').val()

        if ($("#emailPrincipal").is(':checked')) {
            var emailPrincipal = 1
        } else {
            var emailPrincipal = 0
        }


        if (!emailFuncionario) {
            smartAlert("Atenção", "Preencha o campo de Email", "error");
            return;
        }

        for (i = jsonEmailArray.length - 1; i >= 0; i--) {
            if (emailFuncionario !== "") {
                if ((jsonEmailArray[i].email === emailFuncionario) && (jsonEmailArray[i].sequencialEmail != sequencial)) {
                    achouEmail = true;
                    break;
                }
            }
        }

        for (i = jsonEmailArray.length - 1; i >= 0; i--) {
            if (emailPrincipal !== "") {
                if ((jsonEmailArray[i].emailPrincipal === emailPrincipal) && (jsonEmailArray[i].sequencialEmail != sequencial) && (emailPrincipal == 1)) {
                    achouPrincipal = true;
                }
            }
        }

        if (achouEmail || achouPrincipal === true) {
            samrtAlert("Atenção", "Email ou EmailPrincipal já existe na lista.", "error");
            $('#email').val("");
            return false;
        }

        if (achouEmail === false) {
            addEmail();
        }
    }

    function addEmail() {
        var item = $("#formEmail").toObject({
            mode: 'combine',
            skipEmpty: false
        });

        if (item["sequencialEmail"] === '') {
            if (jsonEmailArray.length === 0) {
                item["sequencialEmail"] = 1;
            } else {
                item["sequencialEmail"] = Math.max.apply(Math, jsonEmailArray.map(function(o) {
                    return o.sequencialEmail;
                })) + 1;
            }
            item["EmailId"] = 0;
        } else {
            item["sequencialEmail"] = +item["sequencialEmail"];
        }

        if ($("#emailPrincipal").is(':checked')) {
            item['principalDescricao'] = "Sim"
            item['emailPrincipal'] = true
        } else {
            item['principalDescricao'] = "Não"
            item['emailPrincipal'] = false
        }

        var index = -1;
        $.each(jsonEmailArray, function(i, obj) {
            if (+$('#sequencialEmail').val() === obj.sequencialEmail) {
                index = i;
                return false;
            }
        });

        if (index >= 0)
            jsonEmailArray.splice(index, 1, item);
        else
            jsonEmailArray.push(item);

        $("#jsonEmail").val(JSON.stringify(jsonEmailArray));

        fillTableEmail();
        clearFormEmail();
    }

    function fillTableEmail() {
        $("#tableEmail tbody").empty();
        for (var i = 0; i < jsonEmailArray.length; i++) {
            var row = $('<tr />');
            // var telefone = $("#telefone option[value = '" + jsonEmailArray[i].telefone + "']").text();

            $("#tableEmail tbody").append(row);
            row.append($('<td><label class="checkbox"><input type="checkbox" name="checkbox" value="' + jsonEmailArray[i].sequencialEmail + '"><i></i></label></td>'));

            row.append($('<td class="text-center" onclick="carregaEmail(' + jsonEmailArray[i].sequencialEmail + ');">' + jsonEmailArray[i].email + '</td>'));

            row.append($('<td class="text-left" >' + jsonEmailArray[i].principalDescricao + '</td>'));


        }
    }

    function carregaEmail(sequencial) {
        var arr = jQuery.grep(jsonEmailArray, function(item, i) {
            return (item.sequencialEmail === sequencial);
        });

        clearFormEmail();

        if (arr.length > 0) {
            var item = arr[0];
            $("#emailId").val(item.emailId);
            $("#email").val(item.email);
            $("#sequencialEmail").val(item.sequencialEmail);
            $("#emailPrincipal").val(item.principal);


            if (item.principalDescricao === 1) {
                $('#emailPrincipal').prop('checked', true);
                $('#emailPrincipal').val("Sim");
            } else {
                $('#emailPrincipal').prop('checked', false);
                $('#emailPrincipal').val("Não");
            }


        }

    }

    function clearFormEmail() {
        $("#emailId").val('');
        $("#sequencialEmail").val('');
        $("#Email").val('');
        // $("#funcionarioSimultaneos").val('');
    }

    function excluiEmailTabela() {
        var arrSequencial = [];
        $('#tableEmail input[type=checkbox]:checked').each(function() {
            arrSequencial.push(parseInt($(this).val()));
        });
        if (arrSequencial.length > 0) {
            for (i = jsonEmailArray.length - 1; i >= 0; i--) {
                var obj = jsonEmailArray[i];
                if (jQuery.inArray(obj.sequencialEmail, arrSequencial) > -1) {
                    jsonEmailArray.splice(i, 1);
                }
            }
            $("#jsonEmail").val(JSON.stringify(jsonEmailArray));
            fillTableEmail();
        } else
            alert("Selecione pelo menos um Email para excluir.");
    }

    function validaDependente() {
        var achouDependente = false;
        var nomeDependente = $('#nomeDependente').val();
        var dependenteId = $('#dependenteId').val();
        var sequencial = $('#sequencialDependente').val();
        var cpfDependente = $('#cpfDependente').val();
        var nascimentoDependente = $('#nascimentoDependente').val();
        var tipoDependente = $('#tipoDependente').val();

        if (!nomeDependente) {
            smartAlert("Atenção", "Preencha o Nome do Dependente", "error");
            return;
        }

        for (i = jsonDependenteArray.length - 1; i >= 0; i--) {
            if (cpfDependente !== "") {
                if ((jsonDependenteArray[i].Dependente === cpfDependente) && (jsonDependenteArray[i].sequencialDependente != sequencial)) {
                    achouDependente = true;
                    break;
                }
            }
        }

        if (achouDependente === true) {
            smartAlert("Atenção", "Já existe um Dependente com esse CPF na lista.", "error");
            $('#nomeDependente').val("");
            return false;
        }

        if (achouDependente === false) {
            addDependente();
        }
    }

    function addDependente() {
        var item = $("#formDependente").toObject({
            mode: 'combine',
            skipEmpty: false
        });
        //item.tipoDependente = $("#tipoDependente option:selected").text();


        if (item["sequencialDependente"] === '') {
            if (jsonDependenteArray.length === 0) {
                item["sequencialDependente"] = 1;
            } else {
                item["sequencialDependente"] = Math.max.apply(Math, jsonDependenteArray.map(function(o) {
                    return o.sequencialDependente;
                })) + 1;
            }
            item["dependenteId"] = 0;
        } else {
            item["sequencialDependente"] = +item["sequencialDependente"];
        }



        var index = -1
        $.each(jsonDependenteArray, function(i, obj) {
            if (+$('#sequencialDependente').val() === obj.sequencialDependente) {
                index = i;
                return false;
            }
        });

        if (index >= 0)
            jsonDependenteArray.splice(index, 1, item);
        else
            jsonDependenteArray.push(item);

        $("#jsonDependente").val(JSON.stringify(jsonDependenteArray));

        fillTableDependente();
        clearFormDependente();
    }

    function fillTableDependente() {
        $("#tableDependente tbody").empty();
        for (var i = 0; i < jsonDependenteArray.length; i++) {
            var row = $('<tr />');
            var dependente = $("#tipoDependente option[value = '" + jsonDependenteArray[i].tipoDependente + "']").text();

            $("#tableDependente tbody").append(row);
            row.append($('<td><label class="checkbox"><input type="checkbox" name="checkbox" value="' + jsonDependenteArray[i].sequencialDependente + '"><i></i></label></td>'));

            row.append($('<td class="text-left" onclick="carregaDependente(' + jsonDependenteArray[i].sequencialDependente + ');">' + jsonDependenteArray[i].nomeDependente + '</td>'));

            row.append($('<td class="text-center" >' + jsonDependenteArray[i].cpfDependente + '</td>'));

            row.append($('<td class="text-center" >' + jsonDependenteArray[i].nascimentoDependente + '</td>'));

            row.append($('<td class="text-center" >' + dependente + '</td>'));


        }
    }

    function carregaDependente(sequencial) {
        var arr = jQuery.grep(jsonDependenteArray, function(item, i) {
            return (item.sequencialDependente === sequencial);
        });

        clearFormDependente();

        if (arr.length > 0) {
            var item = arr[0];
            $("#nomeDependente").val(item.nomeDependente);
            $("#dependenteId").val(item.dependenteId);
            $("#sequencialDependente").val(item.sequencialDependente);
            $("#cpfDependente").val(item.cpfDependente);
            $("#nascimentoDependente").val(item.nascimentoDependente);
            $("#tipoDependente").val(item.tipoDependente);

        }

    }

    function clearFormDependente() {
        $("#DependenteId").val('');
        $("#sequencialDependente").val('');
        $("#nomeDependente").val('');
        // $("#funcionarioSimultaneos").val('');
    }

    function excluiDependenteTabela() {
        var arrSequencial = [];
        $('#tableDependente input[type=checkbox]:checked').each(function() {
            arrSequencial.push(parseInt($(this).val()));
        });
        if (arrSequencial.length > 0) {
            for (i = jsonDependenteArray.length - 1; i >= 0; i--) {
                var obj = jsonDependenteArray[i];
                if (jQuery.inArray(obj.sequencialDependente, arrSequencial) > -1) {
                    jsonDependenteArray.splice(i, 1);
                }
            }
            $("#jsonDependente").val(JSON.stringify(jsonDependenteArray));
            fillTableDependente();
        } else
            smartAlert("Atenção", "Selecione pelo menos um Número para excluir.", "error");
    }

    function carregaPagina() {
        var urlx = window.document.URL.toString();
        var params = urlx.split("?");
        if (params.length === 2) {
            var id = params[1];
            var idx = id.split("=");
            var idd = idx[1];
            if (idd !== "") {
                recuperaFuncionario(idd,
                    function(data) {
                        data = data.replace(/failed/g, '');
                        var piece = data.split("#");

                        //Atributos de Cliente
                        var mensagem = piece[0];
                        var out = piece[1];
                        var strArrayNumeroFuncionario = piece[2];
                        var strArrayEmailFuncionario = piece[3];
                        var strArrayDependenteFuncionario = piece[4];

                        piece = out.split("^");

                        //Atributos de clientes

                        var id = piece[0];
                        var nome = piece[1];
                        var ativo = piece[2];
                        var cpf = piece[3]
                        var rg = piece[4];
                        var dataNascimento = piece[5];
                        let idade = piece[6];
                        var genero = piece[7];
                        var primeiroEmprego = piece[8];
                        var pispasep = piece[9];
                        var cep = piece[10];
                        var endereco = piece[11];
                        var numero = piece[12];
                        var complemento = piece[13];
                        var cidade = piece[14];
                        var bairro = piece[15];
                        var uf = piece[16];
                        var estadoCivil = piece[17];


                        //Atributos de cliente
                        $("#codigo").val(id);
                        $("#nomeFuncionario").val(nome);
                        $("#ativo").val(ativo);
                        $("#cpf").val(cpf);
                        $("#rg").val(rg);
                        $("#dataNascimento").val(dataNascimento);
                        $("#idade").val(idade);
                        $("#descricao").val(genero);
                        $("#primeiroEmprego").val(primeiroEmprego);
                        if (primeiroEmprego == 1) {
                            $("#pisPasep").prop('disabled', true);
                            $("#pisPasep").addClass('readonly', true);
                            $("#pisPasep").removeClass('required', true);
                            $("#primeiroEmprego").prop('disabled', true);
                            $("#primeiroEmprego").addClass('readonly', true);
                        } else if (primeiroEmprego == 0) {
                            $("#pisPasep").prop('disabled', false);
                            $("#pisPasep").removeClass('readonly', true);
                            $("#pisPasep").addClass('required', true);
                            $("#primeiroEmprego").prop('disabled', true);
                        }
                        $("#pisPasep").val(pispasep);
                        $("#cep").val(cep);
                        $("#endereco").val(endereco);
                        $("#numero").val(numero);
                        $("#complemento").val(complemento);
                        $("#bairro").val(bairro);
                        $("#cidade").val(cidade);
                        $("#uf").val(uf);
                        $("#descricaoEstadoCivil").val(estadoCivil);


                        $("#jsonTelefone").val(strArrayNumeroFuncionario);

                        jsonTelefoneArray = JSON.parse($("#jsonTelefone").val());
                        fillTableTelefone();

                        $("#jsonEmail").val(strArrayEmailFuncionario);

                        jsonEmailArray = JSON.parse($("#jsonEmail").val());
                        fillTableEmail();

                        $("#jsonDependente").val(strArrayDependenteFuncionario);

                        jsonDependenteArray = JSON.parse($("#jsonDependente").val());
                        fillTableDependente();

                    }
                );
            }
        }
    }

    function novo() {
        $(location).attr('href', 'funcionarioCadastro.php');
    }

    function voltar() {
        $(location).attr('href', 'funcionarioFiltro.php');
    }

    function excluir() {
        var id = +$("#codigo").val();

        if (id === 0) {
            smartAlert("Atenção", "Selecione um registro para excluir!", "error");
            return;
        }
        excluirFuncionario(id);
    }

    function gravar() {
        var id = +($("#codigo").val());
        var nome = $("#nomeFuncionario").val();
        var cpf = $("#cpf").val();
        var rg = $('#rg').val()
        var dataNascimento = $("#dataNascimento").val();
        var codigoGenero = $("#descricao").val();
        var estadoCivil = $("#descricaoEstadoCivil").val();
        var primeiroEmprego = $("#primeiroEmprego").val();
        var pispasep = $("#pisPasep").val();
        var cep = $("#cep").val();
        var endereco = $("#endereco").val();
        var numero = $("#numero").val();
        var complemento = $("#complemento").val();
        var bairro = $("#bairro").val();
        var cidade = $("#cidade").val();
        var uf = $("#uf").val();
        var ativo = 0;

        var jsonTelefone = JSON.parse($("#jsonTelefone").val())
        var jsonEmail = JSON.parse($("#jsonEmail").val())
        var jsonDependente = JSON.parse($("#jsonDependente").val())

        if ((jsonTelefone || jsonEmail) == "") {
            smartAlert("Atenção", "Preencha pelo menos uma forma de Contato", "error");
            return;
        }

        if ($("#ativo").is(':checked')) {
            ativo = 1;
        }

        if (nome === "") {
            smartAlert("Atenção", "Preencha seu nome ", "error");
            return;
        }

        if (cpf === "") {
            smartAlert("Atenção", "Preencha seu CPF ", "error");
        }

        if (validarRg(rg) == false) {
            smartAlert("Atenção", "Informe seu RG ", "error");
            return;
        }

        if (validardata(dataNascimento) == false) {
            smartAlert("Atenção", "Data de Nascimento Inválida", "error");
            return;
        }

        gravaFuncionario(id, ativo, nome, cpf, rg, dataNascimento, codigoGenero, estadoCivil,
            primeiroEmprego, pispasep, cep, endereco, numero, complemento, cidade,
            bairro, uf, jsonTelefone, jsonEmail, jsonDependente,
            function(data) {
                if (data.indexOf('sucess') < 0) {
                    var piece = data.split("#");
                    var mensagem = piece[1];
                    if (mensagem !== "") {
                        smartAlert("Atenção", "Erro ao Cadastrar o Funcionário", "error");
                        $("#btnGravar").prop('disabled', false);
                    } else {

                    }
                    return '';
                } else {
                    smartAlert("Sucesso", "Funcionário Cadastrado Com Sucesso ", "success");
                    voltar();
                }
            })
    }
</script>