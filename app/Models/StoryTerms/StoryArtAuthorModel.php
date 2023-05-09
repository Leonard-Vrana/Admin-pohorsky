<?php

namespace App\Models\StoryTerms;

use App\Models\Story\StoryModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryArtAuthorModel extends Model
{
    use HasFactory;
    protected $table = 'story_art_author';

    public function stories()
    {
        return $this->hasMany(StoryModel::class, 'art_author');
    }

}