<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\IssueRule;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class IssueRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        return Auth::user()->organization->issueRules->load(
            'issueType',
            'issueClient',
            'issuePriority',
            'issueEmployee'
        );
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
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'type_id' => 'nullable',
            'employee_id' => 'nullable',
            'priority_id' => 'nullable',
            'client_id' => 'nullable',
            'observers' => 'nullable',
        ]);

        $observers = $request->observer_ids;
        $request = $request->except('issue_type', 'issue_client', 'issue_priority', 'issue_employee', 'issue_observers', 'observer_ids');
        $issueRule = Auth::user()->organization->issueRules()->create($request);
        $issueRule->issueObservers()->attach($observers);
        return array('status' => 'success', 'created' => true, 'message' => 'Правило для заявок создано', 'issueRule' => $issueRule->load(
            'issueType',
            'issueClient',
            'issuePriority',
            'issueEmployee'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param IssueRule $issueRule
     * @return Response
     */
    public function show(IssueRule $issueRule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param IssueRule $issueRule
     * @return Response
     */
    public function edit(IssueRule $issueRule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param IssueRule $issueRule
     * @return Response
     */
    public function update(Request $request, IssueRule $issueRule)
    {
        //
        $request->validate([
            'type_id' => 'nullable',
            'employee_id' => 'nullable',
            'priority_id' => 'nullable',
            'client_id' => 'nullable',
            'observers' => 'nullable',
        ]);

        $issueRule->issueObservers()->sync($request->observer_ids);
        $request = $request->except('issue_type', 'issue_client', 'issue_priority', 'issue_employee', 'issue_observers', 'observer_ids');
        $issueRule->update($request);
        $message = 'Правило для заявки обновлено';
        if ($issueRule->wasChanged('active')) {
            $message = ($issueRule->active) ? 'Правило для заявки включено' : 'Правило для заявки выключено';
        }
        if ($issueRule->wasChanged('deleted_at')) {
            $message = ($issueRule->deleted_at) ? 'Правило для заявки удалено' : 'Правило для заявки восстановлено';
        }
        return array('status' => 'success', 'updated' => true, 'message' => $message, 'issueRule' => $issueRule->fresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param IssueRule $issueRule
     * @return array
     */
    public function destroy(IssueRule $issueRule)
    {
        //
        $issueRule->delete();
        return array('status' => 'success', 'removed' => true, 'message' => 'Правило для заявки удалено', 'issueRule' => $issueRule);
    }
}
