function clicklikes(buttonid, postid, divid) {
				if ($(buttonid).val() === 'Show Likes') {
		$(buttonid).val('Hide Likes');
		document.getElementById(divid).innerHTML = "";
		const xhttp = new XMLHttpRequest();
		xhttp.onload = function() {
			const obj = JSON.parse(this.responseText);
			for (person of obj.likes) {
				document.getElementById(divid).innerHTML += 
				"\
				<div class=\"card card-body bg-primary\">\n\
					<table style=\"width: 100%; table-layout: fixed;\">\n\
						<tbody>\n\
							<tr>\n\
								<td id=\"likecommentimage\" style=\"width: 8%; \">\n\
									<img src='/" + person.ProfilePic + "' class=\"listprofilephoto\">\n\
								</td>\n\
								<td>\n\
									<b style=\"font-size: 20px;\">" + person.FirstName + " " + person.LastName+"</b>\n\
									<br>\n\
									<a href=\"/profile/" + person.Username + "\" style=\"font-size: 17px; text-decoration: none; color: black;\">" + person.Username + "</a>\n\
									<br>\n\
									<b style=\"font-size: 12px;\">" + person.DateAndTime + "</b>\n\
								</td>\n\
								<td style=\"float: right;\">\n\
									<i class=\"fa fa-thumbs-up fa-2x\"></i>\n\
								</td>\n\
							</tr>\n\
						</tbody>\n\
					</table>\n\
				</div>";
			}
		};
		xhttp.open("GET", "/likes/"+postid);
		xhttp.send();
	
	}
	else $(buttonid).val('Show Likes');
	
}

function clickcomments(buttonid, postid, divid, personid, postbelongsto) {
	if ($(buttonid).val() === 'Show Comments') {
		$(buttonid).val('Hide Comments');
		document.getElementById(divid).innerHTML = "";
		const xhttp = new XMLHttpRequest();
		xhttp.onload = function() {
			const objcom = JSON.parse(this.responseText);
			for (person of objcom.comments) {
				document.getElementById(divid).innerHTML += 
				"\
				<div id=\"commentid" + person.CommentID + "\" class=\"card card-body bg-primary\">\n\
					<table style=\"width: 100%; table-layout: fixed;\">\n\
						<tbody>\n\
							<tr>\n\
								<td id=\"likecommentimage\" style=\"width: 8%; \">\n\
									<img src='/" + person.ProfilePic + "' class=\"listprofilephoto\">\n\
								</td>\n\
								<td>\n\
									<b style=\"font-size: 20px;\">" + person.FirstName + " " + person.LastName+"</b>\n\
									<br>\n\
									<a href=\"/profile/" + person.Username + "\" style=\"font-size: 17px; text-decoration: none; color: black;\">" + person.Username + "</a>\n\
									<br>\n\
									<b style=\"font-size: 12px;\">" + person.DateAndTime + "</b>\n\
								</td>\n\
								<td style=\"float: right; width: 120%;\">\n\
									<a style=\"word-wrap: break-word;\">" + person.Text + "</a>\n\
								</td>\n\
								<td>\n\ " + 
									deletebutton(person.PersonID, personid, postbelongsto, person.CommentID)
								+ "</td>\n\
							</tr>\n\
						</tbody>\n\
					</table>\n\
				</div>";
			}
		}
		xhttp.open("GET", "/comments/"+postid);
		xhttp.send();
	}
	else $(buttonid).val('Show Comments');
}

function deletebutton(personPersonID, personid, postbelongsto, commentid) {
	if (personPersonID == personid || postbelongsto == personid) {
		return "<button type=\"button\" class=\"btn btn-danger float-right\" onclick=\"deletecomment('" + commentid + "');\"><i class=\"fa fa-ban fa-lg\" aria-hidden=\"true\"></i></button>\n\ ";
	}
	else return "\n\ ";
}

