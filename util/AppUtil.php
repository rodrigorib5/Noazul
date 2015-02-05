<?php
class AppUtil {
	const MENSAGEM_SUCESSO = 'alert alert-success';
	const MENSAGEM_ALERTA = '';
	const MENSAGEM_ERRO = 'alert alert-danger';
	const GASTO_FIXO = 1;
	const GASTO_VARIAVEL = 2;
	const GASTO_OCASIONAL = 3;
	
	public static function informaMensagem($msg, $class) {
		$_REQUEST ['msg'] = $msg;
		$_REQUEST ['class_msg'] = $class;
	}
	public static function redirecionar($para = null) {
		if ($para) {
			header ( "Location: /" . $para . "/" );
		} else {
			header ( "Location: " . BASE_URL );
		}
	}
	
	/**
	 * Altera data para formato do banco
	 */
	public static function dataConvertDb($data) {
		$hora = date ( 'H:i:s' );
		$databanco = date_create ( $data . $hora );
		$dataConvertida = date_format ( $databanco, "Y-m-d H:i:s" );
		return $dataConvertida;
	}
	
	/**
	 * Altera data para formato do banco
	 */
	public static function dataParaBd($data) {
		$date = new DateTime ( $data );
		$databanco = date_format ( $date, 'Y-m-d H:i:s' );
		return $databanco;
	}
	
	/**
	 * Altera data para formato do padrão brasileiro
	 */
	public static function dataConvertBr($data) {
		$databanco = date_create ( $data );
		$dataConvertida = date_format ( $databanco, "d/m/Y" );
		return $dataConvertida;
	}
	/**
	 * Função para mostrar hora de Alertas Recentes
	 *
	 * @param unknown $data        	
	 * @return unknown
	 */
	public static function showHora($data) {
		$dataBanco = date_create ( $data );
		$hora = date_format ( $dataBanco, "d/m/Y H:i" );
		return $hora;
	}
}