<?php

namespace App\Http\Controllers\StoryTerms;

use App\Http\Controllers\Controller;
use App\Models\StoryTerms\StoryArtAuthorModel;
use App\Models\StoryTerms\StoryMakerModel;
use App\Models\StoryTerms\StoryPublisherModel;
use App\Models\StoryTerms\StoryTemplateAuthorModel;
use App\Models\StoryTerms\StoryTextAuthorModel;
use Illuminate\Http\Request;

class StoryTermsController extends Controller
{
    public function view($name){
        $itemsPerPage = 20;
        if($name === "maker"){
            $authors = StoryMakerModel::query();
            $name = "Story makers";
            $type = "storyMaker";
        } elseif($name == "artAuthor"){
            $authors = StoryArtAuthorModel::query();
            $name = "Art authors";
            $type = "artAuthor";
        } elseif($name == "templateAuthor"){
            $authors = StoryTemplateAuthorModel::query();
            $name = "Template authors";
            $type = "templateAuthor";
        } elseif($name == "textAuthor"){
            $authors = StoryTextAuthorModel::query();
            $name = "Text authors";
            $type = "textAuthor";
        } elseif($name == "publisher"){
            $authors = StoryPublisherModel::query();
            $name = "Story publishers";
            $type = "publisher";
        } else {
            return redirect(route("homepage"));
        }

        $filterAuthors = $authors->paginate($itemsPerPage);
        return view("pages.StoryTerms.index")
               ->with("authors", $filterAuthors)
               ->with("countAuthors", $filterAuthors->total())
               ->with("name", $name)
               ->with("type", $type);
    }
}
