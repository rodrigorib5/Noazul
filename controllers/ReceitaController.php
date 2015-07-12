<?php
/**
 * 
 * @author rodrigorib
 *
 */
class ReceitaController {
	
	/**
	 * @method para trazer todas as receitas cadastradas
	 * @return Objeto
	 */
	public function getTodasReceitas(){
		$receita = new Receita();		
		return $receita->getTodasReceitas();
	}
	
	/**
	 * @method para trazer somatórias de todas as receitas cadastradas
	 * @return Ambigous <number, mixed>
	 */
	public function getReceitaBruta(){
		$totalReceitas = new Receita();
		return $totalReceitas->getReceitaBruta();
	}
	
	/**
	 * @method retorna a receita liquida
	 * @return number
	 */
	public function getReceitaLiquida(){
		$gastoController = new GastoController();
		$totalGastos = $gastoController->getSomaTodosGastos();
		
		$receitaBruta = self::getReceitaBruta();
	
		$receitaLiquida = $receitaBruta->total - $totalGastos->total;
		
		return $receitaLiquida;
	}
}