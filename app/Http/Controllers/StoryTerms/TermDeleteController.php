<?php

namespace App\Http\Controllers\StoryTerms;

use App\Http\Controllers\Controller;
use App\Models\Story\StoryModel;
use App\Models\StoryTerms\StoryArtAuthorModel;
use App\Models\StoryTerms\StoryMakerModel;
use App\Models\StoryTerms\StoryPublisherModel;
use App\Models\StoryTerms\StoryTemplateAuthorModel;
use App\Models\StoryTerms\StoryTextAuthorModel;
use Illuminate\Http\Request;

class TermDeleteController extends Controller
{
    public function delete(Request $r){
        if($r->id && $r->termType){
            if($r->termType == "storyMaker"){
                if($this->deleteStoryMaker($r->id)){
                    flash("Autor bol úspešne vymazaný")->success();
                }
            } elseif($r->termType == "artAuthor"){
                if($this->deleteStoryArtAuthor($r->id)){
                    flash("Autor bol úspešne vymazaný")->success();
                }
            } elseif($r->termType == "templateAuthor"){
                if($this->deleteTemplateAuthor($r->id)){
                    flash("Autor bol úspešne vymazaný")->success();
                }
            } elseif($r->termType == "textAuthor"){
                if($this->deleteTextAuthor($r->id)){
                    flash("Autor bol úspešne vymazaný")->success();
                }
            } elseif($r->termType == "publisher"){
                if($this->deletePublisher($r->id)){
                    flash("Položka bola úspešne vymazaná")->success();
                }
            }
            return back();
        }
        flash("Niekde nastala chyba")->error();
        return back();
    }

    public function deleteStoryMaker($id){
        $model = StoryMakerModel::all()->where("id", $id)->first();
        $can = StoryModel::where("maker", $model->id)->get();
        if($model){
            if(1 > count($can)){
                if($model->delete()){
                    return true;
                }
            }
        }
        flash("Autor sa nepodaril vymazať")->error();
        return false;
    }

    public function deleteStoryArtAuthor($id){
        $model = StoryArtAuthorModel::all()->where("id", $id)->first();
        $can = StoryModel::where("art_author", $model->id)->get();
        if($model){
            if(1 > count($can)){
                if($model->delete()){
                    return true;
                }
            }
        }
        flash("Autor sa nepodaril vymazať")->error();
        return false;
    }

    public function deleteTemplateAuthor($id){
        $model = StoryTemplateAuthorModel::all()->where("id", $id)->first();
        $can = StoryModel::where("template_author", $model->id)->get();
        if($model){
            if(1 > count($can)){
                if($model->delete()){
                    return true;
                }
            }
        }
        flash("Autor sa nepodaril vymazať")->error();
        return false;
    }

    public function deleteTextAuthor($id){
        $model = StoryTextAuthorModel::all()->where("id", $id)->first();
        $can = StoryModel::where("text_author", $model->id)->get();
        if($model){
            if(1 > count($can)){
                if($model->delete()){
                    return true;
                }
            }
        }
        flash("Autor sa nepodaril vymazať")->error();
        return false;
    }

    public function deletePublisher($id){
        $model = StoryPublisherModel::all()->where("id", $id)->first();
        $can = StoryModel::where("publisher", $model->id)->get();
        if($model){
            if(1 > count($can)){
                if($model->delete()){
                    return true;
                }
            }
        }
        flash("Položka sa nepodarila vymazať")->error();
        return false;
    }
}
