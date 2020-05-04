<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'm_name', 'l_name', 'gender', 'dob', 'phone', 'phone2', 'type',
        'country', 'state', 'username', 'facebook', 'twitter', 'linkd', 'insta', 'others', 
        'contact_person1', 'contact_person2', 'years', 'sector', 'staff_size', 'description', 
        'cac_number', 'industry', 'image_path', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->hasOne('App\Role','user_id');
    }

    public function credentials()
    {
        return $this->hasOne('App\Credential','user_id');
    }
}
