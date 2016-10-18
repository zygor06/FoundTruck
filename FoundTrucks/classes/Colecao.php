<?php

class Colecao {
	
	public $itens;

	function __construct ( $array = false ){
		
		if(!$array) {
			$this->itens = array();
		}
		else {
			$this->itens = $array;
		}
		
	}
	
	function adicionarColecao($colecao)
	{
		foreach( $colecao->itens as $item)
		{
			$this->push($item);
		}
	}
	/**
	 *Define a propriedade $nomePropriedade com o mesmo valor em todos os objetos. Os objetos precisam ter o método setter
	 */
	function definirPropriedadeEmTodos($nomePropriedade,$valor) {
		$chaves = array_keys($this->itens);
		$nomeMetodo = 'set'.ucfirst($nomePropriedade);
		foreach($chaves as $chave) {
			$this->itens[$chave]->$nomeMetodo($valor);
		}
	}
	
	/**
	 * Adiciona um objeto na Coleção
	 * @param [ob] Item a ser inserido na Coleção
	 * @param [in] Índice a ser utilizado na insersão do Item na Coleção
	 */
	function push($item, $indice=false) {
		if($indice!==false){
			$this->itens[$indice] = $item;
		} else {
			$this->itens[] = $item;
		}
	}
	
	/**
	 * Remove um objeto da Coleção pelo índice, retornando o mesmo
	 */
	function remove($indice) {
	
		if(!isset($this->itens[$indice])){
			return null;
		}
	
		$valor = $this->itens[$indice];
	
		unset($this->itens[$indice]);
	
		return $valor;
	}

	/**
	 *retorna e remove o ultimo item da coleção.
	 */
	function pop() {
		return array_pop($this->itens);
	}
	
	/**
	 *retorna e remove o primeiro item da coleção.
	 */
	function shift() {
		return array_shift($this->itens);
	}
	
	/**
	 * Retorna o número de elementos da Coleção
	 * @return [in] Número de elementos
	 */
	function count() {
		return count($this->itens);
	}
	
	/**
	 * Retorna o objeto da Coleção
	 * @return [ob] Objeto da Coleção
	 */
	function get($indice) {
		return $this->itens[$indice];
	}
	
	/**
	 *Retorna um boleano indicando se a coleção tem o indice informado
	 *@param [st] o indice a ser pesquisado.
	 */
	function temIndice($indice) {
		return isset($this->itens[$indice]);
	}
	
	/**
	 * verifica se possui um determinado valor dentro da coleçao.
	 * @param [st] o indice a ser pesquisado.
	 */
	function temValor($valor) {
		return in_array($valor, $this->itens);
	}
	
	/**
	 * Retorna as chaves da Coleção
	 * @return [ar]
	 */
	function getKeys() {
		return array_keys($this->itens);
	}
	
	function getArray() {
		return $this->itens;
	}
	
	/**
	 * retorna um array com os objetos na ordem em que eles estão e com indices de 0 em diante
	 */
	function getArrayIndexado() {
		$novoArray = array();
		foreach ($this->itens as $item) {
			$novoArray[] = $item;
		}
		return $novoArray;
	}
	
	/**
	 * Substitui os indices desta coleção por inteiros ordenador a partir de 0 em diante.
	 */
	function indexar() {
		$this->itens = $this->getArrayIndexado();
	}
	
	function gerarArrayPropriedade($nomePropriedade,$nomePropriedadeIndice = null)
	{
		if(!$nomePropriedade)
		{
			er();die;
		}
	
		if(is_array($nomePropriedade)) return $this->_gerarArrayPropriedadeInterna($nomePropriedade);
	
		$nomeMetodoGet = 'get'.$nomePropriedade;
	
		$arRetorno = array();
	
		foreach( $this->itens as $ob )
		{
			if( method_exists( $ob, $nomeMetodoGet ) )
			{
				$arRetorno[] = $ob->$nomeMetodoGet();
			}
			else
			{
				if (!is_null($nomePropriedadeIndice)){
					$arRetorno[$ob->__get($nomePropriedadeIndice)] = $ob->__get($nomePropriedade);
					
				}else{
					$arRetorno[] = $ob->__get($nomePropriedade);
				}
				
			}
				
		}
		return $arRetorno;
	}
	
	function _gerarArrayPropriedadeInterna($arPropriedades)
	{
		$arRetorno = array();
		foreach ( $this->itens as $valor)
		{
		
			foreach( $arPropriedades as $nomePropriedade )
			{
				$nomeMetodoGet = 'get'.$nomePropriedade;
				if( method_exists( $valor, $nomeMetodoGet ) )
				{
					$arRetorno[] = $valor->$nomeMetodoGet();
				}
				else
				{
					$arRetorno[] = $valor->__get($nomePropriedade);
				
				}
			}
			$arRetorno[] = $valor;
		}
		return $arRetorno;
	}
	/**
	 *Indexa o array da colecao pela propriedade passada caso os objetos tenham o método get da mesma.
	 *Caso haja dois registros com o mesmo valor para a propriedade, os primeiros serão excluidos da coleção.
	 */
	function indexarPorPropriedade($nomePropriedade) {
		$itens2 = array();
	
		foreach($this->itens as $item) {
			$itens2[$item->$nomePropriedade] = $item;
		}
		$this->itens = $itens2;
	}
	
	
	
	
	 
	/**
	 * Retorna uma coleção com os itens que o atributo tenha o valor que é passado por parametro
	 * @param [st] nome do Atributo a ser pesquisado
	 * @param [ar] valor de busca para recuperar a coleção
	 * @return [UColecao]
	 */
	function gerarSubColecaoPorAtributos($nomeAtributo, $arValoresPossiveis ) {
		$novaColecao = array();
		foreach(array_keys($this->itens) as $indice) {
			//Se o terceiro parâmetro opcional strict for passado como TRUE então array_search()  também fará uma checagem de tipos de needle  em haystack.
			if (is_array($nomeAtributo)){
				$nmObjeto = $nomeAtributo[0];
				$nmAtributoObjeto = $nomeAtributo[1];
				$res = in_array($this->itens[$indice]->$nmObjeto->$nmAtributoObjeto, $arValoresPossiveis);
			}else{
				$res = array_search(  $this->itens[$indice]->$nomeAtributo, $arValoresPossiveis , true);
			}
			
			if($res !== false AND $res !== null) {
				$novaColecao[] = $this->itens[$indice];
			}
		}
		return new Colecao($novaColecao);
	}
	
	/**
	 * Ordena a Coleção a partir do metodo compareTo que deve estar definido na classe dos objetos contidos por esta Coleção
	 *
	 */
	function ordenar( $ordenador, $nomeMetodoComparador = 'ordenarPorAtributo' ) {
		if( !method_exists($ordenador, $nomeMetodoComparador) ) {
			//trigger_error(  "O método de ordenação definido $nomeMetodoComparador() não existe no objeto passado : ".ts_get_class($ordenador)  , E_USER_ERROR);
			trigger_error(  "O método de ordenação definido $nomeMetodoComparador() não existe no objeto passado : ".get_class($ordenador)  , E_USER_ERROR);
		}
	
		uasort( $this->itens, array( $ordenador, $nomeMetodoComparador ) );
	}
	
	function carregarColecao($obConexao){
		$chaves = array_keys($this->itens);
		
		$arItensTemp = $this->itens;
		
		foreach($chaves as $chave) {
			$objeto = $this->itens[$chave];
			$objeto->carregarObjeto($obConexao);
			
			$arItensTemp[$chave] = $objeto;
		}
		$this->itens = $arItensTemp ; 
	}
}