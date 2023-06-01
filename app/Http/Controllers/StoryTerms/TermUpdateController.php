<?php

namespace App\Http\Controllers\StoryTerms;

use App\Http\Controllers\Controller;
use App\Models\StoryTerms\StoryArtAuthorModel;
use App\Models\StoryTerms\StoryMakerModel;
use App\Models\StoryTerms\StoryPublisherModel;
use App\Models\StoryTerms\StoryTemplateAuthorModel;
use App\Models\StoryTerms\StoryTextAuthorModel;
use Illuminate\Http\Request;

class TermUpdateController extends Controller
{
    public function update(Request $r){
        if($r->id && $r->termType && $r->nameAuthor){
            if($r->termType == "storyMaker"){
                if($this->updateStoryMaker($r->id, $r->nameAuthor)){
                    flash("Autor byl úspěšně upraven")->success();
                }
            } elseif($r->termType == "artAuthor"){
                if($this->updateStoryArtAuthor($r->id, $r->nameAuthor)){
                    flash("Autor byl úspěšně upraven")->success();
                }
            } elseif($r->termType == "templateAuthor"){
                if($this->updateTemplateAuthor($r->id, $r->nameAuthor)){
                    flash("Autor byl úspěšně upraven")->success();
                }
            } elseif($r->termType == "textAuthor"){
                if($this->updateTextAuthor($r->id, $r->nameAuthor)){
                    flash("Autor byl úspěšně upraven")->success();
                }
            } elseif($r->termType == "publisher"){
                if($this->updatePublisher($r->id, $r->nameAuthor)){
                    flash("Položka byla upravena")->success();
                }
            }
            return back();
        }
        flash("Někde nastala chyba")->error();
        return back();
    }

    public function updateStoryMaker($id, $name){
        $model = StoryMakerModel::all()->where("id", $id)->first();
        if($model){
            $model->name = $name;
            if($model->save()){
                return true;
            }
        }
        flash("Autor se nepodařil upravit");
        return back();
    }

    public function updateStoryArtAuthor($id, $name){
        $model = StoryArtAuthorModel::all()->where("id", $id)->first();
        if($model){
            $model->name = $name;
            if($model->save()){
                return true;
            }
        }
        flash("Autor se nepodařil upravit");
        return back();
    }

    public function updateTemplateAuthor($id, $name){
        $model = StoryTemplateAuthorModel::all()->where("id", $id)->first();
        if($model){
            $model->name = $name;
            if($model->save()){
                return true;
            }
        }
        flash("Autor se nepodařil upravit");
        return back();
    }

    public function updateTextAuthor($id, $name){
        $model = StoryTextAuthorModel::all()->where("id", $id)->first();
        if($model){
            $model->name = $name;
            if($model->save()){
                return true;
            }
        }
        flash("Autor se nepodařil upravit");
        return back();
    }

    public function updatePublisher($id, $name){
        $model = StoryPublisherModel::all()->where("id", $id)->first();
        if($model){
            $model->name = $name;
            if($model->save()){
                return true;
            }
        }
        flash("Položka se nepodařila upravit");
        return back();
    }
}
