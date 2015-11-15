@extends('main')

@section('content')


<div class="ui segments">
    <div class="ui secondary segment"><h3>Settings</h3></div>
    <div class="ui segment">

        <form id="client-form" class="ui form" method="post" action="">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="three fields">
                <div class="field {{ ((oldInputHasError('home_path')) ? 'error' : '') }}">
                    <label>
                        Home user path ($HOME)
                        <small>(e.g.: /usr/bin/nodejs)</small>
                    </label>
                    <input type="text" name="home_path" value="{{ ((empty($settings->home_path)) ? $detectedHome : $settings->home_path) }}">
                </div>

                <div class="field {{ ((oldInputHasError('nodejs_path')) ? 'error' : '') }}">
                    <label>
                        NodeJS full path
                        <small>(e.g.: /usr/bin/nodejs)</small>
                    </label>
                    <input type="text" name="nodejs_path" value="{{ ((empty($settings->nodejs_path)) ? $defaultNodeJsPath : $settings->nodejs_path) }}">
                </div>

                <div class="field {{ ((oldInputHasError('c9_path')) ? 'error' : '') }}">
                    <label>Cloud9 <code>server.js</code> full path</label>
                    <input type="text" name="c9_path" value="{{ $settings->c9_path }}">
                </div>
            </div>

            <div class="three fields">
                <div class="field {{ ((oldInputHasError('default_args')) ? 'error' : '') }}">
                    <label>Default options (always added when launching <code>server.js</code>)</label>
                    <input type="text" name="default_args" value="{{ $settings->default_args }}">
                </div>
            </div>

            <div class="ui divider"></div>

            <small>
                <pre class="ui message">
Useful informations for filling the fields above:
whereis node      {{ $whereis_node }}
whereis nodejs    {{ $whereis_nodejs }}
whoami            {{ $whoami }}
echo $HOME        {{ $home }}
Detected home     {{ $detectedHome }}

------------------------------------

The following options can be used:

--settings       Settings file to use
--help           Show command line options.
-t               Start in test mode
-k               Kill tmux server in test mode
-b               Start the bridge server - to receive commands from the cli  [default: false]
-w               Workspace directory
--port           Port
--debug          Turn debugging on
--listen         IP address of the server (set to 0.0.0.0 to make public. You'll need to add --auth too if public)
--readonly       Run in read only mode
--packed         Whether to use the packed version.
--auth           Basic Auth username:password
--collab         Whether to enable collab.
--no-cache       Don't use the cached version of CSS</pre>
            </small>

            <div class="ui divider"></div>

            <div style="text-align: center;">
                <button type="submit" class="ui primary button">Save</button>
            </div>

        </form>

    </div>
</div>

@stop