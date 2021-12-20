<?php

	// require the include files that has all the back-end functionality
	require_once('config.php');
	require_once('actions.php');
	
	// check to see if a code has been supplied and process it
	if (isset($_GET['code']) && $_GET['code'] != '' && strlen($_GET['code']) > 0){
		$code = $_GET['code']; 

		$fetched_url = fetch_url($code);
		
		if ($fetched_url){
			
			// set some header data and redirect the user to the url
			header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			header("Cache-Control: no-cache");
			header("Pragma: no-cache");

			header("Location: " . $fetched_url);
			
			die();
		}
		else
			$message = '<font color="red">Unable to redirect to your url</font>';
	}
?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/w3-css/4.1.0/w3.min.css"></link>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<body>
	<div id="wrapper">
		<div id="header">
			<h1> <span class="moto"> URL shortener</span></h1>
		</div>
		<div id="content">
			<h3 class="topper">Just enter a url and click <i><u>"Short url"</u></i>. That's it!</h3>
			
			<table class="mainForm">
				<form method="post" action="#" name="shortUrlForm" id="shortUrlForm">
					<tr>
						<td align="right"><input type="text" name="url" id="url" value="" placeholder="http://" style="width: 100%;" /></td>
						<td align="left" width="1"><input type="submit" name="lesnBtn" value="short url" /></td>
					</tr>
					<tr>
						<td colspan="2">
							<span id="shorturl"></span>
						</td>
					</tr>
				</form>
			</table>
			
			<h3 id="message" class="success"><?php echo ( isset($message) ? $message : '' );  ?></h3>
			
			<div class="meta">
				There are currently <b id="counter"><?php echo number_format(count_urls()); ?></b> short urls.
			</div>
		</div>
	</div>	
</body>
<script>
	// ready the sites javascript for use after the page has loaded
	$(document).ready(function(){
		// process the form submission using javascript
		$("#shortUrlForm").submit(function(event){
			// get the url to be shortened
			var url = $("#url").val();
			
			if ($.trim(url) != ''){
				// submit all of the required data via post to the processing script
				$.post("./routes.php", {url:url}, function(data){
					
					// process the returned data from the post
					if (data.substring(0, 7) == 'http://' || data.substring(0, 8) == 'https://'){
						// $("#url").val(data).focus();
						$('#shorturl').text("The shorten url is "+data);

						
						// display a success message to the user
						$("#message").html('Your link has been shortened!');
						
						// update the counter shown on the page
						var counter = $("#counter").text();
						$("#counter").text(parseInt(counter) + 1);
					}
					else
						$("#message").html(data);
				});	
			}
			
			// select the text box after form submission
			$("#url").focus();
			
			// prevent the form from reloading the page
			return false;
		});
		
		// select the text box on page load
		$("#url").focus();
	});
</script>
