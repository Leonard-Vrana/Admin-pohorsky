<?php

namespace App\Http\Controllers\Story;

use App\Http\Controllers\Controller;
use App\Http\Requests\Story\StoryCreateRequest;
use App\Models\Projects\ProjectModel;
use App\Models\Story\StoryModel;
use App\Models\StoryTerms\StoryArtAuthorModel;
use App\Models\StoryTerms\StoryMakerModel;
use App\Models\StoryTerms\StoryPublisherModel;
use App\Models\StoryTerms\StoryTemplateAuthorModel;
use App\Models\StoryTerms\StoryTextAuthorModel;
use Illuminate\Http\Request;

class StoryCreateController extends Controller
{
    public function view(){
        return view("pages.Story.add")
               ->with("makers", StoryMakerModel::all())
               ->with("artAuthors", StoryArtAuthorModel::all())
               ->with("templateAuthors", StoryTemplateAuthorModel::all())
               ->with("textAuthors", StoryTextAuthorModel::all())
               ->with("projects", ProjectModel::all())
               ->with("publishers", StoryPublisherModel::all());
    }

    public function create(StoryCreateRequest $r){
        $story = new StoryModel;
        $story->title = $r->title;
        $story->domain = json_encode($r->projects);
        $story->img = $r->img;
        $story->language = $r->language;
        if($r->note){
            $story->note = $r->note;
        }
        if($r->annotation){
            $story->annotation = $r->annotation;
        }
        if($r->height){
            $story->height = $r->height;
        }
        if($r->have){
            $story->have = $r->have;
        }
        if($r->file){
            $story->file = $r->file;
        }
        if($r->attribute){
            $story->attribute = $r->attribute;
        }
        if($r->labels){
            $story->labels = $r->labels;
        }
        if($r["prop-text"]){
            $story["prop-text"] = $r["prop-text"];
        }
        if($r->publisher){
            $story->publisher = $r->publisher;
        }
        if($r->collection){
            $story->collection = $r->collection;
        }
        if($r->editor){
            $story->editor = $r->editor;
        }
        if($r->translator){
            $story->translator = $r->translator;
        }
        if($r->maker){
            $story->maker = $r->maker;
        }
        if($r->artAuthor){
            $story->art_author = $r->artAuthor;
        }
        if($r->templateAuthor){
            $story->template_author = $r->templateAuthor;
        }
        if($r->textAuthor){
            $story->text_author = $r->textAuthor;
        }
        if($r->marked){
            $story->marked = $r->marked;
        }
        if($r->year){
            $story->year = $r->year;
        }
        if($r->lenght){
            $story->lenght = $r->lenght;
        }
        if($r->onlyUser){
            $story->onlyUser = true;
        }
        if($story->save()){
            flash("Položka bola úspešne pridaná")->success();
            return redirect(route("admin-storyEditView", $story->id));
        }
        flash("Niečo sa pokazilo!")->error();
        return back();
    }
}
