<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company\CompanyModel;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function view(){
        return view("pages.Company.index")
                ->with("settings", CompanyModel::all());
    }

    public function edit(Request $r){
        if($r->id && $r->value){
            $company = CompanyModel::all()->where("id", $r->id)->first();
            if($company){
                $company->value = $r->value;
                if($company->save()){
                    flash("Položka bola aktualizovaná")->success();
                    return back();
                }
            }
        }
        flash("Niečo sa pokazilo")->error();
        return back();
    }
}
