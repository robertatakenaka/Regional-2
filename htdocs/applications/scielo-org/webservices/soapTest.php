<?php
if(!isset($_REQUEST['service'])){
	die("missing parameter <i>service</i>");
}

$service = $_REQUEST['service'];

$clientesoap = new SoapClient('http://'.$_SERVER["HTTP_HOST"].'/applications/scielo-org/webservices/indexBVS.wsdl');

switch($service){
	case "search":
		if(!isset($_REQUEST['expression'])){
			die("missing parameter <i>expression</i>");
		}
		if(!isset($_REQUEST['from'])){
			die("missing parameter <i>from</i>");
		}
		if(!isset($_REQUEST['count'])){
			die("missing parameter <i>count</i>");
		}
		if(!isset($_REQUEST['collection'])){
			die("missing parameter <i>collection</i>");
		}
		//$param = array('expression' => $_REQUEST['expression'],'from' => $_REQUEST['from'],'count' => $_REQUEST['count'],'collection' => $_REQUEST['collection']);
		try{
			$resultado = $clientesoap->search($_REQUEST['expression'], $_REQUEST['from'], $_REQUEST['count'], $_REQUEST['collection']);	
		}catch(Exception $e){
			die('Exception: ' . $e->getMessage());
		}
		
		break;
	case "searchHG":
		if(!isset($_REQUEST['expression'])){
			die("missing parameter <i>expression</i>");
		}
		if(!isset($_REQUEST['from'])){
			die("missing parameter <i>from</i>");
		}
		if(!isset($_REQUEST['count'])){
			die("missing parameter <i>count</i>");
		}
		if(!isset($_REQUEST['collection'])){
			die("missing parameter <i>collection</i>");
		}
		$param = array('expression' => $_REQUEST['expression'],'from' => $_REQUEST['from'],'count' => $_REQUEST['count'],'collection' => $_REQUEST['collection']);
		$resultado = $clientesoap->searchHG($param);
		break;
	case "advancedSearch":
		if(!isset($_REQUEST['index'])){
			die("missing parameter <i>index</i>");
		}
		if(!isset($_REQUEST['expression'])){
			die("missing parameter <i>expression</i>");
		}
		if(!isset($_REQUEST['from'])){
			die("missing parameter <i>from</i>");
		}
		if(!isset($_REQUEST['count'])){
			die("missing parameter <i>count</i>");
		}
		if(!isset($_REQUEST['collection'])){
			die("missing parameter <i>collection</i>");
		}
		$param = array('index' => $_REQUEST['index'],'expression' => $_REQUEST['expression'],'from' => $_REQUEST['from'],'count' => $_REQUEST['count'],'collection' => $_REQUEST['collection']);
		$resultado = $clientesoap->advancedSearch($param);
		break;
	case "advancedSearchHG":
		if(!isset($_REQUEST['index'])){
			die("missing parameter <i>index</i>");
		}
		if(!isset($_REQUEST['expression'])){
			die("missing parameter <i>expression</i>");
		}
		if(!isset($_REQUEST['from'])){
			die("missing parameter <i>from</i>");
		}
		if(!isset($_REQUEST['count'])){
			die("missing parameter <i>count</i>");
		}
		if(!isset($_REQUEST['collection'])){
			die("missing parameter <i>collection</i>");
		}
		$param = array('index' => $_REQUEST['index'],'expression' => $_REQUEST['expression'],'from' => $_REQUEST['from'],'count' => $_REQUEST['count'],'collection' => $_REQUEST['collection']);
		$resultado = $clientesoap->advancedSearchHG($param);
		break;

	case "listRecords":
		if(!isset($_REQUEST['count'])){
			die("missing parameter <i>count</i>");
		}
		if(!isset($_REQUEST['collection'])){
			die("missing parameter <i>collection</i>");
		}
		$param = array('count' => $_REQUEST['count'],'collection' => $_REQUEST['collection']);
		$resultado = $clientesoap->listRecords($param); // Alterar o nome do servi�o. 
		break;
	case "lastRecords":		
		if(!isset($_REQUEST['count'])){
			die("missing parameter <i>count</i>");
		}
		if(!isset($_REQUEST['collection'])){
			die("missing parameter <i>collection</i>");
		}
		$param = array('count' => $_REQUEST['count'],'collection' => $_REQUEST['collection']);
		$resultado = $clientesoap->lastRecords($param);
		break;
	case "lastRecordsHG":		
		if(!isset($_REQUEST['count'])){
			die("missing parameter <i>count</i>");
		}
		if(!isset($_REQUEST['collection'])){
			die("missing parameter <i>collection</i>");
		}
		$param = array('count' => $_REQUEST['count'],'collection' => $_REQUEST['collection']);
		$resultado = $clientesoap->lastRecordsHG($param);
		break;
}


//if($_REQUEST['return'] == 'soap'){
//	echo '<h2>Request</h2><pre>' . htmlspecialchars($clientesoap->request, ENT_QUOTES) . '</pre>';
//	echo '<h2>Response</h2><pre>' . htmlspecialchars($clientesoap->response, ENT_QUOTES) . '</pre>';
//	echo '<h2>Debug</h2><pre>' . htmlspecialchars($clientesoap->debug_str, ENT_QUOTES) . '</pre>';
//}else{
	header('Content-type: application/xml; charset="ISO-8859-1"',true);
	echo $resultado;
//}
?>