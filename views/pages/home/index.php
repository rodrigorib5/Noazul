<?php

$saldoController = new SaldoController();
$saldo = $saldoController->getSaldo();

$receitaController = new ReceitaController();
$receita = $receitaController->getReceitaBruta();

$gastoController = new GastoController();
$gasto = $gastoController->getGastosPorDescricao();

if($saldo->saldo >= 0){
	$cor = "panel-primary";
	$icone = "fa-thumbs-o-up";
}else{
	$cor = "panel-danger";
	$icone = "fa-thumbs-o-down";
}

?>
<div class="row">
	<div class="col-lg-5">
		<h1 class="page-header">Visão Geral</h1>		
	</div>
	<!-- /.col-lg-12 -->
</div>

<!-- /.row -->
<div class="row">
	<div class="col-lg-3 col-md-6">
		<div class="panel <?php echo $cor?>">
			<div 
				class="panel-heading" 
				data-toggle="tooltip" 
				data-placement="top" 
				title="Calculo entre valores positivos e negativos">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa <?php echo $icone ?> fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<span class="huge"></span><div class="huge fa fa-usd" ><?php echo $saldo->saldo ?></div>
						<div>Saldo</div>
					</div>
				</div>
			</div>
			<a href="#">
				<div class="panel-footer">
					<span 
						class="pull-left" 
						data-toggle="tooltip" 
						data-placement="left" 
						title="Soma de todas as receitas">
							Receita bruta R$ <?php echo $receita->total ?>
					</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix">
					</div>
				</div>
			</a>
		</div>
	</div>

	<div class="col-lg-3 col-md-6">
		<div class="panel panel-green">
			<div class="panel-heading">
				<div class="row" data-toggle="tooltip" data-placement="top" title="São todas as despesas que têm o mesmo montante mensalmente">
					<div class="col-xs-3">
						<i class="fa fa-money fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<span class="huge">-</span><div class="huge fa fa-usd"><?php echo $gasto->fixo?></div>
						<div>Gastos Fixos</div>
					</div>
				</div>
			</div>
			<a href="#">
				<div class="panel-footer">
					<span class="pull-left">Ver detalhes</span> <span
						class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-yellow">
			<div class="panel-heading">
				<div class="row" data-toggle="tooltip" data-placement="top" title="São as contas que você paga todo mês, mas que podem ter valores diferentes">
					<div class="col-xs-3">
						<i class="fa fa fa-money fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<span class="huge">-</span><div class="huge fa fa-usd"><?php echo $gasto->variavel?></div>
						<div>Gastos Variáveis</div>
					</div>
				</div>
			</div>
			<a href="#">
				<div class="panel-footer">
					<span class="pull-left">Ver detalhes</span> <span
						class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-red">
			<div class="panel-heading">
				<div class="row" data-toggle="tooltip" data-placement="top" title="São todos aqueles que você não precisa fazer mensalmente">
					<div class="col-xs-3">
						<i class="fa fa-credit-card fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<span class="huge">-</span><div class="huge fa fa-usd"><?php echo $gasto->ocasional?></div>
						<div>Gastos Ocasionais</div>
					</div>
				</div>
			</div>
			<a href="#">
				<div class="panel-footer">
					<span class="pull-left">Ver detalhes</span> <span
						class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
</div>

