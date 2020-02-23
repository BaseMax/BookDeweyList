<?php
// Max Base
// https://github.com/BaseMax/BookDeweyList
$data=file_get_contents("output.json");
$data=json_decode($data, true);
// print_r($data);
readJson($data);

function readJson($data) {
	foreach($data as $item) {
		if(isset($item["name"])) {
			print $item["name"]."\n";
			file_put_contents("names-fa.txt", $item["name"]."\n", FILE_APPEND);
		}
		if(isset($item["children"])) {
			readJson($item["children"]);
		}
	}
}
