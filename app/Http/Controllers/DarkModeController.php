<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DarkModeController extends Controller
{
    public function switch(){
        if(isset($_COOKIE['dark-mode'])){
            setcookie('dark-mode', '', time() - 3600, '/');
        } else {
            setcookie("dark-mode", "true", time() + (30 * 24 * 60 * 60), '/');
        }
        return back();
    }
}
