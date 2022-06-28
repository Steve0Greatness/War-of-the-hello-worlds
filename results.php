<!doctype html>
<html lang="en">

<head>
	<title>Results... so far.</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<h1>Results</h1>
	<p><a href="/">Make sure to vote,</a> if you haven't already.</p>
	<table>
		<thead>
			<tr>
				<th>Type</th> <th>Supporters</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$user = "";
		$headers = apache_request_headers();
		foreach ($headers as $header => $value) {
			if ($header == "X-Replit-User-Name") {
				$user = $value;
				break;
			}
		}
		$hellos = json_decode(file_get_contents('HelloWorlds.json'));
		foreach ($hellos as $hello => $_) {
			$user_supports = "";
			$supporters = 0;
			if ($user !== "" && in_array($user, $hellos->$hello)) {
				$user_supports = "supports";
			}
			for ($i = 0; $i < count($hellos->$hello); $i += 1) {
				if ($hellos->$hello[$i] != null) {
					$supporters += 1;
				}
				if ($hellos->$hello[$i] == $user) {
					$user_supports = "supported";
				}
			}
			echo "<tr class=\"$user_supports\"><td>$hello</td><td>$supporters</td></tr>";
		}
		?>
		</tbody>
	</table>
</body>
	
</html>