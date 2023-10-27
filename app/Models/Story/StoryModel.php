<?php

namespace App\Models\Story;

use App\Models\User\UserNotes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryModel extends Model
{
    use HasFactory;
    protected $table = 'story';

    public function storyChildrens()
    {
        return $this->hasMany(StoryChildrensModel::class, 'gid', 'id');
    }

    public function notes()
    {
        return $this->hasMany(UserNotes::class, "story_id");
    }

    public function tags()
    {
        return $this->belongsToMany(StoryTags::class, 'story_tag_relations', 'story_id', 'tag_id');
    }
}
