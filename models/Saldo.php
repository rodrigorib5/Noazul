<?php
/**
 * 
 * @author rodrigorib
 *
 */
class Saldo extends Model {   
    
    /**
     * 
     * @param string $descricao
     * @param string $data
     */
    public function __construct() { 
        parent::__construct ( 'desenvolvimento' );
    }
    /**
     * Subtrair saldo da conta
     * @param unknown $valor
     */
    public function subtrairSaldo($valor){
    	$saldo = self::getSaldo();    	
    	$saldoAtual = $saldo->saldo - $valor;
    	self::setSaldo($saldoAtual);
    }
    /**
     * Soma o saldo da conta com o valor do parametro
     * @param unknown $valor
     */
    public function somaSaldo($valor){
    	$saldo = self::getSaldo();
    	$saldoAtual = $saldo->saldo + $valor;
    	self::setSaldo($saldoAtual);
    }
    
    /**
     * Pega o saldo atual
     * @return mixed
     */
    public function getSaldo(){
    	$sql = "SELECT saldo FROM `usuario`
				WHERE `usuario`.`id`=:idUsuario";
    
    	$conexao = $this->conexao->conecta();
    
    	$stmt = $conexao->prepare( $sql );
    	$stmt->execute(array(':idUsuario' => $_SESSION['usuario']['id']));
    
    	$result = $stmt->fetchObject();
    	$stmt = null;
    
    	return $result;
    }
    /**
     * Seta o saldo da conta
     * @param unknown $valor
     * @return mixed
     */
    private function setSaldo($valor){
    	$sql ="UPDATE `noazul`.`usuario` SET `saldo`='$valor' WHERE `id`=:idUsuario";

    	$conexao = $this->conexao->conecta();
    
    	$stmt = $conexao->prepare( $sql );
    	$stmt->execute(array(':idUsuario' => $_SESSION['usuario']['id']));
       	$stmt = null;
    }
}
