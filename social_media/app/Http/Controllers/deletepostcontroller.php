<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class deletepostcontroller extends Controller
{
    function deletePost($PostID) {
		$success = DB::delete("DELETE FROM `Posts` WHERE `Posts`.`PostID` = " . $PostID . ";");
		if ($success) {
			DB::delete("DELETE FROM `Images` WHERE `Images`.`PostID` = " . $PostID . ";");
			$success = 'true';
		}
		else $success = 'false';
		return response() -> json([
			'success' => $success
		]);
	}
}
