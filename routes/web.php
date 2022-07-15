<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Spatie\Analytics\Period;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $startDate = Carbon::now()->subYear();
    $endDate = Carbon::now();
    $period = Period::create($startDate, $endDate);
    $analyticsData = Analytics::fetchVisitorsAndPageViews($period);

    // retrieve sessions and pageviews with yearMonth dimension since 1 year ago
    // $analyticsData = Analytics::performQuery(
    //     Period::years(1),
    //     'ga:sessions',
    //     [
    //         'metrics' => 'ga:sessions, ga:pageviews',
    //         'dimensions' => 'ga:yearMonth'
    //     ]
    // );
    // dd($analyticsData);
    return view('welcome', ['analyticsData' => $analyticsData]);
    // return view('welcome');
});
