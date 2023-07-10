<?php

namespace App\Http\Controllers;

use App\Http\Controllers\leftpanecontroller;
use Illuminate\Http\Request;
use DB;
use stdClass;

class notificationscontroller extends Controller
{
    function loadNotifications() {
		$leftpane = new leftpanecontroller;
		$friendRequestNotifications = DB::select("SELECT `Users`.`FirstName`, `Users`.`LastName`, `Users`.`Username`, `Friends`.`DateAndTime`, `Friends`.`PersonID1`, `Users`.`ProfilePic` FROM `Users` JOIN `Friends` ON `Friends`.`PersonID1` = `Users`.`PersonID` WHERE `Friends`.`PendingRequest` = '1' AND `Friends`.`PersonID2` = '" . session() -> get('PersonID') . "' AND `Friends`.`DateAndTime` BETWEEN DATE_ADD(SYSDATE(), INTERVAL -1 MONTH) AND SYSDATE() ORDER BY `Friends`.`DateAndTime` DESC;");
		$friendAcceptedNotifications = DB::select("SELECT `Users`.`FirstName`, `Users`.`LastName`, `Users`.`Username`, `Friends`.`DateAndTime`, `Friends`.`PersonID2`, `Users`.`ProfilePic` FROM `Users` JOIN `Friends` ON `Friends`.`PersonID2` = `Users`.`PersonID` WHERE `Friends`.`PendingRequest` = '0' AND `Friends`.`PersonID1` = '" . session() -> get('PersonID') . "' AND `Friends`.`DateAndTime` BETWEEN DATE_ADD(SYSDATE(), INTERVAL -1 MONTH) AND SYSDATE() ORDER BY `Friends`.`DateAndTime` DESC;");
		$recentPostsLikes = DB::select("SELECT MAX(`Likes`.`DateAndTime`) as lastLikeDate, COUNT(`Likes`.`LikeID`) as amountOfLikes, `Posts`.`PostID` FROM `Posts` JOIN `Likes` ON `Posts`.`PostID` = `Likes`.`PostID` WHERE `Posts`.`UserID` = '" . session() -> get('PersonID') . "' AND `Likes`.`DateAndTime` BETWEEN DATE_ADD(SYSDATE(), INTERVAL -1 MONTH) AND SYSDATE() GROUP BY `Posts`.`PostID` ORDER BY `Likes`.`DateAndTime` DESC;");
		$recentPostsComments = DB::select("SELECT MAX(`Comments`.`DateAndTime`) as lastCommentDate, COUNT(`Comments`.`CommentID`) as amountOfComments, `Posts`.`PostID` FROM `Posts` JOIN `Comments` ON `Posts`.`PostID` = `Comments`.`PostID` WHERE `Posts`.`UserID` = '" . session() -> get('PersonID') . "' AND `Comments`.`DateAndTime` BETWEEN DATE_ADD(SYSDATE(), INTERVAL -1 MONTH) AND SYSDATE() GROUP BY `Posts`.`PostID` ORDER BY `Comments`.`DateAndTime` DESC;");
		
		$i = '0';
		$j = '0';
		$k = '0';
		$t = '0';
		
		$object = new stdClass();
		$object->DateAndTime = date('1000-01-01 12:12:12');
		$friendRequestNotifications[] = $object;
		$friendAcceptedNotifications[] = $object;
		$object = new stdClass();
		$object->lastLikeDate = date('1000-01-01 12:12:12');
		$recentPostsLikes[] = $object;
		$object = new stdClass();
		$object->lastCommentDate = date('1000-01-01 12:12:12');
		$recentPostsComments[] = $object;

		while ($i < count($friendRequestNotifications)-1 || 
			   $j < count($friendAcceptedNotifications)-1 || 
			   $k < count($recentPostsLikes)-1 || 
			   $t < count($recentPostsComments)-1)								{

			if ($friendRequestNotifications[$i] -> DateAndTime > $friendAcceptedNotifications[$j] -> DateAndTime &&
				$friendRequestNotifications[$i] -> DateAndTime > $recentPostsLikes[$k] -> lastLikeDate && 
				$friendRequestNotifications[$i] -> DateAndTime > $recentPostsComments[$t] -> lastCommentDate) 
																				{
				$allNotifications[] = $friendRequestNotifications[$i++];
				$allNotifications[count($allNotifications)-1] -> NotificationType = "newRequest";
			}
			elseif ($friendAcceptedNotifications[$j] -> DateAndTime > $friendRequestNotifications[$i] -> DateAndTime && 
					$friendAcceptedNotifications[$j] -> DateAndTime > $recentPostsLikes[$k] -> lastLikeDate && 
					$friendAcceptedNotifications[$j] -> DateAndTime > $recentPostsComments[$t] -> lastCommentDate) 
																				{
				$allNotifications[] = $friendAcceptedNotifications[$j++];
				$allNotifications[count($allNotifications)-1] -> NotificationType = "acceptedRequest";
			}
			elseif ($recentPostsLikes[$k] -> lastLikeDate > $friendRequestNotifications[$i] -> DateAndTime && 
					$recentPostsLikes[$k] -> lastLikeDate > $friendAcceptedNotifications[$j] -> DateAndTime && 
					$recentPostsLikes[$k] -> lastLikeDate > $recentPostsComments[$t] -> lastCommentDate) 
																				{
				$allNotifications[] = $recentPostsLikes[$k++];
				$allNotifications[count($allNotifications)-1] -> NotificationType = "newLikesRequest";
			}
			else																{
				$allNotifications[] = $recentPostsComments[$t++];
				$allNotifications[count($allNotifications)-1] -> NotificationType = "newCommentsRequest";
			}
		
		}
		return view('notifications')
					->with('notifications', $allNotifications)
					->with('mydata' , $leftpane -> createprofile())
					->with('friends' , $leftpane -> createfriendslist())
					->with('rightpane', 'notifications');
	}
}
