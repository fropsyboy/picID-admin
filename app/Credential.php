<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    //
    protected $fillable = [
        'user_id', 'qualification', 'examing_body', 'subjects', 'o_level_passed', 'skills', 'training_courses', 'degree', 'employment', 'hobbies', 'career_path', 'change_career', 'change_reason', 'guide',
    ];
}
