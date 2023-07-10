<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;

class addnewpostcontroller extends Controller
{
    function addNewPost(Request $request, $PersonID) {
		$inputfiles = "addnewpostimages".$PersonID;
		DB::insert("INSERT INTO `Posts` (`UserID`, `Caption`, `DateAndTime`)
		VALUES ('$PersonID', '" . $request -> input('addnewpostcaption'.$PersonID) . "', SYSDATE())");
		$newpostID = DB::select("SELECT `PostID` FROM `Posts` WHERE `PostID`=(SELECT max(`PostID`) FROM `Posts`)");
		if ($request -> file($inputfiles)) {
			foreach ($request -> file($inputfiles) as $file) {
				$filename = $file -> store('/content');
				if (isset($newpostID[0])) {
					DB::insert("INSERT INTO `Images` (`ImageFile`, `PostID`) 
					VALUES('" . basename($filename) . "', " . $newpostID[0]->PostID . ")");
				}
			}
		}
		return redirect('/profile/'.session() -> get('Username'));
	}
}
