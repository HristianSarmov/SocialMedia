<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class getallphotoscontroller extends Controller
{
    function getPhotos($PersonID) {
		$allPhotos = DB::select("SELECT `ImageFile`, `ImageID` FROM `Images` JOIN `Posts` ON `Images`.`PostID` = `Posts`.`PostID` WHERE `Posts`.`UserID` = '$PersonID' ORDER BY `Posts`.`DateAndTime` DESC");
		return response() -> json([
			'photos' => $allPhotos
		]);
	}
}
