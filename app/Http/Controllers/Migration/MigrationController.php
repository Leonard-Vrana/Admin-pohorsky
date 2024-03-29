<?php

namespace App\Http\Controllers\Migration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Story\StoryModel;
use App\Models\Story\StoryChildrensModel;
use App\Models\Story\StoryTagRelations;
use App\Models\Story\StoryTags;
use App\Models\StoryTerms\StoryArtAuthorModel;
use App\Models\StoryTerms\StoryMakerModel;
use App\Models\StoryTerms\StoryPublisherModel;
use App\Models\StoryTerms\StoryTemplateAuthorModel;
use App\Models\StoryTerms\StoryTextAuthorModel;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MigrationController extends Controller
{
    public function make(){
        $conn = DB::connection("mysql2");
        $items = $conn->select("SELECT * FROM wp_6_participants_database ORDER BY id ASC");
        foreach($items as $key => $item){
            $gallery = $conn->select("SELECT * FROM wp_2_ngg_gallery WHERE gid = $item->id");
            if($gallery){
                $galleryId= $gallery[0]->gid;
                $wct4 = $conn->select("SELECT * FROM wp_2_wct4 WHERE id = $galleryId");
                $images = $conn->select("SELECT * FROM wp_2_ngg_pictures WHERE galleryid = $galleryId");
            } else {
                $images = [];
            }
            $story = new StoryModel;
            $story->id = $item->id;
            $story->language = "cz";
            $story->title = $item->nazev;
            $story->note = $item->poznamka.$item->text;
            $story->annotation = $item->anotace;
            $story->height = $item->vyska;
            $story->have = $item->mam;
            $story->file = $item->soubor;
            $story->attribute = $item->atribut;
            $story->labels = $item->stitky;
            $story["prop-text"] = $item->proptext;
            $story->collection = $item->sbirka;
            $story->editor = $item->redaktor;
            $story->translator = $item->preklad;
            
            if($item->napsal){
                $findStoryWriterAuthor = StoryTextAuthorModel::all()->where("name", $item->napsal)->first();
                if($findStoryWriterAuthor){
                    $story->text_author = $findStoryWriterAuthor->id;
                } else {
                    $writerAuthor = new StoryTextAuthorModel;
                    $writerAuthor->name = $item->napsal;
                    if($writerAuthor->save()){
                        $story->text_author = $writerAuthor->id;
                    }
                }
            }
            if($item->oznaceni){
                $story->marked = $item->oznaceni;
            }
            if($item->vyrobce){
                $findMaker = StoryMakerModel::all()->where("name", $item->vyrobce)->first();
                if($findMaker){
                    $story->maker = $findMaker->id;
                } else {
                    $maker = new StoryMakerModel;
                    $maker->name = $item->vyrobce;
                    if($maker->save()){
                        $story->maker = $maker->id;
                    }
                }
            }
            if($item->rok){
                $story->year = $item->rok;
            }
            if($item->delka){
                $story->lenght = $item->delka;
            }
            if($item->podle){
                $findStoryTemplateAuthor = StoryTemplateAuthorModel::all()->where("name", $item->podle)->first();
                if($findStoryTemplateAuthor){
                    $story->template_author = $findStoryTemplateAuthor->id;
                } else {
                    $templateAuthor = new StoryTemplateAuthorModel;
                    $templateAuthor->name = $item->podle;
                    if($templateAuthor->save()){
                        $story->template_author = $templateAuthor->id;
                    }
                }
            }
            if($wct4){
                if($wct4[0]->kreslil){
                    $findStoryAuthor = StoryArtAuthorModel::all()->where("name", $wct4[0]->kreslil)->first();
                    if($findStoryAuthor){
                        $story->art_author = $findStoryAuthor->id;   
                    } else {
                        $artAuthor = new StoryArtAuthorModel();
                        $artAuthor->name = $wct4[0]->kreslil;
                        if($artAuthor->save()){
                            $story->art_author = $artAuthor->id;
                        }
                    }
                }
            }

            if($item->vydavatel){
                $findPublisher = StoryPublisherModel::all()->where("name", $item->vydavatel)->first();
                if($findPublisher){
                    $story->publisher = $findPublisher->id;
                } else {
                    $publisher = new StoryPublisherModel;
                    $publisher->name = $item->vydavatel;
                    if($publisher->save()){
                        $story->publisher = $publisher->id;
                    }
                }
            }

            if($item->obrazek){
                $story->img = $item->obrazek;
            }
            $story->domain = 2000 >= $item->id ? json_encode(['anime']) : json_encode(['other']);
            $story->save();
            if($gallery){
                foreach($images as $image){
                    $children = new StoryChildrensModel;
                    $children->gid = $item->id;
                    $children->path = "https://kolicky.cz/".$gallery[0]->path."/".$image->filename;
                    $children->img = "false";
                    // $children->path = 'images/'.$randomName.'.jpg';
                    // $children->img = Storage::url('images/'.$randomName.'.jpg');
                    $children->text = $image->description;
                    $children->save();
                }
            }

        }
    }

    // public function migrateImages(){
    //     $images = StoryChildrensModel::all()->where("img", "false");
    //     foreach($images as $image){
    //         try {
    //             $randomName = Str::random(40) . '.jpg';
    //             $contents = file_get_contents($image->path);
    //             Storage::put('public/storage/imgs/'.$image->gid.'/' . $randomName, $contents);
    //             $image->path = '/storage/imgs/'.$image->gid.'/'.$randomName.'';
    //             $image->img = '/storage/imgs/'.$image->gid.'/'.$randomName.'';
    //             if($image->save()){
    //             }
    //         } catch(Exception $e){
    //         }
    //     }
    // }

    // public function rand(){
    //     $stories = StoryModel::all()->where("domain", '["skAnime"]')->where("language", "sk");
    //     foreach($stories as $story){
    //         $gallery = StoryChildrensModel::all()->where("gid", $story->id);
    //         foreach($gallery as $gallery){
    //             $gallery->path = "/".$gallery->path;
    //             $gallery->img = "/".$gallery->img;
    //             $gallery->save();
    //         }
    //     }
    // }

    public function deleteSK(){
        $stories = StoryModel::all()->where("domain", '["skAnime"]')->where("language", "sk");
        foreach($stories as $story){
            $gallery = StoryChildrensModel::all()->where("gid", $story->id);
            foreach($gallery as $item){
                // $file = public_path($item->path);
                // if(file_exists($file)){
                //     if(unlink($file)){
                //     }
                // }
                $item->delete();
            }
            $story->delete();
        }
    }

    public function migrateSK(){
        $conn = DB::connection("mysql2");
        $items = $conn->select("SELECT * FROM wp_6_participants_database ORDER BY id ASC");
        foreach($items as  $item){
            if($item->sktext == "ano" || $item->sktext == "preklad"){
                $gallery = $conn->select("SELECT * FROM wp_3_ngg_gallery WHERE gid = $item->id");
                if($gallery){
                    $galleryId= $gallery[0]->gid;
                    $wct4 = $conn->select("SELECT * FROM wp_2_wct4 WHERE id = $galleryId");
                    $images = $conn->select("SELECT * FROM wp_3_ngg_pictures WHERE galleryid = $galleryId");
                } else {
                    $images = [];
                }
                    $story = new StoryModel;
                    $story->language = "sk";
                    $story->title = $item->sknazev;
                    $story->note = $item->poznamka.$item->text;
                    $story->annotation = $item->anotace;
                    $story->height = $item->vyska;
                    $story->have = $item->mam;
                    $story->file = $item->soubor;
                    $story->attribute = $item->atribut;
                    $story->labels = $item->stitky;
                    $story["prop-text"] = $item->proptext;
                    $story->collection = $item->sbirka;
                    $story->editor = $item->redaktor;
                    $story->translator = $item->preklad;
                    if($item->napsal){
                        $findStoryWriterAuthor = StoryTextAuthorModel::all()->where("name", $item->napsal)->first();
                        if($findStoryWriterAuthor){
                            $story->text_author = $findStoryWriterAuthor->id;
                        } else {
                            $writerAuthor = new StoryTextAuthorModel;
                            $writerAuthor->name = $item->napsal;
                            if($writerAuthor->save()){
                                $story->text_author = $writerAuthor->id;
                            }
                        }
                    }
                    if($item->oznaceni){
                        $story->marked = $item->oznaceni;
                    }
                    if($item->vyrobce){
                        $findMaker = StoryMakerModel::all()->where("name", $item->vyrobce)->first();
                        if($findMaker){
                            $story->maker = $findMaker->id;
                        } else {
                            $maker = new StoryMakerModel;
                            $maker->name = $item->vyrobce;
                            if($maker->save()){
                                $story->maker = $maker->id;
                            }
                        }
                    }
                    if($item->rok){
                        $story->year = $item->rok;
                    }
                    if($item->delka){
                        $story->lenght = $item->delka;
                    }
                    if($item->podle){
                        $findStoryTemplateAuthor = StoryTemplateAuthorModel::all()->where("name", $item->podle)->first();
                        if($findStoryTemplateAuthor){
                            $story->template_author = $findStoryTemplateAuthor->id;
                        } else {
                            $templateAuthor = new StoryTemplateAuthorModel;
                            $templateAuthor->name = $item->podle;
                            if($templateAuthor->save()){
                                $story->template_author = $templateAuthor->id;
                            }
                        }
                    }
                    if($wct4){
                        if($wct4[0]->kreslil){
                            $findStoryAuthor = StoryArtAuthorModel::all()->where("name", $wct4[0]->kreslil)->first();
                            if($findStoryAuthor){
                                $story->art_author = $findStoryAuthor->id;   
                            } else {
                                $artAuthor = new StoryArtAuthorModel();
                                $artAuthor->name = $wct4[0]->kreslil;
                                if($artAuthor->save()){
                                    $story->art_author = $artAuthor->id;
                                }
                            }
                        }
                    }
        
                    if($item->vydavatel){
                        $findPublisher = StoryPublisherModel::all()->where("name", $item->vydavatel)->first();
                        if($findPublisher){
                            $story->publisher = $findPublisher->id;
                        } else {
                            $publisher = new StoryPublisherModel;
                            $publisher->name = $item->vydavatel;
                            if($publisher->save()){
                                $story->publisher = $publisher->id;
                            }
                        }
                    }
        
                    if($item->obrazek){
                        $story->img = $item->obrazek;
                    }
                    $story->domain = json_encode(['skAnime']);
                    $story->save();
                    if($gallery){
                        foreach($images as $image){
                            $children = new StoryChildrensModel;
                            $children->gid = $story->id;
                            $children->path = "http://localhost/".$gallery[0]->path."/".$image->filename;
                            $children->img = "false";
                            $children->text = $image->description;
                            $children->save();
                        }
                    }
                
            }
        }
    }


    public function annotation(){
        $conn = DB::connection("mysql2");
        $stories = StoryModel::all();
        foreach($stories as $story){
            $item = $conn->select("SELECT * FROM wp_6_participants_database WHERE id = $story->id");
            if(!empty($item[0])){
                $story->annotation = $item[0]->anotace;
                if($story->save()){

                }
            }
        } 
    }

    public function images(){
        $images = StoryChildrensModel::all();
        foreach($images as $image){
            $image->path = $image->img;
            if($image->save()){

            }
        }
    }

    public function migrate2(){
        $conn = DB::connection("mysql2");
        $stories = StoryModel::all();
        foreach($stories as $story){
            $gallery = $conn->select("SELECT * FROM wp_6_ngg_gallery WHERE gid = $story->id");
            
        }        
    }

    public function reworkYears(){
        $stories = StoryModel::all();
        foreach($stories as $story){
            if($story->year == 80 || $story->year == 70 || $story->year == 60){
                $story->year = "19".$story->year;
                $story->note = $story->note." + "."výroba ".$story->year."léta";
                if($story->save()){
                    
                }
            }
        }
    }

    // public function migrateTags(){
    //     $stories = StoryModel::all();
    //     foreach($stories as $story){
    //         $file = $story->file;
    //         $array = explode(", ", $file);
    //         foreach($array as $item){
    //             if($item === "-"){
    //                 continue;
    //             }
    //             if(!$item){
    //                 continue;
    //             }
    //             $tag = StoryTags::firstOrCreate(['name' => $item]);
    //             $relation = StoryTagRelations::firstOrCreate(["tag_id" => $tag->id, "story_id" => $story->id]);
    //         }
    //     }
    // }

    // public function diaxImages(){
    //     $directory = public_path('storage/diaxImages');
    //     if (is_dir($directory)) {
    //         $folders = glob($directory . '/*', GLOB_ONLYDIR);
    //         $counter = 0;
    //         foreach ($folders as $folder) {
    //             $folderName = basename($folder);
    //             $story = StoryModel::all()->where("id", $folderName)->first();
    //             if($story){
    //                 $images = glob($folder . '/*');
    //                 foreach($images as $image){
    //                     $imageName = basename($image);
    //                     $newImage = new StoryChildrensModel;
    //                     $newImage->gid = $story->id;
    //                     $newImage->img = "/storage/diaxImages/".$folderName."/".$imageName;
    //                     $newImage->path = "/storage/diaxImages/".$folderName."/".$imageName;
    //                     if($newImage->save()){} else {
    //                         echo $folderName."/".$imageName;
    //                     }
    //                     $counter++;
    //                 }
    //             } else {
    //                 echo "Nenašiel sa záznam";
    //             }
    //         }
    //         echo $counter;
    //     } else {
    //         echo "Zadaný priečinok neexistuje.";
    //     }
    // }


    // public function migrationArtAuthor(){
    //     $stories = StoryModel::all();
    //     foreach($stories as $story){
    //         $author = $story->photographer;
    //         $findAuthor = StoryArtAuthorModel::all()->where("name", $author)->first();
    //         if($author){
    //             if($findAuthor)
    //             {
    //                 $story->text_author = $findAuthor->id;
    //                 $story->photographer = "";
    //                 if($story->save()){
    
    //                 }
    //             } else {
    //                 $newAuthor = new StoryArtAuthorModel;
    //                 $newAuthor->name = $author;
    //                 if($newAuthor->save()){
    //                     $story->text_author = $newAuthor->id;
    //                     $story->photographer = "";
    //                     if($story->save()){
                            
    //                     }
    //                 }
    //             }
    //         }
    //     }
    // }

    // public function generateSlug()
    // {
    //     $stories = StoryModel::all();

    //     foreach ($stories as $story) {
    //             $baseSlug = Str::slug($story->title, '-');
    //             $slug = $baseSlug;
    //             $counter = 1;

    //             while (StoryModel::where('slug', $slug)->exists()) {
    //                 if($counter > 1)
    //                 {
    //                     $slug = $baseSlug . '-' . $counter;
    //                 }
    //                 $counter++;
    //             }

    //             $story->slug = $slug;
    //             $story->save();
    //     }
    // }

}
