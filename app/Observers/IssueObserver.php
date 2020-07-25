<?php

namespace App\Observers;

use App\Activity;
use App\Issue;
use Illuminate\Support\Facades\Auth;

class IssueObserver
{
    /**
     * Handle the issue "created" event.
     *
     * @param \App\Issue $issue
     * @return void
     */
    public function created(Issue $issue)
    {
        //
        $user = Auth::user();
        $organization = $user->organization;

        $client_organization_id = ($organization->parent_id ? $organization->parent_id : $organization->id);
        $service_organization_id = $organization->id;
        if ($organization->isClient()) {
            $client_organization_id = $organization->id;
            $service_organization_id = $organization->parent_id;
        }
        $activity = new Activity();
        $activity->issue_id = $issue->id;
        $activity->service_organization_id = $service_organization_id;
        $activity->client_organization_id = $client_organization_id;
        $activity->author_id = $user->id;
        $activity->type = Activity::ISSUE_CREATED;

        $activity->save();

    }

    /**
     * Handle the issue "updating" event.
     *
     * @param \App\Issue $issue
     * @return void
     */
    public function updated(Issue $issue)
    {
        //
        $changes = $issue->getDirty();

        $user = Auth::user();
        $organization = $user->organization;

        $client_organization_id = $issue->author_organization_id;
        $service_organization_id = $organization->id;
        if ($organization->isClient()) {
            $client_organization_id = $organization->id;
            $service_organization_id = $organization->parent_id;
        }
        $activity = new Activity();
        $activity->issue_id = $issue->id;
        $activity->service_organization_id = $service_organization_id;
        $activity->client_organization_id = $client_organization_id;
        $activity->author_id = $user->id;

        if (array_key_exists('issue_status_id', $changes)) {
            $activity->issue_status_id = $changes['issue_status_id'];
            $type = Activity::ISSUE_STATUS_CHANGED;
        }
        if (array_key_exists('employee_id', $changes)) {
            $currentEmployee = $issue->getOriginal('employee_id');
            $type = ($currentEmployee ? Activity::ISSUE_EMPLOYEE_CHANGED : Activity::ISSUE_ACCEPTED);
            $activity->user_id = $issue->employee_id;
        }
        $activity->type = $type;

        $activity->save();
    }

    /**
     * Handle the issue "deleted" event.
     *
     * @param \App\Issue $issue
     * @return void
     */
    public function deleted(Issue $issue)
    {
        //
    }

    /**
     * Handle the issue "restored" event.
     *
     * @param \App\Issue $issue
     * @return void
     */
    public function restored(Issue $issue)
    {
        //
    }

    /**
     * Handle the issue "force deleted" event.
     *
     * @param \App\Issue $issue
     * @return void
     */
    public function forceDeleted(Issue $issue)
    {
        //
    }
}
