<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class changecoverpiccontroller extends Controller
{
    function chooseNewCoverPic(Request $request) {
		$filename = $request -> file('choosenewcoverpic') -> store('/images');
		DB::update("UPDATE `Users` SET `CoverPic` = '" . basename($filename) . "' WHERE `PersonID` = " . session() -> get('PersonID') . ";");
		return redirect('/profile/'.session() -> get('Username'));
	}
}
