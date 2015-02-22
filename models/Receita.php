<?php
/**
 * 
 * @author rodrigorib
 *
 */
class Receita extends Model {
	var $descricao;
	var $data;
	
	/**
	 * 
	 * @param string $descricao
	 * @param string $data
	 */
	public function __construct($descricao = null, $data = null) {
		$this->descricao = $descricao;
		$this->data = $data;
		parent::__construct ( 'desenvolvimento' );
	}
	
	/**
	 * @method para trazer somatórias de todas as receitas cadastradas
	 * @return Objeto
	 */
	public function getTodasReceitas(){
		$sql = "SELECT * FROM `receita` 
				WHERE `receita`.`usuario_id`=:idUsuario";
		
		$conexao = $this->conexao->conecta();
		
		$stmt = $conexao->prepare($sql);
		$stmt->execute(array(':idUsuario' => $_SESSION['usuario']['id']));
		
		$result = $stmt->fetchAll(PDO::FETCH_OBJ);
		$stmt = null;
		
		return $result;
	}
	
	/**
	 * @method traz a soma das receitas
	 * @return mixed
	 */
	public function getReceitaBruta(){
		$sql = "SELECT SUM(valor) AS total FROM `receita`
				WHERE `receita`.`usuario_id`=:idUsuario";
		
		$conexao = $this->conexao->conecta();
		
		$stmt = $conexao->prepare( $sql );
		$stmt->execute(array(':idUsuario' => $_SESSION['usuario']['id']));
		
		$result = $stmt->fetchObject();
		$stmt = null;
		
		return $result;
	}
}
