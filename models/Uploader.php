<?php
class Uploader {
	public static function upload() {
		
		// Pasta onde o arquivo vai ser salvo
		$pastaDestino = '../imagens/';
		
		// Tamanho máximo do arquivo (em Bytes)
		$tamanhoMaximo = 1024 * 1024 * 2; // 2Mb
		                                  
		// Array com os tipos de erros de upload do PHP
		$_UP ['erros'] [0] = 'Não houve erro';
		$_UP ['erros'] [1] = 'O arquivo no upload é maior do que o limite do PHP';
		$_UP ['erros'] [2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
		$_UP ['erros'] [3] = 'O upload do arquivo foi feito parcialmente';
		$_UP ['erros'] [4] = 'Não foi feito o upload do arquivo';
		
		// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
		$retorno = [ 
				'nomeOriginal' => '',
				'novoNome' => '',
				'tipoArquivo' => '',
				'tamanho' => 0 
		];
		
		if ($_FILES ['arquivo'] ['error'] != 0) {
			echo "Não foi possível fazer o upload";
			return $retorno;
		}
		
		// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
		// Faz a verificação da extensão do arquivo
		$extensoes = [ 
				'jpg',
				'gif',
				'pdf',
				'png' 
		];
		$extensao = strtolower ( end ( explode ( '.', $_FILES ['arquivo'] ['name'] ) ) );
		
		if (array_search ( $extensao, $extensoes ) === false) {
			echo "Por favor, envie arquivos com as seguintes extensões: ", implode ( ', ', $extensoes );
			return $retorno;
		}
		
		// Faz a verificação do tamanho do arquivo
		$tamanhoArquivo = $_FILES ['arquivo'] ['size'];
		if ($tamanhoMaximo < $tamanhoArquivo) {
			echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
			return $retorno;
		}
		
		$novoNome = time () . '.' . $extensao;
		
		// Depois verifica se é possível mover o arquivo para a pasta escolhida
		$nomeFinal = $pastaDestino . $novoNome;
		$nomeOriginal = $_FILES ['arquivo'] ['name'];
		
		if (move_uploaded_file ( $_FILES ['arquivo'] ['tmp_name'], $nomeFinal ) == false) {
			echo "Não foi possível enviar o arquivo, tente novamente";
			return $retorno;
		}
		
		$retorno = [ 
				'nomeOriginal' => $nomeOriginal,
				'novoNome' => $novoNome,
				'tipoArquivo' => $extensao,
				'nomeFinal' => $nomeFinal,
				'tamanho' => $tamanhoArquivo 
		];
		
		return $retorno;
	}
}