<?php

//////////////////////////////////
// Define site variables
//////////////////////////////////

// Identify this server, for clariciation on load balancing
define('MAIN_MENU_CSV', 'https://docs.google.com/spreadsheets/d/e/2PACX-1vSqR4nLCjtZ_CLhKeke-FP0QncX4rRLmXcPCTSab-x2kyFdInKwxlDocJDEKyYXjUjbCSYzZFV1-z0T/pub?gid=0&single=true&output=csv');
// Set the cache refresh password
define('CACHE_PASSWORD', 'password');
// Set the website title
define('WEBSITE_TITLE', 'Lakes of Fire');
// Set the website header description
define('WEBSITE_DESCRIPTION', 'The Offical Site for the Lakes of Fire event');

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

?>
