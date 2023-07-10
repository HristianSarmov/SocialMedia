<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\leftpanecontroller;

class searchcontroller extends Controller
{
    function showsearch(Request $request) {
		$leftpane = new leftpanecontroller;
		return view('search')
					->with('rightpane' , 'search')
					->with('mydata' , $leftpane -> createprofile())
					->with('friends' , $leftpane -> createfriendslist())
					->with('searchresults', $leftpane -> searchusers());
	}
	
	function redirecttopost() {
		return redirect('/post');
	}
}
