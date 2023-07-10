<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\friendsstatecontroller;

class leftpanecontroller extends Controller
{
    function createfriendslist() {
		$friends = DB::select("SELECT `Users`.`FirstName`,`Users`.`LastName`,`Users`.`Username`,`Users`.`PersonID`, `Users`.`ProfilePic` FROM `Users` WHERE (`Users`.`PersonID` IN (SELECT `Friends`.`PersonID1` FROM `Friends` WHERE '".session()->get('PersonID')."' = `Friends`.`PersonID2` AND `Friends`.`PendingRequest` = 0)) OR (`Users`.`PersonID` IN (SELECT `Friends`.`PersonID2` FROM `Friends` WHERE '".session()->get('PersonID')."' = `Friends`.`PersonID1` AND `Friends`.`PendingRequest` = 0))");
		return $friends;
	}
	
	function createprofile() {
		$mydata = DB::select("SELECT * FROM `Users` WHERE `PersonID` = '".session()->get('PersonID')."'");
		return $mydata;
	}
	
	function searchusers() {
		$searchresults = '';
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$searcheduserssql = 'SELECT `PersonID`, `FirstName`, `LastName`, `Username`, `ProfilePic` FROM `Users` WHERE ';
			if (isset($_POST["Username"])) $searcheduserssql = $searcheduserssql . 'INSTR(lower(Username), lower("'.trim($_POST["search"]).'")) ';
			else $searcheduserssql = $searcheduserssql . 'true ';
			if (isset($_POST["Email"])) $searcheduserssql = $searcheduserssql . 'OR INSTR(lower(Email), lower("'.trim($_POST["search"]).'")) ';
			else $searcheduserssql = $searcheduserssql . 'AND true ';
			if (isset($_POST["FirstName"])) $searcheduserssql = $searcheduserssql . 'OR INSTR(lower(FirstName), lower("'.trim($_POST["search"]).'")) ';
			else $searcheduserssql = $searcheduserssql . 'AND true ';
			if (isset($_POST["LastName"])) $searcheduserssql = $searcheduserssql . 'OR INSTR(lower(LastName), lower("'.trim($_POST["search"]).'")) ';
			else $searcheduserssql = $searcheduserssql . 'AND true ';
			$searchresults = DB::select($searcheduserssql);
			$friendsstate = new friendsstatecontroller;
			$searchresults = $friendsstate -> friendsstate($searchresults);
		}		
		return $searchresults;
	}
}
