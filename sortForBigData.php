<?php
// 问题：已知100万数据，数据范围是 0~10000，求出现次数最多的10条数据

// 生成问题
function generateProblem() {

    $count = 1024 * 1024;

    for($i=0;$i<$count;$i++) {

        $randNum = rand(0, 10000);

        file_put_contents('/tmp/0610.lzj', $randNum."\n", FILE_APPEND);
    }
}

//generateProblem();


function getResult() {

    $filename = '/tmp/0610.lzj';
    $arr = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $newArr = array();
    foreach($arr as $v) {

        $v = trim($v);
        if ($newArr[$v]) {

            $newArr[$v] ++;
        } else {
            $newArr[$v] = 1;
        }
    }

    var_dump('aa');die;
    $newArr = sort($newArr);

    $newArr = array_splice($newArr, 0, 10);
    var_dump($newArr);
}

//getResult();

function getResult2() {

    $filename = '/tmp/0610.lzj';

    $fh = fopen($filename, 'r');

    while(($line = fgets($fh)) != false) {

        $line = trim($line);

        $num = floor($line / 100);

        $newFile = "0611_{$num}.lzj";
        file_put_contents($newFile, $line."\n", FILE_APPEND);

    }
}

//getResult2();

function getResult3() {

    $fh = opendir('.');
    $retArr = array();
    while(($filename = readdir($fh)) !== false) {

        if (!preg_match('/0611_\d+/', $filename)) {
            continue;
        }

        $arr = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $newArr = array();
        foreach($arr as $v) {
            if (isset($newArr[$v])) {
                $newArr[$v] ++;
            } else {
                $newArr[$v] = 1;
            }
        }

        arsort($newArr);

        if ($retArr) {
            $newArr = array_merge($newArr, $retArr);
            arsort($newArr);
        }

        $retArr = array_slice($newArr, 0, 10, true);

    }

    return $retArr;
}

var_dump(getResult3());
