<?php

namespace App\Http\Controllers\Api\v1;

use App\FavoriteIssue;
use App\Http\Controllers\Controller;
use App\Issue;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class FavoriteIssueController extends Controller
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
        return $request->user()->favoriteIssues;
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
     * @return array
     */
    public function store(Request $request)
    {
        //
        Auth::user()->favoriteIssues()->attach($request->favorite);
        $issue = Issue::withTrashed()->find($request->favorite)->load('type', 'priority', 'observers')->append('favorite');
        return array('status' => 'success', 'toggled' => true, 'message' => 'Заявка добавлена в избранное', 'issue' => $issue);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\FavoriteIssue $favoriteIssue
     * @return Response
     */
    public function show(FavoriteIssue $favoriteIssue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\FavoriteIssue $favoriteIssue
     * @return Response
     */
    public function edit(FavoriteIssue $favoriteIssue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\FavoriteIssue $favoriteIssue
     * @return Response
     */
    public function update(Request $request, FavoriteIssue $favoriteIssue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return array
     */
    public function destroy(Request $request)
    {
        //
        Auth::user()->favoriteIssues()->detach($request->favorite);
        $issue = Issue::withTrashed()->find($request->favorite)->load('type', 'priority', 'observers')->append('favorite');
        return array('status' => 'success', 'toggled' => true, 'message' => 'Заявка удалена из избранного', 'issue' => $issue);
    }
}
