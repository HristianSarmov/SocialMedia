<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class addfriendcontroller extends Controller
{
    function addFriend($PersonID) {
		$success = DB::insert("INSERT INTO `Friends` (`PersonID1`, `PersonID2`, `PendingRequest`, `DateAndTime`)
		VALUES ('" . session() -> get('PersonID') . "', '" . $PersonID . "', '1', SYSDATE())");
		if ($success) $success = 'true';
		else $success = 'false';
		return response() -> json([
			'success' => $success
		]);
	}
}
