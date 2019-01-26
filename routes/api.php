<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');

Route::get('questions', 'QuestionController@getAllQuestions');
Route::get('question/{id}', 'QuestionController@get_question_details');
Route::get('answer/{id}', 'AnswerController@get_answer_details');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', 'UserController@getAuthenticatedUser');
    
    // Routes related answer  
    Route::post('add_answer', 'AnswerController@insert_answer');

    // Routes related comment  
    Route::post('add_comment', 'CommentController@insert_comment');
    
    // Routes related votes mechanism
    Route::post('vote_answer', 'VoteController@vote_answer');
    Route::post('vote_question', 'VoteController@vote_question');

    // Routes related question module
    Route::post('add_question', 'QuestionController@insert_question');
});
