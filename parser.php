<?php
// Max Base
// https://github.com/BaseMax/BookDeweyList
$data=file_get_contents("input-normal.html");
$finalOutput=[];
$pattern='/<!-- begin -->\n<h2>(?<title>[^\<]+)<\/h2>[\n\s]+<ul>(?<content>.*?)<\/ul>\n<!-- end -->/is';
preg_match_all($pattern, $data, $output);
print_r($output["content"]);
foreach($output["content"] as $x=>$item) {
	$category=[];
	$category["title"]=$output["title"][$x];
	$name=$category["title"];
	// ۰۱۲۳۴۵۶۷۸۹
	$category["code"]=mb_substr($output["title"][$x], 4, 3);
	$category["codeEN"]=($category["code"]),
	$name=mb_substr($name, mb_strlen("ردهٔ ۰۰۰ – "));
	// $name=preg_replace('/ردهٔ ( {***/۰۱۲۳۴۵۶۷۸۹/***} ) – /i', "", $name);
	$category["name"]=$name;
	$category["children"]=[];
	$pattern='/<li><b>(?<title>[^\<]+)<\/b>[\n\s]+<ul>(?<content>.*?)<\/ul>/is';
	preg_match_all($pattern, $item, $result);
	print_r($result);
	$pattern='/<li>(?<title>[^\<]+)<\/li>/si';
	foreach($result["content"] as $y=>$itemList) {
		$itm=[];
		$itm["title"]=$result["title"][$y];
		$itm["code"]=mb_substr($result["title"][$y], 0, 3);
		$itm["codeEN"]=($itm["code"]),
		$itm["name"]=mb_substr($result["title"][$y], 4);
		$itm["children"]=[];
		preg_match_all($pattern, $itemList, $items);
		foreach($items["title"] as $itemLowLevel) {
			$downLevel=[];
			$downLevel["title"]=$itemLowLevel;
			$downLevel["code"]=mb_substr($itemLowLevel, 0, 3);
			$downLevel["codeEN"]=($downLevel["code"]),
			$downLevel["name"]=mb_substr($itemLowLevel, 4);
			$itm["children"][]=$downLevel;
		}
		// print_r($items);
		$category["children"][]=$itm;
	}
	print_r($category);
	$finalOutput[]=$category;
	exit();
}
