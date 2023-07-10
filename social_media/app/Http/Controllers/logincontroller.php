<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class logincontroller extends Controller
{
    function login() {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$email=$_POST["email"];
			$password=$_POST["password"];
			$Err="";

			$foundEmailOrPass = DB::select("SELECT * FROM Users WHERE Email = '$email' AND Pass = '$password'");
			if (empty($foundEmailOrPass)) {
				$Err="Email or password is incorrect.";
			}

			if ($Err == "") {
				$userIDandUsername = DB::select('SELECT `PersonID`,`Username` FROM `Users` WHERE `Email` = "'.$email.'";');
				session(['PersonID' => $userIDandUsername[0] -> PersonID]);
				session(['Username' => $userIDandUsername[0] -> Username]);
					return redirect('/');
			}
			
			else {
				return view('login')
							->with('error', $Err)
							->with('email', $email)
							->with('password', $password);
			}
		}
		else {
			session()->flush();
			return view('login');
		}
	}
}