<div class="row">	
	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bell fa-fw"></i> Contas a Pagar
			</div>

			<div class="panel-body">
				<button 
					type 			= "button"
					class 			= "btn btn-danger btn-lg btn-block"
					data-toggle		= "modal" 
					data-target		= "#exampleModal" 
					data-whatever	= "@mdo"
			  	>
			  	Novo Gasto
			  	</button>

				<!-- Mensagem de confirmação -->
            </div>
							<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="list-group">
					<a href="#" class="list-group-item"> <i
						class="fa fa-comment fa-fw"></i> New Comment <span
						class="pull-right text-muted small"><em>4 minutes
								ago</em> </span>
					</a> <a href="#" class="list-group-item"> <i
						class="fa fa-twitter fa-fw"></i> 3 New Followers <span
						class="pull-right text-muted small"><em>12 minutes
								ago</em> </span>
					</a> <a href="#" class="list-group-item"> <i
						class="fa fa-envelope fa-fw"></i> Message Sent <span
						class="pull-right text-muted small"><em>27 minutes
								ago</em> </span>
					</a> <a href="#" class="list-group-item"> <i
						class="fa fa-tasks fa-fw"></i> New Task <span
						class="pull-right text-muted small"><em>43 minutes
								ago</em> </span>
					</a> <a href="#" class="list-group-item"> <i
						class="fa fa-upload fa-fw"></i> Server Rebooted <span
						class="pull-right text-muted small"><em>11:32 AM</em> </span>
					</a> <a href="#" class="list-group-item"> <i
						class="fa fa-bolt fa-fw"></i> Server Crashed! <span
						class="pull-right text-muted small"><em>11:13 AM</em> </span>
					</a> <a href="#" class="list-group-item"> <i
						class="fa fa-warning fa-fw"></i> Server Not Responding <span
						class="pull-right text-muted small"><em>10:57 AM</em> </span>
					</a> <a href="#" class="list-group-item"> <i
						class="fa fa-shopping-cart fa-fw"></i> New Order Placed <span
						class="pull-right text-muted small"><em>9:49 AM</em> </span>
					</a> <a href="#" class="list-group-item"> <i
						class="fa fa-money fa-fw"></i> Payment Received <span
						class="pull-right text-muted small"><em>Yesterday</em> </span>
					</a>
				</div>
				<!-- /.list-group -->
				<a href="<?=BASE_URL;?>/gastos/todos" class="btn btn-default btn-block">Ver todos</a>
			</div>
	<!-- /.panel-body -->
		</div>
	</div>

	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bell fa-fw"></i> Próximas Receitas
			</div>

			<div class="panel-body">
				<button type="button" class="btn btn-primary btn-lg btn-block">Nova Receita</button>
			</div>
							<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="list-group">
					<a href="#" class="list-group-item"> <i
						class="fa fa-comment fa-fw"></i> New Comment <span
						class="pull-right text-muted small"><em>4 minutes
								ago</em> </span>
					</a> <a href="#" class="list-group-item"> <i
						class="fa fa-twitter fa-fw"></i> 3 New Followers <span
						class="pull-right text-muted small"><em>12 minutes
								ago</em> </span>
					</a> <a href="#" class="list-group-item"> <i
						class="fa fa-envelope fa-fw"></i> Message Sent <span
						class="pull-right text-muted small"><em>27 minutes
								ago</em> </span>
					</a> 
				</div>
				<!-- /.list-group -->
				<a href="<?=BASE_URL;?>/receita/" class="btn btn-default btn-block">Ver todos</a>
			</div>
	<!-- /.panel-body -->
		</div>
	</div>

	<div class="col-lg-4">	
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bar-chart-o fa-fw"></i> Gastos
			</div>
			<div class="panel-body">
				<div id="morris-donut-chart"></div>				
			</div>		
		</div>	
	</div>	
</div>

<!-- Novo Gasto Fixo -->
<form method="post" id="gasto-fixo">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Novo gasto</h4>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="recipient-name" class="control-label">Descrição:</label>
                <input type="text" class="form-control" id="descricao" name="descricao" required>
              </div>
              <div class="form-group">
                <label for="recipient-name" class="control-label">Tipo de Gasto:</label>
                <select class="form-control" id="tipo-gasto" name="tipo-gasto">
                	<option></option>
                	<option value="1">Fixo</option>
                	<option value="2">Ocasional</option>
                	<option value="3">Variável</option>
                </select>
              </div>
              <br>
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
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button id="salvar-gasto" type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </div>
      </div>
    </div>
</form>

