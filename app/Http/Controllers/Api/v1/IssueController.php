<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Issue;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        return $issue->load('type', 'priority');
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
        return array('status' => 'success', 'updated' => true, 'message' => 'Заявка обновлена', 'issue' => $issue->fresh());
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
