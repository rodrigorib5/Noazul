<!-- 
	Inclui as páginas, controllers e models para serem usados.
	Verifica se a sessão está ativa
-->

<?php
include 'autoload.php';
SiteController::autenticacao ();

?>

<!DOCTYPE html>
<html>
<?php include_once 'views/layout/head.php';?>
<body>

	<div id="wrapper">

		<nav class="navbar navbar-default navbar-static-top" role="navigation"
			style="margin-bottom: 0">
            <?php include 'views/layout/menuSuperior.php';?>
			<?php include 'views/layout/menuLateral.php';?>
        </nav>

		<div id="page-wrapper">

			
			<?php
			
			$param1 = ! empty ( $_GET ['url'] ) ? $_GET ['url'] : "home";
			$param2 = ! empty ( $_GET ['page'] ) ? $_GET ['page'] : "index";
			$file = 'views/pages/' . $param1 . '/' . $param2 . '.php';
			
			include $file;
			
			?>
		

		</div>
	</div>

	<!-- Core Scripts - Include with every page -->
	<?php include 'views/layout/footer.php';?>

    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>
</body>
</html>