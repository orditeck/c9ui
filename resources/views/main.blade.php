<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>c9ui</title>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.6/semantic.min.css" type="text/css">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.6/semantic.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $.ajaxPrefilter(function(options, originalOptions, xhr) {
                return xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
            });
        });
    </script>
</head>
<body>

<div class="ui inverted attached stackable menu">
    <div class="ui container">
        <div class="title item"><strong>c9ui</strong></div>
        <a href="{{ url('workflows') }}" class="{{ ((request()->is('workflows*')) ? 'active' : '') }} item">Workflows</a>
        <a href="{{ url('settings') }}" class="{{ ((request()->is('settings*')) ? 'active' : '') }} item">Settings</a>
    </div>
</div>

<br />

<div class="ui container">

    <main>
        @include('status')

        <div id="main-container">
            @yield('content')
        </div>
    </main>

</div>


</body>
</html>