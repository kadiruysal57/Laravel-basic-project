<?php
function checkboxorswitch($data){
    if($data == "on" || $data == 1){
        return "1";
    }else{
        return "2";
    }
}
function statusView($data){
    if($data == 1){
        return __('global.active');
    }else{
        return __('global.passive');
    }
}
function array_only($array = array(),$onlykey){
    $returndata = Array();
    foreach ($array as $a){
        $returndata[] = $a[$onlykey];
    }
    return $returndata;
}

function getRoleCheck($roleName)
{
    $userRoles = new App\Models\userroles;
    return $userRoles->CheckRole($roleName);
}
function getIcon()
{
    $content = fopen('https://gist.githubusercontent.com/zwinnie/64d531ee2f5b77cc25ede895412dd0a2/raw/91c110d10edb6f465718c5809ead6fe98047914a/font-awesome-4.7.0.txt', 'r');
    $AllIconList = array();
    while ($ready = fgets($content)) {
        array_push($AllIconList, $ready);
    }
    return $AllIconList;
}
