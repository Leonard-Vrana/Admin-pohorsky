<?php

namespace App\Models\Story;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryTags extends Model
{
    use HasFactory;
    protected $table = 'story_tags';
    protected $fillable = ['name'];
}
