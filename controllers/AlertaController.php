<?php
class AlertaController {
	public function salvar($situacao, $unidade_id, $motivo, $observacao, $dataInicio, $dataFim, $up) {
		/**
		 * Try serve para inicializar seu problema, caso consiga, continua o programa,
		 * caso apresente erro, entra no fluxo 'catch'.
		 * O catch mostra o erro gerado e
		 * termina a execução da função. Lembrando que, no caso de erro não se deve continuar com
		 * cadastramento/alteração;
		 */
		try {
			$alerta = new Alerta ( $situacao, $unidade_id, $motivo, $observacao, $dataInicio, $dataFim );
			
			$result = $alerta->salvar ( $up );
			
			if ($result) {
				AppUtil::informaMensagem ( "Ocorrência cadastrada com sucesso!", AppUtil::MENSAGEM_SUCESSO );
			} else {
				AppUtil::informaMensagem ( "Ocorreu um erro, tente cadastrar novamente.", AppUtil::MENSAGEM_ERRO );
			}
		} catch ( Exception $erro ) {
			AppUtil::informaMensagem ( $erro->getMessage (), AppUtil::MENSAGEM_ERRO );
		}
		
		Log::register ( 'salvar', 'ocorrencia', $descricaoAnterior, $situacao, $observacao );
		Log::registerAlerta ( 'salvar', $situacao, $motivo, $result );
	}
	
	/**
	 * Função para retornar dados de alertas pendentes tabela;
	 */
	public function getAlertaPendente() {
		$alerta = new Alerta ();
		return $alerta->getAlertaPendente ();
	}
	/**
	 * Função para retornar alertas pendentes da data de hoje
	 *
	 * @return multitype:
	 */
	public function getAlertaPendenteHoje() {
		$alerta = new Alerta ();
		return $alerta->getAlertaPendenteHoje ();
	}
	
	/**
	 * Função para retornar dados de Alertas fechados na tabela
	 *
	 * @return Ambigous <multitype:, multitype:>
	 */
	public function getAlertaFechado() {
		$alerta = new Alerta ();
		return $alerta->getAlertaFechado ();
	}
	/**
	 * Função para retonar alertas fechados da data de hoje
	 *
	 * @return multitype:
	 */
	public function getAlertaFechadoHoje() {
		$alerta = new Alerta ();
		return $alerta->getAlertaFechadoHoje ();
	}
	/**
	 * Função para retonar todos alertas fechados
	 *
	 * @return multitype:
	 */
	public function getAlertaFinalizado() {
		$alerta = new Alerta ();
		return $alerta->getAlertaFinalizado ();
	}
	/**
	 * Função para retonar todos alertas
	 *
	 * @return multitype:
	 */
	public function getAlertaTodos() {
		$alerta = new Alerta ();
		return $alerta->getAlertaTodos ();
	}
	
	/**
	 * Função para retornar os Alertas recentes no index;
	 *
	 * @return Ambigous <multitype:, multitype:>
	 */
	public function getAlertaRecente() {
		$alerta = new Alerta ();
		return $alerta->getAlertaRecente ();
	}
	/**
	 * função de exclusão da tabela;
	 */
	public function excluir($id) {
		$alerta = new Alerta ();
		$resultado = $alerta->excluir ( $id );
		if ($resultado) {
			AppUtil::informaMensagem ( "Motivo excluído com sucesso!", AppUtil::MENSAGEM_SUCESSO );
		} else {
			AppUtil::informaMensagem ( "Não foi possível excluir a ocorrÊncia. ", AppUtil::MENSAGEM_ERRO );
		}
		return $resultado;
	}
	
	/**
	 * Função de busca pelo id
	 *
	 * @param unknown $id        	
	 * @return multitype:
	 */
	public function buscar($id) {
		$alerta = new Alerta ();
		return $alerta->buscar ( $id );
		;
	}
	
	/**
	 * Função busca o histórico do alerta
	 *
	 * @param unknown $id        	
	 */
	public function buscaHistoricoAlerta($id) {
		$alerta = new Alerta ();
		return $alerta->buscahistoricoAlerta ( $id );
	}
	
	/**
	 * Função de alteração do alerta
	 *
	 * @param unknown $id        	
	 * @param unknown $situacao        	
	 * @param unknown $motivo        	
	 * @param unknown $observacao        	
	 * @param unknown $dataInicio        	
	 * @param unknown $dataFim        	
	 * @return boolean
	 */
	public function alterar($id, $situacao, $unidade_id, $motivo, $observacao, $dataIni, $dataFim) {
		try {
			$alerta = new Alerta ( $situacao, $unidade_id, $motivo, $observacao, $dataIni, $dataFim );
		} catch ( Exception $error ) {
			AppUtil::informaMensagem ( $error->getMessage (), AppUtil::MENSAGEM_ERRO );
		}
		if ($alerta->update ( $id )) {
			AppUtil::informaMensagem ( "Ocorrência alterada com sucesso!", AppUtil::MENSAGEM_SUCESSO );
		} else {
			AppUtil::informaMensagem ( "Ocorreu um erro, tente alterar novamente.", AppUtil::MENSAGEM_ERRO );
		}
		
		Log::register ( 'alterar', 'alerta', $situacao, $motivo, $observacao, $id );
		Log::registerAlerta ( 'alterar', $situacao, $motivo, $id );
	}
	
	/**
	 * Função de atualização do status do Alerta (Finalizado ou Pendente)
	 *
	 * @param unknown $id        	
	 */
	public function finalizar($id) {
		try {
			$alerta = new Alerta ();
			$finalizado = $alerta->finalizar ( $id );
		} catch ( Exception $error ) {
			AppUtil::informaMensagem ( $error->getMessage (), AppUtil::MENSAGEM_ERRO );
		}
		if ($finalizado) {
			AppUtil::informaMensagem ( "Ocorrência finalizada com sucesso!", AppUtil::MENSAGEM_SUCESSO );
		} else {
			AppUtil::informaMensagem ( "Ocorreu um erro, tente finalizar novamente.", AppUtil::MENSAGEM_ERRO );
		}
		return $finalizado;
	}
}