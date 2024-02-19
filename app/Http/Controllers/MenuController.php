<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuLevel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index(){
        $menus = Menu::select(
                    'menus.*',
                    'menu_levels.level'
                )
                ->join('menu_levels', 'menu_levels.id', '=', 'menus.level_id')->get();

         return view('admin.menu', [
            'title' => 'Menu',
            'menus' => $menus,
        ]);
    }

    public function create(){
        $levels = MenuLevel::all();

        return view('admin.create.menu', [
            'levels' => $levels    
        ]);
   }

   public function edit(Request $request){
       $menu = Menu::where('id', $request->id)->first();
       $levels = MenuLevel::all();

        return view('admin.edit.menu', [
           'title' => 'Menu',
           'menu' => $menu,
           'levels' => $levels
       ]);
   }

   public function store(Request $request) {
       $request->validate([
           'menu_name'=>'required',
       ],[
           'menu_name.required' => 'nama menu wajib diisi',
       ]);

       DB::transaction(function () use ($request) {
           Menu::create($request->except('actionform', 'id'));
       });

       $result = [
           'flag' => 'success',
           'msg' => 'Berhasil tambah data',
           'title' => 'Sukses',
       ];

       return response()->json($result);
   }

   public function update(Request $request) {
       $request->validate([
           'menu_name'=>'required',
       ],[
           'menu_name.required' => 'Nama menu wajib diisi',
       ]);

       DB::transaction(function () use ($request) {
           Menu::where('id', $request->id)->update([
               'level_id'  => $request->level_id,
               'menu_name'  => $request->menu_name,
               'menu_link'  => $request->menu_link,
               'menu_icon'  => $request->menu_icon,
           ]);
       });

       $result = [
           'flag' => 'success',
           'msg' => 'Berhasil update data',
           'title' => 'Sukses',
       ];

       return response()->json($result);
   }

   public function delete(Request $request) {
       DB::transaction(function () use ($request) {
           Menu::destroy($request->id);
       });

       $result = [
           'flag' => 'success',
           'msg' => 'Berhasil hapus data',
           'title' => 'Sukses',
       ];

       return response()->json($result);
   }
}
