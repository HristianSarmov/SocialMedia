<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class commentscontroller extends Controller
{
    function getPostComments($postid) {
		
		$comments = DB::select("SELECT `Comments`.`CommentID`, `Comments`.`DateAndTime`, `Comments`.`Text`, `Users`.`PersonID`, `Users`.`FirstName`, `Users`.`LastName`, `Users`.`Username`,`Users`.`ProfilePic` FROM `Users` JOIN `Comments` ON `Users`.`PersonID` = `Comments`.`PersonID` WHERE `Comments`.`PostID` = " . $postid . " ORDER BY `Comments`.`DateAndTime` DESC;");
		foreach ($comments as $comment) {
			$comment -> ProfilePic = "content/".$comment -> ProfilePic;
		}
		//error_log($comments[0] -> FirstName);
		return response() -> json([
			"comments" => $comments
		]);
	}
}
