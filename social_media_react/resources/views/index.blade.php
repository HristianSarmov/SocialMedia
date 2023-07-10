<html>
	<head>
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
		<link href="{{ asset('css/mycss.css') }}" rel="stylesheet">
		<script src="{{ asset('/js/app.js') }}" defer></script>
		<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="{{ asset('js/Emoji-textarea') }}" defer></script>
		<script src="{{ asset('js/myJS.js') }}" defer></script>
	</head>
	<header>
		  
	</header>
	<body class="bg-secondary-nav">
		<ul class="nav nav-tabs fixed-top bg-secondary-nav">
			<li class="nav-item" id="showProfile" value="profile"><a class="nav-link" data-toggle="tab" href="#profile">Profile</a></li>
			<li class="nav-item" id="showFriends" value="friends"><a class="nav-link" data-toggle="tab" href="#friends">Friends</a></li>
			<li class="nav-item" id="showSearch" value="search"><a class="nav-link" data-toggle="tab" href="#search">Search</a></li>
			<span id="currentpost" value=""></span>
			<span id="action" value=""></span>
			<span id="session" value="{{ session() -> get('PersonID') }}"></span>
		</ul>
		  <ul class="nav nav-tabs fixed-top-float-right bg-secondary-nav">
			<li class="nav-item"><button class="nav-link" onclick="location.href = '/post';">Home</button></li>
			<li class="nav-item"><button class="nav-link" onclick="location.href = '/notifications';">Notifications</button></li>
			<li class="nav-item"><a class="nav-link" href='/login'>Logout</a></li>
		  </ul>
				<div class="left">
					@yield('leftpane')
				</div>
				<div class="right">
					@yield($rightpane)
				</div>
		<div id="emojidiv"></div>
	</body>
</html>