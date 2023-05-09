<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\ForgotPassword;
use App\Models\PasswordResets;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function Login(LoginRequest $r){
        if(Auth::attempt(['email' => $r->email, 'password' => $r->password])){
            $r->session()->regenerate();
            return redirect(route('homepage'));
        }
        return back()->withErrors([
            'error-auth' => trans('auth.failed'),
        ])->onlyInput('email');

    }

    public function logOut(Request $request){
        Auth::logout();
		return redirect()->route('login');
    }

    public function forgotPassword(Request $r){
        if($r->email){
            $user = User::where("email", $r->email)->first();
            if($user){
                $selectRecoveryPassword = PasswordResets::all()->sortByDesc('created_at')->first();
                $token = hash('sha256', $plainTextToken = Str::random(50));
                if($selectRecoveryPassword){
                    if($selectRecoveryPassword->created_at > Carbon::now()->toDateTimeString()){
                        flash("Požádat o obnovu hesla můžete jednou do 15 minut")->error();
                        return back();
                    }
                }
                $passwords = new PasswordResets;
                $passwords->email = $user->email;
                $passwords->token =  $token;
                $passwords->created_at = Carbon::now()->addMinutes(15)->toDateTimeString();
                $passwords->save();
                Mail::to($user->email)->send(new ForgotPassword($token));
                flash("Ověřovací e-mail byl odeslán")->success();
                return back();
            } else {
                flash("Uživatel neexistuje")->error();
                return back();
            }
        } else {
            flash("Pole E-mail je povinné")->error();
            return back();
        }
    }

    public function verifyPassword(Request $r){
        $r->validate([
            'password' => 'required',
            'again_password' => 'required|same:password',
            'token' => 'required',
        ]);
        $selectToken = PasswordResets::where("token", $r->token)->first();
        if($selectToken){
            $user = User::where("email", $selectToken->email)->first();
            $user->password = Hash::make($r->password);
            $user->save();
            PasswordResets::where("token", $r->token)->delete();
            flash("Heslo bylo změněno.")->success();
            return redirect("login");
        }
        return back();
    }

    public function verifyTokenPage($token){
        $select = PasswordResets::where("token", $token)->first();
        if($select){
            if($select->created_at > Carbon::now()->toDateTimeString()){
                return view("pages.Auth.verify-token")
                ->with("select", $select);
            } else{
                flash("Platnosť tokenu vypršala")->error();
                return redirect("login");
            }
        } else {
            return redirect(route("login"));
        }
    }
}
