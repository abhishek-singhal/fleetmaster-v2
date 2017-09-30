<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rank;

class MembersController extends Controller
{
	public function __construct(){
		$this->middleware('LoginAuth');
	}

	public function members(){
		$members = User::leftJoin('ranks', 'users.rank', '=', 'ranks.rank')->where('users.rank', '>=', 3)->get();

		return view('members', compact('members'));
	}

	public function new(){
		$members = User::where('rank' , 0)->get();

		return view('newMembers', compact('members'));
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
		$members = User::leftJoin('ranks', 'users.rank', '=', 'ranks.rank')->get();
		$ranks = Rank::all();
		return view('allMembers',compact('members', 'ranks'));
	}

	public function allUpdate(){
		$this->validate(request(),[
			'id' => 'required',
			'new_rank' => 'required'
		]);

		User::where('id',request('id'))->update([
			'rank' => request('new_rank')
		]);

		return redirect('/members/all');
	}
}
