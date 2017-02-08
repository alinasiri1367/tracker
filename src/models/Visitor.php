<?php
	/**
	 * Created by PhpStorm.
	 * User: pardis
	 * Date: 2017/2/8
	 * Time: 10:17 AM
	 */

	namespace Tracker\models;


	use Illuminate\Database\Eloquent\Model;

	class Visitor extends Model {
		protected $table    =   'visitors';
		protected $guarded  =   ['id'];

	}