<?php

namespace App\Models\Story;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryTagRelations extends Model
{
    use HasFactory;
    protected $table = 'story_tag_relations';
    protected $fillable = ['tag_id', "story_id"];
    
}
