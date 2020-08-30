<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Issue;
use App\IssueRule;
use App\IssueStatusType;
use App\Organization;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $organization = Auth::user()->organization;
        if ($organization->isClient()) {
            $type = 'author_organization_id';
        } else {
            $type = 'organization_id';
            if ($request->get('organization')) {
                $type = 'author_organization_id';
                $organization = Organization::findOrFail($request->get('organization'));
            }
        }
        $columns = ['issues.id', 'title', null, null, 'created_at'];
        $search = $request->get('search')['value'];
        if ($request->get('user')) {
            $type = 'author_id';
            $organization = User::findOrFail($request->get('user'))->organization;
            if (!$organization->isClient()) {
                $type = 'employee_id';
            }
            $issues = Issue::where($type, $request->get('user'));
        } else {
            $issues = Issue::where($type, $organization->id);
        }
        $issuesCount = $issues->count();
        if ($request->get('status')) {
            $issues = $issues->where('issue_status_id', '=', $request->get('status'));
        }
        if ($request->get('employee')) {
            $employeeId = ($request->get('employee') === 'my' ? Auth::user()->id : $request->get('employee'));
            $issues = $issues->where('employee_id', '=', $employeeId);
        }
        if ($request->get('type') == 'observed') {
            $issues = Auth::user()->favoriteIssues()->getQuery();
        }
        $issues = $issues->where(function ($query) use ($search) {
            $query->where('title', 'LIKE', '%' . $search . '%')
                ->OrWhere('issues.id', '=', $search)
                ->OrWhereHas('author', function (Builder $query) use ($search) {
                    $query->where('title', 'LIKE', '%' . $search . '%');
                })->OrWhereHas('employee', function (Builder $query) use ($search) {
                    $query->where('title', 'LIKE', '%' . $search . '%');
                })->OrWhereHas('status', function (Builder $query) use ($search) {
                    $query->where('title', 'LIKE', '%' . $search . '%');
                })->OrWhereHas('author', function (Builder $query) use ($search) {
                    $query->whereHas('organization', function (Builder $query) use ($search) {
                        $query->where('title', 'LIKE', '%' . $search . '%');
                    });
                });
        });
        foreach ($request->get('order') as $order) {
            $issues = $issues->orderBy($columns[$order['column']], $order['dir']);
        }
        $issues = $issues->get();
        $filteredCount = count($issues);
        $issues = $issues->slice($request->get('start'), $request->get('length'))->values();
        return array('data' => $issues, 'recordsTotal' => $issuesCount, 'recordsFiltered' => $filteredCount, 'draw' => $request->get('draw'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public
    function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public
    function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|max:50|min:4',
            'description' => 'max:10000000',
        ]);

        $user = Auth::user();
        $organization = $user->organization;
        $observers = $request->observer_ids;
        $issueData = $request->except('author', 'observer_ids');

        $issueStatus = $organization->getIssueStatuses()->where('type_id', '=', IssueStatusType::NEW_ISSUE)->first();
        if (!$issueStatus) {
            $issueStatus = $organization->getIssueStatuses()->first();
        }

        $organization_id = ($organization->isClient() ? $organization->parent_id : $organization->id);
        $rule = IssueRule::whereOrganizationId($organization_id)->whereIssueTypeId($request->issue_type_id)->whereIssuePriorityId($request->issue_priority_id)->where(function ($query) use ($organization) {
            $query->where('client_id', '=', $organization->id)
                ->orWhereNull('client_id');
        })->first();

        $issue = new Issue($issueData);
        $issue->issue_status_id = $issueStatus->id;
        $issue->author_organization_id = $organization->id;
        $issue->author_id = $user->id;

        if ($issueData['author_id'] !== (int)$user->id) {
            if (!$organization->isClient()) {
                $issue->service_created = true;
                $issue->author_id = $issueData['author_id'];
                $issue->author_organization_id = User::findOrFail($issueData['author_id'])->organization_id;
            }
        }

        $issue->organization_id = $organization_id;

        if (isset($rule)) {
            $issue->employee_id = $rule->employee_id;
        }

        $issue->save();

        $issue->observers()->attach($observers);

        if (isset($rule)) {
            $issue->observers()->attach($rule->issueObservers);
        }

        return array('status' => 'success', 'created' => true, 'message' => 'Заявка создана', 'issue' => $issue);
    }

    /**
     * Display the specified resource.
     *
     * @param Issue $issue
     * @return Issue
     */
    public
    function show(Issue $issue)
    {
        //
        return $issue->load('type', 'priority', 'observers', 'activity')->append('favorite');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Issue $issue
     * @return Response
     */
    public
    function edit(Issue $issue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Issue $issue
     * @return Issue
     */
    public
    function update(Request $request, Issue $issue)
    {
        //
        if ($issue->trashed()) {
            return array('status' => 'error', 'updated' => false, 'message' => 'Удаленная заявка не может быть обновлена', 'issue' => $issue->load('type', 'priority', 'observers')->append('favorite'));
        }
        $issue->update($request->all());
        return array('status' => 'success', 'updated' => true, 'message' => 'Заявка обновлена', 'issue' => $issue->fresh()->load('type', 'priority', 'observers')->append('favorite'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Issue $issue
     * @return Response
     */
    public
    function destroy(Issue $issue)
    {
        //
        $issue->delete();
        return array('status' => 'success', 'deleted' => true, 'message' => 'Заявка удалена', 'issue' => $issue);
    }
}
