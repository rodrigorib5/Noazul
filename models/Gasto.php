<?php
/**
 * 
 * @author rodrigorib
 *
 */
class Gasto extends Model {
    var $descricao;
    var $valor;
    var $data;
    var $observacao;
    var $pago;
    var $usuarioId;
    var $tipoGastoId;
    
    /**
     * 
     * @param string $descricao
     * @param string $data
     */
    public function __construct($descricao = null, $valor = null,  $data = null, $observacao = null, $pago = null, $tipoGastoId = null) {
        $this->descricao 	= $descricao;
        $this->valor 		= $valor;
        $this->data 		= $data;
        $this->observacao 	= $observacao;
        $this->pago 		= $pago;
        $this->tipoGastoId 	= $tipoGastoId;
        parent::__construct ( 'producao' );
    }
    
    public function salvarGasto(){
    	    	
    	$sql = "INSERT INTO `gasto` (`descricao`, `valor`, `data`, `data_cadastro`, `observacao`, `pago`, `usuario_id`, `tipo_gasto_id`) 
    			VALUES ('$this->descricao', '$this->valor', '$this->data', NOW(), '$this->observacao', '0', :usuarioId, '$this->tipoGastoId')";
    	
    	$conexao = $this->conexao->conecta();
    	
    	$stmt = $conexao->prepare($sql);
    	$stmt->execute(array(':usuarioId' => $_SESSION['usuario']['id']));
    }
    
    /**
     * @method Pega todos os gastos
     * @return array
     */
    public function getTodosGastos(){
        $sql = "SELECT gasto.id, gasto.descricao, gasto.valor, tpGasto.descricao AS descricaoTpGasto, 
					   gasto.data, gasto.observacao
				FROM `gasto` AS gasto
			 		INNER JOIN tipo_gasto AS tpGasto
						ON tpGasto.id = gasto.tipo_gasto_id
				WHERE `gasto`.`usuario_id`=:usuarioId";
        
        $conexao = $this->conexao->conecta();
        
        $stmt = $conexao->prepare($sql);
        $stmt->execute(array(':usuarioId' => $_SESSION['usuario']['id']));
        
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        return $result;
    }
    /**
     * @method retorna os gastos por descrição
     * @return mixed
     */
    public function getGastosPorDescricao(){
        $sql ="SELECT 
                SUM(CASE WHEN tipo_gasto_id = 1 THEN valor ELSE 0 END) as fixo,
                SUM(CASE WHEN tipo_gasto_id = 2 THEN valor ELSE 0 END) as variavel,
                SUM(CASE WHEN tipo_gasto_id = 3 THEN valor ELSE 0 END) as ocasional
               FROM gasto
        	   WHERE gasto.usuario_id=:usuarioId AND gasto.pago = 0";
        
        $conexao = $this->conexao->conecta();
        
        $stmt = $conexao->prepare($sql);
        $stmt->execute(array(':usuarioId' => $_SESSION['usuario']['id']));
        
        $result = $stmt->fetchObject();
        $stmt = null;
        
        return $result;
    }

    /**
    *@method retorna os gastos por descrição para grafico donut
    *@return mixed
    */
    public function getGastosPorDescricaoGrafico(){
        $sql ="SELECT tpGasto.descricao AS label,
               SUM(CASE WHEN tipo_gasto_id in (1,2,3) THEN valor ELSE 0 END) as value
               FROM gasto AS gasto
                   INNER JOIN tipo_gasto AS tpGasto
                       ON gasto.tipo_gasto_id = tpGasto.id
        	   WHERE gasto.usuario_id=:idUsuario AND gasto.pago = 0
               group by tpGasto.descricao";
        
        $conexao = $this->conexao->conecta();
        
        $stmt = $conexao->prepare($sql);
        $stmt->execute(array(':idUsuario' => $_SESSION['usuario']['id']));
    	
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);   
        $stmt = null;
        
        return $result;
    }    
    /**
     * @method retorna a soma de todos os gastos
     * @return mixed
     */
    public function getSomaTodosGastos(){
        $sql = "SELECT SUM(valor) AS total FROM gasto
        		WHERE gasto.usuario_id=:idUsuario AND gasto.pago = 0";
        
        $conexao = $this->conexao->conecta();
        
        $stmt = $conexao->prepare($sql);
        $stmt->execute(array(':idUsuario' => $_SESSION['usuario']['id']));
        
        $result = $stmt->fetchObject();
        $stmt = null;
        
        return $result;
    }
    /**
     * @method Pega o tipo do gasto conforme ID do gasto
     * @param int $tipoGastoId
     * @return object:
     */
    public function getTipoGasto($tipoGastoId){
    	$sql = "SELECT * FROM `gasto`
				WHERE `gasto`.`usuario_id`=:idUsuario AND tipo_gasto_id = '$tipoGastoId' ";    	
    	
    	$conexao = $this->conexao->conecta();
    	
    	$stmt = $conexao->prepare($sql);    
    	$stmt->execute(array(':idUsuario' => $_SESSION['usuario']['id']));
    	    	
    	$result = $stmt->fetchAll(PDO::FETCH_OBJ);
    	$stmt = null;
    	
    	return $result;
    }
    /**
     * Retorna os gastos que ainda não foram pagos
     * @param int $tipoGastoId
     * @return objeto:
     */
    public function getTipoGastoAberto($tipoGastoId){
    	$sql = "SELECT * FROM `gasto`
    			WHERE `gasto`.`usuario_id`=:idUsuario AND gasto.tipo_gasto_id = '$tipoGastoId' AND gasto.pago = 0 ";
    	 
    	$conexao = $this->conexao->conecta();
    	 
    	$stmt = $conexao->prepare($sql);
    	$stmt->execute(array(':idUsuario' => $_SESSION['usuario']['id']));
    	
    	$result = $stmt->fetchAll(PDO::FETCH_OBJ);
    	$stmt = null;
    	 
    	return $result;
    }
    /**
     * Retorna os gasto já pagos
     * @return object:
     */
    public function getTodosGastosPagos(){
    	$sql = "SELECT gasto.id, gasto.descricao, gasto.valor, tpGasto.descricao AS descricaoTpGasto, 
					   gasto.data, gasto.observacao
				FROM `gasto` AS gasto
			 		INNER JOIN tipo_gasto AS tpGasto
						ON tpGasto.id = gasto.tipo_gasto_id
				WHERE `gasto`.`usuario_id`=:usuarioId AND gasto.pago = 1";
    	
    	$conexao = $this->conexao->conecta();
    	
    	$stmt = $conexao->prepare($sql);
    	$stmt->execute(array(':usuarioId' => $_SESSION['usuario']['id']));
    	 
    	$result = $stmt->fetchAll(PDO::FETCH_OBJ);
    	$stmt = null;
    	
    	return $result;
    }
    /**
     * Update para pago = 1 conforme o id do gasto
     * @param int $gastoId
     */
    public function pagarGasto($gastoId){
    	$sql = "UPDATE `gasto` SET `pago`='1' WHERE `id`='$gastoId'";
    	
    	$conexao = $this->conexao->conecta();
    	
    	$stmt = $conexao->prepare($sql);
    	$stmt->execute();
    }
}
