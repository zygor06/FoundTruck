<?php

require_once 'Conexao.class.php';

class ConexaoOracle extends Conexao{
	
	private $obResource;
	
	public function __construct($nmBanco="dbvida",$nrIpBanco ="10.10.8.6",$nrPorta = "1521",$nmUsuario='internet',$teSenha='caixa'){
		parent::__construct();
		
		$this->__set('nmBanco', $nmBanco);
		$this->__set('nrIpBanco',$nrIpBanco);
		$this->__set('nrPorta', $nrPorta);
		$this->__set('nmUsuario', $nmUsuario);
		$this->__set('teSenha', $teSenha);
	}
	
	public function conectar($boFormatoDataComHora = false){
		
		$nmBanco = $this->__get('nmBanco' );
		$nrIpBanco = $this->__get('nrIpBanco');
		$nrPorta = $this->__get('nrPorta' );
		$nmUsuario = $this->__get('nmUsuario' );
		$teSenha = $this->__get('teSenha' );
		
		$connectionString = '(DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = '.$nrIpBanco.')(PORT = '.$nrPorta.')))(CONNECT_DATA =(SERVICE_NAME = '.$nmBanco.')))';
		try{
			
			$obConexao = oci_connect($nmUsuario, $teSenha,$connectionString,'AL32UTF8');
			/*/if ($obConexao = oci_connect($nmUsuario, $teSenha,$connectionString,'AL32UTF8') == false){
				x();
				throw new Exception('Não foi possível realizar a conexão com o banco de dados', '0001');
			}*/
		}catch (Exception $e){
			x($e);
			return new Erro($e->getMessage());
		}
		$this->obConexao = $obConexao;
			
		//$e = $this->executar("Alter SESSION Set NLS_LANGUAGE='BRAZILIAN PORTUGUESE' ");
		$e = $this->executar("Alter SESSION Set NLS_CURRENCY ='R$' ");
		
		if ($boFormatoDataComHora){
			$e = $this->executar("Alter SESSION Set NLS_DATE_FORMAT ='DD/MM/YYYY HH24:MI:SS' ");
		}
		//$e = $this->executar("Alter SESSION Set NLS_NUMERIC_CHARACTERS =',.' ");
		//$e = $this->executar('select * from v$nls_parameters where parameter=\'NLS_NUMERIC_CHARACTERS\'');
		//xd(oci_fetch_assoc($this->obResource),$e);
	}
	
	public function desconectar(){
		$obConexao = $this->obConexao;
		$obResource = $this->obResource;
		if (!is_null($obResource)){
			oci_free_statement($obResource);
		}
		oci_close($obConexao);
	}
	
	/*public function executar($stSql){
		$obConexao = $this->obConexao;
		
		try{
			$obSql = @oci_parse($obConexao, $stSql);
		}catch (Exception $e) {
			throw new Exception('Erro - O Script não foi analisado corretamente. Verifique a sintaxe do código.', '0001');
		}
			
		if (!@oci_execute($obSql,OCI_NO_AUTO_COMMIT)){			
			throw new Exception('Erro - O Script não foi executado', '0002');
		}
		
		$this->obResource = $obSql;
		
		return new Erro();
	}*/
	
	public function executar($stSql,$arBindVariable = []){
		$obConexao = $this->obConexao;
		$err = "";
		
		//$stSql = 
		//x($stSql);
		$obSql = @oci_parse($obConexao, ($stSql));	
		
		if ($obSql){
			$err = oci_error($obSql);
		}
		if (!empty($err) || !$obSql){
			throw new Exception('Erro - O Script possui erro de sintaxe.', '0001');
		}
		
		if (count($arBindVariable) > 0){
			foreach($arBindVariable as $nmVariavel=>$valor){
				//xd(":".$nmVariavel, $valor);
				oci_bind_by_name($obSql, ":".$nmVariavel, $valor);
			}
		}
		
		@oci_execute($obSql,OCI_NO_AUTO_COMMIT);
		$err = oci_error($obSql);
		if (!empty($err)){				
			throw new Exception('Erro - O Script não foi executado: '.$err['message'], '0002');
		}
		
		$this->obResource = $obSql;
	
		return new Erro();
	}
	
	public function pegarArrayRetorno(){
		$obResource = $this->obResource;
		
		$arResultado = array();
		while (($row = oci_fetch_assoc($obResource)) != false) {
			$arResultado[] = $row;
		}
		
		return $arResultado;
	}
	
	public function pegarLinhaRetorno(){
		$obResource = $this->obResource;		
		return oci_fetch_assoc($obResource);
	}
	
	public function commit(){
		$obConexao = $this->obConexao;
		oci_commit($obConexao);
	}
	
	public function rollback(){
		$obConexao = $this->obConexao;
		oci_rollback($obConexao);
	}
	
	
}