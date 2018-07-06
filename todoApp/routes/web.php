<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'todoController@index');
Route::post('/task', 'TasksController@create');
Route::patch('/12', 'TasksController@update');
Route::delete('/123', 'TasksController@delete');
Route::patch('/123', 'TasksController@updatebg');
Route::patch('/1234', 'TasksController@updatefg');
Route::patch('/12345', 'TasksController@updatefrm');
Route::get('/trash','TasksController@trash');
Route::delete('/trash','TasksController@trashdelete');
Route::patch('/trash', 'TasksController@trashrestore');
Route::get('/archive','TasksController@archive');
Route::delete('/archive','TasksController@archivedelete');
Route::delete('/archive123', 'TasksController@delarch');
Route::patch('/archive123', 'TasksController@updatebgarch');
Route::patch('/archive1234', 'TasksController@updatefgarch');
Route::patch('/archive12345', 'TasksController@updatefrmarch');
Route::delete('/unarchive','TasksController@archiveinsert');
Route::patch('/archive12', 'TasksController@updatearch');
Route::post('/label', 'TasksController@label');
Route::get('/label', 'TasksController@alllabels');
Route::delete('/label', 'TasksController@dellabel');
Route::post('/lab', 'TasksController@uptlabel');
Route::post('/archiveshowlabels', 'TasksController@onlylabel');
Route::patch('/addlabels', 'TasksController@add_labels');
Route::patch('/archiveaddlabels', 'TasksController@add_labelsarch');
Route::delete('/removelabel', 'TasksController@delfromlabel');
Route::post('/showlabels', 'TasksController@onlylabels');
Route::post('/getlabels', 'TasksController@onlylabs');
Route::post('/archivegetlabels', 'TasksController@onlylab');
Route::post('/removelabel', 'TasksController@removelabel');
Route::post('/archiveremovelabel', 'TasksController@removelabelarch');
Route::get('/viewlabeltasks/{id}', 'TasksController@viewlabeltasks');
Route::post('/editlabel', 'TasksController@editlabels');
Route::post('/addreminder', 'TasksController@addreminder');
Route::get('/notifications', 'TasksController@getnotifications');
Route::get('/nonoti', 'TasksController@getnonotifications');
Route::post('/makeread', 'TasksController@makeread');
Route::delete('/noti', 'TasksController@removenotifications');
Route::get('/notific','TasksController@noti');
Route::post('/archiveaddreminder', 'TasksController@addreminder');
Route::post('/notidetails', 'TasksController@notidetails');
Route::post('/notitime', 'TasksController@notitime');
Route::get('/viewnotitasks/{id}', 'TasksController@viewnotitasks');
Route::get('/viewnotiarchivetasks/{id}', 'TasksController@viewnotiarchivetasks');
Route::post('/search', 'TasksController@search');
Route::post('/getreminder', 'TasksController@notitime');
Route::post('/removenoti', 'TasksController@removenoti');
Route::post('/pinunpin', 'TasksController@pinunpin');
Route::post('/pin', 'TasksController@pin');