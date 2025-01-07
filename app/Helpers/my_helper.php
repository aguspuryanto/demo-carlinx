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
	$result = curl_exec($curl);
	curl_close($curl);
	
	$json = json_decode($result, true);
	return $json;
}

function format_rupiah($angka){
	$rupiah=number_format($angka,0,',','.');
	return $rupiah;
}