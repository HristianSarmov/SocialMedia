<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class cancelrequestcontroller extends Controller
{
    function cancelrequest($PersonID) {
		error_log('kiinsadf');	
		$success = DB::insert("DELETE FROM `Friends` WHERE `PersonID1` = '" . session() -> get('PersonID') . "' AND `PersonID2` = '" . $PersonID . "';");
		if ($success) $success = 'true';
		else $success = 'false';
		return response() -> json([
			'success' => $success
		]);
	}
}
