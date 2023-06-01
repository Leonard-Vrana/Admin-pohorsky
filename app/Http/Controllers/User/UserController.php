<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\CreateUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function view(){
        $users = new User;
        return view("pages.Users.index")
               ->with("users", $users->paginate());
    }

    public function delete(Request $r){
        if($r->id){
            $user = User::all()->where("id", $r->id)->first();
            if($user){
                if($user->id == Auth::id()){
                    flash("Nemůžeš vymazat sám sebe...")->error();
                    return back();
                } else {
                    if($user->delete()){
                        flash("Uživatel byl úspěšně vymazán")->success();
                        return back();
                    }
                }
            }
        }
        flash("Něco se nepodařilo")->error();
        return back();
    }

    public function update(Request $r){
        if($r->id){
            $user = User::all()->where("id", $r->id)->first();
            if($user){
                $user->email = $r->email;
                if($r->role == true){
                    $user->role = true;
                } else {
                    $user->role = false;
                }
                if($user->save()){
                    flash("Uživatel byl úspěšně upraven")->success();
                    return back();
                }
            }
        }
        flash("Něco se nepodařilo")->error();
        return back();
    }

    public function create(Request $r){
        if($r->email){
            $can = User::all()->where("email", $r->email)->first();
            if(!$can){
                $password = $this->randomPassword();
                $user = new User;
                $user->email = $r->email;
                $user->password = Hash::make($password);
                if($r->admin){
                    $user->role = true;
                } else {
                    $user->role = false;
                }
                if($user->save()){
                    Mail::to($r->email)->send(new CreateUser($r->email, $password));
                    flash("Uživatel byl úspěšně přidán")->success();
                    return back();
                }
            }
        }
        flash("Něco se nepodařilo")->error();
        return back(); 
    }

    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}
