<?php
$resopnse = array();
date_default_timezone_set('Asia/Kolkata');

if(isset($_GET['voltage'])) {

		$data = "" . round(microtime(true) * 1000) . "," . $_GET['voltage'] . "\n";
		$myfile =  fopen('data1.csv', 'a');
		fwrite($myfile,$data);

		$response['error']=false;
		$response['message']='Data Updated!';

} else {
	$response['error']=true;
	$response['message']='Parameters missing!';
}


echo json_encode($response);
?>
