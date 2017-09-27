<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class MembersController extends Controller
{
	public function __construct(){
		$this->middleware('LoginAuth');
	}

	public function members(){
		$members = User::leftJoin('roles', 'users.rank', '=', 'roles.rank')->where('users.rank', '>=', 3)->get();

		return view('members', compact('members'));
	}

	public function new(){
		$members = User::where('rank' , 0)->get();

		return view('newMembers',compact('members'));
	}

	public function newUpdate(){
		$this->validate(request(), [
			'id' => 'required'
		]);

		switch(request('action')){
			case 'allow':
			User::where('id',request('id'))->update([
				'rank' => 3
			]);
			break;
			case 'deny':
			User::where('id',request('id'))->update([
				'rank' => 1
			]);
			break;
		}

		return redirect('/members/new');
	}

	public function all(){
		$members = User::leftJoin('roles', 'users.rank', '=', 'roles.rank')->get();
		$roles = Role::all();
		return view('allMembers',compact('members', 'roles'));
	}

	public function allUpdate(){
		$this->validate(request(),[
			'id' => 'required'
		]);

		User::where('id',request('id'))->update([
			'rank' => request('new_rank')
		]);

		return redirect('/members/all');
	}
}
