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

Route::get('/', function () {
    $file = sizeof(Storage::files('XmlFiles')) > 0 ? true : null;
    return view('index', compact('file'));
})->name('index');

Route::post('/uploadXml', 'FileController@uploadXml')->name('uploadXml');

Route::get('/CsvFiles', 'FileController@showOutputFiles')->name('showOutputFiles');

Route::get('/file/{filePath}', function ($filePath) {
    $filePath = str_replace('|', '/', $filePath);
    return Storage::download($filePath);
});
