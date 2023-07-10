<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class likescontroller extends Controller
{
    function getPostLikes($postid) {
		
		$likes = DB::select("SELECT `Likes`.`DateAndTime`, `Users`.`FirstName`, `Users`.`LastName`, `Users`.`Username`,`Users`.`ProfilePic` FROM `Users` JOIN `Likes` ON `Users`.`PersonID` = `Likes`.`PersonID` WHERE `Likes`.`PostID` = " . $postid . " ORDER BY `Likes`.`DateAndTime` DESC;");
		foreach ($likes as $like) {
			$like -> ProfilePic = "content/".$like -> ProfilePic;
		}
		//error_log($likes[0] -> FirstName);
		return response() -> json([
			"likes" => $likes
		]);
	}
}
