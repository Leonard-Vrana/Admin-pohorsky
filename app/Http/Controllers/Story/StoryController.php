<?php

namespace App\Http\Controllers\Story;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Story\StoryModel;
use Illuminate\Support\Facades\DB;

class StoryController extends Controller
{
    public function view(){
        if(!empty($_GET["itemPerPage"]) && $_GET["itemPerPage"] == 50){
            $itemsPerPage = 50;
        } elseif(!empty($_GET["itemPerPage"]) && $_GET["itemPerPage"] == 100){
            $itemsPerPage = 100;
        } else {
            $itemsPerPage = 25;
        }

        $stories = StoryModel::query();
        if(session()->get('domain')){
            $stories->where("domain", 'LIKE', '%"'.session()->get('domain').'"%');
        }
        if(!empty($_GET["filter"])){
            $searchTerm = $_GET["filter"];
            $stories->where(function ($query) use ($searchTerm) {
                $columns = DB::connection()->getSchemaBuilder()->getColumnListing('story');
                $columns = array_diff($columns, ['maker']); 
                $columns = array_diff($columns, ['art_author']); 
                $columns = array_diff($columns, ['template_author']);
                $columns = array_diff($columns, ['text_author']);  
                $columns = array_diff($columns, ['lenght']); 
                $columns = array_diff($columns, ['publisher']); 
                foreach ($columns as $column) {
                    $query->orWhere($column, 'LIKE', "%$searchTerm%");
                }
            });
        }

        $filterStories = $stories->paginate($itemsPerPage);
        return view("pages.Story.index")
               ->with("stories", $filterStories)
               ->with("countStories", $filterStories->total());
    }

    public function changePublic(Request $r){
        if($r->id){
            $story = StoryModel::all()->where("id", $r->id)->first();
            if($story->public == true){
                $story->public = false;
            } else {
                $story->public = true;
            }
            if($story->save()){
                flash("Publicita bola úspešne zmenená")->success();
                return back();
            }
        }
        flash("Niečo sa pokazilo")->error();
        return back();
    }
}
