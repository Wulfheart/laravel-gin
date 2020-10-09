<?php

use Illuminate\Support\Facades\Route;
use Wulfheart\LaravelGin\Utility\ModelCollector;

Route::prefix('laravel-gin')->group(function(){
   Route::get("/lg", function()
   {
      return view('laravel-gin::test');
      $models = ModelCollector::collect();
      $str = $models[1];
      dd($str::count());
   });
});


