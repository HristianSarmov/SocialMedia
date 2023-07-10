<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use File;

class addimagestopostcontroller extends Controller
{
    function addImagesToPost(Request $request, $PostID) {
		$inputfiles = "addimagesinput".$PostID;
		if($request->hasfile($inputfiles)) {
			foreach ($request -> file($inputfiles) as $file) {
				$filename = $file -> store('/content');
				DB::insert("INSERT INTO `Images` (`ImageFile`, `PostID`) 
				VALUES('" . basename($filename) . "', '$PostID')");
			}
		}
		
		return redirect('/profile/'.session() -> get('Username'));
	}
	
}
