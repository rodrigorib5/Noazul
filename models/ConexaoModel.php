<?php
require_once __DIR__ . '/config.php';
class ConexaoModel {
	var $conexao;
	var $dbname;
	public function __construct($config) {
		switch ($config) {
			case 'desenvolvimento' :
				$this->conexao = mysql_connect ( Config::DESENVOLVIMENTO, Config::USER_DB_D, Config::PASS_DB_D );
				$this->dbname = Config::DB_NAME;
				break;
			case 'homologacao' :
				$this->conexao = mysql_connect ( Config::HOMOLOGACAO, Config::USER_DB_H, Config::PASS_DB_H );
				$this->dbname = Config::DB_NAME;
				break;
			case 'producao' :
				$this->conexao = mysql_connect ( Config::PRODUCAO, Config::USER_DB_P, Config::PASS_DB_P );
				$this->dbname = Config::DB_NAME;
				break;
			case 'sisref' :
				$this->conexao = mysql_connect ( Config::HOST_SISREF, Config::USER_DB_SISREF, Config::PASS_DB_SISREF );
				$this->dbname = Config::DB_NAME_SISREF;
				break;
			default :
				break;
		}
	}
	public function conecta() {
		mysql_select_db ( $this->dbname, $this->conexao );
		mysql_query ( "set names 'utf8'" );
		return $this->conexao;
	}
	public function fecharConexao() {
		return mysql_close ( $this->conexao );
	}
}