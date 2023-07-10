<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class deletecommentcontroller extends Controller
{
    function deleteComment($CommentID) {
		$success = DB::delete("DELETE FROM `Comments` WHERE `Comments`.`CommentID` = '$CommentID';");
		if ($success) $success = 'true';
		else $success = 'false';
		return response() -> json([
			'success' => $success
		]);
	}
}
