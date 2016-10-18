<?php
//error_reporting ( E_ALL ^ E_NOTICE );
//ini_set ( 'display_errors', 1 );
require_once 'includes.php';

define ('CONST_ACAO_INSERIR',1);
define ('CONST_ACAO_ALTERAR',2);
define ('CONST_ACAO_EXCLUIR',3);

class Objeto{
	
	protected $nmSequence;
	protected $nmTabela;
	protected $nmCampoId;
	protected $arCamposCarregamento;
	protected $arCampos;
	protected $arCamposIgnoradosAlteracao;
	protected $arCamposExcluirCarregamento;
	protected $arDependentes;
	
	public function __construct($nmSequence =null,$nmTabela = null,$nmCampoId = null, $arCampos = null,$arCamposCarregamento= null,$arCamposIgnoradosAlteracao = null,$arCamposExcluirCarregamento = null,$arDependentes = null){
		$this->nmSequence = $nmSequence;
		$this->nmTabela = $nmTabela;
		$this->nmCampoId = $nmCampoId;
		$this->arCampos = $arCampos;
		$this->arCamposCarregamento = $arCamposCarregamento;
		$this->arCamposExcluirCarregamento = $arCamposExcluirCarregamento;
		$this->arCamposIgnoradosAlteracao = $arCamposIgnoradosAlteracao;
		$this->arDependentes = $arDependentes;
	}
	
	public function __set($name, $value)
	{
		
		$this->$name = $value;
	}
	
	public function __get($name)
	{
		return $this->$name;
	}
	
	protected function recuperarSequence(ConexaoOracle $obConexao,&$vlSequence){
		

		$stSql = "Select ".$this->nmSequence.".nextval valor from dual ";
		try{
			$obErro = $obConexao->executar($stSql);
		} catch (Exception $e){			
			throw $e;
		}
		$vlSequence = $obConexao->pegarLinhaRetorno()['VALOR'];
		return new Erro();
		
	} 

	protected function verificarAntesExecutar(){
		
	}
	
	protected function salvar(ConexaoOracle $obConexao){
		$arBindVariable = [];
		$nmCampoId = $this->nmCampoId;
		$csTipoAcao = empty($this->$nmCampoId)?CONST_ACAO_INSERIR : CONST_ACAO_ALTERAR;
		$boExecuta = true;
		
		
		try{
			$this->verificarAntesExecutar();
		}	catch (Exception $e){
			throw $e;
		}
		if ($csTipoAcao == CONST_ACAO_INSERIR)
		{
			try{
				$obErro = $this->recuperarSequence($obConexao,$vlSequence);
			}catch (Exception $e){
				//x($e);
				throw $e;
			}

			$stSql = "INSERT INTO " .$this->nmTabela;
			$stCampos = $stValores = " ( ";
			foreach ($this->arCampos as $nmAtributo=> $nmCampoTabela )
			{
				$stCampos .= $nmCampoTabela.",";
				if($nmAtributo == $nmCampoId)
				{
					$nmCampoTabelaId=$nmCampoTabela;
					$stValores .= "'".$vlSequence."',";
				}
				elseif (is_a($this->$nmAtributo,'DateTime'))
				{
					$stValores .= " to_date('".$this->$nmAtributo->format('Y-m-d H:i:s')."','YYYY-MM-DD HH24:MI:SS') ," ;
				}
				elseif (empty($this->$nmAtributo) && !is_int($this->$nmAtributo))
				{
					$stValores .= " NULL,";
				}
				else
				{
					if (is_int($this->$nmAtributo)){
						$stValores .= $this->$nmAtributo.",";
					}else{						
						if (strlen($this->$nmAtributo) < 4000){
							$stValores .= "'".$this->$nmAtributo."',";
						}else{
							$arBindVariable[$nmAtributo] = $this->$nmAtributo;
							$stValores .= ":".$nmAtributo.",";
						}
					}
				}
			} 
			$stCampos = trim($stCampos,',');
			$stValores = trim($stValores,',');
			$stCampos .= " ) ";
			$stValores .= " ) ";
			$stSql .= $stCampos.' VALUES '.$stValores;
			
			$this->$nmCampoId = $vlSequence;
		}else{
			
			
			
			$obObjeto =  new static();
			$obObjeto->recuperarUm($obConexao, $this->$nmCampoId);
			$stSql = " UPDATE ".$this->nmTabela." SET ";
			$stCamposValores = "";
			$boObjetoAlterado = false;
			
			foreach ($this->arCampos as $nmAtributo=> $nmCampoTabela )
			{
				
				
				
				if($nmAtributo == $nmCampoId)
				{
					$nmCampoTabelaId=$nmCampoTabela;
					continue;
				}
				
				if($obObjeto->$nmAtributo == $this->$nmAtributo && !isset($this->arCamposIgnoradosAlteracao[$nmAtributo])){
					continue;
				}
				if (is_a($this->$nmAtributo,'DateTime'))
				{
					$stCamposValores .= $nmCampoTabela." = to_date('".$this->$nmAtributo->format('Y-m-d H:i:s')."','YYYY-MM-DD hh24:mi:ss') ," ;
				}
				elseif (empty($this->$nmAtributo))
				{
					$stCamposValores .= $nmCampoTabela." = NULL,";
				}
				else
				{
					if (is_int($this->$nmAtributo)){
						$stCamposValores .= $nmCampoTabela." = ".$this->$nmAtributo.",";
					}else{
						$stCamposValores .= $nmCampoTabela." = '".$this->$nmAtributo."',";
					}
				}
				$boObjetoAlterado = true;
			}
			$stCamposValores = trim($stCamposValores,',');
			
			$stCondicao = " WHERE ".$nmCampoTabelaId.' = '.$this->$nmCampoId;
			
			$stSql .= $stCamposValores.$stCondicao;
			if (!$boObjetoAlterado){
				$boExecuta = false;
			}
		}
		
		
		
		if ($boExecuta){

			try{
				$obConexao->executar($stSql,$arBindVariable);
			}catch (Exception $e){
				x($e);
				throw $e;
			}
		}
		
		return new Erro();
	}
	
