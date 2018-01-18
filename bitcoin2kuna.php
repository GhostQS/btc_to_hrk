<?php

/*
Plugin Name: Bitcoin 2 Croatian Kuna Converter
Plugin URI: https://bitcoin-radionica.com
Description: Use the shortcode [bitcoin_price] to show the Bitcoin price in HRK. The API for the bitcoin price is from coinmarketcap.
Version: 1.0
Author: Boris Agatić
Author URI: https://bitcoin-radionica.com
License: GPLv2 or later
Text Domain: bitcoin2kuna
*/

function bitcoin_price(){
global $prodajna_cijena_bitcoin;
//tečaj hnb za euro
$url = 'http://api.hnb.hr/tecajn?valuta=EUR';
$content = file_get_contents($url);
$json = json_decode($content, true);
$hrk =  $json[0]["srednji_tecaj"];
$hrk = str_replace(",",".",$hrk);

//cijena bitcoina sa coinmarketcap-a
$url_e = 'https://api.coinmarketcap.com/v1/ticker/bitcoin/?convert=EUR';
$content_e = file_get_contents($url_e);
$json_e = json_decode($content_e, true);
$cijena_bitcoin =  $json_e[0]["price_eur"];


// echo $hrk . '<br  />';
// echo $cijena_bitcoin. '<br  />';
// echo $hrk * $cijena_bitcoin;

//konverzija u kune
$cijena_bitcoin_hrk_round = $hrk * $cijena_bitcoin;
$cijena_bitcoin_hrk_round = round($cijena_bitcoin_hrk_round, 2);
return $cijena_bitcoin_hrk_round;
}
add_shortcode( 'bitcoin_price', 'bitcoin_price' );


?>
