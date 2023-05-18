<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotes extends Model
{
    use HasFactory;
    protected $table = 'user_notes';
}
