<?php
	require_once(ROOT_DIR.'/facebook/src/facebook.php');
	
	// Create our Application instance (replace this with your appId and secret).
	
	$facebook = new Facebook(array(
    //'appId'  => '2191832890955966',
    //'secret' => 'd417df4a2ac6bb8698a324579317acc9',
   //for testing server 
	'appId' => '1588448344777162',
	'secret' => 'bce8e33bd22382d043cc5b2113c1639e',
	));
	
	// Get User ID
	$user = $facebook->getUser();
	//echo $user;
	if ($user) {
	  try {
		// Proceed knowing you have a logged in user who's authenticated.
		$user_profile = $facebook->api('/me');
	  } catch (FacebookApiException $e) {
		error_log($e);
		$user = null;
	  }
	}

?>