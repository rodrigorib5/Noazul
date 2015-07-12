<?php
?>
<div class="navbar-header">
	<button type="button" class="navbar-toggle" data-toggle="collapse"
		data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span>
		<span class="icon-bar"></span> <span class="icon-bar"></span>
	</button>
	<a class="navbar-brand" href="<?=BASE_URL;?>/">Noazul - Controle
		Financeiro</a>
</div>

<ul class="nav navbar-top-links navbar-right">
	<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
		href="#"> <i class="fa fa-user fa-fw"></i><?php echo $_SESSION['usuario']['nome']; ?> <i class="fa fa-caret-down"></i>
	</a>
		<ul class="dropdown-menu dropdown-user">
			<li><a href="#"><b><?php echo $_SESSION['usuario']['descricao'] ?></b></a></li>
		</ul> <!-- /.dropdown-user --></li>

	<li>
		<form method="post"
			action="<?=BASE_URL;?>/controllers/formsController.php">
			<input type="hidden" name="tipo" value="logout">
			<li><input type="submit" class="btn btn-default" value="Sair"></li>
		</form>
	</li>
	<!-- /.dropdown -->
</ul>


