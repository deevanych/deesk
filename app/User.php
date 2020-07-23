<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kodeine\Acl\Traits\HasRole;
use Laravel\Passport\HasApiTokens;

/**
 * @property mixed role
 * @method static findOrFail($get)
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRole;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'organization_id',
        'roles',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = [
        'organization',
        'profile'
    ];

    protected $appends = [
        'permissions',
        'role',
    ];


    public function organization()
    {
        return $this->belongsTo('App\Organization');
    }

    public function profile() {
        return $this->hasOne('App\UserProfile');
    }

    public function activity() {
        return $this->hasMany('App\Activity', 'author_id')->orderByDesc('id');
    }

    public function favoriteIssues()
    {
        return $this->belongsToMany('App\Issue', 'favorite_issues', 'user_id', 'issue_id');
    }

    public function getRoleAttribute()
    {
        return $this->roles->first();
    }

    public function getPermissionsAttribute()
    {
        $role = $this->roles->first();
        return ($role ? $role->getPermissions() : null);
    }
}
