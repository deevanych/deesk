<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class IssueStatus extends Model
{
    //
    protected $with = ['icon', 'color'];
    protected $hidden = ['icon_id', 'color_id'];
    protected $appends = ['issuesCount'];

    public function icon()
    {
        return $this->hasOne('App\IssueStatusIcon', 'id', 'icon_id');
    }

    public function color()
    {
        return $this->hasOne('App\IssueStatusColor', 'id', 'color_id');
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
