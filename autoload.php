<?php
define ( 'DIR_APP', '/' . dirname ( __DIR__ ) );
define ( 'BASE_URL', '/noazul' );
define ( 'IS_AJAX', ! empty ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) && strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' );
class Autoloader {
	/**
	 * Método que registra um autocarregamento de classes.
	 *
	 * @return null
	 */
	public static function register() {
		spl_autoload_register ( __CLASS__ . '::autoload' );
	}
	
	/**
	 * Método que executa o autocarregamento de classes.
	 *
	 * @param string $class        	
	 */
	public static function autoload($class) {
		$classes_sufixos = array (
				'Model' => __DIR__ . '/models/',
				'Controller' => __DIR__ . '/controllers/',
				'Util' => __DIR__ . '/util/' 
		);
		
		foreach ( $classes_sufixos as $class_sufixo => $pasta ) {
			$file = $pasta . $class . '.php';
			if (file_exists ( $file )) {
				require $file;
				return;
			}
		}
	}
}

Autoloader::register ();
session_start ();
