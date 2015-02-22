<?php
class AppUtil {
	const GASTO_FIXO = 1;
	const GASTO_VARIAVEL = 2;
	const GASTO_OCASIONAL = 3;
	/**
	*
	*Redireciona á pagina após uma ação
	*/
	public static function redirecionar($para = null) {
		if($para) {
			echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=/noazul/$para/'>";
		} else {
			header("Location: /noazul/");
		}
	}
	/**
	 * Altera data para formato do banco
	 */
	public static function dataConvertDb($data) {
		$hora = date ( 'H:i:s' );
		$databanco = date_create ( $data . $hora );
		$dataConvertida = date_format ( $databanco, "Y-m-d" );
		return $dataConvertida;
	}
	
	/**
	 * Altera data para formato do banco
	 */
	public static function dataParaBd($data) {
		$date = new DateTime ( $data );
		$databanco = date_format ( $date, 'Y-m-d' );
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
		$hora = date_format ( $dataBanco, "d/m/Y" );
		return $hora;
	}
}