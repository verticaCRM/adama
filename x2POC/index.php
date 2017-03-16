<?php

ini_set('display_errors',true);
error_reporting(E_ALL);
include_once(__DIR__.'/../wp-config.php');
//include_once(__DIR__.'/../wp-load.php');
//include('../wp-content/plugins/bbcrm/_auth.php');

$username = API_USER;
$userkey = API_PASS;
$url = API_HOST."/index.php/api2/";
//echo API_HOST;

    //function to make cURL request
    function call($param)
    {
    global $url,$username,$userkey;
        ob_start();
        $curl_request = curl_init();
//echo $url;
//echo $username.":".$userkey;

echo "<B>".$url.$param['_class']."</B>";

			curl_setopt($curl_request, CURLOPT_URL, $username.":".$userkey.'@'.$url.$param['_class']);
			//curl_setopt($curl_request, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			//curl_setopt($curl_request, CURLOPT_USERPWD, "$username:$userkey");
			curl_setopt($curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
			curl_setopt($curl_request, CURLOPT_HEADER, 1);
			curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_request, CURLOPT_FOLLOWLOCATION, 1);

        $result = curl_exec($curl_request);
        
// echo 'Curl error: ' . curl_error($curl_request);        
        curl_close($curl_request);

//print_r($result);
        return $result;
die;
    }
$jsonresp = call(array('_class'=>$_GET['c']));
echo $jsonresp;    
exit;
?>
