<?php

require_once 'Debug.php';

$nmModulo = isset($_POST['nmModulo']) ? $_POST['nmModulo'] ? null;
$nmObjeto = isset($_POST['nmObjeto']) ? $_POST['nmModulo'] ? null;
$nmMetodo = isset($_POST['nmMetodo']) ? $_POST['$nmMetodo'] ? null;
$arParametros = isset($_POST['arParametros']) ? $_POST['arParametros'] : null;

if(!empty($nmModulo) && !empty($nmObjeto) && !empty($nmMetodo)){
	include_once '../../' . $nmMetodo . '/' . $nmMetodo. '.php';
	$objeto = new $nmObjeto();

	$retorno = $objeto->$nmObjeto($arParametros);

	echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
}