<?php
	namespace Tracker\facade;
	use Illuminate\Support\Facades\Facade;

	class TrackerFacade extends Facade {

		protected static function getFacadeAccessor()
		{
			return 'Tracker';
		}

	}