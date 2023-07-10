<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class profilefriendrequestslistcontroller extends Controller
{
    function getFriendRequests($PersonID) {
		$myFriendRequests = $success = DB::select("SELECT * FROM `Users` JOIN `Friends` ON `Users`.`PersonID` = `Friends`.`PersonID1` WHERE `Friends`.`PersonID2` = '" . session() -> get('PersonID') . "' AND `Friends`.`PendingRequest` = '1' ORDER BY `Friends`.`DateAndTime` DESC;");
		$othersFriendsRequests = $success2 = DB::select("SELECT * FROM `Users` JOIN `Friends` ON `Users`.`PersonID` = `Friends`.`PersonID2` WHERE `Friends`.`PersonID1` = '" . session() -> get('PersonID') . "' AND `Friends`.`PendingRequest` = '1' ORDER BY `Friends`.`DateAndTime` DESC;");
		
		if ($success || $success2) {
			$i = '0';
			foreach ($myFriendRequests as $frRequest) {
				$myFriendRequests[$i++] -> FriendshipState = "I was sent request";
			}
			$success = 'true';
			foreach ($othersFriendsRequests as $frRequest) {
				$myFriendRequests[$i] = $frRequest;
				$myFriendRequests[$i++] -> FriendshipState = "I sent request";
			}
		}
		else $success = 'false';
		return response() -> json([
			'friends' => $myFriendRequests,
			'success' => $success
		]);
	}
}
