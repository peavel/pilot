<?php

use Illuminate\Support\Str;
use PEAVEL\Pilot\Events\Routing;
use PEAVEL\Pilot\Events\RoutingAdmin;
use PEAVEL\Pilot\Events\RoutingAdminAfter;
use PEAVEL\Pilot\Events\RoutingAfter;
use PEAVEL\Pilot\Facades\Pilot;

/*
|--------------------------------------------------------------------------
| Pilot Routes
|--------------------------------------------------------------------------
|
| This file is where you may override any of the routes that are included
| with Pilot.
|
*/

Route::group(['as' => 'pilot.'], function () {
    event(new Routing());

    $namespacePrefix = '\\'.config('pilot.controllers.namespace').'\\';

    Route::get('login', ['uses' => $namespacePrefix.'PilotAuthController@login',     'as' => 'login']);
    Route::post('login', ['uses' => $namespacePrefix.'PilotAuthController@postLogin', 'as' => 'postlogin']);

    Route::group(['middleware' => 'admin.user'], function () use ($namespacePrefix) {
        event(new RoutingAdmin());

        // Main Admin and Logout Route
        Route::get('/', ['uses' => $namespacePrefix.'PilotController@index',   'as' => 'dashboard']);
        Route::post('logout', ['uses' => $namespacePrefix.'PilotController@logout',  'as' => 'logout']);
        Route::post('upload', ['uses' => $namespacePrefix.'PilotController@upload',  'as' => 'upload']);

        Route::get('profile', ['uses' => $namespacePrefix.'PilotUserController@profile', 'as' => 'profile']);

        try {
            foreach (Pilot::model('DataType')::all() as $dataType) {
                $breadController = $dataType->controller
                                 ? Str::start($dataType->controller, '\\')
                                 : $namespacePrefix.'PilotBaseController';

                Route::get($dataType->slug.'/order', $breadController.'@order')->name($dataType->slug.'.order');
                Route::post($dataType->slug.'/action', $breadController.'@action')->name($dataType->slug.'.action');
                Route::post($dataType->slug.'/order', $breadController.'@update_order')->name($dataType->slug.'.update_order');
                Route::get($dataType->slug.'/{id}/restore', $breadController.'@restore')->name($dataType->slug.'.restore');
                Route::get($dataType->slug.'/relation', $breadController.'@relation')->name($dataType->slug.'.relation');
                Route::post($dataType->slug.'/remove', $breadController.'@remove_media')->name($dataType->slug.'.media.remove');
                Route::resource($dataType->slug, $breadController, ['parameters' => [$dataType->slug => 'id']]);
            }
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException("Custom routes hasn't been configured because: ".$e->getMessage(), 1);
        } catch (\Exception $e) {
            // do nothing, might just be because table not yet migrated.
        }

        // Menu Routes
        Route::group([
            'as'     => 'menus.',
            'prefix' => 'menus/{menu}',
        ], function () use ($namespacePrefix) {
            Route::get('builder', ['uses' => $namespacePrefix.'PilotMenuController@builder',    'as' => 'builder']);
            Route::post('order', ['uses' => $namespacePrefix.'PilotMenuController@order_item', 'as' => 'order_item']);

            Route::group([
                'as'     => 'item.',
                'prefix' => 'item',
            ], function () use ($namespacePrefix) {
                Route::delete('{id}', ['uses' => $namespacePrefix.'PilotMenuController@delete_menu', 'as' => 'destroy']);
                Route::post('/', ['uses' => $namespacePrefix.'PilotMenuController@add_item',    'as' => 'add']);
                Route::put('/', ['uses' => $namespacePrefix.'PilotMenuController@update_item', 'as' => 'update']);
            });
        });

        // Settings
        Route::group([
            'as'     => 'settings.',
            'prefix' => 'settings',
        ], function () use ($namespacePrefix) {
            Route::get('/', ['uses' => $namespacePrefix.'PilotSettingsController@index',        'as' => 'index']);
            Route::post('/', ['uses' => $namespacePrefix.'PilotSettingsController@store',        'as' => 'store']);
            Route::put('/', ['uses' => $namespacePrefix.'PilotSettingsController@update',       'as' => 'update']);
            Route::delete('{id}', ['uses' => $namespacePrefix.'PilotSettingsController@delete',       'as' => 'delete']);
            Route::get('{id}/move_up', ['uses' => $namespacePrefix.'PilotSettingsController@move_up',      'as' => 'move_up']);
            Route::get('{id}/move_down', ['uses' => $namespacePrefix.'PilotSettingsController@move_down',    'as' => 'move_down']);
            Route::put('{id}/delete_value', ['uses' => $namespacePrefix.'PilotSettingsController@delete_value', 'as' => 'delete_value']);
        });

        // Admin Media
        Route::group([
            'as'     => 'media.',
            'prefix' => 'media',
        ], function () use ($namespacePrefix) {
            Route::get('/', ['uses' => $namespacePrefix.'PilotMediaController@index',              'as' => 'index']);
            Route::post('files', ['uses' => $namespacePrefix.'PilotMediaController@files',              'as' => 'files']);
            Route::post('new_folder', ['uses' => $namespacePrefix.'PilotMediaController@new_folder',         'as' => 'new_folder']);
            Route::post('delete_file_folder', ['uses' => $namespacePrefix.'PilotMediaController@delete', 'as' => 'delete']);
            Route::post('move_file', ['uses' => $namespacePrefix.'PilotMediaController@move',          'as' => 'move']);
            Route::post('rename_file', ['uses' => $namespacePrefix.'PilotMediaController@rename',        'as' => 'rename']);
            Route::post('upload', ['uses' => $namespacePrefix.'PilotMediaController@upload',             'as' => 'upload']);
            Route::post('crop', ['uses' => $namespacePrefix.'PilotMediaController@crop',             'as' => 'crop']);
        });

        // BREAD Routes
        Route::group([
            'as'     => 'bread.',
            'prefix' => 'bread',
        ], function () use ($namespacePrefix) {
            Route::get('/', ['uses' => $namespacePrefix.'PilotBreadController@index',              'as' => 'index']);
            Route::get('{table}/create', ['uses' => $namespacePrefix.'PilotBreadController@create',     'as' => 'create']);
            Route::post('/', ['uses' => $namespacePrefix.'PilotBreadController@store',   'as' => 'store']);
            Route::get('{table}/edit', ['uses' => $namespacePrefix.'PilotBreadController@edit', 'as' => 'edit']);
            Route::put('{id}', ['uses' => $namespacePrefix.'PilotBreadController@update',  'as' => 'update']);
            Route::delete('{id}', ['uses' => $namespacePrefix.'PilotBreadController@destroy',  'as' => 'delete']);
            Route::post('relationship', ['uses' => $namespacePrefix.'PilotBreadController@addRelationship',  'as' => 'relationship']);
            Route::get('delete_relationship/{id}', ['uses' => $namespacePrefix.'PilotBreadController@deleteRelationship',  'as' => 'delete_relationship']);
        });

        // Database Routes
        Route::resource('database', $namespacePrefix.'PilotDatabaseController');

        // Compass Routes
        Route::group([
            'as'     => 'compass.',
            'prefix' => 'compass',
        ], function () use ($namespacePrefix) {
            Route::get('/', ['uses' => $namespacePrefix.'PilotCompassController@index',  'as' => 'index']);
            Route::post('/', ['uses' => $namespacePrefix.'PilotCompassController@index',  'as' => 'post']);
        });

        event(new RoutingAdminAfter());
    });

    //Asset Routes
    Route::get('pilot-assets', ['uses' => $namespacePrefix.'PilotController@assets', 'as' => 'pilot_assets']);

    event(new RoutingAfter());
});
