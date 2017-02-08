<?php
	namespace Tracker\models;


	use Illuminate\Database\Eloquent\Model;

	class Visit extends Model {
		protected $table    =   'visits';
		protected $guarded  =   ['id','created_at'];
	}