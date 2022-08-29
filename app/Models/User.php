<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isRoot()
    {
        return $this->user_type === 'root';
    }

    public function hasRole($roles)
    {
        return in_array($this->user_type, $roles);
    }

    public static function getNameFromTeachers()
    {
        return User::where('user_type', '=', 'teacher')->get(['id', 'name']);
    }


    public static function getStudentsEmail($ids)
    {
        return User::where('user_type', '=', 'student')->whereNotIn('id', $ids)->get(['id', 'email']);
    }

    public static function getStudentsEmails($ids)
    {
        return User::where('user_type', '=', 'student')->whereIn('id', $ids)->get(['id', 'email']);
    }
}
