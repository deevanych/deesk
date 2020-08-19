<?php

namespace App\Http\Controllers;

use App\Issue;
use App\Organization;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Process;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function deploy(Request $request)
    {
//        $githubPayload = $request->getContent();
//        $githubHash = $request->header('X-Hub-Signature');
//        $localToken = config('app.deploy_secret');
//        $localHash = 'sha1=' . hash_hmac('sha1', $githubPayload, $localToken, false);
//        if (hash_equals($githubHash, $localHash)) {
            $root_path = base_path();
            $process = Process::fromShellCommandline('cd ' . $root_path . '; ./deploy.sh');
            $process->run(function ($type, $buffer) {
                echo $buffer;
            });
//        }
//        Artisan::call('git:deploy');
    }

    public function test(Request $request) {
        Auth::loginUsingId(1);
        if ($request->get('user')) {
            $object = User::findOrFail($request->get('user'));
        } elseif ($request->get('organization')) {
            $object = Organization::findOrFail($request->get('organization'));
        } elseif ($request->get('issue')) {
            $object = Issue::findOrFail($request->get('issue'));
        } else {
            if ($request->get('type') === 'notifications') {
                $user = Auth::user();
                $count = ($request->get('count') ? $request->get('count') : 5);
                $offset = ($request->get('offset') ? $request->get('offset') * $count : 0);

                $activity = $user->notifications()->sortByDesc('id')->load('issue');

                return dd($activity->pluck('id'));
            }
            $object = Auth::user()->organization;
        }

        $count = ($request->get('count') ? $request->get('count') : 5);
        $offset = ($request->get('offset') ? $request->get('offset') * $count : 0);
        $activity = $object->activity->skip($offset)->take($count)->load('issue');

        return array('activities' => $activity, 'count' => count($activity));
    }
}
