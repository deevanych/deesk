<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\IssuePriority;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class IssuePriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        //
        $organization = Auth::user()->organization;
        if ($organization->isClient()) {
            return Auth::user()->organization->parent->issuePriorities($request->withDeleted);
        }
        return Auth::user()->organization->issuePriorities($request->withDeleted);
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
        $request->validate([
            'title' => 'required|max:50|min:4',
            'description' => 'max:50',
        ]);

        $issuePriority = Auth::user()->organization->issuePriorities()->create($request->all());
        return array('status' => 'success', 'created' => true, 'message' => 'Приоритет заявки создан', 'issuePriority' => $issuePriority);
    }

    /**
     * Display the specified resource.
     *
     * @param IssuePriority $issuePriority
     * @return void
     */
    public function show(IssuePriority $issuePriority)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param IssuePriority $issuePriority
     * @return void
     */
    public function edit(IssuePriority $issuePriority)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param IssuePriority $priority
     * @return array
     */
    public function update(Request $request, IssuePriority $priority)
    {
        //
        $request->validate([
            'title' => 'required|max:50|min:4',
            'description' => 'max:50',
        ]);

        $priority->update($request->all());
        $message = 'Приоритет заявки обновлен';
        if ($priority->wasChanged('active')) {
            $message = ($priority->active) ? 'Приоритет заявки включен' : 'Приоритет заявки выключен';
        }
        if ($priority->wasChanged('deleted_at')) {
            $message = ($priority->deleted_at) ? 'Приоритет заявки удален' : 'Приоритет заявки восстановлен';
        }
        return array('status' => 'success', 'updated' => true, 'message' => $message, 'issuePriority' => $priority->fresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param IssuePriority $priority
     * @return IssueType|array|int
     * @throws \Exception
     */
    public function destroy(IssuePriority $priority)
    {
        //
        $priority->delete();
        return array('status' => 'success', 'removed' => true, 'message' => 'Приоритет заявки удален', 'issuePriority' => $priority);
    }
}
