<?php

use App\Http\Controllers\ProcessJsonController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
