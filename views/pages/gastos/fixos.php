<?php
$gastoController = new GastoController();
$gastosFixos = $gastoController->getTipoGastoAberto(AppUtil::GASTO_FIXO);
$valorTotal = null;
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Gastos Fixos</h1>
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
                <!-- Mensagem de confirmação -->
                <div id="mensagem">                
                </div>

    			<div class="row">
    				<div class="h3 col-xs-6 .col-sm-4">
    					<button 
    						type          = "button" 
    						class         = "btn btn-primary" 
    						data-toggle   = "modal" 
    						data-target   = "#salvarGastoModal" 
    						
    						>
    						Novo Gasto
    						</button>
    				</div>
    			</div>
                <!-- Caso não haja informações na tabela mostra mensagem -->
                <?php if($gastosFixos) { ?>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover"
                        id="dataTables-example">
                        <thead>
                            <tr>                                
                                <th>Descrição</th>
                                <th>Valor R$</th>
                                <th>Data de vencimento</th>
                                <th>Data de cadastro</th>
                                <th>Observações</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($gastosFixos as $gasto){ 	                       
	                        		$valorTotal += $gasto->valor;	                        
	                    
                        	?>  
                        
                            <tr>                                
                                <td class="gradeA"><?= $gasto->descricao ?></td>
                                <td class="gradeA">R$ <?= $gasto->valor ?></td>                                        
                                <td class="gradeA"><?= AppUtil::showHora($gasto->data) ?></td>
                                <td class="gradeA"><?= AppUtil::showHora($gasto->data_cadastro) ?></td>
                                <td class="gradeA"><?= $gasto->observacao ?></td>                                        
                                <td class="gradeA">
                                    <button 
                                        class="btn btn-default fa fa-check pagar"
                                        data-toggle= "tooltip" 
                                        data-placement= "top"  
                                        title="Pagar">
                                    </button> 
                                    <button 
                                        class           = "btn btn-default fa fa-pencil-square-o editar"
                                        data-toggle     = "modal" 
                                        data-target     = "#editarGastoModal"
                                        title           = "Editar"
                                    >
                                    </button>                                   
                                    <button 
                                        class           = "btn btn-default fa fa-times remover"
                                        data-toggle     = "tooltip" 
                                        data-placement  = "top"                                        
                                        title           = "Remover"
                                    >
                                    </button>
                                </td>                                        
                            </tr>
                        <?php }?>
                        </tbody>    
                    </table>
                        <?php 
                           
                        }else{
                            echo "Não há registros."; 
                        }?>
                </div>  
            </div>
            <!-- valores para passar no javascript -->
            <input type="hidden" id="id-gasto" value="<?= $gasto->id ?>">
            <input type="hidden" id="valor-gasto" value="<?= $gasto->valor ?>">

             <div class="h3 col-xs-6 .col-sm-4">
	             <button class="btn btn-lg btn-primary" disabled="disabled"><?= "Total: R$ " . $valorTotal ?></button>
             </div>            
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

<!-- Novo Gasto Fixo -->
<form method="post" id="gasto-fixo">
    <div class="modal fade" id="salvarGastoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Novo Gasto Fixo</h4>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="recipient-name" class="control-label">Descrição:</label>
                <input type="text" class="form-control" id="descricao" name="descricao" required>
              </div>
              <div class="form-group">
                <label for="recipient-name" class="control-label">Valor:</label>
                <input type="text" class="form-control" id="valor" name="valor" required>
              </div>
              <div class="form-group">
                <label for="recipient-name" class="control-label">Data de vencimento:</label>
                <input type="text" class="form-control" id="datepicker" name="data" required>
              </div>
              <div class="form-group">
                <label for="message-text" class="control-label">Observação:</label>
                <textarea class="form-control" id="observacao" name="observacao"></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="tipo" value="gasto"/>
            <input type="hidden" name="acao" value="salvar">
            <input type="hidden" name="tipo-gasto" value="1">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button id="salvar-gasto" type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </div>
      </div>
    </div>
</form>

<!-- Editar Gasto -->
<form method="post" id="editar-fixo">
<div class="modal fade" id="editarGastoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Editar Gasto Fixo</h4>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="recipient-name" class="control-label">Descrição:</label>
                <input type="text" class="form-control" id="descricao" name="descricao" required>
              </div>
              <div class="form-group">
                <label for="recipient-name" class="control-label">Valor:</label>
                <input type="text" class="form-control" id="valor" name="valor" required>
              </div>
              <div class="form-group">
                <label for="recipient-name" class="control-label">Data de vencimento:</label>
                <input type="text" class="form-control" id="datepicker" name="data" required>
              </div>
              <div class="form-group">
                <label for="message-text" class="control-label">Observação:</label>
                <textarea class="form-control" id="observacao" name="observacao"></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="tipo" value="gasto"/>
            <input type="hidden" name="acao" value="editar">
            <input type="hidden" name="tipo-gasto" value="1">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button id="editar-gasto" type="submit" class="btn btn-primary">Editar</button>
          </div>
        </div>
      </div>
    </div>
</form>
<!-- Pagar -->
<div id="dialog-confirm" title="Pagamento de gastos">
  <p><span 
        class="ui-icon ui-icon-alert" 
        style="float:left; margin:0 7px 20px 0;"
        >
     </span>Realmente deseja pagar este gasto ?</p>
</div>

<script src="<?=BASE_URL;?>/views/js/mensagens-confirmacao/confirmacao.js"></script>