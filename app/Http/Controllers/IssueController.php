<?php

namespace App\Http\Controllers;

use App\Issue;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class IssueController extends Controller
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
        return $request->user()->organization->issues;
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
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|max:50|min:4',
            'description' => 'max:10000000',
        ]);

        $organization = Auth::user()->organization;
        $observers = $request->observer_ids;
        $request = $request->except('author', 'observer_ids');

        $issueStatus = $organization->issueStatuses()->where('type_id', '=', 2)->first();
        if (!$issueStatus) {
            $issueStatus = $organization->issueStatuses()->first();
        }

        $issue = new Issue($request);
        $issue->author_id = Auth::user()->id;
        $issue->issue_status_id = $issueStatus->id;
        $issue->author_organization_id = $organization->id;
        $issue->organization_id = ($organization->isClient() ? $organization->parent_id : $organization->id);

        $issue->save();

        $issue->observers()->attach($observers);

        return array('status' => 'success', 'created' => true, 'message' => 'Заявка создана', 'issue' => $issue);
    }

    /**
     * Display the specified resource.
     *
     * @param Issue $issue
     * @return Issue
     */
    public function show(Issue $issue)
    {
        //
        return $issue->load('type', 'priority', 'observers')->append('favorite');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Issue $issue
     * @return Response
     */
    public function edit(Issue $issue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Issue $issue
     * @return Issue
     */
    public function update(Request $request, Issue $issue)
    {
        //
        $issue->update($request->all());
        return array('status' => 'success', 'updated' => true, 'message' => 'Заявка обновлена', 'issue' => $issue->fresh()->load('type', 'priority', 'observers')->append('favorite'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Issue $issue
     * @return Response
     */
    public function destroy(Issue $issue)
    {
        //
    }
}
