<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Issue;
use App\IssueComment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class IssueCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Request
     */
    public function index(Request $request)
    {
        //
        $issue = Issue::withTrashed()->findOrFail($request->id);
        return $issue->comments;
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
     * @return IssueComment
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'text' => [
                function ($attribute, $value, $fail) {
                    if (empty(trim(html_entity_decode(strip_tags($value, '<img>')), " \t\n\r\0\x0B\xC2\xA0"))) {
                        $fail('Комментарий не может быть пустым');
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            return array('status' => 'error', 'published' => false, 'message' => $validator->errors()->first('text'));
        }

        try {
            $issueComment = new IssueComment($request->all());
            $issueComment->author_id = Auth::user()->id;
            $issueComment->issue_id = $request->id;
            $issueComment->save();
            return array('status' => 'success', 'published' => true, 'message' => 'Комментарий добавлен', 'comment' => $issueComment);
        } catch (\Exception $e) {
            return array('status' => 'error', 'published' => false, 'message' => $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\IssueComment $issueComment
     * @return Response
     */
    public function show(IssueComment $issueComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\IssueComment $issueComment
     * @return Response
     */
    public function edit(IssueComment $issueComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\IssueComment $issueComment
     * @return Response
     */
    public function update(Request $request, IssueComment $issueComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\IssueComment $issueComment
     * @return Response
     */
    public function destroy(IssueComment $issueComment)
    {
        //
    }
}
