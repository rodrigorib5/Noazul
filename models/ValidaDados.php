<?php
class ValidaDados {
	/**
	 * validação de campos nulos
	 */
	public function validaCampoNulo($texto) {
		if (empty ( $texto )) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * Validação de tamanho da string de situação
	 */
	public function validaTamanhoDescricao($descricao) {
		$tamanho = strlen ( $descricao );
		if ($tamanho > 45) {
			return true;
		} else {
			return false;
		}
	}
	public function validaTamanhoSituacao($situacao) {
		$tamanho = strlen ( $situacao );
		if ($tamanho > 45) {
			return true;
		} else {
			return false;
		}
	}
}