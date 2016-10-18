<?

class Iterador {
	
	/**
	* Coleção utilizada na Iteração
	* @var [Colecao]
	*/
	var $colecao;
	
	/**
	* Índice do objeto da Coleção
	* @var [in]
	*/
	var $indice;
	
	/**
	* Array contendo as Chaves da Coleção
	* @var [in]
	*/
	var $keysColecao;
	
	/**
	* Construtor da classe
	* @param [UColecao] Coleção a ser utilizada na Iteração
	*/
	function __construct(Colecao &$colecao) {
		
		$this->colecao = $colecao;
		$this->indice = 0;
		$this->keysColecao = $this->colecao->getKeys();
	}
	
	/**
	* Retorna o objeto atual da coleção e avança para o próximo objeto
	* este método pode ser utilizado para pegar o valor ou uma referência
	* $obj = & $iterador->pegarEAvancar pega uma referencia
	* $obj = $iterador->pegarEAvancar pega o valor
	* @return [Objeto]
	*/
	function pegarEAvancar() {		
		
		if(  $this->indice < $this->colecao->count() ){
			$this->indice++;			
			return $this->colecao->get($this->keysColecao[$this->indice-1]);
		}else if( $this->indice == $this->colecao->count()-1 ) {
			return false;
		}
	}
	
	function getAnterior() {
		return $this->colecao->get($this->keysColecao[$this->indice-2]);
	}
	
	function temAnterior() {
		return $this->indice > 1;
	}
	
	function getProximo() {
		return $this->colecao->get($this->keysColecao[$this->indice]);
	}
	
	function temProximo() {
		return $this->indice < (count( $this->keysColecao ));
	}
	
	function getChaveAtual() {
		return $this->keysColecao[$this->indice-1];
	}
	
	
	/**
	* Retorna o objeto atual da coleção e retrocede para o objeto anterior
	* este método pode ser utilizado para pegar o valor ou uma referência
	* $obj = & $iterador->pegarEAvancar pega uma referencia
	* $obj = $iterador->pegarEAvancar pega o valor
	* @return [Objeto]
	*/
	function pegarERetroceder() {
		if(  $this->indice > -1  ){
			$this->indice--;
			return $this->colecao->get($this->keysColecao[$this->indice+1]);
		}else if( $this->indice == 0 ) {
			return false;
		}
	}
	
	/**
	* Posiciona o ponteiro para o primeiro objeto
	* @return [Objeto]
	*/
	function irInicio() {
		$this->indice = 0;
	}
	
	/**
	* Posiciona o ponteiro para o último objeto
	* @return [Objeto]
	*/
	function irFim() {
		$this->indice = $this->colecao->count()-1;
	}
	
	/**
	* Retorna o número de elementos da Coleção
	* @return [in] Número de elementos
	*/
	function count() {
		return $this->colecao->count();
	}
}

?>
