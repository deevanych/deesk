<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\IssueStatusType;
use Illuminate\Http\Request;

class IssueStatusTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return IssueStatusType::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IssueStatusType  $issueStatusType
     * @return \Illuminate\Http\Response
     */
    public function show(IssueStatusType $issueStatusType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IssueStatusType  $issueStatusType
     * @return \Illuminate\Http\Response
     */
    public function edit(IssueStatusType $issueStatusType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IssueStatusType  $issueStatusType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IssueStatusType $issueStatusType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IssueStatusType  $issueStatusType
     * @return \Illuminate\Http\Response
     */
    public function destroy(IssueStatusType $issueStatusType)
    {
        //
    }
}
