@if (isset($errors) && count($errors->all()) > 0)
<div class="ui error message">
    <div class="header">Oops! An error occurred!</div>
    <ul>
        @foreach ($errors->all('<li>:message</li>') as $message)
        {!! $message !!}
        @endforeach
    </ul>
</div>
@elseif (!is_null(Session::get('status_error')))
<div class="ui error message">
    <div class="header">Oops! An error occurred!</div>
    @if (is_array(Session::get('status_error')))
    <ul>
        @foreach (Session::get('status_error') as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @else
    {{ Session::get('status_error') }}
    @endif
</div>
@endif

@if (!is_null(Session::get('status_success')))
<div class="ui positive message">
    <div class="header">Success!</div>
    @if (is_array(Session::get('status_success')))
    <ul>
        @foreach (Session::get('status_success') as $success)
        <li>{{ $success }}</li>
        @endforeach
    </ul>
    @else
    {{ Session::get('status_success') }}
    @endif
</div>
@endif

@if (!is_null(Session::get('status_infos')))
<div class="ui info message">
    <div class="header">Informations</div>
    @if (is_array(Session::get('status_infos')))
    <ul>
        @foreach (Session::get('status_infos') as $infos)
        <li>{{ $infos }}</li>
        @endforeach
    </ul>
    @else
    {{ Session::get('status_infos') }}
    @endif
</div>
@endif