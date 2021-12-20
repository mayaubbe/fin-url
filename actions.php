<?php
require_once('database.php');
require_once('config.php');
// function for creating the random string for the unique url
function generate_short_url(){
	
	// create the charset for the codes and jumble it all up
	$charset = str_shuffle(CHARSET);
	$code = substr($charset, 0, MIN_URL_LENGTH);
	
	// verify the code is not taken
	while (count_urls($code) > 0)
		$code = substr($charset, 0, MIN_URL_LENGTH);
	
	// return a randomized code of the desired length
	return $code;
}
// function to count the total number of short urls saved on the site
function count_urls($code = ''){
	// connect to the database
	$conn = connectDb();
	
	// build the extra query string to search for a code in the database
	if ($code != '')
		$extra_query = " WHERE code='$code'";
	else
		$extra_query = "";
	
	// count ow many total shortened urls have been made in the database and return it
	$count = (int) mysqli_num_rows(mysqli_query($conn, "SELECT * FROM short_links " . $extra_query));
	return $count;
}
// function to perform all the validation needed for the urls provided
function validate_url($url){
	
	// make sure the user isn't trying to shorten one of our urls
	if (substr($url, 0, strlen(URL_BASE_SETTING)) != URL_BASE_SETTING){
		return filter_var($url, FILTER_VALIDATE_URL);
	}
	else
		return false;
}
// function to checl the url already exists or not
function check_url_exists($url){
    // connect to the database
	$conn = connectDb();
	
	// build the extra query string to search for a code in the database
	if ($url != '')
		$extra_query = " WHERE url='$url'";
	else
		$extra_query = "";
	
	// count ow many total shortened urls have been made in the database and return it
    $query = mysqli_query($conn, "SELECT * FROM short_links " . $extra_query.' LIMIT 0,1');
    if (mysqli_num_rows($query) == 1){
        // retrieve the data from the database
        $data = mysqli_fetch_assoc($query);
        return $data['code'];
    }
	return false;
}
// function to store short url
function store_url($url){
    // create a connection to the database
    $conn = connectDb();
            
    // create all the variables to save in the database
    $code = generate_short_url($url);
    $timestamp = time();
    $count = 0;
    
    $result = mysqli_query($conn, "INSERT INTO short_links VALUES (NULL, '$code', '$url', '$count', '$timestamp')");
    
    // verify that the new record was created
    $query = mysqli_query($conn, "SELECT * FROM short_links WHERE timestamp='$timestamp' AND code='$code'");
    if ($data = mysqli_fetch_assoc($query)){
        return $code;
    }
    else
        return false;
}
// function to fetch url by code
function fetch_url($code){
    // connect to the database
	$conn = connectDb();

    $query = mysqli_query($conn, "SELECT * FROM short_links WHERE code='$code'");
    if (mysqli_num_rows($query) == 1){
        
        // retrieve the data from the database
        $data = mysqli_fetch_assoc($query);
        
        // update the counter in the database
        mysqli_query($conn, "UPDATE short_links SET count='" . ($data['count']) + 1 . "' WHERE id='". ($data['id'])."'");
        return $data['url'];
    }
    else
	    return false;
}
?>