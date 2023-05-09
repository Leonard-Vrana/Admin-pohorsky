<?php

namespace App\Models\StoryTerms;

use App\Models\Story\StoryModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryTemplateAuthorModel extends Model
{
    use HasFactory;
    protected $table = 'story_template_author';

    public function stories()
    {
        return $this->hasMany(StoryModel::class, 'template_author');
    }
}
