<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\RegistrationType;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        return User::all();
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
     * @param Request $request
     * @return void
     */
    public function show(Request $request)
    {
        //
        return ($request->user === 'my') ? Auth::user() : User::findOrFail($request->user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param RegistrationType $registrationType
     * @return Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param RegistrationType $registrationType
     * @return Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RegistrationType $registrationType
     * @return Response
     */
    public function destroy(User $user)
    {
        //
    }
}
