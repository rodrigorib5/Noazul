<?php
class Model {
	public $conexao;
	public $host;
	public function __construct() {
		$this->conexao = new Conexao ( 'desenvolvimento' );
	}
}