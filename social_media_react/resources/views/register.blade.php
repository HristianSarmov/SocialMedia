<html>
	<head> 
		<link href="{{ asset('css/register.css') }}" rel="stylesheet">
		<title>Create an account</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
    <body>
		<form method="post">
			@csrf
			<div>
				<h1>Register</h1>
				<p>Please fill in this form to create your account.</p>
				<hr>
				<div>
					<input class="names" type="text" placeholder="First name" name="firstname" id="firstname" value="{{ $firstname ?? '' }}" required>
					<input class="names" type="text" placeholder="Last name" name="lastname" id="lastname" value="{{ $lastname ?? '' }}" required>
				</div>
				<input class="email" type="email" placeholder="Your Email" name="email" id="email" value="{{ $email ?? '' }}" required>	
				<br>
				<input class="username" type="text" placeholder="Enter Username" name="username" id="username" value="{{ $username ?? '' }}" required>
				<br>								
				<div>
					<input class="password" type="password" placeholder="Enter Password" name="password" id="psw" value="{{ $password ?? '' }}" required>
					<input class="password" type="password" placeholder="Repeat Password" name="password-repeat" id="psw-repeat" value="{{ $repeatpassword ?? '' }}" required>
				</div>
				<div class="dateofbirthANDgender">
					<input class="dateofbirth" type="date" name="dateofbirth" id="dateofbirth">
					<input type="radio" name="gender" id="male" checked value="Male">Male
					<input type="radio" name="gender" id="female" value="Female">Female
				</div>
				<hr>

				<span class="error">{{ $error ?? '' }}</span>
				<br><br>
				
				<button type="submit" class="registerbtn" name="submit" value="Submit" formmethod="post">Register</button>
								
				<p>Already have an account? <a href="/login" id="reglogin">Log in</a>.</p>

			</div>
		</form>
    </body>
</html>