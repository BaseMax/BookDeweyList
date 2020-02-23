<?php
// Max Base
// https://github.com/BaseMax/BookDeweyList
$dataFile=file_get_contents("output.json");
$data=json_decode($dataFile, true);
// print_r($data);
/*
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
*/

$persianFile=file_get_contents("names-fa.txt");
$persianLines=explode("\n", $persianFile);
$englishFile=file_get_contents("names-en.txt");
$englishLines=explode("\n", $englishFile);
readJson($data);

function findWord($fa) {
	global $persianLines;
	global $englishLines;
	// print_r($persianLines);
	// print_r($englishLines);
	// exit();
	foreach($persianLines as $i=>$line) {
		if($line == $fa) {
			return $englishLines[$i];
		}
	}
	return $fa;
}

function readJson($data) {
	global $dataFile;
	// file_put_contents("names-fa.txt", "");
	foreach($data as $item) {
		if(isset($item["name"])) {
			// file_put_contents("names-fa.txt", $item["name"]."\n", FILE_APPEND);
			$enW=findWord($item["name"]);
			// $dataFile=str_replace(utf8_encode($item["name"]), utf8_encode($enW), $dataFile);
			$dataFile=str_replace(($item["name"]), ($enW), $dataFile);
			print $item["name"]." => " . $enW . "\n";
		}
		if(isset($item["children"])) {
			readJson($item["children"]);
		}
	}
}
file_put_contents("output-en.json", $dataFile);
