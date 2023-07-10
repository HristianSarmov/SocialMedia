<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class gallerycontroller extends Controller
{
    function openGallery($personID) {
		$leftpane = new leftpanecontroller;
		return view('gallery')
				->with('person', $personID)
				->with('rightpane' , 'gallery')
				->with('mydata' , $leftpane -> createprofile())
				->with('friends' , $leftpane -> createfriendslist());
	}
}
