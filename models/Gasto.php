<?php
/**
 * 
 * @author rodrigorib
 *
 */
class Gasto extends Model {
    var $descricao;
    var $tipoGastoId;
    var $data;
    
    /**
     * 
     * @param string $descricao
     * @param string $data
     */
    public function __construct($descricao = null,  $tipoGastoId = null, $data = null) {
        $this->descricao = $descricao;
        $this->tipoGastoId = $tipoGastoId;
        $this->data = $data;
        parent::__construct ( 'desenvolvimento' );
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
				WHERE `gasto`.`usuario_id`=:idUsuario";
        
        $conexao = $this->conexao->conecta();
        
        $stmt = $conexao->prepare($sql);
        $stmt->execute(array(':idUsuario' => $_SESSION['usuario']['id']));
        
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
               FROM noazul.gasto
        	   WHERE gasto.usuario_id=:idUsuario";
        
        $conexao = $this->conexao->conecta();
        
        $stmt = $conexao->prepare($sql);
        $stmt->execute(array(':idUsuario' => $_SESSION['usuario']['id']));
        
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
               FROM noazul.gasto AS gasto
                   INNER JOIN noazul.tipo_gasto AS tpGasto
                       ON gasto.tipo_gasto_id = tpGasto.id
        	   WHERE gasto.usuario_id=:idUsuario 
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
        $sql = "SELECT SUM(valor) AS total FROM noazul.gasto
        		WHERE gasto.usuario_id=:idUsuario";
        
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
}
