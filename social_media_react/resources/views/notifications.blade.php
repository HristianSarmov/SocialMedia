@extends('index')
@extends('leftpane')

@section('notifications')
	<link href="{{ asset('css/notifications.css') }}" rel="stylesheet">
	
	<div class="bg-primary border-radius-5 p-2">
		@foreach($notifications as $notification)
		<div class="bg-primary row">
			@if ($notification -> NotificationType === 'newRequest')
				<div class="card card-body position-relative col-10 bg-primary">
					<div class='d-flex'>
				  <img src="{{ asset('content/'.$notification -> ProfilePic) }}" class="listprofilephoto flex-shrink-0 me-3" alt="...">&nbsp&nbsp&nbsp&nbsp
				  <div>
					<b class="mt-0" style='font-size: 20px;'>{{ $notification -> FirstName }} {{ $notification -> LastName }}</b>
					<br>
					<a href="/profile/{{ $notification -> Username }}" class="stretched-link" style='text-decoration: none; color: #000;'>{{ $notification -> Username }}</a>
					<br>
					<b style='font-size: 12px;'>{{ $notification -> DateAndTime }}</b>
				  </div>
				  <a>Has sent you a friend request.</a>
					</div>
				</div>
				<div class='col-2' id='FriendManagement{{ $notification -> PersonID1 }}'>
				  <button type="button" class="btn btn-success float-right" onclick="acceptRequest('{{ $notification -> PersonID1 }}')"><i class="fa fa-check fa-lg" aria-hidden="true"></i></button>
				  <a class="float-right">&nbsp</a>
				  <button type="button" class="btn btn-danger float-right" onclick="rejectRequest('{{ $notification -> PersonID1 }}')"><i class="fa fa-ban fa-lg" aria-hidden="true"></i></button>
				  <b class="float-right">I was invited&nbsp&nbsp</b>
				</div>
			@elseif ($notification -> NotificationType === 'acceptedRequest')
				<div class="card card-body position-relative col-10 bg-primary">
					<div class='d-flex'>
				  <img src="{{ asset('content/'.$notification -> ProfilePic) }}" class="listprofilephoto flex-shrink-0 me-3" alt="...">&nbsp&nbsp&nbsp&nbsp
				  <div>
					<b class="mt-0" style='font-size: 20px;'>{{ $notification -> FirstName }} {{ $notification -> LastName }}</b>
					<br>
					<a href="/profile/{{ $notification -> Username }}" class="stretched-link" style='text-decoration: none; color: #000;'>{{ $notification -> Username }}</a>
					<br>
					<b style='font-size: 12px;'>{{ $notification -> DateAndTime }}</b>
				  </div>
				  <a>Has accepted your friend request.</a>
					</div>
				</div>
				<div class='col-2' id='FriendManagement{{ $notification -> PersonID2 }}'>
				  <button type="button" class="btn btn-danger float-right" onclick="unfriend('{{ $notification -> PersonID2 }}')"><i class="fa fa-user-times fa-lg" aria-hidden="true"></i></button>
				  <b class="float-right">Friends&nbsp&nbsp</b>
				</div>
			@elseif ($notification -> NotificationType === 'newCommentsRequest')
				<div class="card card-body position-relative bg-primary">
					<b style='font-size: 12px;'>{{ $notification -> lastCommentDate }}&nbsp&nbsp&nbsp&nbsp</b>
					<br>
					@if ($notification -> amountOfComments === 1)
						<a href="/notificationpost/{{ $notification -> PostID }}/comment" class="stretched-link" style='text-decoration: none; color: #000;'>{{ $notification -> amountOfComments }} person commented on your post.</a>
					@else
						<a href="/notificationpost/{{ $notification -> PostID }}/comment" class="stretched-link" style='text-decoration: none; color: #000;'>{{ $notification -> amountOfComments }} people commented on your post.</a>
					@endif
				</div>
			@else 
				<div class="card card-body position-relative bg-primary">
					<b style='font-size: 12px;'>{{ $notification -> lastLikeDate }}&nbsp&nbsp&nbsp&nbsp</b>
					<br>
					@if ($notification -> amountOfLikes === 1)
						<a href="/notificationpost/{{ $notification -> PostID }}/like" class="stretched-link" style='text-decoration: none; color: #000;'>{{ $notification -> amountOfLikes }} person liked your post.</a>
					@else
						<a href="/notificationpost/{{ $notification -> PostID }}/like" class="stretched-link" style='text-decoration: none; color: #000;'>{{ $notification -> amountOfLikes }} people liked your post.</a>
					@endif
				</div>
			@endif
		</div>
		@endforeach
	</div>
@stop