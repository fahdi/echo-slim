<?php

add_action( 'gform_after_submission_5', 'gravixar_after_submission', 10, 2 );
//gravixar_after_submission();

function after_submission() {
	$curl = curl_init();

	curl_setopt_array( $curl, [
		CURLOPT_URL            => 'http://localhost:8090/echo',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING       => '',
		CURLOPT_MAXREDIRS      => 10,
		CURLOPT_TIMEOUT        => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST  => 'POST',
		CURLOPT_POSTFIELDS     => [ 'name'        => 'Fahad Coder',
		                            'description' => 'Sent from code!',
		],
	] );


	$response = curl_exec( $curl );


	curl_close( $curl );
	echo $response;


	curl_setopt_array( $curl, [
		CURLOPT_URL            => 'https://hooks.slack.com/services/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',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING       => '',
		CURLOPT_MAXREDIRS      => 10,
		CURLOPT_TIMEOUT        => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST  => 'POST',
		CURLOPT_POSTFIELDS     => [
			'name'        => 'Fahad Coder',
			'description' => 'Sent from code!',
		],
	] );


	$response = curl_exec( $curl );


	curl_close( $curl );
	echo $response;
}
