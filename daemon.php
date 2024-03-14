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

$data = '{
    "jsonrpc": "2.0",
    "id": "1",
    "method": "DERO.GetSC",
    "params": {
        "scid": "cb375361fc5c73799d8c1f472431020327251eec1a4946b73d6c257c651e4cd9",
        "code": true,
        "variables": true
    }
}';

$data = '{
    "jsonrpc": "2.0",
    "id": "1",
    "method": "DERO.GetBlock",
    "params": {
        "height": 420
    }
}';


$data = '{
			"jsonrpc": "2.0",
			"id": "1",
			"method": "DERO.GetTxPool"
		}';

$data = '{
    "jsonrpc": "2.0",
    "id": "1",
    "method": "DERO.GetEncryptedBalance",
    "params": {
        "address": "dero1qyn7d835kneqp0670lyn0t6er3rp9h0eszn0kqgx7jtj66dung3e2qq2ypcxr",
		"SCID":"cb375361fc5c73799d8c1f472431020327251eec1a4946b73d6c257c651e4cd9",
        "topoheight": -1
    }
}';
$data = '{
    "jsonrpc": "2.0",
    "id": "1",
    "method": "DERO.NameToAddress",
    "params": {
        "name": "WebGuy",
        "topoheight": -1
    }
}';


$data = '{
    "jsonrpc": "2.0",
    "id": "1",
    "method": "DERO.GetTransaction",
    "params": {
        "txs_hashes": ["69dc9282139e9d5767287fab9b50c240483dc5e36d0a643c88ac4da4422f454b"]
    }
}';
$errors = [];

/**/
$host = 'node.derofoundation.org:11012';  //where is the websocket server
$local = "127.0.0.1";  //url where this script run
$data = '{
    "jsonrpc": "2.0",
    "id": "1",
    "method": "DERO.GetSC",
    "params": {
        "scid": "dd29bf592a53d8af04f4a7877b9693c9fdca78df1e1edaa22926fa8111f43bae",
        "code": true,
        "variables": true
    }
}';
$data = json_decode($data);
$data = json_encode($data);
$head = "POST /json_rpc HTTP/1.1\r\n"
        . "Upgrade: WebSocket\r\n"
        . "Connection: Upgrade\r\n"
        . "Origin: $local\r\n"
        . "Host: $host\r\n"
		. "Sec-WebSocket-Version: 13"."\r\n"
		. "Sec-WebSocket-Key: ".rand(0,999)."\r\n"
		. "Content-Type: application/json\r\n"
        . "Content-Length: " . strlen($data) . "\r\n"
		. "Connection: Close\r\n\r\n";
		 ;


$sock = stream_socket_client("$host/ws",$error,$errnum,30,STREAM_CLIENT_CONNECT,stream_context_create(null));
if (!$sock) {
	$errors[] = "[$errnum] $error";
} else {
	fwrite($sock, $head . $data ) or $errors[] = 'error:'.$errno.':'.$errstr;
    $response = stream_get_contents($sock);
	
	if (preg_match('/Content-Length:\s*(\d+)/i', $response , $matches)) {
		$length = (int)$matches[1]; // Extract the length as an integer
	}

	$response_data = substr($response, -($length));
}
	$json = json_decode($response_data);

echo'<pre>';
var_dump($json);
echo'</pre>';	
		

echo'<pre>';
 var_dump($errors);
echo'</pre>';

echo'<pre>';
 var_dump($output);
echo'</pre>';


echo '<hr>'. $json->result->stringkeys->owner;