<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuLevel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuLevelController extends Controller
{
    public function index(){
        $levels = MenuLevel::all();

         return view('admin.menuLevel', [
            'title' => 'Menu Level',
            'levels' => $levels,
        ]);
    }

    public function create(){
         return view('admin.create.menuLevel');
    }

    public function edit(Request $request){
        $level = MenuLevel::where('id', $request->id)->first();

         return view('admin.edit.menuLevel', [
            'title' => 'Menu Level',
            'level' => $level,
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'level'=>'required',
        ],[
            'level.required' => 'username wajib diisi',
        ]);

        DB::transaction(function () use ($request) {
            MenuLevel::create($request->except('actionform', 'id'));
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
            'level'=>'required',
        ],[
            'level.required' => 'username wajib diisi',
        ]);

        DB::transaction(function () use ($request) {
            MenuLevel::where('id', $request->id)->update([
                'level'  => $request->level,
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
            MenuLevel::destroy($request->id);
        });

        $result = [
            'flag' => 'success',
            'msg' => 'Berhasil hapus data',
            'title' => 'Sukses',
        ];

        return response()->json($result);
    }
}
