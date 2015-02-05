<?php
class Alerta extends Model {
	var $situacao;
	var $unidade_id;
	var $motivo;
	var $dataInicio;
	var $dataFim;
	var $observacao;
	var $arquivo;
	
	/**
	 * Função construtora.
	 *
	 * @param unknown $situacao        	
	 * @param unknown $motivo        	
	 * @param unknown $observacao        	
	 * @param unknown $dataInicio        	
	 * @param unknown $dataFim        	
	 * @param unknown $arquivo        	
	 */
	public function __construct($situacao = null, $unidade_id = null, $motivo = null, $observacao = null, $dataInicio = null, $dataFim = null, $arquivo = null) {
		$this->situacao = $situacao;
		$this->unidade_id = $unidade_id;
		$this->motivo = $motivo;
		$this->dataInicio = $dataInicio;
		$this->dataFim = $dataFim;
		$this->observacao = $observacao;
		$this->arquivo = $arquivo;
		parent::__construct ( Config::AMBIENTE_UTUAL );
	}
	
	/**
	 * Função para salvar os Alertas
	 *
	 * @return boolean
	 */
	public function salvar($up) {
		$alerta = new Alerta ();
		
		$dataResult = $alerta->comparaData ( $this->dataInicio );
		$dataAlterado = date ( "Y-m-d H:i:s" );
		
		$sql = "INSERT INTO `novo_sim`.`alerta` (`motivo_id`,`situacao_id`,`unidade_id`,`observacao`,`marcacao`,`dataInicio`,`dataAlteracao`, `dataFim`,`status_id`,`img`) 
				VALUES ('$this->motivo','$this->situacao','$this->unidade_id','$this->observacao','$dataResult','$this->dataInicio','$dataAlterado','$this->dataFim','1','$up')";
		$resultado = mysql_query ( $sql, $this->conexao->conecta () );
		
		if ($resultado) {
			$idAlerta = mysql_insert_id ();
		} else {
			$idAlerta = null;
		}
		
		$this->conexao->fecharConexao ();
		return $idAlerta;
	}
	
	/**
	 * Função para buscar as informações de Alertas pendentes no banco
	 *
	 * @return multitype:
	 */
	public function getAlertaFinalizado() {
		$sql = "SELECT alerta.id, alerta.dataInicio AS dataInicio, alerta.dataFim AS dataFim, alerta.dataAlteracao,
				alerta.observacao, motivo.id AS motivoId, motivo.descricao AS motivoDescricao, situacao.id AS situacaoId, situacao.descricao AS situacaoDescricao 
				FROM novo_sim.alerta AS alerta
				INNER JOIN novo_sim.motivo AS motivo
				ON motivo.id = alerta.motivo_id
				INNER JOIN novo_sim.situacao AS situacao
				ON situacao.id = alerta.situacao_id
				WHERE alerta.status_id=2";
		
		$resultado = mysql_query ( $sql, $this->conexao->conecta () );
		$this->conexao->fecharConexao ();
		$alertas = array ();
		while ( $linhas = mysql_fetch_object ( $resultado ) ) {
			$alertas [] = $linhas;
		}
		return $alertas;
	}
	public function getAlertaTodos() {
		$sql = "SELECT alerta.id, status.descricao AS statusDescricao, alerta.dataInicio AS dataInicio, alerta.dataFim AS dataFim,
				alerta.observacao, motivo.id AS motivoId, motivo.descricao AS motivoDescricao, situacao.id AS situacaoId, situacao.descricao AS situacaoDescricao
				FROM novo_sim.alerta AS alerta
				INNER JOIN novo_sim.motivo AS motivo
				ON motivo.id = alerta.motivo_id
				INNER JOIN novo_sim.situacao AS situacao
				ON situacao.id = alerta.situacao_id
				INNER JOIN novo_sim.status AS status
				ON status.id = alerta.status_id";
		
		$resultado = mysql_query ( $sql, $this->conexao->conecta () );
		$this->conexao->fecharConexao ();
		$alertas = array ();
		while ( $linhas = mysql_fetch_object ( $resultado ) ) {
			$alertas [] = $linhas;
		}
		return $alertas;
	}
	
