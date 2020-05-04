<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    //
    protected $fillable = [
        'user_id', 'job_id', 'status', 'note',  'request'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id')->select([
            'id', 'name', 'gender', 'state', 'phone', 'email',
            ]);
    }

    public function job()
    {
        return $this->belongsTo('App\Job','job_id')->select([
            'id', 'user_id' ,'title', 'location', 'type', 'needed', 'salary', 'start', 'end',
            ]);
    }
}
