<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function view(){
        return view("pages.UserProfile.index");
    }

    public function changePassword(Request $r){
        if($r->password && $r->repeat_password){
            if($r->password == $r->repeat_password){
                $user = User::all()->where("id", Auth::id())->first();
                $user->password = Hash::make($r->password);
                if($user->save()){
                    flash("Heslo bolo úspešne aktualizované")->success();
                    return back();
                }
            }
        }
        flash("Niečo sa pokazilo")->error();
        return back();
    }
}
