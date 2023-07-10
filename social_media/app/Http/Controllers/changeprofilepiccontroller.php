<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class changeprofilepiccontroller extends Controller
{
    function chooseNewProfilePic(Request $request) {
		$filename = $request -> file('choosenewprofilepic') -> store('/images');
		DB::update("UPDATE `Users` SET `ProfilePic` = '" . basename($filename) . "' WHERE `PersonID` = " . session() -> get('PersonID') . ";");
		return redirect('/profile/'.session() -> get('Username'));
	}
}
