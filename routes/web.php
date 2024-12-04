<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WordExportController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FileController;

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/download-word', 'FileController@downloadWord');
Route::get('/download-word', [FileController::class, 'downloadWord']);
Route::get('/openword', [FileController::class, 'openWord']);


Route::get('/export-word', [WordExportController::class, 'export']);
Route::get('/upload', [DocumentController::class, 'showUploadForm'])->name('doc.upload.form');
Route::post('/upload', [DocumentController::class, 'upload'])->name('doc.upload');
Route::get('/edit/{filename}', [DocumentController::class, 'edit'])->name('doc.edit');
Route::post('/callback', [DocumentController::class, 'callback'])->name('doc.callback');