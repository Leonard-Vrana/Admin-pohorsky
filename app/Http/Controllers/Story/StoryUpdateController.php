<?php

namespace App\Http\Controllers\Story;

use App\Http\Controllers\Controller;
use App\Http\Requests\Story\StoryCreateRequest;
use App\Models\Projects\ProjectModel;
use App\Models\Story\StoryChildrensModel;
use App\Models\Story\StoryLongImagesModel;
use App\Models\Story\StoryModel;
use App\Models\StoryTerms\StoryArtAuthorModel;
use App\Models\StoryTerms\StoryMakerModel;
use App\Models\StoryTerms\StoryPublisherModel;
use App\Models\StoryTerms\StoryTemplateAuthorModel;
use App\Models\StoryTerms\StoryTextAuthorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoryUpdateController extends Controller
{
    public function view($id){
        $model = StoryModel::all()->where("id", $id)->first();
        if($model){
            $projectValue = json_decode($model->domain);
            return view("pages.Story.update")
                   ->with("story", $model)
                   ->with("makers", StoryMakerModel::all())
                   ->with("artAuthors", StoryArtAuthorModel::all())
                   ->with("templateAuthors", StoryTemplateAuthorModel::all())
                   ->with("textAuthors", StoryTextAuthorModel::all())
                   ->with("projects", ProjectModel::all())
                   ->with("publishers", StoryPublisherModel::all())
                   ->with("longImages", StoryLongImagesModel::all()->where("ticket_id", $model->id));
        }
        return redirect(route("admin-story"));
    }

    public function update(StoryCreateRequest $r){
        if($r->id){
            $story = StoryModel::all()->where("id", $r->id)->first();
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
            if($r->school_author){
                $story->school_author = $r->school_author;
            }
            if($r->photographer){
                $story->photographer = $r->photographer;
            }
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
        if($r->text && $r->id){
            $image->gid = $r->id;
            $image->text = $r->text;
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
        if($r->text && $r->id){
            $image = StoryChildrensModel::all()->where("id", $r->id)->first();
            $image->text = $r->text;
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
