<?php

namespace App\Http\Controllers\Domain;

use App\Http\Controllers\Controller;
use App\Models\Projects\ProjectModel;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    public function switchDomain($projectId){
        $project = ProjectModel::all()->where("id", $projectId)->first();
        if($project){
            session()->put('domain', $project->value);
            flash("Přepnutí projektu bylo úspěšné")->success();
            return back();
        }
        flash("Přepnutí projektu se nepodařilo!")->error();
        return back();
    }

    public function resetDomain(){
        $session = session();
        $session->forget('domain');
        flash("Přepnutí projektu bylo úspěšné")->success();
        return back();
    }
}
