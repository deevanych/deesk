<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed clients
 * @property mixed parent_id
 * @property mixed id
 * @method static findOrFail($get)
 */
class Organization extends Model
{
    //

//    protected $appends = ['image'];

    public function issueStatuses()
    {
        if ($this->isClient()) {
            return $this->hasMany('App\IssueStatus', 'organization_id', 'parent_id');
        }
        return $this->hasMany('App\IssueStatus');
    }

    public function activity() {
        $key = ($this->isClient()) ? 'client_organization_id' : 'service_organization_id';
        return $this->hasMany('App\Activity', $key)->orderByDesc('id');
    }

    public function issues()
    {
        $key = ($this->isClient()) ? 'author_organization_id' : 'organization_id';
        return $this->hasMany('App\Issue', $key);
    }

    public function issueTypes() {
        return $this->hasMany('App\IssueType');
    }

    public function issuePriorities() {
        return $this->hasMany('App\IssuePriority');
    }

    public function issueRules() {
        return $this->hasMany('App\IssueRule');
    }

    public function isClient()
    {
        return ($this->parent_id) ? true : false;
    }

    public function clientIssues()
    {
        return $this->hasMany('App\Issue', 'author_organization_id');
    }

    public function clients()
    {
        return $this->hasMany('App\Organization', 'parent_id')->withCount('clientIssues');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function parent()
    {
        return $this->belongsTo('App\Organization', 'parent_id');
    }

    public function profile() {
        return $this->hasOne('App\OrganizationProfile');
    }


//    public function getImageAttribute()
//    {
//        return asset('/storage/clients/' . $this->id . '.jpg');
//    }
}
