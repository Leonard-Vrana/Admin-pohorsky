<?php

namespace App\Http\Controllers\Story;

use App\Http\Controllers\Controller;
use App\Models\Story\StoryChildrensModel;
use App\Models\Story\StoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoryDeleteController extends Controller
{
    public function delete(Request $r){
        if($r->deleteStory){
            $story = StoryModel::where("id", $r->deleteStory)->first();
            if($story){
                $childrens = StoryChildrensModel::all()->where("gid", $story->id);
                foreach($childrens as $children){
                    if(Storage::exists($children->path)){
                        if(Storage::delete($children->path)){
                        }
                    }
                    $children->delete();
                }
                if($story->delete()){
                    flash("Položka bola vymazaná")->success();
                    return back();
                }
            }
        }
        flash("Niekde nastala chyba")->error();
        return back();
    }
}
