<?php
/**
 * 
 * @author rodrigorib
 *
 */
class GastoController {
	
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
}