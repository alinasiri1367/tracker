<?php

	namespace Tracker\controllers;

	use App\Http\Controllers\Controller;
	use Carbon\Carbon;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\URL;
	use Tracker\models\Visit;
	use Tracker\models\Visitor;

	class TrackerController extends Controller {
		public function count() {

			if ( self::crawlerDetect( \Request::header( 'User-Agent' ) ) != false ) {
				return false;
			}

			$new = false;
			if ( self::check_is_new_visitor( \Request::ip() ) ) {
				$new = true;
				Visitor::create( [
					'ip'         => \Request::ip(),
					'user_agent' => \Request::header( 'User-Agent' ),
					'from_page'  => URL::previous(),
					'to_page'    => \Request::url()
				] );
			}

			$row = Visit::whereDate( 'created_at', '=', Carbon::today()->toDateString() )->get();
			if ( count( $row ) > 0 ) {
				$row->first()->increment( 'count' );
				if ( $new == true ) {
					$row->first()->increment( 'real_count' );
				}
			} else {
				Visit::create( [ 'count' => 1, 'real_count' => 1 ] );
			}

		}

		public function check_is_new_visitor( $ip ) {

			$check = Visitor::whereDate( 'created_at', '=', Carbon::today()->toDateString() )
			                ->where( 'ip', \Request::ip() )->get();

			if ( count( $check ) > 0 ) {
				$check->first()->touch();

				return false;
			}

			return true;
		}

		public function crawlerDetect( $USER_AGENT ) {
			$crawlers = array (
				array ( 'Google', 'Google' ),
				array ( 'msnbot', 'MSN' ),
				array ( 'Rambler', 'Rambler' ),
				array ( 'Yahoo', 'Yahoo' ),
				array ( 'AbachoBOT', 'AbachoBOT' ),
				array ( 'accoona', 'Accoona' ),
				array ( 'AcoiRobot', 'AcoiRobot' ),
				array ( 'ASPSeek', 'ASPSeek' ),
				array ( 'CrocCrawler', 'CrocCrawler' ),
				array ( 'Dumbot', 'Dumbot' ),
				array ( 'FAST-WebCrawler', 'FAST-WebCrawler' ),
				array ( 'GeonaBot', 'GeonaBot' ),
				array ( 'Gigabot', 'Gigabot' ),
				array ( 'Lycos', 'Lycos spider' ),
				array ( 'MSRBOT', 'MSRBOT' ),
				array ( 'Scooter', 'Altavista robot' ),
				array ( 'AltaVista', 'Altavista robot' ),
				array ( 'IDBot', 'ID-Search Bot' ),
				array ( 'eStyle', 'eStyle Bot' ),
				array ( 'Scrubby', 'Scrubby robot' )
			);

			foreach ( $crawlers as $c ) {
				if ( stristr( $USER_AGENT, $c[0] ) ) {
					return ( $c[1] );
				}
			}

			return false;
		}

		public function onlineVisitors( $s = 60 ) {
			return Visitor::where( 'updated_at', '>=', Carbon::now()->subSeconds( $s ) )->count();
		}

		public function visits( $target = 'all' ) {

			switch ( $target ) {
				case 'today':
					return Visit::whereDate( 'created_at', '=', Carbon::today()->toDateString() )->first() ? Visit::whereDate( 'created_at', '=', Carbon::today()->toDateString() )->first()->count : 0;
				break;
				case 'yesterday':
					return Visit::whereDate( 'created_at', '=', Carbon::yesterday()->toDateString() )->first() ? Visit::whereDate( 'created_at', '=', Carbon::yesterday()->toDateString() )->first()->count : 0;
				break;
				default:
					return Visit::sum( 'count' );

			}

		}

		public function visitors( $target = 'all' ) {

			switch ( $target ) {
				case 'today':
					return Visit::whereDate( 'created_at', '=', Carbon::today()->toDateString() )->first() ? Visit::whereDate( 'created_at', '=', Carbon::today()->toDateString() )->first()->real_count : 0;
				break;
				case 'yesterday':
					return Visit::whereDate( 'created_at', '=', Carbon::yesterday()->toDateString() )->first() ? Visit::whereDate( 'created_at', '=', Carbon::yesterday()->toDateString() )->first()->real_count : 0;
				break;
				default:
					return Visit::sum( 'real_count' );

			}

		}

		public function subDayVisits( $day ) {
			return Visit::whereDate( 'created_at', '>=', Carbon::now()->subDays($day)->toDateString() )->first() ? Visit::whereDate( 'created_at', '>=', Carbon::now()->subDays($day)->toDateString() )->sum('count') : 0;
		}

		public function subDayVisitors( $day ) {
			return Visit::whereDate( 'created_at', '>=', Carbon::now()->subDays($day)->toDateString() )->first() ? Visit::whereDate( 'created_at', '>=', Carbon::now()->subDays($day)->toDateString() )->sum('real_count') : 0;
		}
	}
