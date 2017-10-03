<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Event;
use App\EventRole;
use App\Driver;
use Auth;

class EventRoleController extends Controller
{
	public function __construct(){
		$this->middleware('LoginAuth');
	}

	public function show($id){
		$save_file = $this->isfileexist($id);
		$event = Event::where('id', $id)->first();
		$event_roles = EventRole::leftjoin('roles', 'event_roles.role_id', '=', 'roles.id')->leftjoin('users', 'event_roles.user_id', '=', 'users.id')->where('event_id', $id)->orderBy('event_roles.role_id')->get();
		$drivers = Driver::leftjoin('users', 'drivers.user_id', '=', 'users.id')->where('event_id', $id)->get();
		return view('event', compact('event', 'event_roles', 'drivers','save_file'));
	}

	public function takeRole(){
		$this->validate(request(), [
			'event_id' => 'required',
			'role_id' => 'required'
		]);

		switch(request('action')){
			case 'take_role':

			if(request('role_id') == 'driver'){
				if($this->isUserHaveRole(request('event_id'), Auth::user()->id)){
					$this->removeRole(request('event_id'), Auth::user()->id);
				}
				if(!$this->isUserDriver(request('event_id'), Auth::user()->id)){
					$this->giveDriver(request('event_id'), Auth::user()->id);
				}
				$take_status = 'success';
				return redirect('/event/'.request('event_id'))->with('take_status', $take_status);
			}else{
				if(!$this->isRoleTaken(request('event_id'), request('role_id'))){
					$this->removeRole(request('event_id'), Auth::user()->id);
					$this->removeDriver(request('event_id'), Auth::user()->id);
					$this->giveRole(request('event_id'), request('role_id'), Auth::user()->id);
					$take_status = 'success';
				}else{
					$take_status = 'failed';
				}
				return redirect('/event/'.request('event_id'))->with('take_status', $take_status);
			}
			break;

			case 'remove_role':

			$this->removeRole(request('event_id'), Auth::user()->id);
			$this->removeDriver(request('event_id'), Auth::user()->id);
			$take_status = 'removed';
			return redirect('/event/'.request('event_id'))->with('take_status', $take_status);
			break;
		}
	}

	public function isUserHaveRole($event_id, $user_id){
		if(is_null(EventRole::where([['user_id', $user_id],['event_id', $event_id]])->first())){
			return false;
		}
		return true;
	}

	private function removeRole($event_id, $user_id){
		EventRole::where([
			['user_id', $user_id],
			['event_id', $event_id]
		])->update([
			'user_id' => NULL,
			'confirm' => NULL
		]);
	}

	private function giveRole($event_id, $role_id, $user_id){
		EventRole::where([
			['event_id', $event_id],
			['role_id', $role_id],
		])->update([
			'user_id' => $user_id,
			'confirm' => 0
		]);
	}

	private function isRoleTaken($event_id, $role_id){
		if(is_null(EventRole::where([['event_id', $event_id], ['role_id', $role_id]])->value('user_id'))){
			return false;
		}
		return true;
	}

	public function isUserDriver($event_id, $user_id){
		if(is_null(Driver::where([['event_id', $event_id],['user_id', $user_id]])->first())){
			return false;
		}
		return true;
	}

	private function giveDriver($event_id, $user_id){
		Driver::create([
			'event_id' => $event_id,
			'user_id' => $user_id
		]);
	}

	private function removeDriver($event_id, $user_id){
		Driver::where([['event_id', $event_id],['user_id', $user_id]])->delete();
	}

	public function confirm(){
		$this->validate(request(), [
			'role_id' => 'required',
			'event_id' => 'required',
		]);

		switch(request('action')){
			case('confirm'):
			EventRole::where([
				['role_id', request('role_id')],
				['event_id', request('event_id')]
			])->update(['confirm' => 1]);
			break;
			case('unconfirm'):
			EventRole::where([
				['role_id', request('role_id')],
				['event_id', request('event_id')]
			])->update(['confirm' => 0]);
			break;
			case('delete'):
			EventRole::where([
				['role_id', request('role_id')],
				['event_id', request('event_id')]
			])->update(['user_id' => NULL, 'confirm' => NULL]);
			break;
		}
		return redirect('/event/'.request('event_id'));
	}

	public function driverRemove(){
		$this->validate(request(), [
			'event_id' => 'required',
			'user_id' => 'required'
		]);
		Driver::where([['event_id', request('event_id')],['user_id', request('user_id')]])->delete();
		
		return redirect('/event/'.request('event_id'));
	}

	public function roleGive(){
		$this->validate(request(), [
			'event_id' => 'required',
			'role_id' => 'required',
			'user_id' => 'required'
		]);

		if(request('role_id') == 'driver'){
			//check if role is available
			//if yes -> check if user has another role.
			//if no. give role
			if($this->isUserHaveRole(request('event_id'), request('user_id')) || $this->isUserDriver(request('event_id'), request('user_id'))){
				$give_status = 'failed_user';
				//failed
			}else{
				//give driver
				$this->giveDriver(request('event_id'), request('user_id'));
				$give_status = 'success';
			}

		}else{
			if($this->isRoleTaken(request('event_id'), request('role_id'))){
				$give_status = 'failed_role';
				//failed
			}else{
				//check if user already has some role
				if($this->isUserHaveRole(request('event_id'), request('user_id')) || $this->isUserDriver(request('event_id'), request('user_id'))){
					$give_status = 'failed_user';
					//failed
				}else{
					//give role
					$this->giveRole(request('event_id'), request('role_id'),request('user_id'));
					$give_status = 'success';
				}
			}

		}
		return redirect('/event/'. request('event_id'))->with('give_status', $give_status);
	}

	public function uploadSave(Request $request){
		$this->validate($request,[
			'event_id' => 'required',
			'save' => 'required'
		]);

		if($request->hasFile('save')){
			if(!$this->isfileexist($request->input('event_id'))){
				if($request->save->extension() == 'zip' || $request->save->extension() == 'ZIP'){
					Storage::putFileAs(
						'public\saves', $request->file('save'), 'FleetMasterEvents-'.$request->input('event_id').'.zip'
					);
					$status_file = "success";
				}
				else{
					$status_file = "failed_ext";
				}
			}else{
				$status_file = "failed_exist";
			}
		}
		
		return redirect('/event/'.$request->input('event_id'))->with('status_file', $status_file);
	}

	public function deleteSave(){
		$this->validate(request(), [
			'event_id' => 'required'
		]);

		if($this->isfileexist(request('event_id'))){
			Storage::delete('public\saves\FleetMasterEvents-'.request('event_id').'.zip');
		}
		return redirect('/event/'.request('event_id'));
	}

	public function isfileexist($event_id){
		return Storage::exists('public\saves\FleetMasterEvents-'.$event_id.'.zip');
	}
}
