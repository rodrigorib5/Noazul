<?php

$receitaController = new ReceitaController();
$receita = $receitaController->getReceitaBruta();

$gastoController = new GastoController();
$gasto = $gastoController->getGastosPorDescricao();

$receitaLiquida = $receitaController->getReceitaLiquida();

if($receitaLiquida >= 0){
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
						<span class="huge"></span><div class="huge fa fa-usd" ><?php echo $receitaLiquida ?></div>
						<div>Líquido</div>
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
							Receita bruta R$ <?php echo $receita->total ?></span> <span
						class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
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
<!-- /.row -->
<div class="row">
	<div class="col-lg-4">
		<div class="panel panel-default">				
			<div class="panel-heading">
				<i class="fa fa-bell fa-fw"></i> LANÇAR RÁPIDO
			</div>			
					<!-- /.panel-heading -->
		
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-6">	
					<a href="">
						<div class="panel panel-green">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-plus fa-5x"></i>
										
									</div>
									<div class="col-xs-9 text-right">									
										<div>Receita</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					</a>				
					<div class="col-lg-6">
						<div class="panel panel-red">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-minus fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">										
										<div>Gastos Ocasionais</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>					
			</div>
		</div>
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bar-chart-o fa-fw"></i> Gráfico em Donut
			</div>
			<div class="panel-body">
				<div id="morris-donut-chart"></div>				
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel-body -->
		
	</div>
	<div class="col-lg-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bar-chart-o fa-fw"></i> Area Chart Example
				<div class="pull-right">
					<div class="btn-group">
						<button type="button"
							class="btn btn-default btn-xs dropdown-toggle"
							data-toggle="dropdown">
							Actions <span class="caret"></span>
						</button>
						<ul class="dropdown-menu pull-right" role="menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="#">Separated link</a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div id="morris-area-chart"></div>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bar-chart-o fa-fw"></i> Bar Chart Example
				<div class="pull-right">
					<div class="btn-group">
						<button type="button"
							class="btn btn-default btn-xs dropdown-toggle"
							data-toggle="dropdown">
							Actions <span class="caret"></span>
						</button>
						<ul class="dropdown-menu pull-right" role="menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="#">Separated link</a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="row">
					<div id="morris-bar-chart"></div>
				</div>
				<!-- /.row -->
			</div>
			<!-- /.panel-body -->
		</div>	
	</div>
	<!-- /.col-lg-4 -->			
</div>
<!-- /.row -->
