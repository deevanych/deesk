<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Organization;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Organization[]|Collection
     */
    public function index(Request $request)
    {
        //
        return $request->user()->organization->clients;
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
     * @param int Organization $organization
     * @return Response
     */
    public function show(Organization $organization)
    {
        //
        return $organization->load('profile');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int Organization $organization
     * @return Response
     */
    public function edit(Organization $organization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int Organization $organization
     * @return Response
     */
    public function update(Request $request, Organization $organization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int Organization $organization
     * @return Response
     */
    public function destroy(Organization $organization)
    {
        //
    }
}
