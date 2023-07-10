<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class rejectrequestcontroller extends Controller
{
    function rejectRequest($PersonID) {
		$success = DB::insert("DELETE FROM `Friends` WHERE `PersonID1` = '" . $PersonID . "' AND `PersonID2` = '" . session() -> get('PersonID') . "';");
		if ($success) $success = 'true';
		else $success = 'false';
		return response() -> json([
			'success' => $success
		]);
	}
}
