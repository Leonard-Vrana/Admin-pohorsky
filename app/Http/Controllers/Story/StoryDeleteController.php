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
        if($r->id){
            $story = StoryModel::where("id", $r->id)->first();
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
                    flash("Položka byla vymazána")->success();
                    return back();
                }
            }
        }
        flash("Něco se pokazilo")->error();
        return back();
    }
}
