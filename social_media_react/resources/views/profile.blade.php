@extends('index')
@extends('leftpane')

@section('profile')
	<link href="{{ asset('css/register.css') }}" rel="stylesheet">
	<link href="{{ asset('css/profile.css') }}" rel="stylesheet">
<div class="bg-primary border-radius-5 p-2">
	<span id="person" value="{{ $myprofdata[0]->PersonID }}"></span>
		@if (session()->get('PersonID') == $myprofdata[0]->PersonID)
			<img class="coverphotoinpage" src="{{ asset('content/'.$myprofdata[0] -> CoverPic) }}" onclick="document.getElementById('changeCoverPic').style.display='block'">
			<img class="profilephotoinpage" src="{{ asset('content/'.$myprofdata[0] -> ProfilePic) }}" onclick="document.getElementById('changeProfilePic').style.display='block'">
		@else 
			<img class="coverphoto" src="{{ asset('content/'.$myprofdata[0] -> CoverPic) }}">
			<img class="profilephoto" src="{{ asset('content/'.$myprofdata[0] -> ProfilePic) }}">
		@endif
		<form method="post">
			@csrf
			<div>
				<div>
					<input class="names" type="text" placeholder="First name" name="firstname" id="firstname" {{ (session()->get('PersonID') != $myprofdata[0]->PersonID) ? 'readonly' : '' }} required value="{{ $myprofdata[0] -> FirstName }}"> 
					<input class="names" type="text" placeholder="Last name" name="lastname" id="lastname" {{ (session()->get('PersonID') != $myprofdata[0]->PersonID) ? 'readonly' : '' }} required value="{{ $myprofdata[0] -> LastName }}">
				</div>
				<input class="email" type="email" placeholder="Your Email" name="email" id="email" {{ (session()->get('PersonID') != $myprofdata[0]->PersonID) ? 'readonly' : '' }} required value="{{ $myprofdata[0] -> Email }}">
				<br>
				<input class="username" type="text" placeholder="Enter Username" name="username" id="username" {{ (session()->get('PersonID') != $myprofdata[0]->PersonID) ? 'readonly' : '' }} required value="{{ $myprofdata[0] -> Username }}">
				<br>
				@if (session()->get('PersonID') == $myprofdata[0]->PersonID)
					<div>
						<input class="password" type="password" placeholder="Enter Password" name="password" id="psw"  required value="{{ $myprofdata[0] -> Pass }}">
						<input class="password" type="password" placeholder="Repeat Password" name="password-repeat" id="psw-repeat" required>
					</div>
				@endif
				<div class="dateofbirthANDgender">
					<input class="dateofbirth" type="date" name="dateofbirth" id="dateofbirth" {{ (session()->get('PersonID') != $myprofdata[0]->PersonID) ? 'readonly' : '' }} value="{{ $myprofdata[0] -> DateOfBirth }}">

					@if ($myprofdata[0] -> Gender == 'Male')
						<input type="radio" name="gender" id="male" {{ (session()->get('PersonID') != $myprofdata[0]->PersonID) ? 'readonly' : '' }} checked value="Male">Male
						<input type="radio" name="gender" id="female" {{ (session()->get('PersonID') != $myprofdata[0]->PersonID) ? 'readonly' : '' }} value="Female">Female
					@else
						<input type="radio" name="gender" id="male" {{ (session()->get('PersonID') != $myprofdata[0]->PersonID) ? 'readonly' : '' }} value="Male">Male
						<input type="radio" name="gender" id="female" {{ (session()->get('PersonID') != $myprofdata[0]->PersonID) ? 'readonly' : '' }} value="Female" checked>Female
					@endif
					
				</div>
				@if (session()->get('PersonID') == $myprofdata[0]->PersonID )
					<span class="error">{{ $error ?? ''}}</span>
				@endif
				<br><br>
				
				<table style="margin-left: auto; margin-right: auto;">
					<tbody>
						<tr>
							<td><a>Bio:</a></td>
							<td><a>Education:</a></td>
							<td><a>Workplace:</a></td>
						</tr>
						<tr>
							<td><textarea name="Bio" id="Bio" rows="5" columns="40" {{ (session()->get('PersonID') != $myprofdata[0]->PersonID) ? 'readonly' : '' }}>{{ $myprofdata[0] -> Bio }}</textarea></td>
							<td><textarea name="Education" id="Education" rows="5" columns="40" {{ (session()->get('PersonID') != $myprofdata[0]->PersonID) ? 'readonly' : '' }}>{{ $myprofdata[0] -> Education }}</textarea></td>
							<td><textarea name="Workplace" id="Workplace" rows="5" columns="40" {{ (session()->get('PersonID') != $myprofdata[0]->PersonID) ? 'readonly' : '' }}>{{ $myprofdata[0] -> Workplace }}</textarea></td>
						</tr>
					</tbody>
				</table>	
				<br>
					@if ($myprofdata[0] -> RelationshipStatus == 'Single')
						<input type="radio" name="RelationshipStatus" id="Single" {{ (session()->get('PersonID') != $myprofdata[0]->PersonID) ? 'readonly' : '' }} checked value="Single">Single
						<input type="radio" name="RelationshipStatus" id="Taken" {{ (session()->get('PersonID') != $myprofdata[0]->PersonID) ? 'readonly' : '' }} value="Taken">Taken
					@else
						<input type="radio" name="RelationshipStatus" id="Single" {{ (session()->get('PersonID') != $myprofdata[0]->PersonID) ? 'readonly' : '' }} value="Single">Single
						<input type="radio" name="RelationshipStatus" id="Taken" {{ (session()->get('PersonID') != $myprofdata[0]->PersonID) ? 'readonly' : '' }} value="Taken" checked>Taken
					@endif
				<br>
				<br>
				@if (session()->get('PersonID') == $myprofdata[0]->PersonID)
					<button type="submit" class="registerbtn" name="submit" value="Submit" formmethod="post">Save Changes</button>
				@endif
				<br>
				<br>
				<input type="button" class="btn btn-primary w-25" data-toggle="collapse" data-target="#profileFriendsList" id="ShowFriends" value='Friends' onClick='openProfileFriendsList("{{$myprofdata[0]->PersonID}}"); jQuery(this).toggleClass("active");'>
				@if (session()->get('PersonID') == $myprofdata[0]->PersonID)
					<input type="button" class="btn btn-primary w-25" data-toggle="collapse" data-target="#profileFriendRequestsList" id="ShowFriendRequests" value='Friend requests' onClick='openProfileFriendRequestsList("{{ $myprofdata[0]->PersonID }}"); jQuery(this).toggleClass("active");'>
				@else
					<input type="button" class="btn btn-primary disabled w-25" id="ShowFriendRequests" value='Friend requests'>
				@endif
				<div class="collapse mt-1" id='profileFriendsList'>
					<h1>Friends</h1>
				</div>
				<div class="collapse mt-1" id='profileFriendRequestsList'>
					<h1>Friend requests</h1>
				</div>
				<br>
				<button type="button" onclick="document.getElementById('newPostModal').style.display='block'" class="registerbtn btn-outline-primary mt-4">Create a new post</button>
				<button type="button" onclick="location.href='/gallery/'+document.getElementById('person').getAttribute('value');" class="registerbtn btn-outline-primary mt-4">View gallery</button>
			</div>
		</form>
		<div id="newPostModal" class="modal1">
		  <span onclick="document.getElementById('newPostModal').style.display='none'" class="close1" title="Close Modal">&times;</span>
		  <form class="modal-content1 h-35" action="/addnewpost/{{ session() -> get('PersonID') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="container1">
			  <h2 class="float-left">Create a new post</h2>
			  <br><br>
			  <div class="form-floating">
				<div class="input-group flex-nowrap">
				  <textarea class="float-left form-control mb-3" placeholder="Caption" id="addnewpostcaption{{ session() -> get('PersonID') }}" name="addnewpostcaption{{ session() -> get('PersonID') }}"></textarea>
				  <button type="button" class="btn-transparent" data-toggle="modal" data-target="#emojiModal" onclick="openemojilist('-1'); opennewcaptionemojilist();"><i class="fa fa-smile-o fa-2x" aria-hidden="true"></i></button>
				</div>
			  </div>
			  <br>
			  <input class="float-left" id="addnewpostimages{{ session() -> get('PersonID') }}" name="addnewpostimages{{ session() -> get('PersonID') }}[]" type="file" accept="image/*, video/*, audio/*" multiple>
			  <br><br>
			  <div class="clearfix1 float-right">
				<button type="button" class="btn btn-secondary" onclick="document.getElementById('newPostModal').style.display='none'">Close</button>
				<button type="submit" class="btn btn-primary">Add</button>
			  </div>
			</div>			  
		  </form>
		</div>
		@foreach ($posts as $post)
			@include('singlepost')
		@endforeach
	</div>
	<div id="changeProfilePic" class="modal1">
		  <span onclick="document.getElementById('changeProfilePic').style.display='none'" class="close1" title="Close Modal">&times;</span>
		  <form class="modal-content1 h-26" action="/changeprofilepic" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="container1">
			  <h2 class="float-left">Choose a new profile picture</h2>
			  <br><br>
			  <input class="float-left" id="choosenewprofilepic" name="choosenewprofilepic" type="file" accept="image/png, image/jpeg, image/apng, image/gif, image/ico, image/svg, image/cur, image/jpg, image/jfif, image/pjpeg, image/pjp">
			  <br><br>
			  <div class="clearfix1 float-right">
				<button type="button" class="btn btn-secondary" onclick="document.getElementById('changeProfilePic').style.display='none'">Close</button>
				<button type="submit" class="btn btn-primary">Change</button>
			  </div>
			</div>			  
		  </form>
		</div>
	<div id="changeCoverPic" class="modal1">
		  <span onclick="document.getElementById('changeCoverPic').style.display='none'" class="close1" title="Close Modal">&times;</span>
		  <form class="modal-content1 h-26" action="/changecoverpic" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="container1">
			  <h2 class="float-left">Choose a new cover picture</h2>
			  <br><br>
			  <input class="float-left" id="choosenewcoverpic" name="choosenewcoverpic" type="file" accept="image/png, image/jpeg, image/apng, image/gif, image/ico, image/svg, image/cur, image/jpg, image/jfif, image/pjpeg, image/pjp">
			  <br><br>
			  <div class="clearfix1 float-right">
				<button type="button" class="btn btn-secondary" onclick="document.getElementById('changeCoverPic').style.display='none'">Close</button>
				<button type="submit" class="btn btn-primary">Change</button>
			  </div>
			</div>			  
		  </form>
		</div>
@stop