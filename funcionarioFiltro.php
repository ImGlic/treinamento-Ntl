<?php
//initilize the page
require_once "inc/init.php";

//require UI configuration (nav, ribbon, etc.)
require_once "inc/config.ui.php";

//colocar o tratamento de permissão sempre abaixo de require_once("inc/config.ui.php");
$condicaoAcessarOK = true;
$condicaoGravarOK = true;

if ($condicaoAcessarOK == false) {
    unset($_SESSION['login']);
    header("Location:login.php");
}

$esconderBtnGravar = "";
if ($condicaoGravarOK === false) {
    $esconderBtnGravar = "none";
}

/* ---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Funcionário Filtro";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include "inc/header.php";

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["configuracao"]["sub"]["funcionario"]["active"] = true;

include "inc/nav.php";
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
    <?php
//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
//$breadcrumbs["New Crumb"] => "http://url.com"
$breadcrumbs["Configurações"] = "";
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
                            <h2>Funcionário</h2>
                        </header>
                        <div>
                            <div class="widget-body no-padding">
                                <form action="javascript:gravar()" class="smart-form client-form" id="formUsuarioFiltro" method="post">
                                    <div class="panel-group smart-accordion-default" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFiltro" class="">
                                                        <i class="fa fa-lg fa-angle-down pull-right"></i>
                                                        <i class="fa fa-lg fa-angle-up pull-right"></i>
                                                        Filtro
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseFiltro" class="panel-collapse collapse in">
                                                <div class="panel-body no-padding">
                                                    <fieldset>
                                                        <div class="row">
                                                            <section class="col col-">
                                                                <label class="label">Nome do Funcionário</label>
                                                                <label class="input"><i class="icon-prepend fa fa-user"></i>
                                                                    <input id="nome" maxlength="50" name="nome" type="text" value="">
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label class="label">CPF</label>
                                                                <label class="input">
                                                                    <input type="text" maxlength="14" id="cpf" name="cpf" class="">
                                                                    <!-- <span id="resposta"></span> -->
                                                                </label>
                                                            </section>
                                                            <section class="col col-2 col-auto">
                                                                <label class="label">Data inicio</label>
                                                                <label class="input">
                                                                    <i class="icon-append fa fa-calendar"></i>
                                                                    <input id="dataInicio" name="dataInicio" autocomplete="off" data-mask="99/99/9999" data-mask-placeholder="--/--/----" data-dateformat="dd/mm/yy" placeholder="--/--/----" type="text" style="text-align:center;">

                                                            </section>
                                                            <section class="col col-2 col-auto">
                                                                <label class="label">Data Fim</label>
                                                                <label class="input">
                                                                    <i class="icon-append fa fa-calendar"></i>
                                                                    <input id="dataFim" name="dataFim" autocomplete="off" data-mask="99/99/9999" data-mask-placeholder="--/--/----" data-dateformat="dd/mm/yy" placeholder="--/--/----" type="text" style="text-align:center;">

                                                            </section>

                                                            <section class="col col-2 col-auto">
                                                                <label class="label">Gênero</label>
                                                                      <label class="select">
                                                                    <select id="genero" name="genero">
                                                                        <option></option>
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
                                                            
                                                            <section class="col col-1">
                                                                    <label class="label">Ativo</label>
                                                                    <label class="select">
                                                                    <select id="ativo">
                                                                        <option></option>
                                                                        <option value="1">Sim</option>
                                                                        <option value="0">Não</option>
                                                                    </select><i></i>
                                                                    </label>
                                                                </section>

                                                                <section class="col col-2 col-auto">
                                                                <label class="label">Estado Civil</label>
                                                                <label class="select">
                                                                
                                                                    <select id="estadoCivil" name="estadoCivil">
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
                                                                
                                                                

                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>

                                            <footer>
                                                <button id="btnSearch" type="button" class="btn btn-primary pull-right" title="Buscar">
                                                    <span class="fa fa-search"></span>
                                                </button>
                                                <button type="button" style=< id ="btnPdf" class="btn btn-danger" aria-hidden="true" title="Abrir Pdf de Funcionários">
                                                    <span class="fa fa-file-pdf-o  "></span>
                                                </button>
                                                <?php if ($condicaoGravarOK) {?>
                                                    <button id="btnNovo" type="button" class="btn btn-primary pull-left" title="Novo">
                                                        <span class="fa fa-file"></span>
                                                    </button>
                                                <?php }?>
                                            </footer>

                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="resultadoBusca"></div>
                        </div>
                    </div>
                </article>
            </div>
        </section>
        <!-- end widget grid -->
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
<!--script src="<?php echo ASSETS_URL; ?>/js/businessTabelaBasica.js" type="text/javascript"></script-->
<!-- PAGE RELATED PLUGIN(S)
<script src="..."></script>-->
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
<script src="<?php echo ASSETS_URL; ?>/js/plugin/fullcalendar/locale-all.js"></script>


<script>
    $(document).ready(function() {
        
        $('#btnSearch').on("click", function() {
            listarFiltro();
        });
        $('#btnNovo').on("click", function() {
            novo();
        });
        $('#btnPdf').on('click', function() {
            gerarPdf();
        })
    });

    function gerarPdf() {
        var genero =$('#genero').val();
        var estadoCivil =$('#estadoCivil').val();

        var parametrosUrl = '&genero=' + genero + '&estadoCivil=' + estadoCivil;
        $(location).attr('href', 'pdf.php?function=dadosGerais' + parametrosUrl);
    }



    function listarFiltro() {
        var nome = $('#nome').val();
        var cpf = $('#cpf').val();
        var descricao = $('#descricao').val();
        var dataInicio = $('#dataInicio').val();
        var dataFim = $('#dataFim').val();
        var genero = $('#genero').val();
        var ativo = $('#ativo').val();

        if (nome !== "") {
            nome = nome.replace(/^\s+|\s+$/g, "");
            nome = encodeURIComponent(nome);
        }

        if (cpf !== "") {
            cpf = cpf.replace(/^\s+|\s+$/g, "");
            cpf = encodeURIComponent(cpf);
        }
        var parametrosUrl = '&nome=' + nome + '&cpf=' + cpf + '&descricao=' + descricao + '&dataInicio=' + dataInicio + '&dataFim=' + dataFim + '&descricao=' + genero + '&ativo=' + ativo;
        $('#resultadoBusca').load('funcionarioFiltroListagem.php?' + parametrosUrl);
    }

    function novo() {
        $(location).attr('href', 'funcionarioCadastro.php');
    }
</script>