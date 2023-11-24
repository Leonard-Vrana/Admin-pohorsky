<?php

namespace App\Http\Controllers\Story;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Story\StoryModel;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;
use Illuminate\Support\Str;


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
        if(!empty($_GET["sort"])){
            if($_GET["sort"] === "asc"){
                $stories->orderBy('id', 'asc');
            } elseif($_GET["sort"] === "desc"){
                $stories->orderBy('id', 'desc');
            } elseif($_GET["sort"] === "alphabet_asc"){
                $stories->orderBy('title', 'asc');
            } elseif($_GET["sort"] === "alphabet_desc"){
                $stories->orderBy('title', 'desc');
            }
        }

        $filterStories = $stories->paginate($itemsPerPage);
        
        $filterStories->appends(request()->except('page'));
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
                flash("Publicita byla úspěšně změněna")->success();
                return back();
            }
        }
        flash("Něco se pokazilo")->error();
        return back();
    }


    public function importCsv(Request $r){
        if ($r->hasFile('csv')) {
            $file = $r->file('csv');
            // Vytvorenie čítača pre CSV súbor
            $csv = Reader::createFromPath($file->getPathname(), 'r');
            $csv->setDelimiter(',');
            $csv->setHeaderOffset(0);
            $records = $csv->getRecords(['id prispevku', 'id autor art']);
            foreach($records as $record){
                $id = $record["id prispevku"];
                $artAuthor = $record["id autor art"];
                $story = StoryModel::all()->where("id", $id)->first();
                $story->art_author = $artAuthor;
                if($story->save()){

                }
            }
            // $records = $csv->getRecords(['ID', 'Skladem (pocet kusu)', 'URL']);
            
            // foreach ($records as $record) {
            //     $id = $record['ID'];
            //     $skladem = $record['Skladem (pocet kusu)'];
            //     $url = 'https://www.diacek.eu'.Str::before($record['URL'], '|');

            //     $story = StoryModel::all()->where("id", $id)->first();
            //     if($story){
            //         $story->eshop_url = $url;
            //         $story->eshop_storage = $skladem;
            //         if($story->save()){

            //         }
            //     }
            // }

            flash("Import proběhl úspěšně")->success();
            return back();
        }
        flash("Něco se pokazilo")->error();
        return back();
    }

}
