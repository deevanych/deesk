<?php

namespace App\Http\Controllers;

use App\IssueFile;
use Carbon\Carbon;
use Carbon\CarbonTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return CarbonTimeZone::create();
        return Carbon::now();
        return date(time());
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
     * @param \App\IssueFile $issueFile
     * @return \Illuminate\Http\Response
     */
    public function show(IssueFile $issueFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\IssueFile $issueFile
     * @return \Illuminate\Http\Response
     */
    public function edit(IssueFile $issueFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\IssueFile $issueFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IssueFile $issueFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\IssueFile $issueFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(IssueFile $issueFile)
    {
        //
    }
}
