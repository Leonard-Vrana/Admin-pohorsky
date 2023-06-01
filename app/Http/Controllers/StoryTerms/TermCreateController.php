<?php

namespace App\Http\Controllers\StoryTerms;

use App\Http\Controllers\Controller;
use App\Models\StoryTerms\StoryArtAuthorModel;
use App\Models\StoryTerms\StoryMakerModel;
use App\Models\StoryTerms\StoryPublisherModel;
use App\Models\StoryTerms\StoryTemplateAuthorModel;
use App\Models\StoryTerms\StoryTextAuthorModel;
use Illuminate\Http\Request;

class TermCreateController extends Controller
{
    public function create(Request $r){
        if($r->termType && $r->nameAuthor){
            if($r->termType == "storyMaker"){
                if($this->createStoryMaker($r->nameAuthor)){
                    flash("Autor byl úspěšně přidán")->success();
                }
            } elseif($r->termType == "artAuthor"){
                if($this->createStoryArtAuthor($r->nameAuthor)){
                    flash("Autor byl úspěšně přidán")->success();
                }
            } elseif($r->termType == "templateAuthor"){
                if($this->createTemplateAuthor($r->nameAuthor)){
                    flash("Autor byl úspěšně přidán")->success();
                }
            } elseif($r->termType == "textAuthor"){
                if($this->createTextAuthor($r->nameAuthor)){
                    flash("Autor byl úspěšně přidán")->success();
                }
            } elseif($r->termType == "publisher"){
                if($this->createPublisher($r->nameAuthor)){
                    flash("Položka byla úspěšně přidána")->success();
                }
            }
            return back();
        }
        flash("Někde nastala chyba")->error();
        return back();
    }

    public function createStoryMaker($name){
        $model = new StoryMakerModel;
        if($name){
            $model->name = $name;
            if($model->save()){
                return true;
            }
        }
        flash("Autor se nepodařil vytvořit");
        return back();
    }

    public function createStoryArtAuthor($name){
        $model = new StoryArtAuthorModel;
        if($name){
            $model->name = $name;
            if($model->save()){
                return true;
            }
        }
        flash("Autor se nepodařil vytvořit");
        return back();
    }

    public function createTemplateAuthor($name){
        $model = new StoryTemplateAuthorModel;
        if($name){
            $model->name = $name;
            if($model->save()){
                return true;
            }
        }
        flash("Autor se nepodařil vytvořit");
        return back();
    }

    public function createTextAuthor($name){
        $model = new StoryTextAuthorModel;
        if($name){
            $model->name = $name;
            if($model->save()){
                return true;
            }
        }
        flash("Autor se nepodařil vytvořit");
        return back();
    }

    public function createPublisher($name){
        $model = new StoryPublisherModel;
        if($name){
            $model->name = $name;
            if($model->save()){
                return true;
            }
        }
        flash("Položka se nepodařila vytvořit");
        return back();
    }
}
