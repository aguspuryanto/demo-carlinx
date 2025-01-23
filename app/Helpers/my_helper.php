<?php

// not working
function registerJsUrl($url) {
    if(!$url) return;
    // $context->addJs($url);
    $context = '<script src="' . $url . '"></script>';
    return $context;
}

function registerCssUrl($url) {
    if(!$url) return;
    // $context->addCss($url);
    $context = '<link rel="stylesheet" type="text/css" href="' . $url . '">';
    return $context;
}

function getUrlApi() {
	// return 'http://103.178.174.7/foxrent/';
	return $_ENV['API_BASEURL'];
}

function getCurl($data, $url){
	if(!$url) return;

	/* Set JSON data to POST */
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	// set timeout
	curl_setopt($curl, CURLOPT_TIMEOUT, 60);
	$result = curl_exec($curl);
	curl_close($curl);
	
	$json = json_decode($result, true);
	return $json;
}

function format_rupiah($angka){
	$rupiah=number_format($angka,0,',','.');
	return $rupiah;
}

function format_km($angka){
	return round(str_replace('.', '', $angka) / 1000, 0);
}

function sendWhatsapp($phone, $message, $type = 'link') {
	// <a href=\"whatsapp://send?phone=--your phone--&text=--your text--\">
	// <a href=\"https://api.whatsapp.com/send?phone=--your phone--&text=--your text--\">
	$message = urlencode($message);
	
	if($type == 'link') {
		$url = "https://api.whatsapp.com/send?phone={$phone}&text={$message}";
	} else {
		$url = "whatsapp://send?phone={$phone}&text={$message}";
	}
    return $url;
}

function sendWhatsappApi($phone, $message) {
	// $phone_number = "whatsapp_number"; // The phone number of the recipient in international format
	// $message_text = "Hello, this is a test message from the WhatsApp Business API!"; // The message text

	$api_endpoint = 'https://graph.facebook.com/v18.0/<WHATSAPP_BUSINESS_ACCOUNT_ID>/messages';
	// for more details https://developers.facebook.com/docs/whatsapp/business-management-api/get-started/

	$api_token = "YOUR_API_TOKEN"; // Replace with your own API token
	$data = [
		'phone' => $phone,
		'body' => $message
	];
	$ch = curl_init($api_endpoint);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', "Authorization: Bearer $api_token"));
	$result = curl_exec($ch);
	curl_close($ch);
}

function getImage($url) {
    // return "http://localhost/proxy.php?url=" . urlencode($url);
	return base_url() . 'proxy.php?url=' . urlencode($url);
}

