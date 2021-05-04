<?php
include "js/repositorio.php";
?>
<div class="table-container">
    <div class="table-responsive" style="min-height: 115px; border: 1px solid #ddd; margin-bottom: 13px; overflow-x: auto;">
        <table id="tableSearchResult" class="table table-bordered table-striped table-condensed table-hover dataTable">
            <thead>
                <tr role="row">
                    <th class="text-left" style="min-width:30px;">Mês Ano</th>
                    <th class="text-left" style="min-width:30px;">Projeto</th>
                    <th class="text-left" style="min-width:30px;">Usuario Fechamento</th>
                    <th class="text-left" style="min-width:30px;">Data Fechamento</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $reposit = new reposit();
                $sql = "SELECT PB.codigo, PB.mesAno, PB.projeto,P.descricao,P.apelido, PB.usuarioFechamento,PB.dataFechamento
                        FROM Beneficio.processaBeneficio AS PB
                        LEFT JOIN ntl.projeto AS P ON PB.projeto = P.codigo";
                $where = " WHERE (0=0) ";


                if ($_GET["mesAno"] != "") {
                    $mesAno = $_GET["mesAno"];
                    $where = $where . " AND ( mesAno like '%' + " . "replace('" . $mesAno . "',' ','%') + " . "'%')";
                }

                if ($_GET["projeto"] != "") {
                    $projeto = $_GET["projeto"];
                    $where = $where . " AND projeto = $projeto";
                }

                $sql = $sql . $where;
                $result = $reposit->RunQuery($sql);

                foreach ($result as $row) {
                    $codigo = (int) $row['codigo'];
                    $mesAno = (string) $row['mesAno'];
                    $projetoDescricao = (string) $row['apelido'];
                    $usuarioFechamento = (string) $row['usuarioFechamento'];
                    $dataFechamento = (string)$row['dataFechamento'];

                    if ($dataFechamento != "") {
                        $dataFechamento = explode("-", $dataFechamento);
                        $dataFechamentoDia = explode(" ", $dataFechamento[2]);
                        // $dataFechamentoHoras =  $dataFechamentoDia[1];
                        // $dataFechamentoHoras = explode(".", $dataFechamentoHoras);
                        $dataFechamento = $dataFechamentoDia[0] . "/" . $dataFechamento[1] . "/" . $dataFechamento[0];
                    }

                    echo '<tr>';
                    echo '<td class="text-center" onclick=abreModal(); ><a ' . $codigo . '">'  . $mesAno . '</a></td>';
                    echo '<td class="text-center">' . $projetoDescricao . '</td>';
                    echo '<td class="text-center">' . $usuarioFechamento . '</td>';
                    echo '<td class="text-center">' . $dataFechamento . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="parametroLinkModalPanel" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:75%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title"> Calculo por grupo</h4>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<!-- PAGE RELATED PLUGIN(S) -->

<script src="js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
<script src="js/plugin/datatables/sorting/date-eu.js"></script>
<link rel="stylesheet" type="text/css" href="js/plugin/Buttons-1.5.2/css/buttons.dataTables.min.css" />

<script type="text/javascript" src="js/plugin/JSZip-2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="js/plugin/pdfmake-0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="js/plugin/pdfmake-0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="js/plugin/Buttons-1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="js/plugin/Buttons-1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="js/plugin/Buttons-1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="js/plugin/Buttons-1.5.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        var responsiveHelper_datatable_tabletools = undefined;

        var breakpointDefinition = {
            tablet: 1024,
            phone: 480
        };

        function abreModal() {
            $('#parametroLinkModalPanel').modal();
        }

        /* TABLETOOLS */
        $('#tableSearchResult').dataTable({

            // Tabletools options:
            //   https://datatables.net/extensions/tabletools/button_options
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'B'l'C>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
            "oLanguage": {
                "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>',
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                //"sLengthMenu": "_MENU_ Resultados por página",
                "sLengthMenu": "_MENU_",
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
            "buttons": [
                //{extend: 'copy', className: 'btn btn-default'},
                //{extend: 'csv', className: 'btn btn-default'},
                {
                    extend: 'excel',
                    className: 'btn btn-default'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-default'
                },
                //{extend: 'print', className: 'btn btn-default'}
            ],
            "autoWidth": true,

            "preDrawCallback": function() {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_datatable_tabletools) {
                    responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($(
                        '#tableSearchResult'), breakpointDefinition);
                }
            },
            "rowCallback": function(nRow) {
                responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
            },
            "drawCallback": function(oSettings) {
                responsiveHelper_datatable_tabletools.respond();
            },
            "columnDefs": [{
                "type": 'date-eu',
                "targets": [0, 3]
            }],
        });

        /* END TABLETOOLS */
    });
</script>