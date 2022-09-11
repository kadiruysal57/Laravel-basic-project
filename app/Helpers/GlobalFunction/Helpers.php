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
