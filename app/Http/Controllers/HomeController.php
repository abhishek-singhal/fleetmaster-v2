<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Event;
use App\User;

class HomeController extends Controller
{
    public function index(){
    	$members = User::leftjoin('ranks', 'users.rank', '=', 'ranks.rank')->where('users.rank', '>=', 3)->get();
    	return view('home', compact('members'));
    }

    public function dashboard(){
    	$events = Event::where([['time', '>=', Carbon::now()],['status',1]])->get();
    	return view('dashboard', compact('events'));
    }

}
