<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use  Notifiable;
    protected $table = 'members';

    protected $fillable = [
        'name', 'email', 'password','api_token','level'
    ];
    protected $hidden = [
        'password', 'api_token'
    ];
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */

}
