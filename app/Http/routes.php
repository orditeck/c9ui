<?php

use Laravel\Lumen\Routing\Route;

$app->get('/', function () { return redirect('workflows'); });

$app->get('settings', 'SettingsController@all');
$app->post('settings', 'SettingsController@store');

$app->get('workflows', 'WorkflowController@all');
$app->get('workflows/new', 'WorkflowController@create');
$app->post('workflows/new', 'WorkflowController@store');
$app->get('workflows/edit/{id}', 'WorkflowController@edit');
$app->post('workflows/edit/{id}', 'WorkflowController@store');
$app->get('workflows/delete/{id}', 'WorkflowController@delete');
$app->get('workflows/start/{id}', 'WorkflowController@start');
$app->get('workflows/stop/{id}', 'WorkflowController@stop');
