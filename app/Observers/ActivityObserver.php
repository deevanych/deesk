<?php

namespace App\Observers;

use App\Activity;
use App\Events\ActivityCreated;
use App\Notification;

class ActivityObserver
{
    /**
     * Handle the activity "created" event.
     *
     * @param \App\Activity $activity
     * @return void
     */
    public function created(Activity $activity)
    {
        //
        $issue = $activity->issue;
        $usersIds = collect($issue->observers->pluck('id'));
        $usersIds = $usersIds->merge([$issue->author_id, $issue->employee_id, $activity->user_id]);
        foreach ($usersIds->unique() as $userId) {
            if ($userId === null || $userId === $activity->author_id) {
                continue;
            }
            Notification::create(
                [
                    'user_id' => $userId,
                    'activity_id' => $activity->id,
                ]
            );
        }
        event(new ActivityCreated($activity->load('issue')));
    }

    /**
     * Handle the activity "updated" event.
     *
     * @param \App\Activity $activity
     * @return void
     */
    public function updated(Activity $activity)
    {
        //
    }

    /**
     * Handle the activity "deleted" event.
     *
     * @param \App\Activity $activity
     * @return void
     */
    public function deleted(Activity $activity)
    {
        //
    }

    /**
     * Handle the activity "restored" event.
     *
     * @param \App\Activity $activity
     * @return void
     */
    public function restored(Activity $activity)
    {
        //
    }

    /**
     * Handle the activity "force deleted" event.
     *
     * @param \App\Activity $activity
     * @return void
     */
    public function forceDeleted(Activity $activity)
    {
        //
    }
}
