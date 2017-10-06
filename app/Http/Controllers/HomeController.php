<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Event;

class HomeController extends Controller
{
    public function index(){
    	//insert view
    	return "HOMEPAGE";
    }

    public function dashboard(){
    	$events = Event::where([['time', '>=', Carbon::now()],['status',1]])->get();
    	return view('dashboard', compact('events'));
    }
}
