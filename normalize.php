<?php
// Max Base
// https://github.com/BaseMax/BookDeweyList
$data=file_get_contents("input.html");
$data=strip_tags($data,"<ul><li><b><h1><h2>");
$data=html_entity_decode($data);
$data=htmlspecialchars_decode($data);
$data=str_replace("هٔ", "ه", $data);
file_put_contents("input-normal.html", $data);
print $data;
