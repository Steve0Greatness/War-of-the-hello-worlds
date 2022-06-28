<!doctype html>
<html lang="en">

<head>
	<title>Requested Factions</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<h1>Request Form</h1>
	<?php
		$headers = apache_request_headers();
		$lo = true;

		foreach ($headers as $header => $value) {
    	if ($header == "X-Replit-User-Name" && $value != "") {
				$lo = false;
			}
		}
		if ($lo) {
			echo "<p>You're not currenlty logged in, you will need to login to submit a request<noscript>, but you don't seem to have JavaScript enabled. Please enable it for this to work</noscript>.<script src=\"https://auth.util.repl.co/script.js\" authed=\"location.reload()\"></script></p>";
		} else {
			echo "<form action=\"submit_request.php\" method=\"post\"><input type=\"text\" name=\"requested\" required> <input type=\"submit\" value=\"Submit Request\"></form><p>But before you request a new variation of hello world, please make sure to scroll down to make sure that it's not already in the list of requests below. Also read the <a href=\"rules.html\">rules of requests</a> before requesting. You can check back occasionally on <a href=\"/\">the home page</a> to see if your request is there yet.</p>";
		}
	?>
	<h1>Requested Factions</h1>
	<?php
	$user = "";
	foreach ($headers as $header => $value) {
		if ($header == "X-Replit-User-Name") {
			$user = $value;
		}
	}

	$requests = json_decode(file_get_contents('Requests.json'));
	$admins = json_decode(file_get_contents('ADMINS.json'));
	foreach ($requests as $ind=>$value) {
		if ($requests[$ind] != null) {
			$upvotes = 0;
			for ($i = 0; $i < count($value->upvotes); $i += 1) {
				if ($value->upvotes[$i] != null) {
					$upvotes += 1;
				}
			}
			$supported_class = "";
			if (in_array($user, $value->upvotes)) {
				$supported_class = "supported";
			}
			echo "<details><summary>{$value->name}</summary><form class=\"command\" action=\"upvote_request.php\" method=\"post\"><input type=\"text\" value=\"{$value->name}\" style=\"display:none\" name=\"request\"><input type=\"submit\" value=\"Upvotes ($upvotes)\" class=\"upvote $supported_class\"></form>";
			if (in_array($user, $admins)) {
				echo " <form class=\"command\" method=\"post\" action=\"admin_add.php\"><input style=\"display:none\" value=\"{$value->name}\" name=\"request\" type=\"text\"><input type=\"submit\" value=\"Add Faction\" class=\"admin_command\"> <input type=\"submit\" formaction=\"admin_deny.php\" formmethod=\"post\" value=\"Deny Faction\" class=\"admin_command\"></form>";
			}
			echo "</details>";
		}
	}
	?>
	<h1>Denied Factions</h1>
	<p>Public list of denials from admins.</p>
	<ul>
	<?php
	$denied = json_decode(file_get_contents('DENIED.json'));
	for ($i = 0; $i < count($denied); $i += 1) {
		echo "<li>$denied[$i]</li>";
	}
	?>
	</ul>
</body>

</html>