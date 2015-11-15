@extends('main')

@section('content')



<div class="ui segments">
    <div class="ui secondary segment">
        <div class="ui equal width grid">
            <div class="column"><h3>Workflows</h3></div>
            <div class="right aligned column">
                <a href="{{ url('workflows/new') }}" class="ui compact tiny primary button">
                    <i class="plus icon"></i> Add new
                </a>
            </div>
        </div>
    </div>
    <div class="ui segment">
        <table class="ui very basic table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Path</th>
                    <th>Arguments</th>
                    <th style="width: 250px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($workflows as $workflow)
                <tr>
                    <td>{{ $workflow->id }}</td>
                    <td>{{ $workflow->name }}</td>
                    <td>{{ $workflow->path }}</td>
                    <td>{{ $workflow->args }}</td>
                    <td style="text-align: right;">
                        @if($workflow->started)
                        <a href="{{ url('workflows/stop/' . $workflow->id) }}" class="compact tiny ui purple button btn-xs"><i class="stop icon"></i> Stop</a>
                        @else
                        <a href="{{ url('workflows/start/' . $workflow->id) }}" class="compact tiny ui green button btn-xs"><i class="play icon"></i> Start</a>
                        @endif
                        <a href="{{ url('workflows/edit/' . $workflow->id) }}" class="compact tiny ui button btn-xs"><i class="edit icon"></i> Edit</a>
                        <a href="{{ url('workflows/delete/' . $workflow->id) }}" class="compact tiny ui red icon button"><i class="remove icon"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop