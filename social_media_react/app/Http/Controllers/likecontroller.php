<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class likecontroller extends Controller
{
    function likeAPost($postid) {
		$isliked = DB::select("SELECT * FROM `Likes` WHERE `PostID` = '$postid' AND `PersonID` = '" . session() -> get('PersonID') . "';");
		if (empty($isliked)) {
			$success = DB::insert("INSERT INTO `Likes` (`PersonID`, `PostID`, `DateAndTime`)
			VALUES ('" . session() -> get('PersonID') . "', '$postid', SYSDATE())");
		}
		else $success = DB::delete("DELETE FROM `Likes` WHERE `PostID` = '$postid' AND `PersonID` = '" . session() -> get('PersonID') . "';");
		if ($success) $success = 'true';
		else $success = 'false';
		return response() -> json([
			'success' => $success
		]);
	}
}
