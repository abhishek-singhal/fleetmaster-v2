<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

		return redirect('/event/' . $event_id);	
	}

	public function edit($id){
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

	}

	public function showall(){

	}
}
