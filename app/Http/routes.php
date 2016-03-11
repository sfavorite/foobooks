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

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        #return view('welcome');
        return 'Welcome to Foobooks';
    });

    Route::get('/book/create', function() {
        $view = '<form method="POST" action="/book/create">';
        $view .= csrf_field();
        $view .= 'Book title: <input tpye="text" name="title">';
        $view .= '<input type="submit">';
        $view .= '</form>';

        return $view;
    });

    Route::post('/book/create', function() {
        return 'Add the book: ' . $_POST['title'];
    });

/* Had to comment this out so that /book/show would be found
    Route::get('/book/{title}', function($title) {
        return 'The book you are looking for is ' . $title;
    });
*/
    /* The question mark makes the title optional. You must match this in the
    controller.php function.
    */
    Route::get('book/show/{title?}', 'BookController@getShow');
    Route::get('book/list', 'BookController@getIndex');


    Route::get('/practice', function() {

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
});
