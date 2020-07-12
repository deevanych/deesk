<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FileController extends Controller
{
    //
    function store(Request $request)
    {
        switch ($request->model) {
            case 'user':
                $path = $request->file('avatar')->store('avatars');
                $profile = User::findOrFail($request->id)->profile;
                $profile->avatar = asset($path);
                $profile->save();
                return response()->json(array('status' => 'success', 'url' => asset($path)));
        }
    }
}
