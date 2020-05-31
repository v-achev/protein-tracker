<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return 'Protein Tracker App';
});

$router->get('/test', function () use ($router) {
    return phpinfo();
});

# API route group
$router->group(['prefix' => 'api'], function () use ($router) {

    #### PUBLIC ROUTES ####

    # Auth route group
    $router->group(['prefix' => 'auth'], function () use ($router) {

        # Creates user
        $router->post('sign-up',
            [
                'as' => 'auth.signUp',
                'uses' => 'AuthController@signUp'
            ]
        );

        # Creates guest
        $router->post('sign-up-guest',
            [
                'as' => 'auth.signUpGuest',
                'uses' => 'AuthController@signUpGuest'
            ]
        );

        # Authenticates user
        $router->post('sign-in',
            [
                'as' => 'auth.signIn',
                'uses' => 'AuthController@SignIn'
            ]
        );

    });

    #### Authenticatable routes ####

    $router->group(['middleware' => 'auth'], function () use ($router) {

        # Users route group
        $router->group(['prefix' => 'user'], function () use ($router) {

            # Creates user
            $router->get('profile',
                [
                    'as' => 'user.profile',
                    'uses' => 'UserController@profile'
                ]
            );

            # Creates user
            $router->get('logout',
                [
                    'as' => 'user.logout',
                    'uses' => 'UserController@logout'
                ]
            );

        });

    });

});