	protected function excluir(ConexaoOracle $obConexao){
		$nmCampoId = $this->nmCampoId;
		$nmCampoIdTabela = $this->arCampos[$nmCampoId];
		$obObjeto =  new static();
		$stSql = " DELETE FROM ".$this->nmTabela."  WHERE ".$nmCampoIdTabela.' = '.$this->$nmCampoId;
		try{
			$obConexao->executar($stSql);
		}catch (Exception $e){
			throw $e;
		}
		
		return new Erro();
	}
	
	public function recuperarUm(ConexaoOracle $obConexao,$vlAtributo){
		$nmCampoId = $this->nmCampoId;
		
		$stSql = 'SELECT * FROM '.$this->nmTabela.' WHERE '.$this->arCampos[$nmCampoId].' = '.$vlAtributo;
		
		try{
			$obErro = $obConexao->executar($stSql);
		} catch (Exception $e){
			throw $e;
		}
		$arDados = $obConexao->pegarLinhaRetorno();
		
		$this->lerUm($arDados,$this);
		return new Erro();
	}
	
	public function recuperarUmPorAtributo (ConexaoOracle $obConexao,$nmAtributo,$vlAtributo){
		$stSql = "SELECT * FROM ".$this->nmTabela." WHERE ".$this->arCampos[$nmAtributo]." = '".$vlAtributo."'";
		
		try{
			$obErro = $obConexao->executar($stSql);
		} catch (Exception $e){
			throw $e;
		}
		$arDados = $obConexao->pegarLinhaRetorno();
	
		$this->lerUm($arDados,$this);
		return new Erro();
	}
	
