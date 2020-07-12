<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    //
    function store(Request $request)
    {
        switch ($request->model) {
            case 'user':
                if ((int)$request->id !== $request->user()->id) {
                    return response()->json(array('status' => 'error', 'message' => 'Нет прав'), 403);
                }
                $request->validate([
                    'avatar' => 'image',
                ]);
                $path = $request->file('avatar')->store('/public/avatars');
                $path = Storage::url($path);
                $profile = User::findOrFail($request->id)->profile;
                $profile->avatar = $path;
                $profile->save();
                return response()->json(array('status' => 'success', 'url' => $path));
        }
    }
}
