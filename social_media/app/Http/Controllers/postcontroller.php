<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\leftpanecontroller;
use Illuminate\Support\Facades\DB;

class postcontroller extends Controller
{
    function showposts(Request $request) {
		$leftpane = new leftpanecontroller;
		$friendsposts = DB::select("SELECT `Users`.`PersonID`, `Users`.`FirstName`, `Users`.`LastName`, `Users`.`Username`, `Users`.`ProfilePic`, `Posts`.`PostID`, `Posts`.`DateAndTime`, `Posts`.`Caption` FROM `Users` JOIN `Posts` ON `Users`.`PersonID`=`Posts`.`UserID` WHERE (`Posts`.`UserID` IN (SELECT `Users`.`PersonID` FROM `Users` WHERE (`Users`.`PersonID` IN (SELECT `Friends`.`PersonID1` FROM `Friends` WHERE '".session()->get('PersonID')."' = `Friends`.`PersonID2` AND `Friends`.`PendingRequest` = 0)) OR (`Users`.`PersonID` IN (SELECT `Friends`.`PersonID2` FROM `Friends` WHERE '".session()->get('PersonID')."' = `Friends`.`PersonID1` AND `Friends`.`PendingRequest` = 0)))) ORDER BY `Posts`.`DateAndTime` DESC");
		foreach ($friendsposts as $post) {
			$isLiked = DB::select("SELECT `PostID` FROM `Likes` WHERE `PostID` = " . $post -> PostID . " AND `PersonID` = " . session() -> get('PersonID') . ";");
			if (!empty($isLiked)) $post -> isLiked = 'Liked';
			else $post -> isLiked = 'Not Liked';
			$images = DB::select("SELECT `Images`.`ImageID`, `Images`.`ImageFile`  FROM `Images` JOIN `Posts` ON `Images`.`PostID` = `Posts`.`PostID` WHERE `Posts`.`PostID` = '" . $post -> PostID . "';");
			$post -> Images = $images;
		}
		return view('post')
					->with('rightpane' , 'post')
					->with('mydata' , $leftpane -> createprofile())
					->with('friends' , $leftpane -> createfriendslist())
					->with('posts', $friendsposts);
	}
}
