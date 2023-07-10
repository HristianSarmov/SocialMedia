<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class commentcontroller extends Controller
{
    function commentOnAPost($postid, $comment) {
		
		$success = DB::insert("INSERT INTO `Comments` (Text, PostID, PersonID, DateAndTime)
		VALUES ('$comment', '$postid', '" . session() -> get('PersonID') . "', SYSDATE())");
		if ($success) $success = 'true';
		else $success = 'false';
		return response() -> json([
			'success' => $success
		]);
	}
}
