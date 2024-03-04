<?php

namespace App\Http\Controllers\Story;

use App\Http\Controllers\Controller;
use App\Http\Requests\Story\StoryCreateRequest;
use App\Models\Projects\ProjectModel;
use App\Models\Story\StoryChildrensModel;
use App\Models\Story\StoryLongImagesModel;
use App\Models\Story\StoryModel;
use App\Models\Story\StoryTagRelations;
use App\Models\Story\StoryTags;
use App\Models\StoryTerms\StoryArtAuthorModel;
use App\Models\StoryTerms\StoryMakerModel;
use App\Models\StoryTerms\StoryPublisherModel;
use App\Models\StoryTerms\StoryTemplateAuthorModel;
use App\Models\StoryTerms\StoryTextAuthorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class StoryUpdateController extends Controller
{
    public function view($id){
        $model = StoryModel::all()->where("id", $id)->first();
        if($model){
            $projectValue = json_decode($model->domain);
            return view("pages.Story.update")
                   ->with("story", $model)
                   ->with("makers", StoryMakerModel::orderBy("name", "asc")->get())
                   ->with("tags", StoryTags::all())
                   ->with("artAuthors", StoryArtAuthorModel::orderBy("name", "asc")->get())
                   ->with("templateAuthors", StoryTemplateAuthorModel::orderBy("name", "asc")->get())
                   ->with("textAuthors", StoryTextAuthorModel::orderBy("name", "asc")->get())
                   ->with("projects", ProjectModel::all())
                   ->with("publishers", StoryPublisherModel::all())
                   ->with("longImages", StoryLongImagesModel::all()->where("ticket_id", $model->id));
        }
        return redirect(route("admin-story"));
    }

    public function update(StoryCreateRequest $r){
        if($r->id){
            $story = StoryModel::all()->where("id", $r->id)->first();
            $story->tags()->sync($r->tags);
            $story->title = $r->title;
            $story->slug = Str::slug($r->title, "-");
            $story->domain = json_encode($r->projects);
            $story->img = $r->img;
            $story->language = $r->language;
            $story->note = $r->note ? $r->note : null;
            $story->annotation = $r->annotation ? $r->annotation : null;
            $story->height = $r->height ? $r->height : null;
            $story->have = $r->have ? $r->have : null;
            $story->file = $r->file ? $r->file : null;
            $story->attribute = $r->attribute ? $r->attribute : null;
            $story->labels = $r->labels ? $r->labels : null;
            $story["prop-text"] = $r["prop-text"] ? $r["prop-text"] : null;
            $story->publisher = $r->publisher ? $r->publisher : null;
            $story->collection = $r->collection ? $r->collection : null;
            $story->editor = $r->editor ? $r->editor : null;
            $story->translator = $r->translator ? $r->translator : null;
            $story->maker = $r->maker ? $r->maker : null;
            $story->art_author = $r->artAuthor ? $r->artAuthor : null;
            $story->template_author = $r->templateAuthor ? $r->templateAuthor : null;
            $story->text_author = $r->textAuthor ? $r->textAuthor : null;
            $story->marked = $r->marked ? $r->marked : null;
            $story->year = $r->year ? $r->year : null;
            $story->lenght = $r->lenght ? $r->lenght : null;
            $story->school_author = $r->school_author ? $r->school_author : null;
            $story->photographer = $r->photographer ? $r->photographer : null;
            if($r->onlyUser){
                $story->onlyUser = true;
            } else {
                $story->onlyUser = false;
            }
            if($story->save()){
                flash("Položka byla úspěšně upravena")->success();
                return redirect(route("admin-storyEditView", $story->id));
            }
        }
        flash("Něco se pokazilo")->error();
        return back();
    }

    public function createImage(Request $r){
        $image = new StoryChildrensModel;
        if($r->id){
            $image->gid = $r->id;
            if($r->text){
                $image->text = $r->text;
            }
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

    public function deleteImage(Request $r){
        if($r->id){
            $gallery = StoryChildrensModel::all()->where("id", $r->id)->first();
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

    public function updateImage(Request $r){
        if($r->id){
            $image = StoryChildrensModel::all()->where("id", $r->id)->first();
            if($r->text){
                $image->text = $r->text;
            }
            if($r->file('image')){
                $file = public_path($image->path);
                if (file_exists($file)) {
                    unlink($file);
                }
                $randomName = $r->file('image')->hashName();
                $r->file('image')->move(public_path('storage/imgs/'.$r->id.''), $randomName);
                $image->img = "/storage/imgs/".$r->id."/".$randomName;
                $image->path = "/storage/imgs/".$r->id."/".$randomName;
            }
            if($image->save()){
                flash("Obrázek byl úspěšně upraven")->success();
                return back();
            }
        }
        flash("Něco se pokazilo")->error();
        return back();
    }
}
