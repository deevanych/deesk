<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int issue_id
 * @property int service_organization_id
 * @property int client_organization_id
 * @property int author_id
 * @property int type
 * @property int comment_id
 * @property int issue_status_id
 * @property int user_id
 * @property object issue
 */
class Activity extends Model
{
    //
    const ISSUE_COMMENT_CREATED = 1;
    const ISSUE_COMMENT_DELETED = 2;
    const ISSUE_STATUS_CHANGED = 3;
    const ISSUE_ACCEPTED = 4;
    const ISSUE_TYPE_CHANGED = 5;
    const ISSUE_PRIORITY_CHANGED = 6;
    const ISSUE_CREATED = 7;
    const ISSUE_EMPLOYEE_CHANGED = 8;
    const ISSUE_STATUS_CREATED = 9;
    const ISSUE_TYPE_CREATED = 10;
    const ISSUE_PRIORITY_CREATED = 11;
    const ORGANIZATION_CLIENT_CREATED = 12;
    const ORGANIZATION_CONTACT_CREATED = 13;
    const ORGANIZATION_CREATED = 14;

    protected $with = [
        'author',
        'user',
        'issueStatus',
        'issue'
    ];

    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function issue()
    {
        return $this->belongsTo('App\Issue', 'issue_id');
    }

    public function issueStatus()
    {
        return $this->belongsTo('App\IssueStatus', 'issue_status_id');
    }
}
