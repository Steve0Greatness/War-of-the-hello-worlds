<!doctype html>
<html lang="en">

<head>
	<title>War of the "Hello World"s</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<h1>War of the "Hello World"s</h1>
	<p>Which side will you take in this... very clearly important topic.</p>
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
		}
	?>
	<form action="submit_support.php" method="post">
		<select name="side" id="side">
			<?php
				$hellos = json_decode(file_get_contents('HelloWorlds.json'));
				foreach ($hellos as $hello=>$_) {
					echo "<option value=\"$hello\">$hello</option>";
				}
			?>
		</select>
		<p class="small"><input type="submit" value="Support this side"></p>
	</form>
	<p>Don't see your favorite way of writing "Hello World?" Maybe <a href="requests.php">request it.</a> However if you don't care and just want to see the results, you can find them on the <a href="results.php">results page</a>.</p>
		<?php
		$headers = apache_request_headers();
		foreach ($headers as $header => $value) {
			if ($header == "X-Replit-User-Name" && $value != "") {
				echo "Hello $value!";
			}
		}
	?>
</body>

</html>