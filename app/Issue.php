<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * @method static where(string $string, $id)
 * @method fill($all)
 * @method update($all)
 * @method save()
 * @method fresh()
 * @method static findOrFail($id)
 * @property int id
 * @property int employee_id
 * @property int organization_id
 * @property int author_organization_id
 * @property int author_id
 * @property int issue_status_id
 * @property bool service_created
 */
class Issue extends Model
{
    //
    use SoftDeletes;

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
    protected $appends = [
        'link',
        'my',
        'favorite',
        'isTrashed'
    ];

    protected $guarded = ['created_at'];

    public function author()
    {
        return $this->hasOne('App\User', 'id', 'author_id');
    }

    public function activity() {
        return $this->hasMany('App\Activity', 'issue_id')->orderByDesc('id');
    }

    public function employee()
    {
        return $this->hasOne('App\User', 'id', 'employee_id');
    }

    public function status()
    {
        return $this->belongsTo('App\IssueStatus', 'issue_status_id', 'id')->withTrashed();
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
        return ($this->id ? route('issues.show', $this->id) : null);
    }

    public function getFavoriteAttribute()
    {
        return (boolean)(FavoriteIssue::whereUserId(Auth::id())->whereIssueId($this->id)->count());
    }

    public function getMyAttribute(): bool
    {
        return (boolean)(Auth::id() === $this->employee_id);
    }

    public function getIsTrashedAttribute(): bool {
        return $this->trashed();
    }
}
