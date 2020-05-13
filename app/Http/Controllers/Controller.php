<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Artisan;
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
//            $root_path = base_path();
//            $process = Process::fromShellCommandline('cd ' . $root_path . '; ./deploy.sh');
//            $process->run(function ($type, $buffer) {
//                echo $buffer;
//            });
//        }
        Artisan::call('git:deploy');
    }
}
