<?php
ini_set ( 'display_errors', 1 );
ini_set ( 'log_errors', 1 );
ini_set ( 'error_log', dirname ( '_FILE_' ) . '/error_log.txt' );
error_reporting ( E_ALL );
class SiteController {
	public static function autenticacao() {
		if (! self::logado ()) {
			include 'views/login.php';
			exit ();
		}
	}
	public static function logout() {
		unset ( $_SESSION );
		session_destroy ();
	}
	public static function logado() {
		return isset( $_SESSION ['usuario'] );
	}
	public static function logar($login, $senha) {
		$autenticar = new Autenticar();
		$dadosServidor = $autenticar->autenticar ( $login, $senha );
		
		if ($dadosServidor) {
			$_SESSION ['usuario'] = $dadosServidor;
		}
	}
}

