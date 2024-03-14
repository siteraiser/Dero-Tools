<?php

	function connectionErrors($ch){
		// Check HTTP status code
		if (!curl_errno($ch)) {
		  switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
			case 200:  # OK
			  break;
			default:
			  return 'Unexpected HTTP code: '. $http_code ;
		  }
		}else{
			return curl_error($ch) . ' ' . curl_errno($ch);
		}
	}



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,            "http://127.0.0.1:10103/install_sc" );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($ch, CURLOPT_POST,           1 );
curl_setopt($ch, CURLOPT_POSTFIELDS,  file_get_contents($_SERVER ['DOCUMENT_ROOT']."/Token.Bas")); 
curl_setopt($ch, CURLOPT_HTTPHEADER, [ 		
			"Authorization: Basic " . base64_encode('secret:pass'),
			"Content-Type: text/plain"
		]);


$result=curl_exec ($ch);
$errors = connectionErrors($ch);
	curl_close($ch);

	
echo'<pre>';
 var_dump($result);
echo'</pre>';	
echo'<pre>';
 var_dump($errors);
echo'</pre>';	
//dd29bf592a53d8af04f4a7877b9693c9fdca78df1e1edaa22926fa8111f43bae


/*


$data = [];
		$data["jsonrpc"] = "2.0";
		$data["id"] = "1";
		$data["method"] = "transfer";
		//$data["amount"] = 2;
		$params = [];
		
		
		
		$transfers_array[] = 
			(object)[
			"amount"=>0,
			"destination"=>'dero1qynekhrgcry8uurh0v8y8gnucc47rz0ejr6ktslz7w8fx8ssdqvd7qgkd3ud5'
			];
		
		$params["transfers"] = $transfers_array;
		$params["sc_code"] = (string)file_get_contents($_SERVER ['DOCUMENT_ROOT']."/Token2.Bas");
		
		$params["sc_value"] = 0;
		$sc_rpc_array[] = 
			(object)[
			"name"=>"entrypoint",
			"datatype"=>"S",
			"value"=>'InitializePrivate'
			];
		$sc_rpc_array[] = 
			(object)[
			"name"=>"b",
			"datatype"=>"S",
			"value"=>"token"
			];
		$params["sc_rpc"] = $sc_rpc_array;
		$params["ringsize"] = 2;
		
		
		$data["params"] = (object)$params;



	$json = json_encode($data, JSON_PRETTY_PRINT); 
//$json = str_replace(array("\r\n","\r","\n","\\r","\\n","\\r\\n"), '\n', $json);	
	echo "<pre>"; 
echo $json;
echo "</pre>";
	$json = json_encode($data); 

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,            "http://127.0.0.1:10103/json_rpc" );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($ch, CURLOPT_POST,           1 );
curl_setopt($ch, CURLOPT_POSTFIELDS,  $json); 
curl_setopt($ch, CURLOPT_HTTPHEADER, [ 		
			"Authorization: Basic " . base64_encode('secret:pass'),
			"Content-Type: application/json"
		]);


$result=curl_exec ($ch);
$errors = connectionErrors($ch);
	curl_close($ch);

	
echo'<pre>';
 var_dump($result);
echo'</pre>';	
*/





/*
$data = array ('foo' => 'bar', 'bar' => 'baz');
$data = http_build_query($data);

$context_options = array (
        'http' => array (
            'method' => 'POST',
            'header'=>	"Authorization: Basic " . base64_encode('secret:pass'). "\r\n"
			. "Content-type: application/x-www-form-urlencoded\r\n"
                . "Content-Length: " . strlen($data) . "\r\n",
            'content' => $json
            )
        );

$context = stream_context_create($context_options);
$fp = fopen("http://127.0.0.1:10103/json_rpc", 'r', false, $context);
echo'<pre>';
 var_dump($fp);
echo'</pre>';	
*/