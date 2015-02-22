<?php
/**
 * 
 * @author rodrigorib
 *
 */
class SaldoCOntroller {
	
	/**
	 * Retorna o saldo da conta
	 * @return mixed
	 */
	public function getSaldo(){
		$saldo = new Saldo();
		return $saldo->getSaldo();
	}
	/**
	 * Subtrai o saldo da conta
	 * @param float $valor
	 */
	public function subtrairSaldo($valor){
		$saldo = new Saldo();
		$saldo->subtrairSaldo($valor);
	}
	/**
	 * Soma o saldo da conta com o valor do parametro
	 * @param unknown $valor
	 */
	public function somaSaldo($valor){
		$saldo = new Saldo();
		$saldo->adicaonarSaldo($valor);
	}
	
	
}