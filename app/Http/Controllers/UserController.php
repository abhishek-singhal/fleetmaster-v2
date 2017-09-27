<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
    public function __construct(){
    	$this->middleware('LoginAuth');
    }


    public function skin(){
    	$this->validate(request(),[
    		'skin' => 'required',
    		'url' => 'required'
    	]);

    	User::where('id', Auth::user()->id)->update([
    		'skin' => request('skin')
    	]);

    	return redirect(request('url'));
    }

    public function showProfile($id = null){
    	if(is_null($id)){
    		return redirect('profile/'.Auth::user()->id);
    	}
    	return User::where('id', $id)->get();
    }
}
