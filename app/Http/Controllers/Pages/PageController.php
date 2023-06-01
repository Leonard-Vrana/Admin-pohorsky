<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Pages\PageModel;
use App\Models\Projects\ProjectModel;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function view(){
        return view("pages.Pages.index")
               ->with("pages", PageModel::paginate(20));
    }
    public function add(){
        return view("pages.Pages.add")
               ->with("projects", ProjectModel::all());
    }
    public function edit($id){
        if($id){
            $page = PageModel::all()->where("id", $id)->first();
            $urls = json_decode($page->domain);
            if($page){
                return view("pages.Pages.edit")
                       ->with("page", $page)
                       ->with("projects", ProjectModel::all())
                       ->with("urls", $urls);
            }
        }
        return back();
    }

    public function createPage(Request $r){
        if($r->title && $r->projects && $r->content){
            $page = new PageModel;
            $page->title = $r->title;
            $page->text = $r->content;
            $page->domain = json_encode($r->projects);
            if($page->save()){
                flash("Stránka byla úspěšně přidána")->success();
                return back();
            }
        }
        flash("Něco se pokazilo")->error();
        return back();
    }

    public function editPage(Request $r){
        if($r->title && $r->projects && $r->content && $r->id){
            $page = PageModel::all()->where("id", $r->id)->first();
            if($page){
                $page->title = $r->title;
                $page->text = $r->content;
                $page->domain = json_encode($r->projects);
                if($page->save()){
                    flash("Stránka byla úspěšně upravena")->success();
                    return back();
                }
            }
        }
        flash("Něco se pokazilo")->error();
        return back();
    }

    public function deletePage(Request $r){
        if($r->id){
            $page = PageModel::all()->where("id", $r->id)->first();
            if($page){
                if($page->delete()){
                    flash("Stránka byla úspěšně vymazána")->success();
                    return back();
                }
            }
        }
        flash("Něco se pokazilo")->error();
        return back();
    }
}
