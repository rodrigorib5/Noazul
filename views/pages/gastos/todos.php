<?php
$gastoController = new GastoController();
$todosGastos = $gastoController->getTodosGastos();
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Gastos Ocasionais</h1>
    </div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Detalhe dos gastos</div>
            <!-- /.panel-heading -->
            <div class="panel-body">

                <!-- Caso não haja informações na tabela mostra mensagem -->
                <?php if($todosGastos) { ?>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover"
                        id="dataTables-example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Descrição</th>
                                <th>Tipo Gasto</th>
                                <th>Valor R$</th>
                                <th>Data de vencimento</th>
                                <th>Data de cadastro</th>
                                <th>Observações</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($todosGastos as $gasto){ ?>  
                        
                            <tr>
                                <td class="gradeA"><?= $gasto->id ?></td>
                                <td class="gradeA"><?= $gasto->descricao ?></td>
                                <td class="gradeA"><?= $gasto->descricaoTpGasto ?></td>
                                <td class="gradeA"><?= $gasto->valor ?></td>                                        
                                <td class="gradeA"><?= AppUtil::showHora($gasto->data) ?></td>
                                <td class="gradeA"><?= AppUtil::showHora($gasto->data) ?></td>
                                <td class="gradeA"><?= $gasto->observacao ?></td>                                        
                                <td class="gradeA">
                                    <button 
                                        class="btn btn-default fa fa-pencil-square-o editar"
                                        data-toggle= "tooltip" 
                                        data-placement= "top"  
                                        title="Editar">
                                    </button>
                                    <button 
                                        class="btn btn-default fa fa-times remover"
                                        data-toggle= "tooltip" 
                                        data-placement= "top"  
                                        title="Remover">
                                    </button>
                                </td>                                        
                            </tr>
                        <?php }?>
                        </tbody>
                            <?php 

                            }else{
                                echo "Não há registros."; 

                        	}?>
                    </table>
                </div>              
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>  