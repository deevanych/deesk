<?php

namespace App\Observers;

use App\Activity;
use App\Events\IssueCommentAdded;
use App\IssueComment;
use Illuminate\Support\Facades\Auth;

class IssueCommentObserver
{
    /**
     * Handle the issue comment "created" event.
     *
     * @param  \App\IssueComment  $issueComment
     * @return void
     */
    public function created(IssueComment $issueComment)
    {
        //

        event(new IssueCommentAdded($issueComment));

        $user = Auth::user();
        $organization = $user->organization;

        $client_organization_id = ($organization->parent_id ? $organization->parent_id : $organization->id);
        $service_organization_id = $organization->id;
        if ($organization->isClient()) {
            $client_organization_id = $organization->id;
            $service_organization_id = $organization->parent_id;
        }
        $activity = new Activity();
        $activity->issue_id = $issueComment->issue->id;
        $activity->service_organization_id = $service_organization_id;
        $activity->client_organization_id = $client_organization_id;
        $activity->author_id = $user->id;
        $activity->type = Activity::ISSUE_COMMENT_CREATED;

        $activity->save();
    }

    /**
     * Handle the issue comment "updated" event.
     *
     * @param  \App\IssueComment  $issueComment
     * @return void
     */
    public function updated(IssueComment $issueComment)
    {
        //
    }

    /**
     * Handle the issue comment "deleted" event.
     *
     * @param  \App\IssueComment  $issueComment
     * @return void
     */
    public function deleted(IssueComment $issueComment)
    {
        //
    }

    /**
     * Handle the issue comment "restored" event.
     *
     * @param  \App\IssueComment  $issueComment
     * @return void
     */
    public function restored(IssueComment $issueComment)
    {
        //
    }

    /**
     * Handle the issue comment "force deleted" event.
     *
     * @param  \App\IssueComment  $issueComment
     * @return void
     */
    public function forceDeleted(IssueComment $issueComment)
    {
        //
    }
}
