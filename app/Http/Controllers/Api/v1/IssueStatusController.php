<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\IssueStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IssueStatusController extends Controller
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
        return $request->user()->organization->issueStatuses;
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
     * @param IssueStatus $issueStatus
     * @return Response
     */
    public function show(IssueStatus $issueStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param IssueStatus $issueStatus
     * @return Response
     */
    public function edit(IssueStatus $issueStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param IssueStatus $issueStatus
     * @return Response
     */
    public function update(Request $request, IssueStatus $issueStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param IssueStatus $issueStatus
     * @return Response
     */
    public function destroy(IssueStatus $issueStatus)
    {
        //
    }
}
