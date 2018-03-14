<?php
$ch = curl_init();
$email = 'ashish.it.in.go@gmail.com';
curl_setopt($ch, CURLOPT_URL, "https://api2.autopilothq.com/v1/contact/".$email);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_HTTPHEADER, array("autopilotapikey: 888a08ca5f2c42bb8cf468f9a4c463b8"));

$response = curl_exec($ch);
curl_close($ch);
$json_a = json_decode($response, true);
$json_a['error'];

if($json_a['error']){
	echo 'data inserter successfylly';
	insertData($email);
}else{
	echo 'Already Exist';
}



function insertData($email){
	$ch = curl_init();
	$dataSet  = array('contact'=>array('FirstName'=>'Test','LastName'=>'Development','Email'=>$email));
	$newDataset = json_encode($dataSet);
	curl_setopt($ch, CURLOPT_URL, "https://api2.autopilothq.com/v1/contact");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);

	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "$newDataset");

	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	  "autopilotapikey: 888a08ca5f2c42bb8cf468f9a4c463b8",
	  "Content-Type: application/json"
	));

	return $response = curl_exec($ch);
}

//var_dump($response);