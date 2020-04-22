<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $id)
 * @property mixed id
 */
class Issue extends Model
{
    //
    protected $with = ['author', 'employee', 'status'];
    protected $hidden = ['author_id', 'employee_id', 'issue_status_id', 'issue_type_id', 'issue_priority_id'];
    protected $casts = [
        'created_at' => 'datetime:d.m.Y / H:i',
    ];
    protected $appends = ['link'];

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

    public function getLinkAttribute()
    {
        return route('api.issues.show', $this->id);
    }
}
