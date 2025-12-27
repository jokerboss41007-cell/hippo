<?php

use Illuminate\Support\Facades\Route;
use App\Models\Bid;

Route::post('/bid/update-status/{id}/{status}', function($id,$status){
    $bid = Bid::findOrFail($id);
    $bid->update(['status'=>$status]);
    return response()->json(['updated'=>true]);
});


Route::get('/', function () {
    return view('welcome');
});
