<?php

namespace App\Http\Controllers\StoryLongImages;

use App\Http\Controllers\Controller;
use App\Models\Story\StoryLongImagesModel;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function create(Request $r){
        $image = new StoryLongImagesModel();
        if($r->id){
            $image->ticket_id = $r->id;
            $randomName = $r->file('image')->hashName();
            $r->file('image')->move(public_path('storage/imgs/'.$r->id.''), $randomName);
            $image->img = "/storage/imgs/".$r->id."/".$randomName;
            $image->path = "/storage/imgs/".$r->id."/".$randomName;
            if($image->save()){
                flash("Obrázek byl úspěšně přidán")->success();
                return back();
            }
        }
        flash("Něco se pokazilo")->error();
        return back();
    }
}
