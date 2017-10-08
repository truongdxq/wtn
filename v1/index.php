<?php
require_once("../include/Parser.php");
require(".././libs/Slim/Slim.php");

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();


$app->get('/news',  function() {

	$response = array();
	$ps = new Parser();
	$result = $ps->get_new_data();

	$response["news"] = array();
	foreach ($result as $value) {
		$tmp = array();
		$tmp["name"] = $value->get_name_new();
		$tmp["link_image"] = $value->get_link_image();
		$tmp["url_video"] = $value->get_url_video();
		$tmp["url_page"] =  $value->get_url_page();
		$tmp["description"] = $value->get_description();
		$tmp["type"] = "thoitiet";
		array_push($response["news"], $tmp);
	}
	echoResponse(200, $response);
});


function echoResponse($status_code, $response) {
	$app = \Slim\Slim::getInstance();
	$app->status($status_code);
	$app->contentType('application/json');
	echo json_encode($response);
}

$app->run();
?>
