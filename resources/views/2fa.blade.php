<link rel="stylesheet" type="text/css" href="css/default.css" />
<link rel="stylesheet" type="text/css" href="css/component.css" />
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{ mix('css/app.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ mix('css/default.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ mix('css/component.css') }}" />
	<script src="js/modernizr.custom.js"></script>
	<link rel="icon" type="image/png" href="{{ asset('/images/app-logo.png') }}">

</head>

<body class="bg-dark">
	<center>
		<div class="container">
			<div class="main">
				<ul id="bk-list" class="bk-list clearfix">
					<li style="z-index: 1;">
						<div class="bk-book book-1 bk-viewinside">
							<div class="bk-front">
								<div class="bk-cover-back"></div>
								<div class="bk-cover">
									<h2>
										<span>Two Factor Authentication</span>
										<div class="divider"></div>
										<span>Logging you in</span>
									</h2>
								</div>
							</div>
							<div class="bk-page">
								<div class="bk-content bk-content-current">
									<form method="POST" action="{{ route('2fa.post') }}">
										@csrf

										<p style>We sent code to email:</p>
										<p style="font-size: 30px;font-weight: bolder;text-align:center">{{ substr(auth()->user()->email, 0, 5) . '******' . substr(auth()->user()->email,  -2) }}</p>

										@if ($message = Session::get('success'))
										<div class="row">
											<div class="col-md-12">
												<div class="alert alert-success alert-block">
													<strong>{{ $message }}</strong>
												</div>
											</div>
										</div>
										@endif

										@if ($message = Session::get('error'))
										<strong>{{ $message }}</strong>
										@endif

										<div class="inputs">
											<label for="code" class="label">Enter code below</label>
											<input id="code" type="number" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code" autofocus>

											@error('code')
											<span>
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="buttons">
											<a class="bk-bookback" href="{{ route('2fa.resend') }}">Resend Code</a>
											<button type="submit" class="bk-bookview bk-active submit">Submit</button>
										</div>
									</form>
								</div>
							</div>
							<div class="bk-back">
								<h2>
									<span>Equinox Hub</span>
									<div class="divider"></div>
									<span>Resending Code</span>
								</h2>
							</div>
							<div class="bk-right"></div>
							<div class="bk-left"></div>
							<div class="bk-top"></div>
							<div class="bk-bottom"></div>
						</div>
					</li>
				</ul>
			</div>
		</div><!-- /container -->
	</center>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="js/books1.js"></script>
	<script>
		$(function() {
			Books.init();
		});
	</script>
</body>

</html>