<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absent;
use Auth;

class AbsentController extends Controller
{
	public function __construct(){
		$this->middleware('LoginAuth');
	}

	public function show(){
		$absents = Absent::where('id', Auth::user()->id)->get();
		
		return view('absent', compact('absents'));
	}

	public function store(){
		$this->validate(request(), [
			'date' => 'required',
			'reason' => 'required'
		]);

		$date = explode(' - ', request('date'));
		$start = date_create($date[0]);
		$end = date_create($date[1]);

		Absent::create([
			'id' => Auth::user()->id,
			'start' => $start,
			'end' => $end,
			'reason' => request('reason')
		]);

		return redirect('/absent')->with('status', 'success');
	}
}
