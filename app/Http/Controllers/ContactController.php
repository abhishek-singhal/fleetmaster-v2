<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    public function __construct(){
        $this->middleware('LoginAuth', ['except' => 'store']);
    }

    public function store(){
    	$this->validate(request(),[
    		'name' => 'required',
    		'email' => 'required',
    		'message' => 'required',
    	]);

    	Contact::create([
    		'name' => request('name'),
    		'email' => request('email'),
    		'message' => request('message')
    	]);

    	return "Message Sent!";
    }

    public function show($id = null){
        $contacts = Contact::orderby('created_at', 'desc')->get();
        if(!is_null($id)){
            Contact::where('serial', $id)->update(['status' => 1]);
            $message = Contact::where('serial', $id)->first();
        }
        return view('contact', compact('contacts', 'id', 'message'));
    }

    public function status(){
        $this->validate(request(), [
            'id' => 'required',
            'url' => 'required'
        ]);

        switch(request('action')){
            case('read'):
            Contact::where('serial', request('id'))->update([
                'status' => 1
            ]);
            break;
            case('unread'):
            Contact::where('serial', request('id'))->update([
                'status' => 0
            ]);
            break;
        }

        return redirect(request('url'));
    }
}
