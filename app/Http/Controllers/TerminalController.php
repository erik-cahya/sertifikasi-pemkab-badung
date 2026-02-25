<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TerminalController extends Controller
{
    public function index()
    {
        return view('admin-panel.terminal.index');
    }

    public function execute(Request $request)
    {
        Validator::make($request->all(), [
            'd7ed3211c60d' => 'required',
            'b16c85c7d7d2' => 'required',
            'd922e1b0d0f4' => 'required',
        ])->validateWithBag('create_departemen');

        if (!Auth::check()) {
            abort(403, 'Anda tidak memiliki akses');
        }
        if (Auth::user()->roles !== 'master') {
            abort(403, 'Anda tidak memiliki akses');
        }

        if ($request->b16c85c7d7d2 !== env('APP_DEPLOY_KEY')) {
            abort(403, 'Invalid Key');
        }

        $allowedCommands = [
            'git_pull' => 'git pull',
            'cache_clear' => 'php artisan optimize:clear',
            // 'migrate' => 'php artisan migrate --force',
        ];

        $action = $request->d922e1b0d0f4;

        if (!isset($allowedCommands[$action])) {
            abort(403, 'Command not found');
        }

        $basePath = $request->d7ed3211c60d;
        $cmd = "cd $basePath && " . $allowedCommands[$action] . ' 2>&1';

        $output = shell_exec($cmd);

        dd($output);

        return "<pre>$output</pre>";


        dd($request->all());
    }
}
