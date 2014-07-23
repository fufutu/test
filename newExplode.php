<?php

$str = 'a,,br,,dd';
print_r(explode(',', $str));
print_r(newExplode(',', $str));
function newExplode($delimiter, $string) {

    $startPos = 0;
    $arr = array();

    while(($pos = strpos($string, $delimiter, $startPos)) !== false) {
        $arr[] = substr($string, $startPos, $pos-$startPos);
        $startPos = $pos+1;
    }

    if ($startPos <= strlen($string)) {
        $arr[] = substr($string, $startPos);
    }

    return $arr;
}


