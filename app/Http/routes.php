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


	Route::get('/login', 'Auth\AuthController@getLogin');
	Route::post('/login', 'Auth\AuthController@postLogin');

	Route::get('/register', 'Auth\AuthController@getRegister');
	Route::post('/register', 'Auth\AuthController@postRegister');

	Route::get('/logout', 'Auth\AuthController@logout');


	Route::get('/', 'BookController@getIndex'); # Home
#	Route::get('/home', 'BookController@getIndex'); # Home

    Route::get('/books', 'BookController@getIndex');
	Route::get('/book/edit/{id?}', 'BookController@getEdit');
	Route::post('/book/edit/{id?}', 'BookController@postEdit');

    Route::get('/book/create', 'BookController@getCreate');
    Route::post('/book/create', 'BookController@postCreate');
    Route::post('/book/show/{title?}', 'BookController@getShow');

    Route::get('/practice/ex4', 'PracticeController@getEx4');
    Route::get('/practice/ex5', 'PracticeController@getEx5');
    Route::get('/practice/ex6', 'PracticeController@getEx6');
    Route::get('/practice/ex7', 'PracticeController@getEx7');
    Route::get('/practice/ex8', 'PracticeController@getEx8');
    Route::get('/practice/ex9', 'PracticeController@getEx9');
    Route::get('/practice/ex10', 'PracticeController@getEx10');
    Route::get('/practice/ex11', 'PracticeController@getEx11');
    Route::get('/practice/ex12', 'PracticeController@getEx12');
    Route::get('/practice/ex13', 'PracticeController@getEx13');
    Route::get('/practice/ex16', 'PracticeController@getEx16');
    Route::get('/practice/ex17', 'PracticeController@getEx17');
	Route::get('/practice/ex18', 'PracticeController@getEx18');
	Route::get('/practice/ex19', 'PracticeController@getEx19');
	Route::get('/practice/ex20', 'PracticeController@getEx20');
	Route::get('/practice/ex21', 'PracticeController@getEx21');
	Route::get('/practice/ex22', 'PracticeController@getEx22');
	Route::get('/practice/ex23', 'PracticeController@getEx23');
	Route::get('/practice/ex24', 'PracticeController@getEx24');
	Route::get('/practice/ex25', 'PracticeController@getEx25');


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

	Route::get('/show-login-status', function() {

		# You may access the authenticated user via the Auth facade
		$user = Auth::user();

		if($user) {
			echo 'You are logged in.';
			dump($user->toArray());
		} else {
			echo 'You are not logged in.';
		}

		return;

	});

});
