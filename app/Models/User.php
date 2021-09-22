<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    CONST USER_BLOGGER_TYPE = 'blogger';
    CONST USER_SUPERVISOR_TYPE = 'supervisor';
    CONST USER_ADMIN_TYPE = 'admin';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
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
        'last_login' => 'datetime'
    ];

    protected $appends = [
        'name'
    ];

    public function getNameAttribute()
    {
        return $this->first_name." ".$this->last_name;
    }

    public function getIsAdminAttribute()
    {
        return $this->user_type == self::USER_ADMIN_TYPE;
    }

    public function getIsSupervisorAttribute()
    {
        return $this->user_type == self::USER_SUPERVISOR_TYPE;
    }

    public function getIsBloggerAttribute()
    {
        return $this->user_type == self::USER_BLOGGER_TYPE;
    }


    public function blogs()
    {
        return $this->hasMany(Blog::class, 'created_by', 'id');
    }

    public function assignedBloggers()
    {
        return $this->belongsToMany(self::class, 'supervisor_bloggers', 'supervisor_id', 'blogger_id');
    }

    public function supervisors()
    {
        return $this->belongsToMany(self::class, 'supervisor_bloggers', 'blogger_id', 'supervisor_id');
    }
}
