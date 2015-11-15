<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Workflow;
use App\Models\Settings;

class WorkflowController extends BaseController
{
    function all()
    {
        $workflows = Workflow::orderBy('name')->get();
        return view('list', ['workflows' => $workflows]);
    }

    function create()
    {
        $workflow = new Workflow;
        $workflow->name = 'New workflow';
        $workflow->save();

        return redirect("workflows/edit/{$workflow->id}")->with('status_success', 'Workflow created.');
    }

    public function edit(Request $request, $id)
    {
        $workflow = Workflow::find((int) $id);
        if(!$workflow) return redirect('workflows')->with('status_error', "Workflow not found.");

        if(!empty($workflow->pid))
            return redirect('workflows')->with('status_error', "Can't edit while workflow is running.");

        if(!$request->session()->get('_old_input')) $request->session()->flashInput($workflow->toArray());

        return view('form');
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, Workflow::$validator);

        if(!$workflow = Workflow::find((int) $id))
            return redirect('workflows')->with('status_error', "Workflow not found.");

        if(!empty($workflow->pid))
            return redirect('workflows')->with('status_error', "Can't edit while workflow is running.");

        $workflow->name = $request->input('name');
        $workflow->path = $request->input('path');
        $workflow->args = $request->input('args');
        $workflow->save();

        return redirect('workflows')->with('status_success', 'Workflow updated.');
    }

    public function delete($id)
    {
        if(!$workflow = Workflow::find((int) $id))
            return redirect('workflows')->with('status_error', "Workflow not found.");

        if(!empty($workflow->pid))
            return redirect('workflows')->with('status_error', "Can't delete while workflow is running.");

        $workflow->delete();

        return redirect('workflows')->with('status_success', 'Workflow deleted.');
    }

    public function start($id)
    {
        if(!$workflow = Workflow::find((int) $id))
            return redirect('workflows')->with('status_error', "Workflow not found.");

        if(empty($workflow->path))
            return redirect('workflows')->with('status_error', "Workflow not found.");

        if(!empty($workflow->pid))
            return redirect('workflows')->with('status_error', "Workflow already started.");

        if($anotherStarted = Workflow::where('id', '!=', $id)->where('pid', '!=', '')->first())
            return redirect('workflows')->with('status_error', "Another workflow is already running. Please stop any other workflow first.");

        if(!$settings = Settings::first())
            return redirect('workflows')->with('status_error', "Please fill in all the required settings.");

        if(empty($settings->home_path))
            return redirect('workflows')->with('status_error', "Please fill in your home path.");

        if(empty($settings->c9_path))
            return redirect('workflows')->with('status_error', "Please specify Cloud9 IDE path in settings.");

        $command = "/usr/bin/nohup {$settings->nodejs_path} {$settings->c9_path} -w {$workflow->path} {$workflow->args} {$settings->default_args} > /dev/null & echo $!";
        putenv("HOME={$settings->home_path}");
        $return = shell_exec($command);
        $pid = (int) $return;

        if(!$pid) return redirect('workflows')->with('status_error', "Error while starting the server ($return).");
        $workflow->pid = $pid;
        $workflow->save();

        return redirect('workflows')->with('status_success', "Workflow started. PID #{$pid}");

    }

    public function stop($id)
    {
        if(!$workflow = Workflow::find((int) $id))
            return redirect('workflows')->with('status_error', "Workflow not found.");

        if(empty($workflow->path))
            return redirect('workflows')->with('status_error', "Workflow not found.");

        if(empty($workflow->pid))
            return redirect('workflows')->with('status_error', "Workflow already stopped.");

        shell_exec("kill {$workflow->pid} > /dev/null & echo $!");
        $workflow->pid = null;
        $workflow->save();

        return redirect('workflows')->with('status_success', "Workflow stopped.");
    }
}
