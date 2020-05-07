<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\IssueType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IssueTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Auth::user()->organization->issueTypes;
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\IssueType $issueType
     * @return \Illuminate\Http\Response
     */
    public function show(IssueType $issueType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\IssueType $issueType
     * @return \Illuminate\Http\Response
     */
    public function edit(IssueType $issueType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\IssueType $issueType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IssueType $issueType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\IssueType $issueType
     * @return \Illuminate\Http\Response
     */
    public function destroy(IssueType $issueType)
    {
        //
    }
}
