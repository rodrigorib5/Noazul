<?php
/**
 * 
 * @author rodrigorib
 *
 */
class Autenticar extends Model {
	public function __construct() {
		parent::__construct();
	}
	/**
	 * 
	 * @param unknown $login
	 * @param unknown $senha
	 * @return mixed
	 */
	public function autenticar($login, $senha) {
		
		$senhaMd5 = md5($senha);
		
		$sql = "SELECT usuario.id, usuario.login, usuario.nome, usuario.perfil_id, perfil.descricao
				FROM usuario AS usuario
				INNER JOIN perfil AS perfil
				ON perfil.id = usuario.perfil_id 
				WHERE login = '$login' AND senha = '$senhaMd5'";
		
		$conexao = $this->conexao->conecta ();
		
		$stmt = $conexao->prepare( $sql );
		$stmt->execute();
		
		$row = $stmt->fetch();
		$stmt = null;
		
		return $row;
	}
}