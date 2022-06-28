<meta http-equiv="refresh" content="0;url=requests.php">
<style>:root{background:black;}</style>
<?php
$headers = apache_request_headers();
$user = "";
$admins = json_decode(file_get_contents('ADMINS.json'));
foreach ($headers as $header => $value) {
	if ($header == "X-Replit-User-Name") {
		$user = $value;
	}
}
if ($user != "" && in_array($user, $admins)) {
	$hellos = json_decode(file_get_contents('HelloWorlds.json'));
	$requests = json_decode(file_get_contents('Requests.json'));
	$request = $_POST['request'];
	for ($i = 0; $i < count($requests); $i += 1) {
		if ($requests[$i] != null && $requests[$i]->name == $request) {
			$requests[$i] = null;
			$hellos->$request = json_decode('[]');
			file_put_contents('Requests.json', json_encode($requests));
			file_put_contents('HelloWorlds.json', json_encode($hellos));
			break;
		}
	}
}
?>