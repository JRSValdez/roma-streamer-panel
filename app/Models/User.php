<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'streamer_attributes'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'streamer_attributes' => 'object',
        'created_at' => 'datetime:Y-m-d h:i',
    ];

    protected $appends = ['site_name','site_desc'];

    public function getSiteNameAttribute(){
        $info = AdminConfiguration::all()->first()->getSiteInfo();
        return $info->site_name;
    }

    public function getSiteDescAttribute(){
        $info = AdminConfiguration::all()->first()->getSiteInfo();
        return $info->site_description;
    }

    public function isAdmin(){
        return ($this->type == 2);
    }

    public function isStreamer(){
        return ($this->type == 1);
    }

    public function isUser(){
        return ($this->type == 0);
    }

}
