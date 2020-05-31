<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property array issueObservers
 */
class IssueRule extends Model
{
    //
    use SoftDeletes;

    protected $with = [
        'issueType',
        'issueClient',
        'issuePriority',
        'issueEmployee',
    ];

    protected $appends = [
      'observer_ids'
    ];

    protected $attributes = [
        'active' => true,
    ];

    protected $casts = [
        'observer_ids' => 'array'
    ];

    protected $guarded = [];

    public function issueType()
    {
        return $this->belongsTo('App\IssueType');
    }

    public function issuePriority()
    {
        return $this->belongsTo('App\IssuePriority');
    }

    public function issueClient()
    {
        return $this->belongsTo('App\Organization', 'client_id', 'id');
    }

    public function issueEmployee()
    {
        return $this->belongsTo('App\User', 'employee_id', 'id');
    }

    public function issueObservers()
    {
        return $this->belongsToMany('App\User', 'issue_rule_observers', 'issue_rule_id', 'user_id');
    }

    public function getObserverIdsAttribute()
    {
        return $this->issueObservers->pluck('id');
    }
}