	public function recuperarUmPorArrayAtributos (ConexaoOracle $obConexao,$arAtributos){
	$stSql = 'SELECT * FROM '.$this->nmTabela.' WHERE ';
		
		foreach( $arAtributos as $nmAtributo=>$vlAtributo ){
			if (is_array($vlAtributo)){
				$arValores = $vlAtributo;
				
				$stRegra = key($arValores);
				switch ($stRegra)
				{
					case 'igual':
						$stSql .= $this->arCampos[$nmAtributo]." = ".$vlAtributo[$stRegra].' and  ';
						break;
					case 'igualString':
						$stSql .= $this->arCampos[$nmAtributo]." = '".$vlAtributo[$stRegra]."' and  ";
						break;
					case 'notNull':
						$stSql .= "".$this->arCampos[$nmAtributo]."  is not null and  ";
						break;
					case 'isNull':
						$stSql .= "".$this->arCampos[$nmAtributo]."  is null and  ";
						break;
					case 'in': 
						$stSql .= $this->arCampos[$nmAtributo].' in (';					
						break;
					case 'notIn': 						
						$stSql .= $this->arCampos[$nmAtributo].' not in (';					
						break;
					case 'menorQue': 		
						$stSql .= $this->arCampos[$nmAtributo].' < '.$vlAtributo[$stRegra].'     ';			 
						break;
					case 'like':
						$stSql .= "lower(".$this->arCampos[$nmAtributo].") like  lower('%".$vlAtributo[$stRegra]."%')     ";
						break;
					default: 
						throw new Exception('Regra "'.$stRegra.'" inexistente!');
						break;
				}
				
				foreach($arValores as $stRegra => $vlAtributo){

					switch ($stRegra)
					{
						case 'in':
							$arValoresEm = $vlAtributo;
							foreach($arValoresEm as $vlAtributoEm){
								$stSql .=		$vlAtributoEm.', ';
							}
							$stSql = substr($stSql, 0, -2);
							$stSql .=		') AND ';
						break;
						
						case 'notIn':
							$arValoresEm = $vlAtributo;
							foreach($arValoresEm as $vlAtributoEm){
								$stSql .=		$vlAtributoEm.', ';
							}
							$stSql = substr($stSql, 0, -2);
							$stSql .=		') AND ';
						break;
						
						
					}
					
				}
				
				
			}else{
				
				if (!isset($this->arCampos[$nmAtributo])){
					trigger_error('Atributo ['.$nmAtributo.'] inexistente no objeto: ['.get_class($this).']');
					die;
				}elseif(preg_match("/^dt/", $nmAtributo)){
					$stSql .= 'to_char('.$this->arCampos[$nmAtributo].",'DD/MM/YYYY') = '".$vlAtributo."' AND ";
				}else{
					$stSql .= $this->arCampos[$nmAtributo]." = '".$vlAtributo."' AND ";
					
				}
			}
			
		}
		$stSql = substr($stSql, 0, -5);
		//x($stSql);
		try{
			$obErro = $obConexao->executar($stSql);
		} catch (Exception $e){
			
			throw $e;
		}

		$arDados = $obConexao->pegarLinhaRetorno();
		
		$this->lerUm($arDados,$this);
		return new Erro();
	}
	
	public function recuperarTodos (ConexaoOracle $obConexao, Colecao $colecao,$arOrderBy = null){
		$stSql = 'SELECT * FROM '.$this->nmTabela;
		
		if(is_array($arOrderBy)){
			$stSql .= ' ORDER BY ';
			foreach($arOrderBy as $nmAtributoOrdenacao=>$indice  ){
				$nmCampoOrdenacao = $this->arCampos[$nmAtributoOrdenacao];
				$stSql .= $nmCampoOrdenacao.' '.(!is_numeric($indice)?$indice:'').' , ';
			}
			$stSql = substr($stSql, 0, -2);
			//x($stSql);
		}
		
		try{
			$obErro = $obConexao->executar($stSql);
		} catch (Exception $e){
			x($e);
			throw $e;
		}
		$arDados = $obConexao->pegarArrayRetorno();
	
		$this->lerTodos($colecao, $arDados,$this);
		return new Erro();
	}
	
	public function recuperarTodosPorAtributo (ConexaoOracle $obConexao, Colecao $colecao,$nmAtributo,$vlAtributo,$arOrderBy = null){
		$stSql = 'SELECT * FROM '.$this->nmTabela.' WHERE '.$this->arCampos[$nmAtributo].' = '.$vlAtributo;
		
		if(is_array($arOrderBy)){
			
			$stSql .= ' ORDER BY ';
			foreach($arOrderBy as $nmAtributoOrdenacao => $indice){
				$nmCampoOrdenacao = $this->arCampos[$nmAtributoOrdenacao];
				$stSql .= $nmCampoOrdenacao.' '.(!is_numeric($indice)?$indice:'').' , ';
			}
		
			$stSql = substr($stSql, 0, -2);
		}
		
		try{
			//x($stSql);
			$obErro = $obConexao->executar($stSql);
		} catch (Exception $e){
			x($e);
			throw $e;
		}
		
		
		$arDados = $obConexao->pegarArrayRetorno();
	
		$this->lerTodos($colecao, $arDados,$this);
		return new Erro();
	}
	
