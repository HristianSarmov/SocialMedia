<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class friendsstatecontroller extends Controller
{
    function friendsstate($results) {
		foreach ($results as $result) {
			$requeststate = DB::select("SELECT `PendingRequest` FROM `Friends` WHERE `PersonID1` = '" . session() -> get('PersonID') . "' AND `PersonID2` = '" . $result -> PersonID . "'");
			if ($requeststate) {
				if ($requeststate[0] -> PendingRequest == 0) $result -> requeststate = "Friends";
				else $result -> requeststate = "Invited by me";
			}
			else {
				$requeststate = DB::select("SELECT `PendingRequest` FROM `Friends` WHERE `PersonID1` = '" . $result -> PersonID . "' AND `PersonID2` = '" . session() -> get('PersonID') . "'");
				if ($requeststate) {
					if ($requeststate[0] -> PendingRequest == 0) $result -> requeststate = "Friends";
					else $result -> requeststate = "I was invited";
				}
				else $result -> requeststate = "Not related";
			}
		}
		return $results;
	}
}
