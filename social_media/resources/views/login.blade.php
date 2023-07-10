<html>
	<head>
		<title>Log in</title>
		<link rel="stylesheet" href="{{ asset('css/login.css') }}">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
			
		<form method="post">
			@csrf
			<div>
				<h1>Log in</h1>
				<p>Please fill in this form to log in to your account.</p>
				<hr>
				<input class="email" type="email" placeholder="Your Email" name="email" id="email" required value='{{ $email ?? '' }}'>	
				<br>
				<input class="password" type="password" placeholder="Enter Password" name="password" id="psw" required value='{{ $password ?? '' }}'>
				<hr>
				<span class="error">{{ $error ?? ''}}</span>
				<br><br>
				<button type="submit" class="registerbtn" name="submit" value="Submit" formmethod="post">Log in</button>
								
				<p>Don't have an account? <a href="/register">Register</a>.</p>

			</div>
		</form>
	</body>
</html>