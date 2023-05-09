<?php

namespace App\Models\Story;

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
}