	public function recuperarTodosPorArrayAtributos (ConexaoOracle $obConexao,Colecao &$colecao, $arAtributos,$arOrderBy = null,$nrLimite = null){
		$stSql = 'SELECT * FROM '.$this->nmTabela.' WHERE ';
		
		foreach( $arAtributos as $nmAtributo=>$vlAtributo ){
			if (is_array($vlAtributo)){
				$arValores = $vlAtributo;
				
				$stRegra = key($arValores);
				
				if(preg_match("/^dt/", $nmAtributo)){
					switch ($stRegra)
					{

						case 'isNull':
							$stSql .= "".$this->arCampos[$nmAtributo]."  is null and  ";
							break;
						case 'notNull':
							$stSql .= "".$this->arCampos[$nmAtributo]."  is not null and  ";
							break;
						case 'maiorOuIgual':
							$stSql .= $this->arCampos[$nmAtributo].' >= to_date(\''.$vlAtributo[$stRegra].'\',\'DD/MM/YYYY\') and  ';
							break;
						case 'maiorQue':
							$stSql .= $this->arCampos[$nmAtributo].' >  to_date(\''.$vlAtributo[$stRegra].'\',\'DD/MM/YYYY\') and  ';
							break;
						case 'menorOuIgual':
							$stSql .= $this->arCampos[$nmAtributo].' <=  to_date(\''.$vlAtributo[$stRegra].'\',\'DD/MM/YYYY\') and  ';
							break;
						case 'menorQue':
							$stSql .= $this->arCampos[$nmAtributo].' <  to_date(\''.$vlAtributo[$stRegra].'\',\'DD/MM/YYYY\') and  ';
							break;
						case 'entreDatas':
								
								if (!is_array($vlAtributo[$stRegra])){
									throw new Exception('$vlAtributo deve ser um Array neste regra!');
									break;
								}else{
									$stSql .= $this->arCampos[$nmAtributo].' between  to_date(\''.$vlAtributo[$stRegra][0].' 00:00:00\',\'DD/MM/YYYY  HH24:MI:SS\') and to_date(\''.$vlAtributo[$stRegra][1].' 23:59:59\',\'DD/MM/YYYY  HH24:MI:SS\') and  ';
									
								}
						break;
						default:
							
							throw new Exception('Regra "'.$stRegra.'" inexistente!');
							break;
					}
				}else{
					
				
				
					switch ($stRegra)
					{
						case 'igual': $stSql .= $this->arCampos[$nmAtributo]." = ".$vlAtributo[$stRegra].' and  ';
							break;
						case 'igualString': $stSql .= $this->arCampos[$nmAtributo]." = '".$vlAtributo[$stRegra]."' and  ";
							break;
						case 'in': $stSql .= $this->arCampos[$nmAtributo].' in (';					
							break;
						case 'notIn': 						
							$stSql .= $this->arCampos[$nmAtributo].' not in (';					
							break;
						case 'menorQue': 		
							$stSql .= $this->arCampos[$nmAtributo].' < '.$vlAtributo[$stRegra].' and  ';			 
							break;
						case 'like':
							$stSql .= "lower(".$this->arCampos[$nmAtributo].") like  lower('%".$vlAtributo[$stRegra]."%') and  ";
							break;
						case 'notNull':
							$stSql .= "".$this->arCampos[$nmAtributo]."  is not null and  ";
							break;
						case 'isNull':
							$stSql .= "".$this->arCampos[$nmAtributo]."  is null and  ";
							break;
						default: 
							throw new Exception('Regra "'.$stRegra.'" inexistente!');
							break;
					}
				}
				foreach($arValores as $stRegra => $vlAtributo){

					switch ($stRegra)
					{
						case 'in':
							$arValoresEm = $vlAtributo;
							foreach($arValoresEm as $vlAtributoEm){
								$stSql .=		$vlAtributoEm.', ';
							}
							$stSql = substr($stSql, 0, -2);
							$stSql .=		') AND  ';
						break;
						
						case 'notIn':
							$arValoresEm = $vlAtributo;
							foreach($arValoresEm as $vlAtributoEm){
								$stSql .=		$vlAtributoEm.', ';
							}
							$stSql = substr($stSql, 0, -2);
							$stSql .=		') AND  ';
						break;
						
						
					}
					
				}
				
				
			}else{
				if (!isset($this->arCampos[$nmAtributo])){
					trigger_error('Atributo ['.$nmAtributo.'] inexistente no objeto: ['.get_class($this).']');
					die;
				}
				$stSql .= $this->arCampos[$nmAtributo]." = '".$vlAtributo."' AND  ";
			}
			
		}
		$stSql = substr($stSql, 0, -6);
			
		if(is_array($arOrderBy)){
			
			$stSql .= ' ORDER BY ';
			foreach($arOrderBy as  $nmAtributoOrdenacao => $indice){				
				$nmCampoOrdenacao = $this->arCampos[$nmAtributoOrdenacao];
				$stSql .= $nmCampoOrdenacao.' '.(!is_numeric($indice)?$indice:'').' , ';
			}
		
			$stSql = substr($stSql, 0, -2);
		}
		
		if (!is_null($nrLimite)){
			$stSql = 'select * from ('.$stSql.') where rownum <= '.$nrLimite;
		}
		
		try{
			//xd($stSql);
			
			$obErro = $obConexao->executar($stSql);
		} catch (Exception $e){
			x($e);
			throw $e;
		}
		
		$arDados = $obConexao->pegarArrayRetorno();
	
		$stClasseObjeto = get_class($this);
		$this->lerTodos($colecao,$arDados,$stClasseObjeto);
		return new Erro();
	}
	
