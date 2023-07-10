<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class deletePictureFromPostcontroller extends Controller
{
    function deletePictureFromPost($ImageID) {
		$success = DB::delete("DELETE FROM `Images` WHERE `Images`.`ImageID` = " . $ImageID . ";");
		if ($success) {
			$success = 'true';
		}
		else $success = 'false';
		return response() -> json([
			'success' => $success
		]);
	}
}
