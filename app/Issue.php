<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @method static where(string $string, $id)
 * @method fill($all)
 * @method update($all)
 * @method save()
 * @method fresh()
 * @method static findOrFail($id)
 * @property mixed id
 */
class Issue extends Model
{
    //
    protected $with = [
        'author',
        'employee',
        'status',
    ];
    protected $hidden = [
        'author_id',
        'author_organization_id',
        'employee_id',
        'issue_status_id',
        'issue_type_id',
        'issue_priority_id',
    ];
    protected $casts = [
        'created_at' => 'datetime:d.m.Y / H:i',
        'updated_at' => 'datetime:d.m.Y / H:i',
    ];
    protected $appends = [
        'link',
    ];
    protected $attributes = [
        'favorite',
    ];
    protected $guarded = [];

    public function author()
    {
        return $this->hasOne('App\User', 'id', 'author_id');
    }

    public function employee()
    {
        return $this->hasOne('App\User', 'id', 'employee_id');
    }

    public function status()
    {
        return $this->hasOne('App\IssueStatus', 'id', 'issue_status_id');
    }

    public function type()
    {
        return $this->hasOne('App\IssueType', 'id', 'issue_type_id');
    }

    public function comments()
    {
        return $this->hasMany('App\IssueComment', 'issue_id');
    }

    public function priority()
    {
        return $this->hasOne('App\IssuePriority', 'id', 'issue_priority_id');
    }

    public function observers()
    {
        return $this->belongsToMany('App\User', 'favorite_issues', 'issue_id', 'user_id');
    }

    public function getLinkAttribute()
    {
        return route('api.issues.show', $this->id);
    }

    public function getFavoriteAttribute()
    {
        return (boolean)(FavoriteIssue::whereUserId(Auth::id())->whereIssueId($this->id)->count());
    }
}
