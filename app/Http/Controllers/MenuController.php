<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index(){
        $menus = Menu::all();

         return view('admin.menu', [
            'title' => 'Menu',
            'menus' => $menus,
        ]);
    }
}