	protected function lerUm($arDados,Objeto $obObjeto){
		foreach ($this->arCampos as $nmAtributo=> $nmCampoTabela )
		{			
			if (is_a($arDados[$nmCampoTabela],'OCI-Lob')){
				$ob = $arDados[$nmCampoTabela];
				$obObjeto->$nmAtributo = $ob->load();
				
			}else{
				$obObjeto->$nmAtributo = $arDados[$nmCampoTabela];
			}
		}
	}
	
	protected function lerTodos(Colecao $colecao, $arDados,$stClasseObjeto){
		
		if(is_array($arDados)){
			foreach($arDados as $nrLinha => $arLinha){
				
				$obObjeto = new $stClasseObjeto;
				foreach ($this->arCampos as $nmAtributo=> $nmCampoTabela )
				{
					if (is_a($arLinha[$nmCampoTabela],'OCI-Lob')){
						$obObjeto->$nmAtributo = $arLinha[$nmCampoTabela]->load();
					}else{						
						$obObjeto->$nmAtributo = $arLinha[$nmCampoTabela];
					}
				}
				$colecao->push($obObjeto);
			}
		}
	}
	
	public function carregarObjeto(Conexao $obConexao){
		
		$arClassVars = get_class_vars (get_class($this));
		$arCamposCarregamento = $this->arCamposCarregamento;
		$arCamposExcluirCarregamento = !empty($this->arCamposExcluirCarregamento)?$this->arCamposExcluirCarregamento:array();
		foreach($arClassVars as $classVar => $valor){
			// verifica se atributo é ID
			if ($classVar == $this->nmCampoId  || in_array($classVar,$arCamposExcluirCarregamento)){
				continue;
			}
				
			if( preg_match("/^id/", $classVar) || (is_array($arCamposCarregamento) && isset($arCamposCarregamento[$classVar]))){
				$teNomeClasse = substr($classVar,2);
				$teNomeClasseOriginal = $teNomeClasse;
				$boNomePersonalizado = false;
				if (is_array($arCamposCarregamento)){
					if (isset($arCamposCarregamento[$classVar])){
						if (is_array($arCamposCarregamento[$classVar])){
							$boNomePersonalizado = true;
							$teNomeClasse = $arCamposCarregamento[$classVar][0];
							$stSufixo = $arCamposCarregamento[$classVar][1];
						}else{
							$teNomeClasse = $arCamposCarregamento[$classVar];
						}
					}
				}
				
				try{
					$obObjeto = new $teNomeClasse;
				}catch (Exception $e){
					if (debugDesenv()){
						x($e);
					}	
				}
				
				if ($boNomePersonalizado){
					$stAtributoObjeto = $stSufixo;
					
					
				}else{
					$stAtributoObjeto = 'ob'.$teNomeClasse;
				}
				
				if (!is_null($this->$classVar)){
					$obObjeto->recuperarUm($obConexao,$this->$classVar);
					
					$this->__set($stAtributoObjeto,$obObjeto);
				}
			}elseif( preg_match("/^dt/", $classVar)){
				if (strlen(trim($this->__get($classVar))) == 10){
					$obObjeto = DateTime::createFromFormat('d/m/Y',$this->__get($classVar));
				}elseif (strlen(trim($this->__get($classVar))) == 19){
					$obObjeto = DateTime::createFromFormat('d/m/Y H:i:s',$this->__get($classVar));
				}
				
				$stAtributoObjeto = 'ob'.ucfirst($classVar);
				$this->__set($stAtributoObjeto,$obObjeto);
			}
		}
	}
	
	public function carregarDependentes(Conexao $obConexao){
	
		$arClassVars = get_class_vars (get_class($this));
		$arDependentes = $this->arDependentes;
		if (!is_array($arDependentes)){
			throw Exception('$arDependentes precisa ser um array.');
		}
		foreach($arDependentes as $teNomeClasse => $nmCampoCorrespondente){
			// verifica se atributo é ID
			$obColecao = new Colecao();
			$nmColecao = 'co'.$teNomeClasse;
			$obObjeto = new $teNomeClasse;
			$nmCampoId = $this->nmCampoId;
			$valorId = $this->$nmCampoId;
			$obObjeto->recuperarTodosPorAtributo($obConexao,$obColecao,$nmCampoCorrespondente,$valorId,array($nmCampoCorrespondente=>'ASC'));
			$this->__set($nmColecao,$obColecao);
		}
	}
	
	
}