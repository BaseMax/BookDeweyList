<?php
// Max Base
// https://github.com/BaseMax/BookDeweyList
$data=file_get_contents("input-normal.html");
$pattern='/<!-- begin -->\n<h2>([^\<]+)<\/h2>[\n\s]+<ul>(.*?)<\/ul>\n<!-- end -->/is';
preg_match_all($pattern, $data, $output);
print_r($output);
