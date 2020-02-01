<?php

$PDF_FILENAME = "NAB-2007-Ticket.pdf";

echo make_encrypted_url("document=nab-2007-ticket.svg&fullname=Marc%20Liyanage&company=entropy.ch&barcode_value=123456&barcode_text=11223344&type=Guest%20Ticket");


function make_encrypted_url($parameters) {
	global $PDF_FILENAME;
	return "http://nab2007.itechit.com:9006/pdfrenderservice/get-pdf/$PDF_FILENAME?data=" . bin2hex(encrypt_parameter_string($parameters));
}


function encrypt_parameter_string($string) {
	$cipher     = "rijndael-128";
	$mode       = "cbc";
	$plain_text = $string;
	$secret_key = "Rf4RQ5zD2LqjbmVQ";
	$iv         = "6Uhx6YhujT4FhdJS";
	
	$td = mcrypt_module_open($cipher, "", $mode, $iv);
	mcrypt_generic_init($td, $secret_key, $iv);
	$cyper_text = mcrypt_generic($td, $plain_text);
	mcrypt_generic_deinit($td);
	mcrypt_module_close($td);
	return $cyper_text;
}



?>

