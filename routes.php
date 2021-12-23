<?php
require_once('database.php');
require_once('config.php');
require_once('actions.php');

// Fetching counts
if (isset($_GET['count']) && $_GET['count'] != ''){
	$count = (int)count_urls();
	echo $count;
	exit;
}

// verify the url data has been posted to this script
if (isset($_POST['url']) && $_POST['url'] != '')
	$url = $_POST['url']; 
else
	$url = '';


// verify that a url was provided and that it is a valid url
if ($url != '' && strlen($url) > 0){
	if ( validate_url($url) == true ){
		
        $code = check_url_exists($url);
        if(!$code){
            $code = store_url($url);
        }
		
		
        if ($code){
			
			echo URL_BASE_SETTING . $code;
		}
		else
			echo 'Unable to shorten your url';
	}
	else
		echo 'Please enter a valid url';
}
else
	echo 'No url was found';

?>