<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Pages\MenuModel;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function view(){
        if(session()->get('domain')){
            $menu = MenuModel::query()->where("domain", session()->get('domain'))->paginate();
            return view("pages.Menu.index")
                   ->with("items", $menu);
        } else {
            flash("Nemáte vybraný projekt!")->error();
            return redirect(route("homepage"));
        }
        flash("Niekde sa nastala chyba")->error();
        return back();
    }

    public function create(Request $r){
        if($r->url && $r->name && session()->get('domain')){
            $menu = new MenuModel();
            $menu->domain = session()->get('domain');
            $menu->name = $r->name;
            $menu->url = $r->url;
            if($menu->save()){
                flash("Položka do menu bola úspešne pridaná")->success();
                return back();
            }
        }
        flash("Niekde sa nastala chyba")->error();
        return back();
    }

    public function edit(Request $r){
        if($r->id && $r->name && $r->url){
            $menu = MenuModel::all()->where("id", $r->id)->first();
            if($menu){
                $menu->name = $r->name;
                $menu->url = $r->url;
                if($menu->save()){
                    flash("Položka v menu bola úspešne upravená")->success();
                    return back();
                }
            }
        }
        flash("Niekde sa nastala chyba")->error();
        return back();
    }

    public function delete(Request $r){
        if($r->id){
            $menu = MenuModel::all()->where("id", $r->id)->first();
            if($menu){
                if($menu->delete()){
                    flash("Položka bola úspešne vymazaná")->success();
                    return back();
                }
            }
        }
        flash("Niekde sa nastala chyba")->error();
        return back();
    }
}
