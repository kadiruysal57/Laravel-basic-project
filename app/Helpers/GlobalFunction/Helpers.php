<?php
function checkboxorswitch($data){
    if($data == "on" || $data == 1){
        return "1";
    }else{
        return "2";
    }
}
function array_only($array = array(),$onlykey){
    $returndata = Array();
    foreach ($array as $a){
        $returndata[] = $a[$onlykey];
    }
    return $returndata;
}
