<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * @property mixed active
 */
class IssueStatus extends Model
{
    //
    use SoftDeletes;

    protected $attributes = [
        'active' => true,
    ];

    protected $guarded = [];
    protected $with = ['icon', 'color', 'type'];
    protected $appends = ['issuesCount'];

    public function icon()
    {
        return $this->hasOne('App\IssueStatusIcon', 'id', 'icon_id');
    }

    public function color()
    {
        return $this->hasOne('App\IssueStatusColor', 'id', 'color_id');
    }

    public function type()
    {
        return $this->hasOne('App\IssueStatusType', 'id', 'type_id');
    }

    public function organization()
    {
        return $this->belongsTo('App\Organization');
    }

    public function getIssuesAttribute()
    {
        return Auth::user()->organization->issues->where('issue_status_id', $this->id)->get();
    }

    public function getIssuesCountAttribute()
    {
        return Auth::user()->organization->issues->where('issue_status_id', $this->id)->count();
    }
}
