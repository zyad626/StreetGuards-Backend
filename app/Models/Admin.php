<?php
namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Auth\Passwords\CanResetPassword;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Jenssegers\Mongodb\Eloquent\Model as MongoModel;

class Admin extends MongoModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    protected $fillable = ['login_name', 'email', 'password', 'is_active', 'user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
