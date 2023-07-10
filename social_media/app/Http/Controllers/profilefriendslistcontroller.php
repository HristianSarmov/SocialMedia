<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class profilefriendslistcontroller extends Controller
{
	function getFriends($PersonID) {
		$friends = $success = DB::select("SELECT `Users`.`PersonID`, `Users`.`FirstName`,`Users`.`LastName`,`Users`.`Username`,`Users`.`PersonID`, `Users`.`ProfilePic` FROM `Users` WHERE (`Users`.`PersonID` IN (SELECT `Friends`.`PersonID1` FROM `Friends` WHERE '$PersonID' = `Friends`.`PersonID2` AND `Friends`.`PendingRequest` = 0)) OR (`Users`.`PersonID` IN (SELECT `Friends`.`PersonID2` FROM `Friends` WHERE '$PersonID' = `Friends`.`PersonID1` AND `Friends`.`PendingRequest` = 0))");
		if ($success) {
			$success = 'true';
			foreach ($friends as $friend) {
				$friend -> FriendshipState = "Friends";
			}
		}
		else $success = 'false';
		return response() -> json([
			'friends' => $friends,
			'success' => $success
		]);
	}
}
