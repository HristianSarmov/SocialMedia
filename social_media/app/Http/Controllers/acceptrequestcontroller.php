<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class acceptrequestcontroller extends Controller
{
    function acceptRequest($PersonID) {
		$success = DB::update("UPDATE `Friends` SET `PendingRequest` = '0' WHERE `PersonID1` = '" . $PersonID . "' AND `PersonID2` = '" . session() -> get('PersonID') . "';");
		if ($success) $success = 'true';
		else $success = 'false';
		return response() -> json([
			'success' => $success
		]);	
	}
}
