<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

#use \Rych\Random\Random;

#Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    });


    Route::get('/books', 'BookController@getIndex');
    Route::get('/book/create', 'BookController@getCreate');
    Route::post('/book/create', 'BookController@postCreate');
    Route::post('/book/show/{title?}', 'BookController@getShow');


    Route::get('/practice', function() {

        // Using random package
        $random = new Random();
        echo $random->getRandomString(18) . '<br><br>';

        # If this isn't our production environment show debug information
        if (config('app.debug')) {
            echo 'Mail: ' . config('mail.driver') . '<br>';
            echo 'Env: ' . config('app.env') . '<br>';
            if (config('app.debug')) {
                echo 'Debug: True<br>';
            }
            else {
                echo 'Debug: False<br>';
            }
            echo 'URL: ' .config('app.url') . '<br>';

            $data = Array('foo' => 'bar');

            Debugbar::info($data);
            Debugbar::error('Error!');
            Debugbar::warning('Watch out...');
            Debugbar::addMessage('Another message', 'mylabel');
        }
        else {
            return 'Hello';
        }

    });

    if (App::environment('local')) {
        Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    }

    Route::get('/debug', function() {

        echo '<pre>';

        echo '<h1>Environment</h1>';
        echo App::environment().'</h1>';

        echo '<h1>Debugging?</h1>';
        if(config('app.debug')) echo "Yes"; else echo "No";

        echo '<h1>Database Config</h1>';
        /*
        The following line will output your MySQL credentials.
        Uncomment it only if you're having a hard time connecting to the database and you
        need to confirm your credentials.
        When you're done debugging, comment it back out so you don't accidentally leave it
        running on your live server, making your credentials public.
        */
        //print_r(config('database.connections.mysql'));

        echo '<h1>Test Database Connection</h1>';
        try {
            $results = DB::select('SHOW DATABASES;');
            echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
            echo "<br><br>Your Databases:<br><br>";
            print_r($results);
        }
        catch (Exception $e) {
            echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
        }

        echo '</pre>';

    });

});
