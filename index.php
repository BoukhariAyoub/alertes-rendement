<?php

require 'vendor/autoload.php';
include 'lib/leboncoin.php';

function ServiceHandler() {
    $data = new stdClass();
    $data->Output = "Hello World!";

    return json_encode($data);
};

function getAds() {
$leboncoin = new LeBonCoin();
$options = array(
	//	"search_title_only" => 1,
	//	"localisation" => array("34500","34000","91000"),
		//"categorie" => $leboncoin->searchCategorie("informatique")->code,
	//	"prix_min" => 150,
	//	"prix_max" => 10000,
	//	"particulier" => true,
	//	"pro" => false,
	//	"urgent_only" => false
	);

	$annonces = $leboncoin->getAnnonces("loyer", 1, $options);

    return json_encode($annonces);
};


function getAnnonce(){
$leboncoin_result_url = 'https://www.leboncoin.fr/locations/offres/ile_de_france/?th=1&location=Paris%2075017&parrot=0&sqs=5&ros=2&ret=2';

  $searchResults = (new Lbc\GetFrom)->search($leboncoin_result_url, true);


    return json_encode($searchResults);
}


$app = new \Slim\App;


	
	
$app->get('/get/ads', 'getAnnonce');
//$app->get('/get/ad/{id}', 'getAd(id)');
$app->get('/', 'getAds');
$app->post('/', 'ServiceHandler');

$app->run();
