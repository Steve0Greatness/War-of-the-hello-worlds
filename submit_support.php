<style>:root{background:black;}</style>
<meta http-equiv="refresh" content="0;url=results.php">
<?php
$headers = apache_request_headers();
$lo = true;
$user = "";
$side = $_POST['side'];

foreach ($headers as $header => $value) {
	if ($header == "X-Replit-User-Name") {
		$lo = false;
		$user = $value;
	}
}
if ($user == "") {
	header("Location: index.php");
}

$hellos = json_decode(file_get_contents('HelloWorlds.json'));
foreach ($hellos as $hello => $_) {
	if (in_array($user, $hellos->$hello)) {
		$hellos->$hello[array_search($user, $hellos->$hello)] = null;
	}
	if ($hello == $side && !$already_set) {
		if (in_array(null, $hellos->$hello)) {
			for ($i = 0; $i < count($hellos->$hello); $i += 1) {
				if ($hellos->$hello[$i] == null) {
					$hellos->$hello[$i] = $user;
					break;
				}
			}
		}
	}
}
$hellos = json_encode($hellos);
file_put_contents('HelloWorlds.json', $hellos);
?>