<?php


	use Tracker\models\Visitor;

	Route::get('tracker','Tracker\controllers\TrackerController@index');
	Route::get('create',function (){
		Visitor::create(['ip'=>'1','user_agent'=>'2','from_page'=>'3','to_page'=>'4']);
	});
	Route::get('test', function () {
		return Tracker::index();
	});