function clickcomment(postid, postpersonid, myid) {
	comment = document.getElementById("commentText"+postid).value;
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		const obj = JSON.parse(this.responseText);
		if (obj.success === 'true') {
			clickcomments('#ShowCommentsButton'+postid, postid, 'collapsecomments'+postid, myid, postpersonid);
			$("#commentButton"+postid).toggleClass("active");
			$("#ShowCommentsButton"+postid).toggleClass("active");
			$("#comment"+postid).collapse('hide');
			$("#collapsecomments"+postid).collapse('show');
		}
	}
	xhttp.open("GET", "/comment/"+postid+"/"+comment);
	xhttp.send();
}

function clicklike(postid) {
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		const obj = JSON.parse(this.responseText);
		if (obj.success === 'true') {
			$('#LikeButton'+postid).toggleClass("active");
		}
	}
	xhttp.open("GET", "/like/"+postid);
	xhttp.send();
}

function deletecomment(commentid) {
	if (confirm("Do you want to delete this comment?")) {
		const xhttp = new XMLHttpRequest();
		xhttp.onload = function() {
			const obj = JSON.parse(this.responseText);
			if (obj.success === 'true') {
				$("#commentid"+commentid).remove();
			}
		}
		xhttp.open("GET", "/deletecomment/" + commentid);
		xhttp.send();
	}
}


function deletepost(postid) {
	if (confirm("Do you want to delete this post?")) {
		const xhttp = new XMLHttpRequest();
		xhttp.onload = function() {
			const obj = JSON.parse(this.responseText);
			if (obj.success === 'true') {
				$("#post"+postid).remove();
			}
		}
		xhttp.open("GET", "/deletepost/" + postid);
		xhttp.send();
	}
}

function updateCaption(postid) {
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		const obj = JSON.parse(this.responseText);
		if (obj.success === 'true') {
			$("#postCaption"+postid).value = obj.newcaption;
			document.location.reload();
		}
	}
	xhttp.open("GET", "/updatecaption/" + postid + "/" + $("#addnewpostcaption"+postid).val());
	xhttp.send();
}

//          --------------------------------       Uploading/Deleteing Photos        --------------------------------



function deleteFromPost(imageid, divid) {
	if (confirm("Do you want to remove this picture from this post?")) {
		const xhttp = new XMLHttpRequest();
		xhttp.onload = function() {
			const obj = JSON.parse(this.responseText);
			if (obj.success == 'true') {
//				$("#carousel-control-next"+postid).click();
//				$("#"+divid).remove();
				document.location.reload();
			}
		}
		xhttp.open("GET", "/deletepicturefrompost/" + imageid);
		xhttp.send();
	}
}


function addPhotosToPost(postid) {
	const xhttp = new XMLHttpRequest();
	alert(postid);
	xhttp.onload = function() {
		const obj = JSON.parse(this.responseText);
		
	}
	xhttp.open("POST", "/addimagestopost/" + postid);
	xhttp.send();
}



//			---------------------------------       Profile Friend Management        --------------------------------




function openProfileFriendsList(PersonID) {
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		const obj = JSON.parse(this.responseText);
		if (obj.success === 'true') {
			document.getElementById("profileFriendsList").innerHTML = "<h1>Friends</h1>";
			friendLists(obj.friends, "profileFriendsList");
		}
	}
	xhttp.open("GET", "/profilefriendslist/"+PersonID);
	xhttp.send();
}

function openProfileFriendRequestsList(PersonID) {
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		const obj = JSON.parse(this.responseText);
		if (obj.success === 'true') {
			document.getElementById("profileFriendRequestsList").innerHTML = "<h1>Friend requests</h1>";
			friendLists(obj.friends, "profileFriendRequestsList");
		}
	}
	xhttp.open("GET", "/profilefriendrequestslist/"+PersonID);
	xhttp.send();
}

