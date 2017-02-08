<?php

namespace Tracker\controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TrackerController extends Controller
{
	public function index() {
		return 'test => '.Carbon::now();
    }
}
