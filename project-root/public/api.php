<?php
header("Content-Type:application/json");

// brincando com API

if(!empty($_GET['livro']))
{
	$livro=$_GET['livro'];
	if (date('s')%2 == 0) {
		$contagem = '';
	}
	else {
		$contagem = 1;
	}
        $texto="Livro "	. $livro;
	if($contagem!='')
	{
		response(200,$texto . " nao encontrado",NULL);
	}
	else
	{
		response(200,$texto . " encontrado.XXXXXXXXXXXXXXXXXXXXXX",$contagem);
	}
	
}
else
{
	response(400,"Invalid Request",NULL);
}

function response($status,$status_message,$data)
{
	header("HTTP/1.1 ".$status);
	
	$response['status']=$status;
	$response['status_message']=$status_message;
	$response['data']="Rebimboca da parafuseta";
	
	$json_response = json_encode($response);
	echo $json_response;
}