	/**
	 * Função para buscar as informações de Alertas pendentes no banco
	 *
	 * @return multitype:
	 */
	public function getAlertaPendente() {
		$sql = "SELECT alerta.id, alerta.img, alerta.unidade_id, unidade.NmUnidadeOrganica, alerta.observacao, alerta.marcacao, situacao.descricao AS situacaoDescricao, motivo.descricao AS motivoDescricao, dataInicio, dataFim
			  FROM novo_sim.alerta AS alerta 
		      INNER JOIN novo_sim.situacao AS situacao ON situacao.id = alerta.situacao_id
		      INNER JOIN novo_sim.motivo AS motivo ON motivo.id = alerta.motivo_id
              INNER JOIN tb0700.unidadeorganica AS unidade ON IdUnidadeOrganica = unidade_id
			  WHERE alerta.status_id=1";
		
		$resultado = mysql_query ( $sql, $this->conexao->conecta () );
		$this->conexao->fecharConexao ();
		$alertas = array ();
		while ( $linhas = mysql_fetch_object ( $resultado ) ) {
			$alertas [] = $linhas;
		}
		return $alertas;
	}
	/**
	 * Função para buscar as informações de alertas fechados no banco
	 *
	 * @return multitype:
	 */
	public function getAlertaFechado() {
		$sql = "SELECT *
			  FROM alerta as alerta
		      INNER JOIN situacao as situacao ON situacao.id = alerta.situacao_id
		      INNER JOIN motivo as motivo ON motivo.id = alerta.motivo_id
			  WHERE alerta.status_id=2";
		$resultado = mysql_query ( $sql, $this->conexao->conecta () );
		$this->conexao->fecharConexao ();
		$alertasFechados = array ();
		while ( $linhas = mysql_fetch_object ( $resultado ) ) {
			$alertasFechados [] = $linhas;
		}
		return $alertasFechados;
	}
	
	/**
	 * Função para buscar os alertas mais recentes e mostrar no index
	 *
	 * @return multitype:
	 */
	public function getAlertaRecente() {
		$sql = "SELECT *
			  FROM alerta as alerta
		      INNER JOIN situacao as situacao ON situacao.id = alerta.situacao_id
		      INNER JOIN motivo as motivo ON motivo.id = alerta.motivo_id 
			  ORDER BY alerta.dataAlteracao DESC limit 5";
		
		$resultado = mysql_query ( $sql, $this->conexao->conecta () );
		$this->conexao->fecharConexao ();
		
		$alertas = array ();
		if ($resultado) {
			while ( $linhas = mysql_fetch_object ( $resultado ) ) {
				$alertas [] = $linhas;
			}
		}
		return $alertas;
	}
	/**
	 * Função para buscar os alertas pendentes mais recentes da data de hoje
	 *
	 * @return multitype:
	 */
	public function getAlertaPendenteHoje() {
		$dataAlterado = date ( "Y-m-d" );
		$sql = "SELECT COUNT(id_alerta) 
		      FROM novo_sim.alerta  
		      WHERE status_id=1 AND 
		      dataInicio 
		      LIKE '$dataAlterado%'";
		$resultado = mysql_query ( $sql, $this->conexao->conecta () );
		$this->conexao->fecharConexao ();
		$alertas = null;
		if ($resultado) {
			$alertas = mysql_fetch_row ( $resultado );
		}
		return $alertas;
	}
	/**
	 * Função para buscar os alertas fechados mais recentes da data de hoje
	 *
	 * @return multitype:
	 */
	public function getAlertaFechadoHoje() {
		$dataAlterado = date ( "Y-m-d" );
		$sql = "SELECT COUNT(id_alerta) FROM novo_sim.alerta  WHERE status_id=2 AND dataAlteracao LIKE '$dataAlterado%'";
		$resultado = mysql_query ( $sql, $this->conexao->conecta () );
		$this->conexao->fecharConexao ();
		$alertas = null;
		if ($resultado) {
			$alertas = mysql_fetch_row ( $resultado );
		}
		return $alertas;
	}
	
