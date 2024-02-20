<!DOCTYPE HTML>

<html>
	<head>
		<title>WYtańcz</title>
		<link rel="icon" type="image/x-icon" href="{{ asset('storage/css/images/icon.png') }}">
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="{{asset('storage/css/main.css')}}" /> 	
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
		
	</head>
	<body class="is-preload">
		<div id="wrapper">
			<div id="bg"></div>
			<div id="overlay"></div>
			<div id="main">

				<!-- Header -->
					<header id="header">
						<h1>WYtańcz</h1>
						<p>Mistrzostwa Polski &nbsp;&bull;&nbsp; Liga &nbsp;&bull;&nbsp; Konkursy ogólnopolskie</p>
						<nav>
							
							<li><a href="{{url('welcome')}}" class="fa fa-home"><span class="label">Email</span></a></li>
							<ul>
								<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
								<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
								<li><a href="#" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
							</ul>
						</nav>
					</header>

				<!-- Footer -->
					<footer id="footer">
						<span class="copyright">&copy; Untitled. Design: Kaja Nowicka.</span>
					</footer>

			</div>
		</div>
		<script>
			window.onload = function() { document.body.classList.remove('is-preload'); }
			window.ontouchmove = function() { return false; }
			window.onorientationchange = function() { document.body.scrollTop = 0; }
		</script>
	</body>
</html>