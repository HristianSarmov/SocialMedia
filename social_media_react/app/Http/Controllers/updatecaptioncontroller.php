<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class updatecaptioncontroller extends Controller
{
    function updateCaption($PostID, $newcaption) {
		error_log("newCaptionlkjfdhsg;k");
		$success = DB::update("UPDATE `Posts` SET `Caption` = '$newcaption' WHERE `PostID` = '$PostID';");
		if ($success) {
			$success = 'true';
		}
		else $success = 'false';
		return response() -> json([
			'newcaption' => $newcaption,
			'success' => $success
		]);
	}
}
