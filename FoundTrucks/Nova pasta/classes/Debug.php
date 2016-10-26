<?php	
	
	/**
	 * chama o x caso a condição seja atendida.
	 * Primeiro argumento é sempre a condição
	 * Ex.: xif($obNFuncionario->nrCracha == 1200,$arDodos,$arEventos);
	 */
	function xif()
	{
		if ($_SERVER['REMOTE_ADDR'] != '10.10.8.95' && $_SERVER['REMOTE_ADDR'] != '10.10.8.125' && $_SERVER['REMOTE_ADDR'] != '10.10.8.81'  && $_SERVER['REMOTE_ADDR'] != '10.10.8.48'){
				
			return;
		}
		$args 		= func_get_args();
		$condicao	= array_shift($args);
			
		if($condicao)
		{
			$string = '';
			foreach($args as $indice => $valor){
				$string .= '$args['.$indice.'],';
			}
			$string = substr($string,0,strlen($string) -1);
			eval("x({$string});");
		}
	}
	
	/**
	 * chama o xd caso a condição seja atendida.
	 * Primeiro argumento é sempre a condição
	 * Ex.: xdif($obNFuncionario->nrCracha == 1200,$arDodos,$arEventos);
	 */
	function xdif()
	{
		if ($_SERVER['REMOTE_ADDR'] != '10.10.8.125' && $_SERVER['REMOTE_ADDR'] != '10.10.8.81' && $_SERVER['REMOTE_ADDR'] != '10.10.8.48' ){
				
			return;
		}
		$args 		= func_get_args();
		$condicao	= array_shift($args);
			
		if($condicao)
		{
			$string = '';
			foreach($args as $indice => $valor){
				$string .= '$args['.$indice.'],';
			}
			$string = substr($string,0,strlen($string) -1);
			eval("xd({$string});");
		}
	}

	function x() {
		if ($_SERVER['REMOTE_ADDR'] != '10.10.8.95' && $_SERVER['REMOTE_ADDR'] != '10.10.8.125' && $_SERVER['REMOTE_ADDR'] != '10.10.8.81' && $_SERVER['REMOTE_ADDR'] != '10.10.8.48' ){
			return;
		}
		// Mostra onde o x foi chamado
		$trace = debug_backtrace ();
		while ( ($arLocal = array_shift ( $trace )) != false ) {
			if (preg_match ( '/(MyDebugger|eval\(\))+/', $arLocal ['file'] )) {
				$arLocal = array_shift ( $trace );
				continue;
			}
			break;
		}
		$stLocal = 'Horário: '.date('H:i:s:u').'<br>';
		$stLocal .= 'Timestamp: '.time().'<br>';
		$stLocal .= 'Arquivo :' . $arLocal ['file'] . ' ---> Linha ' . $arLocal ['line'] . ". <br><p>";
	
		echo $stLocal; 		
		echo "
		<div style='border: 1px solid black; padding: 10px; background-color: #ffff9f'>";
	
		if (count ( func_get_args () )) {
			foreach ( func_get_args () as $idx => $arg ) {
				echo "<b><u>ARG[$idx]</u></b><br><pre>";
				print_r ( $arg );
				echo "</pre>";
			}
		} else {
			echo "Sem argumentos!";
		}
		echo "</div><br><br>";
		flush ();
	}
	
	/**
	 * die() + x()
	 */
	function xd() {

		
		if ($_SERVER['REMOTE_ADDR'] != '10.10.8.95' && $_SERVER['REMOTE_ADDR'] != '10.10.8.125' && $_SERVER['REMOTE_ADDR'] != '10.10.8.81' && $_SERVER['REMOTE_ADDR'] != '10.10.8.66' && $_SERVER['REMOTE_ADDR'] != '10.10.8.48'){
			
			return;
		}
		// Mostra onde o x foi chamado
		// $arLocal = array_shift(debug_backtrace());
		$trace = debug_backtrace ();
		while ( ($arLocal = array_shift ( $trace )) != false ) {
			if (preg_match ( '/(Debug.php|eval\(\))+/', $arLocal ['file'] )) {
				$arLocal = array_shift ( $trace );
				continue;
			}
			break;
		}
		
		$stLocal = 'Horário: '.date('H:i:s:u').'<br>';
		$stLocal .= 'Timestamp: '.time().'<br>';
		$stLocal .= 'Arquivo :' . $arLocal ['file'] . ' ---> Linha ' . $arLocal ['line'] . "<br><p>";
		echo $stLocal;
	
		echo "<div style='display:none'>on line 0</div>
		<div style='border: 1px solid black; padding: 10px; background-color: #BBCCDD'>";
		
		if (count ( func_get_args () )) {
			foreach ( func_get_args () as $idx => $arg ) {
				echo "<b><u>ARG[$idx]</u></b><br><pre>";
				print_r ( $arg );
				echo "</pre>";
			}
		} else {
			
			echo "Sem argumentos!";
		}
		echo "</div><br><br>";
		flush ();
		die ();
	}
	/**
	 * die() + x() + Html
	 */
	function xdHtml() {
		if ($_SERVER['REMOTE_ADDR'] != '10.10.8.125' && $_SERVER['REMOTE_ADDR'] != '10.10.8.81' && $_SERVER['REMOTE_ADDR'] != '10.10.8.48' ){
				
			return;
		}
		// Mostra onde o x foi chamado
		// $arLocal = array_shift(debug_backtrace());
		$trace = debug_backtrace ();
		$arLocal = array_shift ( $trace );
		if (preg_match ( '/(MyDebugger)+/', $arLocal ['file'] )) {
			$arLocal = array_shift ( $trace );
		}
		$stLocal = 'Arquivo :' . $arLocal ['file'] . ' ---> Linha ' . $arLocal ['line'] . "<br><p>";
	
		echo $stLocal;
	
		echo "<div style='display:none'>on line 0</div>
		<div style='border: 1px solid black; padding: 10px; background-color: #00EEDD'>";
		if (count ( func_get_args () )) {
			$ar = func_get_args ();
			_retirarTags ( $ar );
	
			foreach ( $ar as $idx => $arg ) {
				echo "<b><u>ARG[$idx]</u></b><br><pre>";
				print_r ( $arg );
				echo "</pre>";
			}
		} else {
			echo "Sem argumentos!";
		}
		echo "</div><br><br>";
		flush ();
		die ();
	}
	/**
	 * x() + Html
	 */
	function xHtml() {
		if ($_SERVER['REMOTE_ADDR'] != '10.10.8.125' && $_SERVER['REMOTE_ADDR'] != '10.10.8.81'  && $_SERVER['REMOTE_ADDR'] != '10.10.8.48' ){
				
			return;
		}
		// Mostra onde o x foi chamado
		// $arLocal = array_shift(debug_backtrace());
		$trace = debug_backtrace ();
		$arLocal = array_shift ( $trace );
		if (preg_match ( '/(MyDebugger)+/', $arLocal ['file'] )) {
			$arLocal = array_shift ( $trace );
		}
		$stLocal = 'Arquivo :' . $arLocal ['file'] . ' ---> Linha ' . $arLocal ['line'] . "<br><p>";
	
		echo $stLocal;
	
		echo "<div style='display:none'>on line 0</div>
		<div style='border: 1px solid black; padding: 10px; background-color: #B4B464'>";
		if (count ( func_get_args () )) {
			$ar = func_get_args ();
			_retirarTags ( $ar );
	
			foreach ( $ar as $idx => $arg ) {
				echo "<b><u>ARG[$idx]</u></b><br><pre>";
				print_r ( $arg );
				echo "</pre>";
			}
		} else {
			echo "Sem argumentos!";
		}
		echo "</div><br><br>";
		flush ();
	}
	
	
	function _retirarTags(&$mixed)
	{
		if ($_SERVER['REMOTE_ADDR'] != '10.10.8.125' && $_SERVER['REMOTE_ADDR'] != '10.10.8.81' ){
				
			return;
		}
		if( is_array( $mixed ) ){
			foreach( $mixed as $k => $v ){
				_retirarTags($mixed[$k]);
			}
		} else {
			$mixed= htmlspecialchars($mixed);
		}
	}
	
	function j()
	{
		if ($_SERVER['REMOTE_ADDR'] != '10.10.8.125' && $_SERVER['REMOTE_ADDR'] != '10.10.8.81' ){
				
			return;
		}
		ob_end_clean();
	
		$aDbt = debug_backtrace();
	
		$aData = [
		'sFile' => $aDbt[0]['file'],
		'sLine' => $aDbt[0]['line'],
		'aArgs' => func_get_args()
		];
	
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($aData);
		die();
	}
	
	function xdForum() {
	
	
		
		// Mostra onde o x foi chamado
		// $arLocal = array_shift(debug_backtrace());
		$trace = debug_backtrace ();
		while ( ($arLocal = array_shift ( $trace )) != false ) {
			if (preg_match ( '/(Debug.php|eval\(\))+/', $arLocal ['file'] )) {
				$arLocal = array_shift ( $trace );
				continue;
			}
			break;
		}
	
		$stLocal = 'Horário: '.date('H:i:s:u').'<br>';
		$stLocal .= 'Timestamp: '.time().'<br>';
		$stLocal .= 'Arquivo :' . $arLocal ['file'] . ' ---> Linha ' . $arLocal ['line'] . "<br><p>";
		echo $stLocal;
	
		echo "<div style='display:none'>on line 0</div>
		<div style='border: 1px solid black; padding: 10px; background-color: #BBCCDD'>";
	
		if (count ( func_get_args () )) {
			foreach ( func_get_args () as $idx => $arg ) {
				echo "<b><u>ARG[$idx]</u></b><br><pre>";
				print_r ( $arg );
				echo "</pre>";
			}
			} else {
				
			echo "Sem argumentos!";
			}
			echo "</div><br><br>";
					flush ();
					die ();
	}
	
	function debugDesenv(){
		if ($_SERVER['REMOTE_ADDR'] == '10.10.8.125' ||  $_SERVER['REMOTE_ADDR'] == '10.10.8.95'){
			return true;				
		}else{
			return false;
		}
	}

?>