function friendLists(FriendsData, divid) {
	for (friend of FriendsData) {
		if (friend.FriendshipState === "I sent request") {
			document.getElementById(divid).innerHTML += "<table><tr class=\"friendlistrow\">\n\
					<td id=\"likecommentimage\">\n\
						<img src=\"/content/" + friend.ProfilePic + "\" class=\"listprofilephoto\">\n\
					</td>\n\
					<td>\n\
						<b style=\"font-size: 20px;\">" + friend.FirstName + " " + friend.LastName + "</b>\n\
						<br>\n\
						<a href=\"/profile/" + friend.Username + "\" style=\"font-size: 17px; text-decoration: none; color: black;\">" + friend.Username + "</a>\n\
					</td>\n\
					<div id=\"FriendManagement" + friend.PersonID + "\">\n\
					<button type=\"button\" class=\"btn btn-danger float-right\" onclick=\"cancelRequest('" + friend.PersonID + "')\"><i class=\"fa fa-ban fa-lg\" aria-hidden=\"true\"></i></button>\n\
					<b class=\"float-right\">Invited by me&nbsp&nbsp</b>\n\
					</div>\n\
</tr></table>";
		}
		else if (friend.FriendshipState === "I was sent request") {
			document.getElementById(divid).innerHTML += "<table><tr class=\"friendlistrow\">\n\
					<td id=\"likecommentimage\">\n\
						<img src=\"/content/" + friend.ProfilePic + "\" class=\"listprofilephoto\">\n\
					</td>\n\
					<td>\n\
						<b style=\"font-size: 20px;\">" + friend.FirstName + " " + friend.LastName + "</b>\n\
						<br>\n\
						<a href=\"/profile/" + friend.Username + "\" style=\"font-size: 17px; text-decoration: none; color: black;\">" + friend.Username + "</a>\n\
					</td>\n\
					<div id=\"FriendManagement" + friend.PersonID + "\">\n\
					<button type=\"button\" class=\"btn btn-success float-right\" onclick=\"acceptRequest('" + friend.PersonID + "')\"><i class=\"fa fa-check fa-lg\" aria-hidden=\"true\"></i></button>\n\
					<a class=\"float-right\">&nbsp</a>\n\
					<button type=\"button\" class=\"btn btn-danger float-right\" onclick=\"rejectRequest('" + friend.PersonID + "')\"><i class=\"fa fa-ban fa-lg\" aria-hidden=\"true\"></i></button>\n\
					</div>\n\
					</tr></table>";
		}
		else {
			document.getElementById(divid).innerHTML += "<table><tr class=\"friendlistrow\">\n\
					<td id=\"likecommentimage\">\n\
						<img src=\"/content/" + friend.ProfilePic + "\" class=\"listprofilephoto\">\n\
					</td>\n\
					<td>\n\
						<b style=\"font-size: 20px;\">" + friend.FirstName + " " + friend.LastName + "</b>\n\
						<br>\n\
						<a href=\"/profile/" + friend.Username + "\" style=\"font-size: 17px; text-decoration: none; color: black;\">" + friend.Username + "</a>\n\
					</td>\n\
					<div id=\"FriendManagement" + friend.PersonID + "\">\n\
					<button type=\"button\" class=\"btn btn-danger float-right\" onclick=\"unfriend('" + friend.PersonID + "')\"><i class=\"fa fa-user-times fa-lg\" aria-hidden=\"true\"></i></button>\n\
					<b class=\"float-right\">Friends&nbsp&nbsp</b>\n\
					</div>\n\
</tr></table>";
		}
	}
}




//			------------------------------------       Friend Management        -------------------------------------




function addFriend(PersonID) {
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		const obj = JSON.parse(this.responseText);
		if (obj.success === 'true') {
			document.getElementById("FriendManagement"+PersonID).innerHTML="\n\
			<button type=\"button\" class=\"btn btn-danger float-right\" onclick=\"cancelRequest('" + PersonID + "')\"><i class=\"fa fa-ban fa-lg\" aria-hidden=\"true\"></i></button>\n\
			<b class=\"float-right\">Invited by me&nbsp&nbsp</b>";
		}
	}
	xhttp.open("GET", "/addfriend/"+PersonID);
	xhttp.send();
}

