@extends('main')

@section('content')


<div class="ui segments">
    <div class="ui secondary segment"><h3>Edit a workflow</h3></div>
    <div class="ui segment">

        <form id="client-form" class="ui form" method="post" action="">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="two fields">
                <div class="field {{ ((oldInputHasError('name')) ? 'error' : '') }}">
                    <label>Name</label>
                    <input type="text" name="name" required value="{{ old('name') }}">
                </div>

                <div class="field {{ ((oldInputHasError('path')) ? 'error' : '') }}">
                    <label>Path</label>
                    <input type="text" name="path" required value="{{ old('path') }}">
                </div>
            </div>

            <div class="two fields">
                <div class="field {{ ((oldInputHasError('args')) ? 'error' : '') }}">
                    <label>Options</label>
                    <input type="text" name="args" value="{{ old('args') }}">
                </div>
            </div>

            <div style="text-align: center;">
                <button type="submit" class="ui primary button">Save</button>
            </div>

        </form>

    </div>
</div>

@stop