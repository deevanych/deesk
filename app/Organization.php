<?php

namespace App;

use http\Env\Request;
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

    public function issueStatuses($withDeleted = false)
    {
        $issueStatuses = $this->hasMany('App\IssueStatus');
        if ($this->isClient()) {
            $issueStatuses = $this->hasMany('App\IssueStatus', 'organization_id', 'parent_id');
        }
        if ($withDeleted) {
            return $issueStatuses;
        }
        return $issueStatuses->whereActive(true);
    }

    public function getIssueStatuses($withDeleted = false)
    {
        $issueStatuses = $this->hasMany('App\IssueStatus');
        if ($this->isClient()) {
            $issueStatuses = $this->hasMany('App\IssueStatus', 'organization_id', 'parent_id');
        }
        if ($withDeleted) {
            return $issueStatuses->get();
        }
        return $issueStatuses->whereActive(true)->get();
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

    public function issueTypes($withDeleted = false) {
        $issueTypes = $this->hasMany('App\IssueType');
        if ($withDeleted) {
            return $issueTypes->get();
        }
        return $issueTypes->whereActive(true);
    }

    public function getIssueTypes($withDeleted = false) {
        $issueTypes = $this->hasMany('App\IssueType');
        if ($withDeleted) {
            return $issueTypes->get();
        }
        return $issueTypes->whereActive(true)->get();
    }

    public function issuePriorities($withDeleted = false) {
        $issuePriorities = $this->hasMany('App\IssuePriority');
        if ($withDeleted) {
            return $issuePriorities->get();
        }
        return $issuePriorities->whereActive(true);
    }

    public function getIssuePriorities($withDeleted = false) {
        $issuePriorities = $this->hasMany('App\IssuePriority');
        if ($withDeleted) {
            return $issuePriorities->get();
        }
        return $issuePriorities->whereActive(true)->get();
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
