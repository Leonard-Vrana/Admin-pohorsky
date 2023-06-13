<?php

namespace App\Http\Controllers\StoryLongImages;

use App\Http\Controllers\Controller;
use App\Models\Story\StoryLongImagesModel;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function delete(Request $r){
        if($r->id){
            $gallery = StoryLongImagesModel::all()->where("id", $r->id)->first();
            if($gallery){
                $file = public_path($gallery->path);
                if(file_exists($file)){
                    if(unlink($file) && $gallery->delete()){
                        flash("Obrázek byl úspěšně vymazán")->success();
                        return back();
                    }
                }
            }
        }

        flash("Něco se pokazilo")->error();
        return back();
    }
}
