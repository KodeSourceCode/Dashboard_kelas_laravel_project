<?php

use App\Http\Controllers\KelasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('kelas.index');
});

Route::resource('kelas', KelasController::class)->parameters([
    'kelas' => 'kelas'
]);
