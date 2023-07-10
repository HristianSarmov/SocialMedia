<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class registercontroller extends Controller
{
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
			return $data;
	}
    function loadreg() {
		$Err = "";
		$firstname = $lastname = $username = $password = $repeatpassword = $email = $gender = $dateofbirth = "";
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if (empty($_POST["username"])) {
				$Err = "Username is required";
			} else {
				$username = registercontroller::test_input($_POST["username"]);
				if (!preg_match('/^[a-zA-Z0-9]{5,}$/',$username)) {
					$Err = "Enter a valid username";
				}
			}
			if (empty($_POST["firstname"])) {
				$Err = "First name is required";
			} else {
				$firstname = registercontroller::test_input($_POST["firstname"]);
				if (!preg_match("/^[а-яА-Яa-zA-Z-' ]*$/", $firstname)) {
					$Err = "Enter a valid name";
				}
			}
			if (empty($_POST["lastname"])) {
				$Err = "Last name is required";
			} else {
				$lastname = registercontroller::test_input($_POST["lastname"]);
				if (!preg_match("/^[а-яА-Яa-zA-Z-' ]*$/", $lastname)) {
					$Err = "Enter a valid name";
				}
			}
			if (empty($_POST["email"])) {
				$Err = "Email is required";
			} else {
				$email = registercontroller::test_input($_POST["email"]);
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$Err = "Invalid email format";
				}
			}
			if (empty($_POST["password"])) {
				$Err = "Password is required";
			} else {
				$password = registercontroller::test_input($_POST["password"]);
				if(!empty($_POST["password"])) {
					$password = registercontroller::test_input($_POST["password"]);
					if(!empty($_POST["password-repeat"])) {
						$repeatpassword = registercontroller::test_input($_POST["password"]);
					}
					if (strlen($_POST["password"]) < '8') {
						$Err = "Your Password Must Contain At Least 8 Characters!";
					}
					elseif(!preg_match("#[0-9]+#",$password)) {
						$Err = "Your Password Must Contain At Least 1 Number!";
					}
					elseif(!preg_match("#[A-Z]+#",$password)) {
						$Err = "Your Password Must Contain At Least 1 Capital Letter!";
					}
					elseif(!preg_match("#[a-z]+#",$password)) {
						$Err = "Your Password Must Contain At Least 1 Lowercase Letter!";
					}
					elseif($password != $repeatpassword) {
						$Err = "Your passwords should match";
					}
				}
			}
			if ($Err != '') {
				return view('register')
					->with('firstname', $firstname)
					->with('lastname', $lastname)
					->with('username', $username)
					->with('password', $password)
					->with('repeatpassword', $repeatpassword)
					->with('email', $email)
					->with('gender', $gender)
					->with('dateofbirth', $dateofbirth)
					->with('error', $Err);
			}
			else {
				$founddata = false;
				$gender = $_POST["gender"];
				$dateofbirth = '';
				if ($_POST["dateofbirth"] != '') {
					$dateofbirth = $_POST["dateofbirth"];
				}
				
				$foundemails = DB::select("SELECT * FROM Users WHERE Email = '$email'");
				if (!empty($foundemails)) {
					$Err = "This email is already being used.";
					$founddata = true;
				}

				$foundusernames = DB::select("SELECT * FROM Users WHERE Username = '$username'");
				if ($founddata == false && !empty($foundusernames)) {
					$Err = "Username is taken";
					$founddata = true;
				}

				if ($founddata == false) {
						DB::insert("INSERT INTO Users (FirstName, LastName, Email, Username, Pass, Gender, DateOfBirth)
						VALUES ('$firstname', '$lastname', '$email', '$username', '$password', '$gender', " . ($dateofbirth == '' ? "NULL" : "'$dateofbirth'") . ");");
				}
				
				if ($Err == "") {
					header("refresh:0; url=login");
				}
			}
		}
		else return view('register');
	}
}