	/**
	 * Função de exclusão de Alertas
	 *
	 * @param unknown $id        	
	 * @return boolean
	 */
	public function excluir($id) {
		$sql = "DELETE FROM `novo_sim`.`alerta` WHERE `id`='$id'";
		$resultado = mysql_query ( $sql, $this->conexao->conecta () );
		$this->conexao->fecharConexao ();
		return $resultado;
	}
	
	/**
	 * Função de busca dos id's
	 *
	 * @param unknown $id        	
	 * @return multitype:
	 */
	public function buscar($id) {
		$sql = "SELECT alerta.id, alerta.dataInicio AS dataInicio, alerta.dataFim AS dataFim,
				alerta.observacao, motivo.id AS motivoId, motivo.descricao AS motivoDescricao, situacao.id AS situacaoId, situacao.descricao AS situacaoDescricao 
				FROM novo_sim.alerta AS alerta
				INNER JOIN novo_sim.motivo AS motivo
				ON motivo.id = alerta.motivo_id
				INNER JOIN novo_sim.situacao AS situacao
				ON situacao.id = alerta.situacao_id
				where alerta.id =$id";
		$resultado = mysql_query ( $sql, $this->conexao->conecta () );
		$this->conexao->fecharConexao ();
		$alerta = mysql_fetch_object ( $resultado );
		return $alerta;
	}
	public function buscaHistoricoAlerta($id) {
		$sql = "SELECT situacao.descricao As situacaoDescricao, motivo.descricao As motivoDescricao, log.acao, log.data, usuario.nome
				FROM log_ocorrencias As log
				INNER JOIN novo_sim.situacao As situacao
				On situacao.id = log.situacao_id
				INNER JOIN novo_sim.motivo As motivo
				On motivo.id = log.motivo_id
				INNER JOIN novo_sim.usuarios As usuario
				On usuario.id = log.usuario_id
				where log.alerta_id = '$id'";
		
		$resultado = mysql_query ( $sql, $this->conexao->conecta () );
		$this->conexao->fecharConexao ();
		
		$alertas = array ();
		while ( $linhas = mysql_fetch_object ( $resultado ) ) {
			$alertas [] = $linhas;
		}
		return $alertas;
	}
	
	/**
	 * Função de atualização dos Alertas
	 *
	 * @param unknown $id        	
	 * @return boolean
	 */
	public function update($id) {
		$dataAlteracao = date ( "Y-m-d H:i:s" );
		
		$sql = "UPDATE  `novo_sim`.`alerta` SET  `observacao` =  '" . $this->observacao . "',
				`motivo_id` =  '" . $this->motivo . "',
				`situacao_id` =  '" . $this->situacao . "',
				`unidade_id` = '" . $this->unidade_id . "',
				`dataInicio` =  '" . $this->dataInicio . "',
				`dataAlteracao` = '" . $dataAlteracao . "',
				`dataFim` =  '" . $this->dataFim . "' WHERE  `alerta`.`id` =$id";
		$resultado = mysql_query ( $sql, $this->conexao->conecta () );
		$this->conexao->fecharConexao ();
		return $resultado;
	}
	/**
	 * Função para atualização do status do Alerta
	 *
	 * @param unknown $id        	
	 * @return boolean
	 */
	public function finalizar($id) {
		$dataAlterado = date ( "Y-m-d H:i:s" );
		
		$sql = "UPDATE `novo_sim`.`alerta` SET `status_id` =  '2', `dataAlteracao` = '" . $dataAlterado . "' WHERE`alerta`.`id`='$id'";
		$resultado = mysql_query ( $sql, $this->conexao->conecta () );
		$this->conexao->fecharConexao ();
		return $resultado;
	}
	
	/**
	 *
	 * @param unknown $data        	
	 * @return Ambigous <NULL, string>
	 */
	public function comparaData($data) {
		$result = null;
		
		$dataAtual = AppUtil::dataConvertBr ( date ( 'Y-m-d' ) );
		$dataCriacao = AppUtil::dataConvertBr ( ($data) );
		
		if ($dataCriacao < $dataAtual) {
			$result = "ORDP";
		} else if ($dataCriacao > $dataAtual) {
			$result = "ORDF";
		} else {
			$result = "Normal";
		}
		return $result;
	}
}
