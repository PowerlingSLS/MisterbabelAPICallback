<?php

require('misterbabelCallback.php');

$callback = new MisterbabelCallback();

try 
{

	$verified = $callback->verifyData();

	if ($verified)
	{
		// Process the data received
		$data = $callback->getJob();
		var_dump($data);
		file_put_contents('log.txt', json_encode($data));
		header("HTTP/1.1 200 OK");
		exit;
	}
} 
catch (Exception $e)
{
	$error = $e->getMessage();
	echo $error;
	header("HTTP/1.1 400 BAD-REQUEST");
	exit;
}

header("HTTP/1.1 400 BAD-REQUEST");
?>