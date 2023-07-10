@extends('index')
@extends('leftpane')

@section('search')
	<div class="bg-primary border-radius-5 p-2 w-100">
		<table class="friendlist w-100">
			<tbody>
				@foreach ($searchresults as $result)
					<tr class="friendlistrow" data-href="profile.php">
						<td id="likecommentimage" class='w-10'>
							<img src="{{ asset('/content/'.$result -> ProfilePic) }}" class="listprofilephoto">
						</td>
						<td>
							<b style="font-size: 20px;">{{ $result -> FirstName }} {{ $result -> LastName }}</b>
							<br>
							<a href="/profile/{{ $result -> Username }}" style="font-size: 17px; text-decoration: none; color: black;">{{ $result -> Username }}</a>
						</td>
						<td>
							<div id="FriendManagement{{ $result -> PersonID }}">
								@if ($result -> requeststate == "Friends")
									<button type="button" class="btn btn-danger float-right" onclick="unfriend('{{ $result -> PersonID }}')"><i class="fa fa-user-times fa-lg" aria-hidden="true"></i></button>
								@elseif ($result -> requeststate == "Invited by me")
									<button type="button" class="btn btn-danger float-right" onclick="cancelRequest('{{ $result -> PersonID }}')"><i class="fa fa-ban fa-lg" aria-hidden="true"></i></button>
								@elseif ($result -> requeststate == "I was invited")
									<button type="button" class="btn btn-success float-right" onclick="acceptRequest('{{ $result -> PersonID }}')"><i class="fa fa-check fa-lg" aria-hidden="true"></i></button>
									<a class="float-right">&nbsp</a>
									<button type="button" class="btn btn-danger float-right" onclick="rejectRequest('{{ $result -> PersonID }}')"><i class="fa fa-ban fa-lg" aria-hidden="true"></i></button>
								@else
									<button type="button" class="btn btn-success float-right" onclick="addFriend('{{ $result -> PersonID }}')"><i class="fa fa-user-plus fa-lg"></i></button>
								@endif
								<b class="float-right">{{ $result -> requeststate }}&nbsp&nbsp</b>
							</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		@if (count($searchresults) < 1)
			<h1 class='text-center'>No results found</h1>
		@endif
	</div>
@stop