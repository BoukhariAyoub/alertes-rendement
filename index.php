<?php

require 'vendor/autoload.php';
include 'lib/leboncoin.php';

function ServiceHandler() {
    $data = new stdClass();
    $data->Output = "Hello World!";

    return json_encode($data);
};

function getAnnonces() {
$leboncoin = new LeBonCoin();
$options = array(
		"search_title_only" => 1,
		"localisation" => array("34500","34000","91000"),
		"categorie" => $leboncoin->searchCategorie("informatique")->code,
		"prix_min" => 150,
		"prix_max" => 10000,
		"particulier" => true,
		"pro" => false,
		"urgent_only" => false
	);

	$annonces = $leboncoin->getAnnonces("AlienWare", 1, $options);

    return json_encode($annonces);
};

$app = new \Slim\App;


	
	
$app->get('/Annonces', 'getAnnonces');
$app->get('/', 'getAnnonces');
$app->post('/', 'ServiceHandler');

$app->run();
