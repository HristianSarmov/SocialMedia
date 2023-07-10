
@section('leftpane')
	<div id="aaa" class="tab-content bg-primary border-radius-5 mr-0">
		<div id="profile" class="fade">
			<div id="Profile" class="tabcontent">
				<img src="{{ asset('content/'.$mydata[0] -> CoverPic) }}" class="coverphoto">
				<img src="{{ asset('content/'.$mydata[0] -> ProfilePic) }}" class="profilephoto">
				<button type="button" class="editprofilebutton" onclick="location.href='/profile/{{ $mydata[0] -> Username}}';">Edit profile</button>
				<table borderstyle="dashed" class="userinfo">
					<tbody>
						@foreach ($mydata as $data)
							<tr class="friendlistrow">
								<td>Name: {{ $data -> FirstName }} {{ $data -> LastName }} </td>
							</tr>
							<tr class="friendlistrow">
								<td>Username: {{ $data -> Username }} </td>
							</tr>
							<tr class="friendlistrow">
								<td>Email: {{ $data -> Email }}</td>
							</tr>
							<tr class="friendlistrow">
								<td>Gender: {{ $data -> Gender }}</td>
							</tr>
							<tr class="friendlistrow">
								<td>Birthday: {{ $data -> DateOfBirth }}</td>
							</tr>
							<tr class="friendlistrow">
								<td>Relationship status: {{ $data -> RelationshipStatus }}</td>
							</tr>
							<tr class="friendlistrow">
								<td>Bio: {{ $data -> Bio }}</td>
							</tr>
							<tr class="friendlistrow">
								<td>Workplace: {{ $data -> Workplace }}</td>
							</tr>
							<tr class="friendlistrow">
								<td>Education: {{ $data -> Education }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>

			</div>
		</div>
		<div id="friends" class="fade">
			<h1>Friends list</h1>
			<table>
				@foreach ($friends as $friend)
				<tr class="friendlistrow" data-href="profile.php">
					<td id="likecommentimage">
						<img src="{{ asset('content/'.$friend -> ProfilePic) }}" class="listprofilephoto">
					</td>
					<td>
						<b style="font-size: 20px;">{{ $friend -> FirstName }} {{ $friend -> LastName }}</b>
						<br>
						<a href="/profile/{{ $friend -> Username }}" style="font-size: 17px; text-decoration: none; color: black;">{{ $friend -> Username }}</a>
					</td>
				</tr>
				@endforeach
			</table>
		</div>
		<div id="search" class="fade">
			<div id="Search" class="tabcontent">
			<form method="POST" action='/search'>
				@csrf
				<table border="0" style="">
					<tr>
						<td><input type="text" name="search" value="" class="search"/></td>
						<td><button type="submit" class="searchbutton"><i class="fa fa-search"> Search</i></button></td>
					</tr>
				</table>
				<p></p>
				<table border="0">
					<tr>
						<td><input type="checkbox" name="Username" value="Username" checked="checked" />Username</td>
						<td><input type="checkbox" name="Email" value="Email" />Email</td>
					</tr>
					<tr>
						<td><input type="checkbox" name="FirstName" value="FirstName" />First name</td>
						<td><input type="checkbox" name="LastName" value="LastName" />Last name</td>
					</tr>
				</table>
			</form>
			</div>
		</div>
	</div>
@stop