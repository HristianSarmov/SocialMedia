<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\leftpanecontroller;
use DB;
class profilecontroller extends Controller
{
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
			return $data;
	}
	
	function showuserprofile(Request $request, $username) {
		$userdata = DB::select('SELECT * FROM `Users` WHERE `Username` = "'.$username.'"');
		$userposts = DB::select("SELECT `Users`.`PersonID`, `Users`.`FirstName`, `Users`.`LastName`, `Users`.`Username`, `Users`.`ProfilePic`, `Posts`.`PostID`, `Posts`.`DateAndTime`, `Posts`.`Caption` FROM `Users` JOIN `Posts` ON `Users`.`PersonID` = `Posts`.`UserID` WHERE " . $userdata[0] -> PersonID . "=`Posts`.`UserID` ORDER BY `Posts`.`DateAndTime` DESC;");
		$leftpane = new leftpanecontroller;
		foreach ($userposts as $post) {
			$isLiked = DB::select("SELECT `PostID` FROM `Likes` WHERE `PostID` = " . $post -> PostID . " AND `PersonID` = " . session() -> get('PersonID') . ";");
			if (!empty($isLiked)) $post -> isLiked = 'Liked';
			else $post -> isLiked = 'Not Liked';
			$images = DB::select("SELECT `Images`.`ImageID`, `Images`.`ImageFile` FROM `Images` JOIN `Posts` ON `Images`.`PostID` = `Posts`.`PostID` WHERE `Posts`.`PostID` = '" . $post -> PostID . "';");
			$post -> Images = $images;
		}
		if (isset($_GET['error'])) {
			return view('profile')
						->with('error', $_GET['error'])
						->with('rightpane' , 'profile')
						->with('mydata' , $leftpane -> createprofile())
						->with('friends' , $leftpane -> createfriendslist())
						->with('myprofdata' , $userdata)
						->with('posts', $userposts);
		}
		else return view('profile')
						->with('error', '')
						->with('rightpane' , 'profile')
						->with('mydata' , $leftpane -> createprofile())
						->with('friends' , $leftpane -> createfriendslist())
						->with('myprofdata' , $userdata)
						->with('posts', $userposts);
	}
	
	
	
	function showupdateduserprofile(Request $request, $username) {
		$userdata = DB::select('SELECT * FROM `Users` WHERE `Username` = "'.$username.'"');
		$leftpane = new leftpanecontroller;
		$Err = "";
		$firstname = $lastname = $newusername = $password = $repeatpassword = $email = $gender = $dateofbirth = "";
		if (empty($_POST["username"])) {
			$Err = "Username is required";
		} else {
			$newusername = profilecontroller::test_input($_POST["username"]);
			if (!preg_match('/^[a-zA-Z0-9]{5,}$/',$newusername)) {
				$Err = "Enter a valid username";
			}
		}
		if (empty($_POST["firstname"])) {
			$Err = "First name is required";
		} else {
			$firstname = profilecontroller::test_input($_POST["firstname"]);
			if (!preg_match("/^[а-яА-Яa-zA-Z-' ]*$/", $firstname)) {
				$Err = "Enter a valid name";
			}
		}
		if (empty($_POST["lastname"])) {
			$Err = "Last name is required";
		} else {
			$lastname = profilecontroller::test_input($_POST["lastname"]);
			if (!preg_match("/^[а-яА-Яa-zA-Z-' ]*$/", $lastname)) {
				$Err = "Enter a valid name";
			}
		}
		if (empty($_POST["email"])) {
			$Err = "Email is required";
		} else {
			$email = profilecontroller::test_input($_POST["email"]);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$Err = "Invalid email format";
			}
		}
		if (empty($_POST["password"])) {
			$Err = "Password is required";
		} else {
			$password = profilecontroller::test_input($_POST["password"]);
			if(!empty($_POST["password"])) {
				$password = profilecontroller::test_input($_POST["password"]);
				if(!empty($_POST["password-repeat"])) {
					$repeatpassword = profilecontroller::test_input($_POST["password-repeat"]);
				}
				else {
					$Err = "Repeat your password";
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

		$founddata = false;
		$gender = $_POST["gender"];
		$dateofbirth = '';
		if ($_POST["dateofbirth"] != '') {
			$dateofbirth = $_POST["dateofbirth"];
		}

		$foundemails = DB::select("SELECT * FROM Users WHERE Email = '$email' AND Email != '" . $userdata[0]->Email . "'");
		if (!empty($foundemails)) {
			$Err = "This email is already being used.";
			$founddata = true;
		}

		$foundusernames = DB::select("SELECT * FROM Users WHERE Username = '$newusername' AND Username != '$username'");
		if ($founddata == false && !empty($foundusernames)) {
			$Err = "Username is taken";
			$founddata = true;
		}

		if ($founddata == false) {
			DB::update("UPDATE `Users` SET "
					. "`FirstName` = '$firstname', "
					. "`LastName` = '$lastname', "
					. "`Email` = '$email', "
					. "`Username` = '$newusername', "
					. "`Pass` = '$password', "
					. "`Gender` = '$gender', "
					. "`DateOfBirth` = " . ($dateofbirth == '' ? "NULL" : "'$dateofbirth'") . ", "
					. "`Bio` = '" . $_POST['Bio'] . "', "
					. "`RelationshipStatus` = '" . $_POST['RelationshipStatus'] . "', "
					. "`Education` = '" . $_POST['Education'] . "', "
					. "`Workplace` = '" . $_POST['Workplace'] . "', "
					. "`ProfilePic` = '1.jpeg', "
					. "`CoverPic` = '2.jpeg' "
					. "WHERE `PersonID` = '" . session() -> get('PersonID') . "';");
			session(['Username' => $newusername]);
		}
		return redirect("/profile/" . $newusername . '?error=' . $Err);
	}
}
