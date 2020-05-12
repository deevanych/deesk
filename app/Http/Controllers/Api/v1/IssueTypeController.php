<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\IssueType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class IssueTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        return Auth::user()->organization->issueTypes;
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
        $issueType = Auth::user()->organization->issueTypes()->create($request->all());
        return array('status' => 'success', 'created' => true, 'message' => 'Тип заявки создан', 'issueType' => $issueType);
    }

    /**
     * Display the specified resource.
     *
     * @param IssueType $issueType
     * @return Response
     */
    public function show(IssueType $issueType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param IssueType $issueType
     * @return Response
     */
    public function edit(IssueType $issueType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param IssueType $type
     * @return array
     */
    public function update(Request $request, IssueType $type)
    {
        //
        $validatedData = $request->validate([
            'title' => 'required|max:50|min:4',
            'description' => 'max:50',
        ]);

        $type->update($request->all());
        $message = 'Тип заявки обновлен';
        if ($type->wasChanged('active')) {
            $message = ($type->active) ? 'Тип заявки включен' : 'Тип заявки выключен';
        }
        if ($type->wasChanged('deleted_at')) {
            $message = ($type->deleted_at) ? 'Тип заявки удален' : 'Тип заявки восстановлен';
        }
        return array('status' => 'success', 'updated' => true, 'message' => $message, 'issueType' => $type->fresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param IssueType $type
     * @return IssueType|array|int
     * @throws \Exception
     */
    public function destroy(IssueType $type)
    {
        //
        $type->delete();
        return array('status' => 'success', 'removed' => true, 'message' => 'Тип заявки удален', 'issueType' => $type);
    }
}
