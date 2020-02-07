<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Member extends Model
{
    use Notifiable;
    protected $table = 'members';
    protected $fillable = [
        'name', 'email', 'password','api_token'
    ];
    protected $hidden = [
        'password', 'api_token',
    ];
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */

}
