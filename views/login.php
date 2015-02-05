<!DOCTYPE html>
<html>

<?php require_once 'layout/head.php';?>

<body>

	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">

				<div class="login-panel panel panel-default">

					<div class="panel-heading">

						<div align="center">
							<img src="<?=BASE_URL;?>/views/img/noazul.png" alt="No Azul"
								height="80" width="80">
						</div>

						<h3 class="panel-title">Login</h3>
					</div>

					<div class="panel-body">

					<div id="erro-senha"></div>
						<form method="post" class="login">
							<fieldset>						
								<div class="form-group">
									<input class="form-control" placeholder="Login de usuário" id="login" name="login" type="text" autofocus required>
								</div>
	
								<div class="form-group">
									<input class="form-control" placeholder="Senha de usuário" id="senha" name="senha" type="password" required>
								</div>
	
								<input type="submit" id="bota-login" class="btn btn-lg btn-success btn-block" value="Login">
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<fieldset></fieldset>

		</div>
	</div>

	<?php require_once 'layout/footer.php';?>

</body>
<script
	src="<?=BASE_URL;?>/views/js/mensagens-confirmacao/confirmacao.js">
</script>
</html>
