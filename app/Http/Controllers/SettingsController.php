<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Settings;
use DB;

class SettingsController extends BaseController
{
    function all()
    {
        if(!$settings = Settings::first()){
            $settings = new Settings;
            $settings->save();
        }


        $whereis_node = trim(preg_replace('/\s\s+/', ' ', shell_exec('whereis node')));
        $whereis_nodejs = trim(preg_replace('/\s\s+/', ' ', shell_exec('whereis nodejs')));
        $whoami = trim(preg_replace('/\s\s+/', ' ', shell_exec('whoami')));
        $home = trim(preg_replace('/\s\s+/', ' ', shell_exec('echo $HOME')));

        $pw = @posix_getpwuid(@posix_getuid());
        $detectedHome = (is_array($pw) && isset($pw['dir'])) ? trim(preg_replace('/\s\s+/', ' ', $pw['dir'])) : '';

        $defaultNodeJsPath = false;

        if(empty($settings->nodejs_path)){
            if(!empty($whereis_nodejs)){
                $parts = explode(' ', $whereis_nodejs);
                if(isset($parts[0]) && $parts[0] == 'nodejs:' && isset($parts[1])){
                    $defaultNodeJsPath = $parts[1];
                }
            }

            if(!$defaultNodeJsPath && !empty($whereis_nodejs)){
                $parts = explode(' ', $whereis_node);
                if(isset($parts[0]) && $parts[0] == 'node:' && isset($parts[1])){
                    $defaultNodeJsPath = $parts[1];
                }
            }
        }

        return view('settings', [
            'settings'              => $settings,
            'whereis_node'          => $whereis_node,
            'whereis_nodejs'        => $whereis_nodejs,
            'whoami'                => $whoami,
            'home'                  => $home,
            'detectedHome'          => $detectedHome,
            'defaultNodeJsPath'     => $defaultNodeJsPath,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, Settings::$validator);

        DB::table('settings')->update([
            'home_path'     => $request->input('home_path'),
            'nodejs_path'   => $request->input('nodejs_path'),
            'c9_path'       => $request->input('c9_path'),
            'default_args'  => $request->input('default_args'),
        ]);

        return redirect('settings')->with('status_success', 'Settings updated.');
    }

}
