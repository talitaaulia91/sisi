<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Admin\Event\Actions;

class TestController extends Controller
{
    public function first(){
        return view('test.first');
    }

}
