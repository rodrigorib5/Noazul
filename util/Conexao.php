<?php
class Conexao {
	public $conexao;
	public $dbname;
	public function __construct($config) {
		switch ($config) {
			case 'desenvolvimento' :
				$this->conexao = new PDO ( 'mysql:host=' . Config::DESENVOLVIMENTO . ';dbname=' . Config::DB_NAME . '', Config::USER_DB_D, Config::PASS_DB_D );
				$this->conexao->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				break;
			
			case 'producao' :
				$this->conexao = new PDO ( 'mysql:host=' . Config::PRODUCAO . ';dbname=' . Config::DB_NAME_PRODUCAO . '', Config::USER_DB_P, Config::PASS_DB_P );
				$this->conexao->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				break;
			
			default :
				$this->conexao = mysql_connect ( Config::DESENVOLVIMENTO, Config::USER_DB_D, Config::PASS_DB_D );
				$this->dbname = Config::DB_NAME;
				break;
		}
	}
	public function conecta() {
		$this->conexao->exec("set names utf8");
		return $this->conexao;
	}
}