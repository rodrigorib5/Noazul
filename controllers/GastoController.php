<?php
/**
 * 
 * @author rodrigorib
 *
 */
class GastoController {	
	
	public function salvarGasto($descricao, $valor, $data, $observacao, $pago, $tipoGastoId){
		$gasto = new Gasto($descricao, $valor, $data, $observacao, $pago, $tipoGastoId);
		$gasto->salvarGasto();
	}
	
	/**
	 * @method Retorna todos os gastos
	 * @return Ambigous <multitype:, mixed>
	 */
	public function getTodosGastos(){
		$gasto = new Gasto();
		return $gasto->getTodosGastos();
	}
	
	/**
	 * @method retorna a soma de todos os gastos
	 */
	public function getSomaTodosGastos(){
		$gasto = new Gasto();
		return $gasto->getSomaTodosGastos();
	}
	
	/**
	 * @method Retorna a soma de todos os gastos com descrição
	 * @return mixed
	 */
	public function getGastosPorDescricao(){
		$gasto = new Gasto();
		return $gasto->getGastosPorDescricao();
	}
	
	/**
	 * @method Retorna a soma de todos os gastos com descrição para o gráfico Donut
	 * @return mixed
	 */
	public function getGastosPorDescricaoGrafico(){
		$gasto = new Gasto();
		return $gasto->getGastosPorDescricaoGrafico();
	}
	/**
	 * @method retorna um tipo de gasto conforme ID
	 * @param int $tipoGastoId
	 * @return Object:
	 */
	public function getTipoGasto($tipoGastoId){
		$gasto = new Gasto();
		return $gasto->getTipoGasto($tipoGastoId);
	}
	/**
	 * Retorna os gastos que ainda não foram pagos
	 * @param int $tipoGastoId
	 * @return objeto:
	 */
	public function getTipoGastoAberto($tipoGastoId){
		$gasto = new Gasto();
		return $gasto->getTipoGastoAberto($tipoGastoId);
	}
	/**
	 * Retorna os gasto já pagos
	 * @return object:
	 */
	public function getTodosGastosPagos(){
		$gasto = new Gasto();
		return $gasto->getTodosGastosPagos();
	}
	/**
	 * Update para pago = 1 conforme o id do gasto
	 * @param int $gastoId
	 * @param float $valor
	 */
	public function pagarGasto($gastoId, $valor){
		$gasto = new Gasto();
		$saldo = new Saldo();
		
		$saldo->subtrairSaldo($valor);
		$gasto->pagarGasto($gastoId);
	}
}