<?php

namespace App\Models\Story;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryChildrensModel extends Model
{
    use HasFactory;
    protected $table = 'story_childrens';

    public function story()
    {
        return $this->belongsTo(Story::class, 'gid', 'id');
    }
}
