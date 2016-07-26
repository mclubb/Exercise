<?php

$url = 'https://digication.com/hiring-exercise.php';
$ch = curl_init( $url );

/* 
 * The environment that I am working in doesn't have the cainfo setup in php.inf
 * so I have to put this option in and set it to 0/false
 */
curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );

/*
 * The OPTIONS request will provide us with the Answer
 */ 
curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'OPTIONS' );

/*
 * Since the answer is in the request headers, we will need to output them
 */
curl_setopt( $ch, CURLOPT_HEADER, 1 );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );

$output = curl_exec( $ch );

/*
 * Breaking up the output on 2 carriage returns and new lines
 */
list( $header, $response ) = explode( "\r\n\r\n", $output, 2 );

/*
 * Breaking up the headers into an array
 */
$headers = explode( "\n", $header );

/*
 * Loop through the headers array and check to see if the 
 * X-Hiring-Exercise-Answer is in the array
 * If it is, then output the answer and break out of the loop
 * as we will not have to process this any longer
 */
foreach( $headers as $h )
{
	 if( stripos( $h, 'X-Hiring-Exercise-Answer:' ) !== false)
	 {
		   list( $header_label, $value ) = explode( ':', $h, 2 );
		    echo 'The answer to the exercise is: ' . $value . PHP_EOL;
		    break;
	}
}
?>
