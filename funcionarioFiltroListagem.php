<?php
include "js/repositorio.php";
?>
<div class="table-container">
    <div class="table-responsive" style="min-height: 115px; border: 1px solid #ddd; margin-bottom: 13px; overflow-x: auto;">
        <table id="tableSearchResult" class="table table-bordered table-striped table-condensed table-hover dataTable">
            <thead>
                <tr role="row">
                    <th class="text-left" style="min-width:30px;">Nome Funcionário</th>
                    <th class="text-center" style="min-width:30px;">Data de Nascimento</th>
                    <th class="text-center" style="min-width:35px;">Ativo</th>
                    <th class="text-center" style="min-width:35px;">CPF</th>
                    <th class="text-center" style="min-width:35px;">Estado civil</th>
                    <th class="text-center" style="min-width:35px;">Gênero</th>
                    <th class="text-center" style="min-width:35px;">Relatório</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $nomeFiltro = "";


                if ($_GET["nome"] != "") {
                    $nomeFiltro = $_GET["nome"];
                    $where .= " AND nome LIKE '%$nomeFiltro%'";
                }

                if ($_GET["cpf"] != "") {
                    $cpfFiltro = $_GET["cpf"];
                    $where .= " AND cpf = '$cpfFiltro'";
                }

                $dataInicio = $_GET["dataInicio"];
                $campo1 = $dataInicio;
                if ($campo1) {
                    $campo1 = explode("/", $campo1);
                    $diaCampo = explode(" ", $campo1[2]);
                    $campo1 = $diaCampo[0] . "-" . $campo1[1] . "-" . $campo1[0];
                }
                $dataFim = $_GET["dataFim"];
                $campo2 = $dataFim;
                if ($campo2) {
                    $campo2 = explode("/", $campo2);
                    $diaCampo = explode(" ", $campo2[2]);
                    $campo2 = $diaCampo[0] . "-" . $campo2[1] . "-" . $campo2[0];
                }

                if (($campo1  && $campo2)) {
                    $where .= " AND dataNascimento BETWEEN '$campo1' AND '$campo2'";
                }
                if ((!$campo1 && $campo2)) {
                    $where .= "AND dataNascimento <= '$campo2'";
                }
                if (($campo1 && !$campo2)) {
                    $where .= " AND dataNascimento >= '$campo1'";
                }

                if ($_GET['genero'] != "") {
                    $genero = $_GET['genero'];
                    $where .=  " AND genero = $genero";
                }

                if ($_GET['estadoCivil'] != "") {
                    $estadoCivil = $_GET['estadoCivil'];
                    $where .=  " AND estadoCivil = $estadoCivil";
                }

                if ($_GET['ativo'] != "") {
                    $ativo =  $_GET['ativo'];
                    if ($ativo == 1) {
                        $where .= "AND ativo = $ativo";
                    }
                    if ($ativo == 0) {
                        $where .= "AND ativo = $ativo";
                    }
                }


                $sql = " SELECT f.codigo, f.nome, f.ativo, f.cpf, f.dataNascimento, f.genero , f.estadoCivil,
                GF.descricao, Ef.descricao as estadoCivil from dbo.funcionario f
                LEFT JOIN dbo.desc_genero GF on f.genero = GF.codigo
                LEFT JOIN dbo.estadoCivil EF ON f.estadoCivil= EF.codigo

                WHERE (0=0)";                      
                
                $sql = $sql . $where;
                $reposit = new reposit();
                $result = $reposit->RunQuery($sql);

                foreach ($result as $row) {
                    $id = (int) $row['codigo'];
                    $nomefuncionario = $row['nome'];
                    $ativo = (int) $row['ativo'];
                    $dataNascimento = $row['dataNascimento'];
                    $campo = $dataNascimento;
                    $campo = explode("-", $campo);
                    $diaCampo = explode(" ", $campo[2]);
                    $campo = $diaCampo[0] . "/" . $campo[1] . "/" . $campo[0];

                    $cpf = $row['cpf'];
                    $descricaoAtivo = "";
                    if ($ativo == 1) {
                        $descricaoAtivo = "Sim";
                    } else {
                        $descricaoAtivo = "Não";
                    }

                    $genero = $row['descricao'];
                    $estadoCivil = $row['estadoCivil'];
                    
                    
                    echo '<tr >';
                    echo '<td class="text-left"><a href="funcionarioCadastro.php?id=' . $id . '">' . $nomefuncionario . '</a></td>';
                    echo '<td class="text-center">' . $campo . '</td>';
                    echo '<td class="text-center">' . $descricaoAtivo . '</td>';
                    echo '<td class="text-center">' . $cpf . '</td>';
                    echo '<td class="text-center">' . $estadoCivil . '</td>';
                    echo '<td class="text-center">' . $genero . '</td>';
                    echo '<td class="text-center"><a href=pdf.php?function=dadosFuncionario&id='. $id .'><button type="button" style=< id ="btnPdf" class="btn btn-danger" aria-hidden="true" title="Abrir Pdf">
                    <span class="fa fa-file-pdf-o"></span>
                </button></td>';
                    echo '</tr >';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- PAGE RELATED PLUGIN(S) -->
<script src="js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
<script>
    $(document).ready(function() {

        // $('#btnPdf').on('click', function() {
        //     gerarPdf();
        // });        

        var responsiveHelper_dt_basic = undefined;
        var responsiveHelper_datatable_fixed_column = undefined;
        var responsiveHelper_datatable_col_reorder = undefined;
        var responsiveHelper_datatable_tabletools = undefined;

        var breakpointDefinition = {
            tablet: 1024,
            phone: 480
        };

        /* TABLETOOLS */
        $('#tableSearchResult').dataTable({
            // Tabletools options: 
            //   https://datatables.net/extensions/tabletools/button_options
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'T>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
            "oLanguage": {
                "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>',
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sLengthMenu": "_MENU_ Resultados por página",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            },
            "oTableTools": {
                "aButtons": ["copy", "csv", "xls", {
                        "sExtends": "pdf",
                        "sTitle": "SmartAdmin_PDF",
                        "sPdfMessage": "SmartAdmin PDF Export",
                        "sPdfSize": "letter"
                    },
                    {
                        "sExtends": "print",
                        "sMessage": "Generated by SmartAdmin <i>(press Esc to close)</i>"
                    }
                ],
                "sSwfPath": "js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
            },
            "autoWidth": true,
            "preDrawCallback": function() {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_datatable_tabletools) {
                    responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($('#tableSearchResult'), breakpointDefinition);
                }
            },
            "rowCallback": function(nRow) {
                responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
            },
            "drawCallback": function(oSettings) {
                responsiveHelper_datatable_tabletools.respond();


            }
        });

    });

    // function gerarPdf() {
    //         $(location).attr('href', 'pdf.php?function=dadosFuncionario', );
    //     }
</script>