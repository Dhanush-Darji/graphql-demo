<?php

namespace App\Models;

use App\Traits\BaseModel;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use  HasApiTokens, Notifiable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
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

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function scopeSearch($query, $value)
    {
        return $query->where('name', 'like', '%'. $value .'%')
            ->orWhere('email', 'likes', '%'. $value .'%');
    }

    public function scopeName($query,$value)
    {
        return $query->where('name', $value);
    }

    public function scopeEmail($query, $value)
    {
        return $query->where('email',$value);
    }
}
