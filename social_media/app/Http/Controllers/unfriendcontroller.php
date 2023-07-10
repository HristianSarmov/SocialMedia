<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class unfriendcontroller extends Controller
{
	function unfriend($PersonID) {
		$success = DB::insert("DELETE FROM `Friends` WHERE `PersonID1` = '" . session() -> get('PersonID') . "' AND `PersonID2` = '" . $PersonID . "' OR `PersonID1` = '" . session() -> get('PersonID') . "' AND `PersonID2` = '" . $PersonID . "';");
		if ($success) $success = 'true';
		else $success = 'false';
		return response() -> json([
			'success' => $success
		]);
	}
}
