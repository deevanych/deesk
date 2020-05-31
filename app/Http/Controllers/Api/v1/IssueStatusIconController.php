<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\IssueStatusIcon;
use Illuminate\Http\Request;

class IssueStatusIconController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return IssueStatusIcon::all();
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
     * @param  \App\IssueStatusIcon  $issueStatusIcon
     * @return \Illuminate\Http\Response
     */
    public function show(IssueStatusIcon $issueStatusIcon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IssueStatusIcon  $issueStatusIcon
     * @return \Illuminate\Http\Response
     */
    public function edit(IssueStatusIcon $issueStatusIcon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IssueStatusIcon  $issueStatusIcon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IssueStatusIcon $issueStatusIcon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IssueStatusIcon  $issueStatusIcon
     * @return \Illuminate\Http\Response
     */
    public function destroy(IssueStatusIcon $issueStatusIcon)
    {
        //
    }
}
