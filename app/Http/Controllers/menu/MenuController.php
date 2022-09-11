<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\menuitem;
use Illuminate\Http\Request;
use App\Models\Contents;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$this->PermissionCheck()){

            return view('Kpanel.401');
        }
        $data['menus'] = Menu::where('status','!=',3)->get();
        return view('Kpanel.menu.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(!$this->PermissionCheck()){

            return view('Kpanel.401');
        }
        return view('Kpanel.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$this->PermissionCheck()){

            return response()->json(['error' => array('Bu Modülü Güncelleme Yetkiniz Bulunmamaktadır.')]);

        }

        if($request->id == "update"){

            $data = json_decode($request->data);
            try {
                $Menu_item = new menuitem();
                foreach ($data as $key =>  $d){
                    $test = $Menu_item->create_Menu($d,++$key);
                }

                $menu_id = $request->menu_id;
                $post = Contents::select('contents.id','contents.name','menu_item.menu_id')
                    ->where('menu_item.menu_id',null) // menu_id'si boş olanlar gelsin dedim böylelikle menu_item tablosuna eklenmemiş veriler gelicek sadece
                    ->where('contents.status',1)// her alan gelmesin diye select attım
                    ->leftJoin('menu_item', function($join) use ($menu_id) // laravel de join içerisinde koşul belirtilebiliyor buda onlardan biri.
                    {
                        $join->on('contents.id', '=', 'menu_item.menu_name')
                            ->where('menu_item.menu_id',$menu_id)// on ile tabloların bakıalcağı columları söyledim
                            ->where('menu_item.tableId',1); // ve sadece tableId 1 olanlara bakılsın dedim


                    })
                    ->get();

                $collaps = array('0'=>$Menu_item->collaps_html($post,$request->menu_id,1));


                return response()->json(['type' => 'success','menu_html'=>$Menu_item->show_menu($request->menu_id),'collaps'=>$collaps,'success_message_array' => array(Lang::get('global.success_message'))]);

            }catch (ModelNotFoundException $e){
                return response()->json(['type' => 'error','error_message_array'=>array(Lang::get('global.error_message'))]);
            }

        }
        if($request->id == "custom_link_add"){
            $validator = Validator::make($request->all(), [
                'custom_link_name'=>'required',
                'custom_link_target'=>'required',
            ]);
            if ($validator->passes()) {
                $menu_item = new menuitem();
                $menu_item->tableId = 99;
                $menu_item->menu_name = $request->custom_link_name;
                $menu_item->real_link = $request->custom_link_url;
                $menu_item->menu_order = 0;
                $menu_item->menu_id = $request->menu_id;
                $menu_item->target = $request->custom_link_target;
                $menu_item->save();

                $MenuModel = new menuitem();
                return response()->json(['type' => 'success','menu_html'=>$MenuModel->show_menu($request->menu_id),'success_message_array' => array(Lang::get('global.success_message'))]);
            }else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
        }
        if($request->id == "custom_link_edit"){
            $validator = Validator::make($request->all(), [
                'custom_link_name'=>'required',
                'custom_link_target'=>'required',
            ]);
            if ($validator->passes()) {
                $menu_item = menuitem::find($request->custom_link_id);
                $menu_item->menu_name = $request->custom_link_name;
                $menu_item->real_link = $request->custom_link_url;
                $menu_item->target = $request->custom_link_target;
                $menu_item->save();

                $MenuModel = new menuitem();
                return response()->json(['type' => 'success','menu_html'=>$MenuModel->show_menu($request->menu_id),'success_message_array' => array(Lang::get('global.success_message'))]);
            }else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$this->PermissionCheck()){

            return view('Kpanel.401');
        }
        $data['menu_id'] = $id;

        $post = Contents::select('contents.id','contents.name','menu_item.menu_id')
            ->where('menu_item.menu_id',null) // menu_id'si boş olanlar gelsin dedim böylelikle menu_item tablosuna eklenmemiş veriler gelicek sadece
            ->where('contents.status',1)// her alan gelmesin diye select attım
            ->leftJoin('menu_item', function($join) use ($id) // laravel de join içerisinde koşul belirtilebiliyor buda onlardan biri.
            {
                $join->on('contents.id', '=', 'menu_item.menu_name')
                    ->where('menu_item.menu_id',$id)// on ile tabloların bakıalcağı columları söyledim
                    ->where('menu_item.tableId',1); // ve sadece tableId 1 olanlara bakılsın dedim


            })
            ->get();

        $data['collapseData'] = array(
            array(
                'title'=>'Post',
                'data'=>$post,
                'type' => 1 // veritabanındaki tableId alanı için
            ),
        );


        $MenuModel = new menuitem();
        $data['menus'] = $MenuModel->show_menu($id);
        return view('Kpanel.menu.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$this->PermissionCheck()){

            return response()->json(['error' => array('Bu Modülü Güncelleme Yetkiniz Bulunmamaktadır.')]);

        }
        $menu = menuitem::find($id);
        if(!empty($menu)){
            return response()->json(['type' => 'success','data'=>$menu,'action'=>route('menu.store')]);
        }else{
            return response()->json(['type'=>'error','error_message_array'=>array(Lang::get('global.error_message'))]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$this->PermissionCheck()){

            return response()->json(['error' => array('Bu Modülü Silme Yetkiniz Bulunmamaktadır.')]);

        }
        $menu_item = menuitem::find($id);
        if(!empty($menu_item)){
            $menu_id = $menu_item->menu_id;
            $delete_process = $menu_item->delete();
            if($delete_process == 1){
                $menuModel = new menuitem();
                $menuModel->menu_category_delete($id);

            }
            $menu_item = new menuitem();

            $post = contents::select('contents.id','contents.name','menu_item.menu_id')
                ->where('menu_item.menu_id',null) // menu_id'si boş olanlar gelsin dedim böylelikle menu_item tablosuna eklenmemiş veriler gelicek sadece
                ->where('contents.status',1)// her alan gelmesin diye select attım
                ->leftJoin('menu_item', function($join) use ($menu_id) // laravel de join içerisinde koşul belirtilebiliyor buda onlardan biri.
                {
                    $join->on('contents.id', '=', 'menu_item.menu_name')
                        ->where('menu_item.menu_id',$menu_id)// on ile tabloların bakıalcağı columları söyledim
                        ->where('menu_item.tableId',1); // ve sadece tableId 1 olanlara bakılsın dedim


                })
                ->get();
            $collaps = array('0'=>$menu_item->collaps_html($post,$menu_id,1));

            return response()->json(['type' => 'success','menu_html'=>$menu_item->show_menu($menu_id),'collaps'=>$collaps,'success_message_array' => array(Lang::get('global.success_message'))]);
        }else{
            return response()->json(['type'=>'error','error_message_array'=>array(Lang::get('global.error_message'))]);

        }
    }
}
