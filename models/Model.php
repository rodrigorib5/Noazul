<?php
class Model {
	public $conexao;
	public $host;
	public function __construct($host) {
		$this->conexao = new Conexao ( $host );
	}
}