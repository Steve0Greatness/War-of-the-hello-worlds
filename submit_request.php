<style>:root{background:black;}</style>
<meta http-equiv="refresh" content="0;url=requests.php">
<?php
$user = "";
$headers = apache_request_headers();
foreach ($headers as $header => $value) {
	if ($header == "X-Replit-User-Name") {
		$user = $value;
	}
}
if ($user == "") {
	header("Location: requests.php");
}
$requests = json_decode(file_get_contents('Requests.json'));
$denied = json_decode(file_get_contents('DENIED.json'));
$hellos = json_decode(file_get_contents('HelloWorlds.json'));
$requested = $_POST['requested'];
$allowed = true;
// { name: $requested, upvotes: [] }
if (in_array($requested, $denied)) {
	$allowed = false;
}
for ($i = 0; $i < count($requests); $i += 1) {
	if ($requests[$i] != null) {
		if ($requests[$i]->name == $requested) {
			$allowed = false;
			$added = false;
			if (!in_array($user, $requests[$i]->upvotes)) {
				for ($x = 0; $x < count($requests[$i]->upvotes); $x += 1) {
					if ($requests[$i]->upvotes[$x] == null) {
						$requests[$i]->upvotes[$x] = $user;
						$added = true;
						break;
					}
				}
			} else {
				$added = true;
			}
			if (!$added) {
				array_push($requests[$i]->upvotes, $user);
			}
			file_put_contents('Requests.json', json_encode($requests));
			break;
		}
	}
}
foreach ($hellos as $hello => $value) {
	if ($hello == $requested) {
		$allowed = false;
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
		file_put_contents('HelloWorlds.json', json_encode($hellos));
		break;
	}
}
if ($allowed) {
	if (!in_array(null, $requests)) {
		array_push($requests, json_decode("{ \"name\": \"$requested\", \"upvotes\": [ \"$user\" ] }"));
	} else {
		for ($i = 0; $i < count($requests); $i += 1) {
			if ($requests[$i] == null) {
				$requests[$i] = json_decode("{ \"name\": \"$requested\", \"upvotes\": [ \"$user\" ] }");
				break;
			}
		}
	}
	file_put_contents('Requests.json', json_encode($requests));
}
?>