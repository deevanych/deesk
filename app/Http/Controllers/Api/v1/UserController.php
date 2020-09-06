<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Organization;
use App\RegistrationType;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
        $organization = Auth::user()->organization;
        if ($organization->isClient()) {
            $users[] = ['title' => $organization->parent->title, 'users' => $organization->parent->users];
        } else {
            $clients = [];
            if ($request->type == 'employee') {
                return $organization->users;
            }
            foreach ($organization->clients as $client) {
                $clients[] = $client->id;
                $users[] = ['title' => $client->title, 'users' => $client->users];
            }
            if ($request->type == 'clients') {
                $search = $request->get('search')['value'];
                $clients = User::whereIn('organization_id', $clients);
                $columns = ['id', 'title', 'organization.title'];
                $clients = $clients->where(function ($query) use ($search) {
                    $query->where('title', 'LIKE', '%' . $search . '%')
                        ->OrWhere('id', '=', $search)
                        ->OrWhereHas('organization', function (Builder $query) use ($search) {
                            $query->where('title', 'LIKE', '%' . $search . '%');
                        });
                });
                $clientsCount = $clients->count();
                foreach ($request->get('order') as $order) {
                    $clients = $clients->orderBy($columns[$order['column']], $order['dir']);
                }
                $clients = $clients->get();
                $filteredCount = count($clients);
                $clients = $clients->slice($request->get('start'), $request->get('length'))->values();
                return array('data' => $clients, 'recordsTotal' => $clientsCount, 'recordsFiltered' => $filteredCount, 'draw' => $request->get('draw'));
            }
        }
        $users[] = ['title' => $organization->title, 'users' => $organization->users];
        return collect($users);
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
        return $request;
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
        return ($request->user === 'my') ? Auth::user()->load('profile') : User::findOrFail($request->user)->load('profile');
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
        return $request;
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
