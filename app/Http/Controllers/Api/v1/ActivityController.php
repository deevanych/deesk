<?php

namespace App\Http\Controllers\Api\v1;

use App\Activity;
use App\Http\Controllers\Controller;
use App\Issue;
use App\Organization;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        //
        if ($request->get('user')) {
            $object = User::findOrFail($request->get('user'));
        } elseif ($request->get('organization')) {
            $object = Organization::findOrFail($request->get('organization'));
        } elseif ($request->get('issue')) {
            $object = Issue::withTrashed()->findOrFail($request->get('issue'));
        } else {
            if ($request->get('organization') === 'notifications') {
                $user = Auth::user();
                $count = ($request->get('count') ? $request->get('count') : 5);
                $offset = ($request->get('offset') ? $request->get('offset') * $count : 0);
                $activity = $user->notifications()->skip($offset)->take($count);

                return array('activities' => $activity);
            }
            $object = Auth::user()->organization;
        }

        $count = ($request->get('count') ? $request->get('count') : 5);
        $offset = ($request->get('offset') ? $request->get('offset') * $count : 0);
        $activity = $object->activity->skip($offset)->take($count);

        return array('activities' => $activity);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Activity $activity
     * @return Response
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Activity $activity
     * @return Response
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Activity $activity
     * @return Response
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Activity $activity
     * @return Response
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
