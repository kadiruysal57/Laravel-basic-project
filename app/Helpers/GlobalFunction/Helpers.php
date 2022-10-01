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
    return "";
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

function RolesName($data){
    $data = str_replace('language.index','Dil Listeleme',$data);
    $data = str_replace('language.store','Dil Güncelleme',$data);
    $data = str_replace('language.destroy','Dil Silme',$data);
    $data = str_replace('contents.index','Sayfa Listeleme',$data);
    $data = str_replace('contents.create','Sayfa Oluşturma',$data);
    $data = str_replace('contents.store','Sayfa Güncelleme',$data);
    $data = str_replace('contents.show','Sayfa Görüntüleme',$data);
    $data = str_replace('contents.destroy','Sayfa Silme',$data);
    $data = str_replace('menu.index','Menü Listeleme',$data);
    $data = str_replace('menu.create','Menü Oluşturma',$data);
    $data = str_replace('menu.store','Menü Güncelleme',$data);
    $data = str_replace('menu.show','Menü Görüntüleme',$data);
    $data = str_replace('menu.edit','Menü Editleme',$data);
    $data = str_replace('menu.destroy','Menü Silme',$data);
    $data = str_replace('slider.index','Slider Listeleme',$data);
    $data = str_replace('slider.create','Slider Oluşturma',$data);
    $data = str_replace('slider.store','Slider Güncelleme',$data);
    $data = str_replace('slider.show','Slider Görüntüleme',$data);
    $data = str_replace('slider.destroy','Slider Silme',$data);
    $data = str_replace('site-settings.index','Site Ayarları Listeleme',$data);
    $data = str_replace('site-settings.store','Site Ayarları Güncelleme',$data);
    $data = str_replace('social-media.store','Sosyal Medya Güncelleme',$data);
    $data = str_replace('social-media.update','Sosyal Medya Görüntüleme',$data);
    $data = str_replace('social-media.destroy','Sosyal Medya Silme',$data);
    $data = str_replace('form-builder.index','Form Listeleme',$data);
    $data = str_replace('form-builder.create','Form Oluşturma',$data);
    $data = str_replace('form-builder.store','Form Güncelleme',$data);
    $data = str_replace('form-builder.show','Form Görüntüleme',$data);
    $data = str_replace('form-builder.destroy','Form Silme',$data);
    $data = str_replace('blok-management.index','Blok Yönetimi Listeleme',$data);
    $data = str_replace('blok-management.create','Blok Yönetimi Oluşturma',$data);
    $data = str_replace('blok-management.store','Blok Yönetimi Güncelleme',$data);
    $data = str_replace('blok-management.show','Blok Yönetimi Görüntüleme',$data);
    $data = str_replace('blok-management.destroy','Blok Yönetimi Silme',$data);
    $data = str_replace('users.index','Kullanıcıları Listeleme',$data);
    $data = str_replace('users.create','Kullanıcı Oluşturma',$data);
    $data = str_replace('users.store','Kullanıcıları Güncelleme',$data);
    $data = str_replace('users.show','Kullanıcıları Görüntüleme',$data);
    $data = str_replace('users.destroy','Kullanıcı Silme',$data);
    $data = str_replace('permission.index','İzin Listesi Listeleme',$data);
    $data = str_replace('permission.create','İzin Listesi Oluşturma',$data);
    $data = str_replace('permission.store','İzin Listesi Güncelleme',$data);
    $data = str_replace('permission.show','İzin Listesi Görüntüleme',$data);
    $data = str_replace('gallery.index','Galeri Listeleme',$data);
    $data = str_replace('gallery.create','Galeri Oluşturma',$data);
    $data = str_replace('gallery.store','Galeri Güncelleme',$data);
    $data = str_replace('gallery.show','Galeri Görüntüleme',$data);
    $data = str_replace('gallery.destroy','Galeri Silme',$data);

    return $data;
}
function getCurrentUrlName(){
    $name = Illuminate\Support\Facades\Route::getCurrentRoute()->getName();
    $name = explode('.',$name);
    if(!empty($name[0])){
        return $name[0];
    }else{
        return "dashboard";
    }
}
