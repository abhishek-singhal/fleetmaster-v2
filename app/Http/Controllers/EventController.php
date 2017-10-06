<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Event;
use App\EventRole;
use App\Role;
use Auth;

class EventController extends Controller
{
	public function __construct(){
		$this->middleware('LoginAuth');
	}

	public function create(){
		$roles = Role::all();
		return view('createEvent', compact('roles'));
	}

	public function store(){
		$this->validate(request(),[
			'event_name' => 'required',
			'server' => 'required',
			'source' => 'required',
			'destination' => 'required',
			'time' => 'required',
		]);
		if(request('trailer'))
			$trailer=true;
		else
			$trailer=false;

		$event_id = Event::create([
			'user_id' => Auth::user()->id,
			'name' => request('event_name'),
			'server' => request('server'),
			'source' => request('source'),
			'destination' => request('destination'),
			'time' => request('time'),
			'trailer' => $trailer,
			'route' => request('route'),
			'ets2c' => request('ets2c'),
			'sheet' => request('sheet'),
			'notes' => request('notes')
		])->id;

		for($i=1;$i<=15;$i++){
			if(request('role'.$i)){
				EventRole::create([
					'event_id' => $event_id,
					'role_id' => $i
				]);
			}
		}
		$status = 'success';
		return redirect('/event/create')->with('status', $status);	
	}

	public function edit($id){
		if(Auth::user()->rank < 4 && Auth::user()->id != Event::where('id', $id)->value('user_id')){
			return redirect('/dashboard');
		}
		$event_roles = EventRole::where('event_id', $id)->get();
		$roles = Role::all();
		$event = Event::where('id', $id)->first();
		return view('editEvent', compact('roles', 'event', 'event_roles'));
	}

	public function update(){
		$this->validate(request(),[
			'id' => 'required',
			'event_name' => 'required',
			'server' => 'required',
			'source' => 'required',
			'destination' => 'required',
			'time' => 'required',
		]);
		if(Auth::user()->rank < 4 && Auth::user()->id != Event::where('id', request('id'))->value('user_id')){
			return redirect('/dashboard');
		}
		if(request('trailer'))
			$trailer=true;
		else
			$trailer=false;

		Event::where('id', request('id'))->update([
			'user_id' => Auth::user()->id,
			'name' => request('event_name'),
			'server' => request('server'),
			'source' => request('source'),
			'destination' => request('destination'),
			'time' => request('time'),
			'trailer' => $trailer,
			'route' => request('route'),
			'ets2c' => request('ets2c'),
			'sheet' => request('sheet'),
			'notes' => request('notes')
		]);

		EventRole::where('event_id', request('id'))->delete();

		for($i=1;$i<=15;$i++){
			if(request('role'.$i)){
				EventRole::create([
					'event_id' => request('id'),
					'role_id' => $i
				]);
			}
		}

		return redirect('/event/' . request('id'));

	}

	public function show(){
		$id = Event::where([['time', '>=', Carbon::now()], ['status', 1]])->orderby('time')->first();
		if(is_null($id))
			return redirect('dashboard');
		else
			return redirect('/event/'.$id->id);
	}

	public function new(){
		$events = Event::where([['time', '>=', Carbon::now()],['status', 0]])->get();
		return view('newEvents', compact('events'));
	}

	public function approve(){
		$this->validate(request(), [
			'event_id' => 'required'
		]);

		Event::where('id', request('event_id'))->update([
			'status' => 1,
			'approved_by' => Auth::user()->id
		]);

		return redirect('/event/'.request('event_id'));
	}
}
