<meta http-equiv="refresh" content="0;url=requests.php">
<style>:root{background:black;}</style>
<?php
$headers = apache_request_headers();
$user = "";
foreach ($headers as $header => $value) {
	if ($header == "X-Replit-User-Name") {
		$user = $value;
	}
}
if ($user == "") {
	header("Location: requests.php");
}

$requests = json_decode(file_get_contents('Requests.json'));
$request = $_POST['request'];
for ($i = 0; $i < count($requests); $i += 1) {
	if ($requests[$i]->name == $request) {
		if (!in_array($user, $requests[$i]->upvotes) && in_array(null, $requests[$i]->upvotes)) {
			for ($x = 0; $x < count($requests[$i]->upvotes); $x += 1) {
				if ($requests[$i]->upvotes[$x] == null) {
					$requests[$i]->upvotes[$x] = user;
					break;
				}
			}
		} else if (!in_array($user, $requests[$i]->upvotes)) {
			array_push($requests[$i]->upvotes, $user);
		}
		file_put_contents('Requests.json', json_encode($requests));
		break;
	}
}
?>