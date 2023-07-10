<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\leftpanecontroller;

class notificationpostcontroller extends Controller
{
    function getPost($PostID, $LikesOrComments) {
		$leftpane = new leftpanecontroller;
		$success = $post = DB::select("SELECT * FROM `Posts`JOIN `Users` ON `Posts`.`UserID` = `Users`.`PersonID` WHERE `Posts`.`PostID` = '$PostID';");
		if ($success) {
			$success = 'true';
			$isLiked = DB::select("SELECT `PostID` FROM `Likes` WHERE `PostID` = " . $post[0] -> PostID . " AND `PersonID` = " . session() -> get('PersonID') . ";");
			if (!empty($isLiked)) $post[0] -> isLiked = 'Liked';
			else $post[0] -> isLiked = 'Not Liked';	
			$images = DB::select("SELECT `Images`.`ImageID`, `Images`.`ImageFile`  FROM `Images` JOIN `Posts` ON `Images`.`PostID` = `Posts`.`PostID` WHERE `Posts`.`PostID` = '" . $post[0] -> PostID . "';");
			$post[0] -> Images = $images;
		}
		else $success = 'false';
		return view('post')
					->with('open', $LikesOrComments)
					->with('rightpane' , 'post')
					->with('mydata' , $leftpane -> createprofile())
					->with('friends' , $leftpane -> createfriendslist())
					->with('posts', $post);
	}
}
