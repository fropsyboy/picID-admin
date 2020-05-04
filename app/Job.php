<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    protected $fillable = [
        'user_id', 'title', 'location', 'type', 'experience', 'salary', 'start', 'end', 'needed', 'description',
    ];

    public function company()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function cleanCompany()
    {
        return $this->belongsTo('App\User','user_id')->select(['id', 'name', 'country', 'state', 'sector', 'industry', 'description']);
    }
}