function cancelRequest(PersonID) {
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		const obj = JSON.parse(this.responseText);
		if (obj.success === 'true') {
			document.getElementById("FriendManagement"+PersonID).innerHTML="\n\
			<button type=\"button\" class=\"btn btn-success float-right\" onclick=\"addFriend('" + PersonID + "')\"><i class=\"fa fa-user-plus fa-lg\" aria-hidden=\"true\"></i></button>\n\
			<b class=\"float-right\">Not related&nbsp&nbsp</b>";
		}
	}
	xhttp.open("GET", "/cancelrequest/"+PersonID);
	xhttp.send();
}

function unfriend(PersonID) {
	if (confirm("Do you want to unfriend this user?")) {
		const xhttp = new XMLHttpRequest();
		xhttp.onload = function() {
			const obj = JSON.parse(this.responseText);
			if (obj.success === 'true') {
				document.getElementById("FriendManagement"+PersonID).innerHTML="\n\
				<button type=\"button\" class=\"btn btn-success float-right\" onclick=\"addFriend('" + PersonID + "')\"><i class=\"fa fa-user-plus fa-lg\" aria-hidden=\"true\"></i></button>\n\
				<b class=\"float-right\">Not related&nbsp&nbsp</b>";
			}
		}
		xhttp.open("GET", "/unfriend/"+PersonID);
		xhttp.send();
	}
}

function rejectRequest(PersonID) {
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		const obj = JSON.parse(this.responseText);
		if (obj.success === 'true') {
			document.getElementById("FriendManagement"+PersonID).innerHTML="\n\
			<button type=\"button\" class=\"btn btn-success float-right\" onclick=\"addFriend('" + PersonID + "')\"><i class=\"fa fa-user-plus fa-lg\" aria-hidden=\"true\"></i></button>\n\
			<b class=\"float-right\">Not related&nbsp&nbsp</b>";
		}
	}
	xhttp.open("GET", "/rejectrequest/"+PersonID);
	xhttp.send();
}

function acceptRequest(PersonID) {
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		const obj = JSON.parse(this.responseText);
		if (obj.success === 'true') {
			document.getElementById("FriendManagement"+PersonID).innerHTML="\n\
			<button type=\"button\" class=\"btn btn-danger float-right\" onclick=\"unfriend('" + PersonID + "')\"><i class=\"fa fa-user-times fa-lg\" aria-hidden=\"true\"></i></button>\n\
			<b class=\"float-right\">Friends&nbsp&nbsp</b>";
		}
	}
	xhttp.open("GET", "/acceptrequest/"+PersonID);
	xhttp.send();
}



//			------------------------------------       LeftPane Management        -------------------------------------



$(document).ready(function() {
	var tab = getCookie("tab");
	if (tab === "profile") {
		$("#profile").addClass("show active");
		$("#friends").css("display","none");
		$("#search").css("display","none");
	}
	else if (tab === "friends") {
		$("#friends").addClass("show active");
		$("#profile").css("display","none");
		$("#search").css("display","none");
	}
	else {
		$("#search").addClass("show active");
		$("#profile").css("display","none");
		$("#friends").css("display","none");
	}
});

$("#showProfile").click(function() {
	$("#profile").css("display","block");
	$("#friends").css("display","none");
	$("#search").css("display","none");
	document.cookie = "tab=profile; path=/"; 
});

$("#showFriends").click(function() {
	$("#friends").css("display","block");
	$("#profile").css("display","none");
	$("#search").css("display","none");
	document.cookie = "tab=friends; path=/"; 
});

$("#showSearch").click(function() {
	$("#profile").css("display","none");
	$("#friends").css("display","none");
	$("#search").css("display","block");
	document.cookie = "tab=search; path=/"; 
});

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
