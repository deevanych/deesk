<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\IssueStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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
        $request->validate([
            'title' => 'required|max:50|min:4',
            'description' => 'max:50',
            'icon_id' => 'required',
            'color_id' => 'required',
            'type_id' => 'required',
        ]);

        $issueStatus = Auth::user()->organization->issueStatuses()->create($request->all());
        return array('status' => 'success', 'created' => true, 'message' => 'Статус заявки создан', 'issueStatus' => IssueStatus::find($issueStatus->id));
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
     * @param IssueStatus $status
     * @return array
     */
    public function update(Request $request, IssueStatus $status)
    {
        //
        $request->validate([
            'title' => 'required|max:50|min:4',
            'description' => 'max:50',
            'icon_id' => 'required',
            'color_id' => 'required',
            'type_id' => 'required',
        ]);
        $request = $request->except('issuesCount', 'icon', 'color', 'type');
        $status->update($request);
        $message = 'Статус заявки обновлен';
        if ($status->wasChanged('active')) {
            $message = ($status->active) ? 'Статус заявки включен' : 'Статус заявки выключен';
        }
        if ($status->wasChanged('deleted_at')) {
            $message = ($status->deleted_at) ? 'Статус заявки удален' : 'Статус заявки восстановлен';
        }
        return array('status' => 'success', 'updated' => true, 'message' => $message, 'issueStatus' => $status->fresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param IssueStatus $status
     * @return array
     * @throws \Exception
     */
    public function destroy(IssueStatus $status)
    {
        //
        $status->delete();
        return array('status' => 'success', 'removed' => true, 'message' => 'Статус заявки удален', 'issueStatus' => $status);
    }
}
